<?php
session_start();
 include("con_db.php");
 global $db;
 if (!isset($_SESSION['user'])) {
     header("Location: ../index.php");
     die();     
}


 $user = $_SESSION['user'];
//$db->debug=1;
error_reporting(E_ALL);
ini_set('display_errors', 1);

    if (!VToken::checkT(trim($_POST['_token']))) {
    echo "<i class='icon fas fa-exclamation-triangle'></i>InvalidRequest";
    exit();
  }

 function cleanDataHtml(&$value, $key)
  {
    $value = safehtml($value);
  }

$curDT = $db->GetOne("select current_timestamp");
unset($_POST['_token']);

  if (isset($_POST['btnSaveSaccoUsers'])) {
 
  $ReturnType = isset($_POST['ReturnType']) ? "RstID" : "Message";
  $ModCode = isset($_POST['ModCode']) ? $_POST['ModCode'] : "";
  $tableName = "tbl_saccousers";
  
  
     unset($_POST['ReturnType']);
     unset($_POST['ModCode']);
     array_pop($_POST);
     
    /*  echo "<pre>";
     print_r($_POST);
     exit();
*/
     $SaccoCode = safehtml($_POST['SaccoCode']);
     $PhoneNo = safehtml($_POST['PhoneNo']);
     $UserRole = safehtml($_POST['UserRole']);
     $FirstName = safehtml($_POST['FirstName']);
     
   $SaccoName = $db->GetOne("select SaccoName from tbl_sacco where SaccoCode ='$SaccoCode'");
    $CheckExist = $db->GetOne("select S_ROWID from $tableName where PhoneNo ='$PhoneNo' and SaccoCode='$SaccoCode'");
        if ($CheckExist !="") {
          echo "Similar User PhoneNo :- $PhoneNo. \n Already Exist, Please try Again";
          exit();
        }
      
     

      array_walk($_POST,"cleanDataHtml");

       $MetaTypes = metatype($tableName);
    foreach ($_POST as $column => $value) {
      $value = is_array($value) ? implode(',', $value) : $value;
    $record[$column] = checkDT($value,$MetaTypes[$column]);
    }

          $randompswd = mt_rand(10000,99999);
          $record["UserPswd"] =  md5($randompswd.$SaccoCode.'GodFirst'.$PhoneNo);
          $record["UserStatus"] = "Active";
       
       $record["CreatedBy"] = $user;
       $record["DateCreated"] = $curDT;
       $table  = $tableName;
       $action = "INSERT";
       $db->AutoExecute($table,$record,$action);
       //$log->write($log->makesql($table,$record,$action));
         $S_ROWID = getID($tableName)-1;
        if ($db) {
         $RolesAllowed = array("SaccoAdmin","SaccoAuditor");
            if (in_array($record["UserRole"], $RolesAllowed)) {
              $exec = $db->Execute("insert into listitems (CreatedBy,ItemType,ItemCode,ItemDescription) values ('$user','SaccoRoleUser','$UserRole','$S_ROWID')");
            }
     
        
          $Msg = "<#> Hi $FirstName welcome to DalaPay,your account has been created under $SaccoName as a $UserRole.Your passcode is $randompswd \n.Download app via https://tinyurl.com/y9qw7j2y";
      $recSMS["MsgBody"]    = $Msg;
      $recSMS["MsgType"] = "SMS";
      $recSMS["CreatedBy"] = $user;
      $recSMS["MsgRecipient"] = "+".$PhoneNo;
      $rs->AddAlert($recSMS);
     $S_ROWID = $db->GetOne("select max(S_ROWID) from $tableName");

        if ($ReturnType == "RstID") {
          echo $S_ROWID;
        }
        else
        {
          echo "Record Saved Successfully";
        }
        logAction($S_ROWID,$tableName,$user,$action,$record,$ModCode);
        }
        else
        {
          echo "Error in saving Record reason because :".$db->ErrorMsg();
        }
 }


 if (isset($_POST['btnUpdateSaccoUsers'])) {
    $tableName = "tbl_saccousers";
    $MetaColumns = $db->MetaColumns($tableName);
    foreach ($MetaColumns as $key => $val) {
       $MetaType[$val->name] = $val->type;
    }

    $ModCode = isset($_POST['ModCode']) ? $_POST['ModCode'] : "";
    $ReturnType = isset($_POST['ReturnType']) ? "RstID" : "Message";
    
  
     array_pop($_POST);

     $S_ROWID = $_POST['S_ROWID'];
     unset($_POST['S_ROWID']);
      unset($_POST['ReturnType']);
      unset($_POST['ModCode']);
      array_walk($_POST,"cleanDataHtml");
     foreach ($_POST as $ckey => $cval) {
       $cval = is_array($cval) ? implode(',', $cval) : $cval;
       $_POST[$ckey] = $cval;
     }
      
    $auditLog = doAuditLog($_POST,$S_ROWID,$tableName);
    $record   = $auditLog[0];
    $LogChanges = $auditLog[1];

     $arg = array_filter($record);

     if (empty($arg)) {
       echo "No Change to Update";
       exit();
     }

       $record["ModifiedBy"] = $user;
       $record["DateModified"] = $db->GetOne("select current_timestamp");
       $criteria = "S_ROWID = '$S_ROWID'";
       $table  = $tableName;
       $action = "UPDATE";
       $db->AutoExecute($table,$record,$action,$criteria);
       
        if ($db) {
          $execDel = $db->Execute("delete from listitems where ItemType='SaccoRoleUser' and ItemDescription='$S_ROWID'");
          $RolesAllowed = array("SaccoAdmin","SaccoAuditor");
            if (in_array($record["UserRole"], $RolesAllowed)) {
              
              $UserRole = $record["UserRole"];
              $exec = $db->Execute("insert into listitems (CreatedBy,ItemType,ItemCode,ItemDescription) values ('$user','SaccoRoleUser','$UserRole','$S_ROWID')");
            }
        
         if ($ReturnType == "RstID") {
          echo $S_ROWID;
        }
        else
        {
          echo "Record Saved Successfully";
        }
        logAction($S_ROWID,$tableName,$user,$action,$LogChanges,$ModCode);
        }
        else
        {
          echo "Error in saving Record reason because :".$db->ErrorMsg();
        }
 }

?>