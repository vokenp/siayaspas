<?php
session_start();
include("assets/bin/con_db.php");
global $db;
 //$db->debug=1;
   if (!isset($_SESSION["exportParams"])) {
     exit();
   }
  $Params  = $_SESSION["exportParams"];
  $modCode = $Params["modCode"];
  $qrysmt  = $Params["wheresmt"];


  $MView = $rs->getDataTblView($modCode);
  $cols =  $MView["ViewCols"];
  $tableName = $MView["ModInfo"]["TableName"];
  $ModuleName = $MView["ModInfo"]["ModuleName"];

   function cleanData(&$value, $key)
  {
    $value = str_replace(array("\r\n", "\r", "\n", "\t"), ' ', $value);
  }
 
  $csv = "";
  $filename = $ModuleName."- Export".date('Ymd-Hms') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

   
  $getdata = $db->Execute("select *from $tableName $qrysmt");
    array_shift($cols);
    $csv .= implode("\t", array_values($cols)) . "\r\n";
       $i = 0;
      while (!$getdata->EOF) {
          $rst = array();
          $rst = $getdata->fields;
          $data = array();

          foreach ($cols as $key => $val) {
            $data[] = $rst[$val];
          }

           array_walk($data,"cleanData");
      $csv .= implode("\t", array_values($data)) . "\r\n";
        $getdata->MOveNext();
      }
    
    echo $csv;

   ?>