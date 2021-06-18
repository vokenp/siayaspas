<?php
 include("con_db.php");
global $db;
//$db->debug=1;

   if (isset($_POST['getFaresChart'])) {
   	 $SaccoCode = safehtml($_POST['getFaresChart']);
   	 $getfares = $db->GetArray("select * from vw_saccoroutes where time(current_timestamp) between StartTime and EndTime and SaccoCode='$SaccoCode' order by EndTime");
   	   $html ="<table class='table table-striped table-valign-middle'>";
   	   $html .= "<thead><tr>";
   	   $html .= "<th>Route Name</th>";
   	   $html .= "<th>Time Span</th>";
   	   $html .= "<th>Fare</th>";
   	   $html .= "</tr></thead>";
   	   $html .= "<tbody>";
         $color = array("badge-danger","badge-info","badge-success","badge-warning","badge-primary");
       foreach ($getfares as $key => $val) {
          $bgColor = array_rand($color);
         $StartTime = date('g:i A',strtotime($val["StartTime"]));
         $EndTime = date('g:i A',strtotime($val["EndTime"]));
         $html .= "<tr>";
           $html .= "<td>".$val["RouteName"]."</td>";
           $html .= "<td>".$StartTime." <i class='fa fa-arrow-alt-circle-right'></i> ".$EndTime."</td>";
           $html .= "<td><span class='badge $color[$bgColor]' style='font-size:12px;'> ".pesa($val["MaxFare"])."</span></td>";
            $html .= "</tr>";
       }

   	   $html .= "</tbody></table>";
   	    echo $html;
   }

?>