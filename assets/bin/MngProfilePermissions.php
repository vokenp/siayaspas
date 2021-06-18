<?php
include("../timeout.php");
include("con_db.php");
global $db;
//$db->debug=1;
$user = $_SESSION['user'];
//$db->debug=1;



error_reporting(E_ALL);
ini_set('display_errors', 1);
   if (isset($_POST['ModOperation'])) {   
    $ProfileID = $_POST['S_ROWID'];
    $rec = array();
    $tableName = "dh_userprofiles";
     
      $exec = $db->Execute("delete from dh_profilepermissions where ProfileID='$ProfileID'");
       foreach ($_POST['ModOperation'] as $key => $Perval)
      {
          foreach ($Perval as $pkey => $pval) {
          $record = array();
            $record["CreatedBy"] = "admin";
            $record["ModCode"] = $key;
            $record["ProfileID"] = $_POST['S_ROWID'];
            $record["ModOperation"] = $pkey;
            $record["IsAllowed"] = $pval;

            $table  = "dh_profilepermissions";
            $action = "INSERT";
            $db->AutoExecute($table,$record,$action);
           } 
       }
       //$rs->SetValues($rec,$_POST['S_ROWID'],$tableName,$user,$_POST['ModCode']);
   }
?>