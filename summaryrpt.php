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
           $tamt = 0;
           $tMeeting = 0;

          foreach ($weekDates as $wkey => $wvals) {
              $tamt += $wvals["PayOutAmount"];
              $tMeeting += 1;
          }
    $Payment = array();
    $Payment["TotalMeetings"] =  $tMeeting;
    $Payment["ExtraMeetings"] = 0;
    $Payment["GrossPay"] = $tamt;
     $Payment["AmountPayable"] = $Payment["GrossPay"];

            $grandTotal["TotalMeetings"] += $Payment["TotalMeetings"];
            $grandTotal["ExtraMeetings"] += $Payment["ExtraMeetings"];
            $grandTotal["GrossPay"] += $Payment["GrossPay"];
            $grandTotal["AmountPayable"] += $Payment["AmountPayable"];

  $Wlist["Week#$key (".date('d-m-Y',strtotime($weekVals["week_start"]))." to ".date('d-m-Y',strtotime($weekVals["week_end"])).")"] = $Payment;
}
  $param = $rptYear."_".$MemID."_".$mwezi;
   $Wlist["GrandTotal"] = $grandTotal;
   $Wlist["ReportPath"] = $url."/summaryrpt.php/?q=$param";


   $html = "";
    $GrandTT = $grandTotal;
    $html .="<p style='v-align:center;'> <img src='assets/images/logo.png'></p>";
    $html .="<p style='v-align:center;'><h2>Summarized Attendance Report</h2></p>";

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


       $html .= "<table class='gridtable' width='99%'>";
          
          $html .= "<thead>";
          $html .= "<tr>";
          $html .= "<th>Period</th>";
          $html .= "<th>Total Meetings</th>";
           $html .= "<th>Extra Meetings</th>";
          $html .= "<th>Gross Pay</th>";
          $html .= "<th>AmountPayable</th>";
          $html .= "</tr>";
          $html .= "</thead>";
          $html .= "<tbody>";
          $wksTotal = 0;
          $i = 0;
     
      foreach ($Wlist as $skey => $Wevals) {
       if ($skey == "GrandTotal" || $skey == "ReportPath") {
         continue;
       }
         
         $html .= "<tr>";
         $html .= "<td style='background: #f2efef;'>".$skey."</td>";
         $html .= "<td>".$Wevals["TotalMeetings"]."</td>";
         $html .= "<td>".$Wevals["ExtraMeetings"]."</td>";
         $html .= "<td>".$Wevals["GrossPay"]."</td>";
         $html .= "<td>".$Wevals["AmountPayable"]."</td>";
         $html .= "</tr>";
         $wksTotal += $Wevals["AmountPayable"];
  
    
   }

    $html .= "</tbody>";
        $html .= "<tfoot>";
          $html .= "<tr>";
          $html .= "<th colspan='4'>Total</th>";
          $html .= "<th>".pesa($wksTotal)."</th>";
          $html .= "</tr>";
          $html .= "</tfoot>";
       $html .= "</table>";


   $mpdf->WriteHTML($html);
      // Set a simple Footer including the page number

    //$mpdf->setFooter("Generated by Kevin on $dateCreated");
 $mpdf->Output("summaryrpt-".date('ymdhms')."_".date('Y-M',strtotime($rptYear."-".$rptMonth)).".pdf", "D");   
//$mpdf->Output();


  ?>