<?php  
include("../assets/bin/con_db.php");
global $db;
//$db->debug=1;
    echo "<pre>";
    error_reporting(E_ALL);
ini_set('display_errors', 1);

$tableName = filter_input(INPUT_GET, "tbl");
$getData = $db->Execute("select *from $tableName ");
     while (!$getData->EOF) {
      $rst = array();
      $rst = $getData->fields;
        $S_ROWID = $rst["S_ROWID"];
        unset($rst["S_ROWID"]);
      // unset($rst["DateCreated"]);
      // unset($rst["DateModified"]);
       //$criteria = "S_ROWID = '$S_ROWID' ";
       $table  = $tableName;
       $action = "INSERT";
    echo $log->makesql($table,$rst,$action).";<br>";
    //echo  ElementStorage($S_ROWID);
       $getData->MoveNext();
     }
?>