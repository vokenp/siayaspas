<?php
include("../timeout.php");
 include("con_db.php");
 global $db;
 if (!isset($_SESSION['user'])) {
     header("Location: ../index.php");
     die();     
}
//$db->debug=1;
 $user = $_SESSION['user'];
  if (isset($_POST['btnSaveRecord'])) {
    $confType = safehtml($_POST['btnSaveRecord']);
      array_pop($_POST);
  
  	switch ($confType) {
  		case 'AssetPath':
  			$AssetPath = $_POST['AssetPath'];
  			if (!dir($AssetPath)) {
  		   echo "Invalid Path. Enter a Valid Asset Path";
  		   exit();
  			}
      $Update = $db->Execute("update appconfigs set confValue='$AssetPath' where confType='AssetPath' ");
       echo "Record Saved Successfully";
      
  			break;
  		
  		default:
  			foreach ($_POST as $fld => $value) {
          $record = array();
       $record["confValue"] = $value;
       $record["ModifiedBy"] = $user;
       $record["DateModified"] = $db->GetOne("select current_timestamp");
       $criteria = "confName='$fld'";
       $table  = "appconfigs";
       $action = "UPDATE";
       $db->AutoExecute($table,$record,$action,$criteria);
        }
        echo "Record Save Successfully";
  			break;
  	}
  }
 ?>