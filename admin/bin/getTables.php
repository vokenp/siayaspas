<?php 
include("../../timeout.php");
 include("../../assets/bin/con_db.php");
global $db;
//$db->debug=1;

$Tables = $db->metaTables('TABLES');
$Views = $db->metaTables('VIEWS');
$TableList1 = array_merge($Tables,$Views);
 
    $getTbls = $db->GetArray("select ItemCode from listitems where ItemType='SystemTables'");
    $SysTbls = array();
   foreach ($getTbls as $key => $tblName) {
    $SysTbls[] = $tblName["ItemCode"];
   }
    $TableList = array_diff($TableList1, $SysTbls);

   $count = count($TableList);
   $recdata = array();

  $Order = $_POST['order'];
  $OrderColumn = $Viewcols[$Order[0]["column"]];
  $OrderDire = $Order[0]["dir"];

   if ($OrderDire == "asc") {
     asort($TableList);
   }else
   {
    arsort($TableList);
   }
  $k = 0;
  foreach ($TableList as $key => $TblName) {
    
   $record = array();
   $k += 1;
   $record[] = $k;
   $link = "<a href='#' onclick='OpenTblDef(\"$TblName\"); return false;'>$TblName</a>";
   $record[] = $link;
   $recdata[] = $record;
  }
 
   $array = array();
   $array["draw"] = $_POST['draw'];
   $array["recordsTotal"] = $count;
   $array["recordsFiltered"] = $count;
   $array["data"] =  $recdata;
   echo json_encode($array);
?>