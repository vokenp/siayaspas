<?php
  include("../../timeout.php");
 include("../../assets/bin/con_db.php");
 global $db;
 if (!isset($_SESSION['user'])) {
     header("Location: ../index.php");
     die();     
}
 $user = $_SESSION['user'];
//$db->debug=1;
  // Add New client
 if (isset($_POST['btnSaveRecord'])) {
 	$tableName = safehtml($_POST['btnSaveRecord']);
     array_pop($_POST);
     $ROWID = getID($tableName);
     $_POST['ModuleCode'] = str_replace(' ','', $_POST['ModuleCode'])."_".$ROWID;
     $ModuleCode = $_POST['ModuleCode'];
      /*echo "<pre>";
     print_r($_POST);
     exit();*/
      
       $MetaTypes = metatype($tableName);
    foreach ($_POST as $column => $value) {
       $record[$column] = checkDT($value,$MetaTypes[$column]);
    }
       $record["CreatedBy"] = $user;
       $table  = $tableName;
       $action = "INSERT";
       $db->AutoExecute($table,$record,$action);
        if ($db) {

  
           
        $S_ROWID = $db->GetOne("select max(S_ROWID) from $tableName");
        echo $S_ROWID; 
        $exec = $db->Execute("insert into listitems (ItemCode,ItemType,ItemDescription) values ('$S_ROWID','ModActions','View')");
        logAction($S_ROWID,$tableName,$user,$action,$record,"999");

        //$log->write($log->makesql($table,$record,$action));
        }
        else
        {
          echo "Error in saving Record reason because :".$db->ErrorMsg();
        }
 }


 // List View
 if (isset($_POST['btnlistview'])) {
 //$db->debug=1;
   array_pop($_POST);
   $TableName = $_POST['TableName'];
   $ModuleCode = $_POST['ModuleCode'];
   $ListType = $_POST['ListType'];
     if (isset($_POST['showfield'])) {
$delSql = "delete from dh_listview where ModuleCode='$ModuleCode' and TableName='$TableName' and ListType='$ListType'";
$del = $db->Execute($delSql);
     //$log->write($delSql);
      $FieldName = $_POST['FieldName']; 
      $DisplayName = $_POST['DisplayName'];
      $DisplayOrder = $_POST['DisplayOrder']; 
      $searchable = $_POST['searchable'];  
     
      $selected = $_POST['showfield'];
      
        foreach ($selected as $key => $value) {
          $record["FieldName"] = $FieldName[$key];
          $record["DisplayName"] = $DisplayName[$key];
          $record["DisplayOrder"] = $DisplayOrder[$key];
          $record["searchable"] = $searchable[$key];
          $record["TableName"] = $TableName;
          $record["ListType"] = $ListType;
          $record["ModuleCode"] = $ModuleCode;
          $record["CreatedBy"] = $user;

          $table  = "dh_listview";
          $action = "INSERT";
          $db->AutoExecute($table,$record,$action);
           //$log->write($log->makesql($table,$record,$action));
        }
     }
 }

  // List View
 if (isset($_POST['btnlistQuery'])) {
 //$db->debug=1;
   array_pop($_POST);
   $TableName = $_POST['TableName'];
   $ModuleCode = $_POST['ModuleCode'];
   $ListType = $_POST['ListType'];
     if (isset($_POST['showfield'])) {
$delSql = "delete from dh_listquery where ModuleCode='$ModuleCode' and TableName='$TableName' and ListType='$ListType'";
$del = $db->Execute($delSql);
     //$log->write($delSql);
      $FieldName = $_POST['FieldName']; 
      $FilterCondition = $_POST['FilterCondition'];
      $FilterValue = $_POST['FilterValue'];  
     
      $selected = $_POST['showfield'];
      
        foreach ($selected as $key => $value) {
          $record["FieldName"] = $FieldName[$key];
          $record["FilterCondition"] = $FilterCondition[$key];
          $record["FilterValue"] = $FilterValue[$key];
          $record["TableName"] = $TableName;
          $record["ListType"] = $ListType;
          $record["ModuleCode"] = $ModuleCode;
          $record["CreatedBy"] = $user;

          $table  = "dh_listquery";
          $action = "INSERT";
          $db->AutoExecute($table,$record,$action);
           //$log->write($log->makesql($table,$record,$action));
        }
     }
 }
  
 
?>