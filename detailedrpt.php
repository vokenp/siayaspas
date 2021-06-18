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

    $param = filter_input(INPUT_GET, "q");
      list($rptYear,$MemID,$rptMonth) = explode('_', $param);
      
      $MemInfo = $rs->row("committemembers","S_ROWID='$MemID'");
      $MonthWeek = $rs->list_week_days($rptYear, $rptMonth);

   $grandTotal = array();
            $grandTotal["TotalMeetings"] = 0;
            $grandTotal["ExtraMeetings"] = 0;
            $grandTotal["GrossPay"] = 0;
            $grandTotal["AmountPayable]"] = 0;
foreach ($MonthWeek as $key => $weekVals) {
  $key += 1;
    

            $week_start = $weekVals["week_start"];
            $week_end = $weekVals["week_end"];
            
            $weekDates = $db->GetArray("select *from vw_committeeattendance where MeetingDate  between '$week_start' and '$week_end' and MemID='$MemID' ");
            
             $WeekPay = array();
            $arg = array_filter($weekDates);
            if (empty($arg)) {
              $DayPay = array();
                $DayPay["AllowanceDate"] = "";
                $DayPay["Venue"] = "";
                $DayPay["Committee"] = "";
                $DayPay["InAttendancePosition"] = "";
                $DayPay["PayOut"] = "";  
                $WeekPay[] = $DayPay;
            }
            
           foreach ($weekDates as $Wkey => $dVals) {

              if ($grandTotal["TotalMeetings"] == 16) {
                  break;
                } 
              
                  
                $DayPay = array();
                $DayPay["AllowanceDate"] = date('D jS M-Y',strtotime($dVals["MeetingDate"]));
                $DayPay["Venue"] = $dVals["Venue"];
                $DayPay["Committee"] = $dVals["CommitteeName"];
                $DayPay["InAttendancePosition"] = $dVals["InAttendancePosition"];
                $DayPay["PayOut"] = $dVals["PayOutAmount"];

                $grandTotal["TotalMeetings"] += 1;
                $grandTotal["ExtraMeetings"] = 0;
                $grandTotal["GrossPay"] += $DayPay["PayOut"];
                $grandTotal["AmountPayable]"] += $DayPay["PayOut"];
               
                
                $WeekPay[] = $DayPay;
                 
              
              
              
            }


  $Wlist["Week#$key (".date('d-m-Y',strtotime($weekVals["week_start"]))." to ".date('d-m-Y',strtotime($weekVals["week_end"])).")"] = $WeekPay;
}
   $param = $rptYear."_".$MemID."_".$rptMonth;
   $Wlist["GrandTotal"] = $grandTotal;
  

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
 $mpdf->Output("detailedrpt-".date('ymdhms')."_".date('Y-M',strtotime($rptYear."-".$rptMonth)).".pdf", "D");   
//$mpdf->Output();
?>