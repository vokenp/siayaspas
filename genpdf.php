<?php
   include("assets/bin/con_db.php");
   global $db;

    require_once __DIR__ . '/assets/mpdf/vendor/autoload.php';

     error_reporting(E_ALL);
     ini_set('display_errors', 1);
   
  $url = "https://www.kiambuassembly.go.ke/app/";
     $mpdf = new \Mpdf\Mpdf([
    'setAutoTopMargin' => 'stretch',
    'autoMarginPadding' => 5
]);


     $stylesheet = file_get_contents('mpdfstyle.css');
    $mpdf->WriteHTML($stylesheet,1);
  $dateCreated = date('D jS M Y g:i a');

    $mpdf->SetWatermarkImage('assets/images/logo.png');
    $mpdf->showWatermarkImage = true;
    $mpdf->watermarkImageAlpha = 0.1;


      $rptYear  = "2020";
      $rptMonth = "09";
      $MemID = 65;
      $MemInfo = $rs->row("committemembers","S_ROWID='$MemID'");
      $MonthWeek = $rs->list_week_days($rptYear, $rptMonth);

$allawancesRate = array(6500,5200,3900);
  $ExtraRate = array(6500,5200,3900);

  $days2Show = array("Monday","Wednesday","Friday","Saturday","Sunday");

    $RankPayOut = array();
    $RankPayOut["Chairman"] = 6500;
    $RankPayOut["Vice Chairman"] = 5200;
    $RankPayOut["Member"] = 3900;

    $Venues = array("Chambers","Committee Room 1","Committee Room 2","Committee Room 3","Committee Room 4");
    
            $grandTotal = array();
            $grandTotal["TotalMeetings"] = 0;
            $grandTotal["ExtraMeetings"] = 0;
            $grandTotal["GrossPay"] = 0;
            $grandTotal["AmountPayable"] = 0;
foreach ($MonthWeek as $key => $weekVals) {
  $key += 1;
    $AlloIndex = array_rand($allawancesRate);
     $ExtraIndex = array_rand($allawancesRate);

            $weedDates = getDatesFromRange($weekVals["week_start"], $weekVals["week_end"]);
            
            $WeekPay = array();
            foreach ($weedDates as $Wkey => $dateVal) {

              if ($grandTotal["TotalMeetings"] == 16) {
                  break;
                } 
              if (in_array(date('l',strtotime($dateVal)), $days2Show)) {
                  $VenueIndex = array_rand($Venues);
                  $RankIndex = array_rand($RankPayOut);
                $DayPay = array();
                $DayPay["AllowanceDate"] = date('D jS M-Y',strtotime($dateVal));
                $DayPay["Venue"] = $Venues[$VenueIndex];
                $DayPay["InAttendancePosition"] = $RankIndex;
                $DayPay["Committee"] = "Test Committee";
                $DayPay["PayOut"] = $RankPayOut[$RankIndex];

                $grandTotal["TotalMeetings"] += 1;
                $grandTotal["ExtraMeetings"] = 0;
                $grandTotal["GrossPay"] += $DayPay["PayOut"];
                $grandTotal["AmountPayable"] += $DayPay["PayOut"];
               
                
                $WeekPay[] = $DayPay;
                 continue;
              }
              
              
            }


  $Wlist["Week#$key (".date('d-m-Y',strtotime($weekVals["week_start"]))." to ".date('d-m-Y',strtotime($weekVals["week_end"])).")"] = $WeekPay;
}
   $Wlist["GrandTotal"] = $grandTotal;
   $Wlist["ReportPath"] = $url."/assets/StoragePool/tmpreports/test.pdf";
    $html = "";
    $GrandTT = $grandTotal;
    $html .="<p style='v-align:center;'> <img src='assets/images/logo.png'></p>";
    $html .="<p style='v-align:center;'><h2>Detailed Attendance Report</h2></p>";

   $html .= "<table width='100%'>";
   $html .= "<tr><td>";
     $html .= "<table class='gridtable' width='100%'>";
        $html .= "<thead><tr><thead><th colspan='2'>Member Info</th></tr></thead>";
       $html .= "<tr><td style='background: #f2efef;'>Member Name</td><td><b>".$MemInfo["FullName"]."</b></td></tr>";
       $html .= "<tr><td style='background: #f2efef;'>Ward</td><td><b>".$MemInfo["Ward"]."</b></td></tr>";
       $html .= "<tr><td style='background: #f2efef;'>PF No</td><td><b>".$MemInfo["PersonnelNo"]."</b></td></tr>";
       $html .= "<tr><td style='background: #f2efef;'>Period</td><td><b>".date('M Y',strtotime($rptYear."-".$rptMonth))."</b></td></tr>";
       
     $html .= "</table>";
   $html .= "</td>";


    $html .= "<td>";
     $html .= "<table class='gridtable' width='100%'>";
        $html .= "<thead><tr><thead><th colspan='2'>Grand Totals</th></tr></thead>";
       $html .= "<tr><td style='background: #f2efef;'>TotalMeetings</td><td><b>".$GrandTT["TotalMeetings"]."</b></td></tr>";
       $html .= "<tr><td style='background: #f2efef;'>Extra Meetings</td><td><b>".$GrandTT["ExtraMeetings"]."</b></td></tr>";
       $html .= "<tr><td style='background: #f2efef;'>Gross Pay</td><td><b>".pesa($GrandTT["GrossPay"])."</b></td></tr>";
       $html .= "<tr><td style='background: #f2efef;'>Amount Payable</td><td><b>".pesa($GrandTT["AmountPayable"])."</b></td></tr>";
       
     $html .= "</table>";
   $html .= "</td></tr>";

   $html .= "</table>";

    
   foreach ($Wlist as $skey => $Wevals) {
       if ($skey == "GrandTotal" || $skey == "ReportPath") {
         continue;
       }
       
          $html .= "<table class='gridtable' width='99%'>";
          $html .= "<thead><tr><th colspan='5'>$skey</th></tr></thead>";
          $html .= "<thead>";
          $html .= "<tr>";
          $html .= "<th>Date</th>";
          $html .= "<th>Committee</th>";
           $html .= "<th>Venue</th>";
          $html .= "<th>InAttendance As</th>";
          $html .= "<th>PayOut Amount</th>";
          $html .= "</tr>";
          $html .= "</thead>";
          $html .= "<tbody>";
          $wksTotal = 0;
          $i = 0;
       foreach ($Wevals as $wkey => $WkVals) {
       	  $i=$i+1;
	      $crl = $i%2 ? "alt" : "";
         $html .= "<tr class='$crl'>";
         $html .= "<td>".$WkVals["AllowanceDate"]."</td>";
         $html .= "<td>".$WkVals["Committee"]."</td>";
         $html .= "<td>".$WkVals["Venue"]."</td>";
         $html .= "<td>".$WkVals["InAttendancePosition"]."</td>";
         $html .= "<td>".$WkVals["PayOut"]."</td>";
         $html .= "</tr>";
         $wksTotal += $WkVals["PayOut"];
       }
       $html .= "</tbody>";
        $html .= "<tfoot>";
          $html .= "<tr>";
          $html .= "<th colspan='4'>Weeks Total</th>";
          $html .= "<th>".pesa($wksTotal)."</th>";
          $html .= "</tr>";
          $html .= "</tfoot>";
       $html .= "</table>";

    
   }
  


  
   
$mpdf->WriteHTML($html);
      // Set a simple Footer including the page number




    //$mpdf->setFooter("Generated by Kevin on $dateCreated");
 $mpdf->Output($rptYear."_".$rptMonth.".pdf", "D");   
//$mpdf->Output();
?>