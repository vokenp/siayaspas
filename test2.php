
<?php
 include("assets/bin/con_db.php");
  global $db;
  //$db->debug=1;
  echo "<pre>";
  error_reporting(E_ALL);
ini_set('display_errors', 1);

  $getVals = $db->GetArray("SELECT ValueType,SA_ScoreValue,SA_Remarks FROM tbl_section5a where AppraisalID='2'");
  print_r($getVals);
   echo json_encode($getVals);
?>
