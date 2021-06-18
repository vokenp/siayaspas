<?php 
  unset($_GET['sk']);
 $mod = $_GET['mod'];
  $pvals = array();
  foreach ($_GET as $key => $val) {
   $pvals[] = $key.":".$val;
  }
  $postvals = implode(',',$pvals);
  $dateTypes = array('date','timestamp','datetime');
   $modInfo    = $rs->row("dh_modules","S_ROWID = '$mod'");
   //$db->debug=1;
 $ModuleCode = $modInfo["ModuleCode"];
$TableName   = $modInfo["TableName"];
$IsDelete    = $modInfo["DeleteItems"];

$getCols = $db->GetArray("select FieldName,DisplayName from dh_listview where ModuleCode='$ModuleCode'  and ListType='Main' and TableName='$TableName' order by DisplayOrder asc");
    
   $OrderClm = ""; 
    $columns["columns"] = array();
    $columns["columns"][0]["title"] = "Actions";
    $columns["columns"][0]["className"] = "S_ROWID";
    foreach ($getCols as $key => $val) {
      $clmIndex = $key+1;
      $clmName = $val["DisplayName"];
      $OrderClm .= "<option value='$clmIndex'>$clmName</option>";
      $columns["columns"][$key+1]["title"] = $val["DisplayName"];
      $columns["columns"][$key+1]["className"] = $val["FieldName"];
    }
  $Deflist = json_encode($columns); 
  $ColCount = count($getCols)+1;
?>