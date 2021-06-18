<?php
 include("../timeout.php");
include('con_db.php');
global $db;
$user = $_SESSION['user'];

if (!isset($_SESSION['user'])) {
     header("Location: ../index.php");
     die();     
}
//$db->debug=1;

 function cleanDataHtml(&$value, $key)
  {
    $value = safehtml($value);
  }

if (isset($_POST['btnSaveRecord'])) {
  $tableName = safehtml(strtolower($_POST['btnSaveRecord']));
     array_pop($_POST);
     $ReturnType = isset($_POST['ReturnType']) ? "RstID" : "Message";
    $ModCode = isset($_POST['ModCode']) ? $_POST['ModCode'] : "";
  unset($_POST['ReturnType']);
  unset($_POST['ModCode']);
     array_walk($_POST,"cleanDataHtml");
	$loginid = safehtml(trim($_POST['loginid']));
  $Fullname = safehtml(trim($_POST['Fullname']));
 $CheckExist = $db->GetOne("select S_ROWID from users where loginid='$loginid'");
        if ($CheckExist !="") {
          echo "Similar User Already Exist, Please try Again";
          exit();
        }
  $MetaTypes = metatype($tableName);
 foreach ($_POST as $column => $value) {
      $value = is_array($value) ? implode(',', $value) : $value;
      $record[$column] = checkDT($value,$MetaTypes[$column]);
    }

  
$randompswd = $rs->GetConf("DefaultPassword","UserSetting");
$record["pswd"] =  md5($randompswd.$loginid.'GodFirst');
$record["CreatedBy"] = $user;
$record["UserStatus"] = "Active";
        
     $table  = "users";
     $action = "INSERT";
     $db->AutoExecute($table,$record,$action);

   if($db)
   {
  $EmailTemp = $rs->row("dh_emailtemplates","TempName='LoginWelcome'");
  $TempBody = $EmailTemp["TempBody"];
  $TempCss = $EmailTemp["TempCss"]; 
  $TempBody = "<div style='$TempCss'>".$TempBody."</div>";
  $TempBody = str_replace('@Fullname@',$Fullname, $TempBody);
  $TempBody = str_replace('@pswd@',$randompswd , $TempBody);
  $TempBody = str_replace('@loginid@',$loginid , $TempBody);

      $recMail["MsgBody"]    = $TempBody;
      $recMail["MsgSubject"] = $EmailTemp["TempSubject"];
      $recMail["MsgType"] = "Mail";
      $recMail["MsgRecipient"] = $record["Email"];
      $rs->AddAlert($recMail);

   
    $S_ROWID = $db->GetOne("select max(S_ROWID) from $table");
    logAction($S_ROWID,$table,$user,$action,$record,$ModCode);
   echo "User ".$Fullname." Successfully saved ";

        $rec["ItemDescription"] = $loginid;
        $rec["ItemCode"] = "General";
        $rec["ItemType"] = "RoleUser";
        $rec["CreatedBy"] = $user;
        $table  = "listitems";
        $action = "INSERT";
        $db->AutoExecute($table,$rec,$action);
   }else
   {
   $getloginid = $db->GetOne("SELECT Fullname FROM users where loginid='$loginid' ");
      
   echo "Error in Saving Record. <br/>Please try again because login Id $loginid is already taken by $getloginid ";
   }
}

if (isset($_POST['btnUpdateRecord'])) {
  $tableName = safehtml($_POST['btnUpdateRecord']);
     array_pop($_POST);
     $ReturnType = isset($_POST['ReturnType']) ? "RstID" : "Message";
    $ModCode = isset($_POST['ModCode']) ? $_POST['ModCode'] : "";

     $S_ROWID = $_POST['S_ROWID'];
     unset($_POST['S_ROWID']);
  unset($_POST['ReturnType']);
  unset($_POST['ModCode']);


    $MetaColumns = $db->MetaColumns($tableName);
    foreach ($MetaColumns as $key => $val) {
       $MetaType[$val->name] = $val->type;
    }

  $loginid = safehtml(trim($_POST['loginid']));
  $Fullname = safehtml(trim($_POST['Fullname']));


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
 
        $criteria = " S_ROWID = '$S_ROWID'";
        $table  = $tableName;
        $action = "UPDATE";
          $db->AutoExecute($table,$record,$action,$criteria);

   if($db)
   { 
    $rand = md5(rand());
   logAction($S_ROWID,$tableName,$user,$action,$LogChanges,$ModCode);
     echo "Update Successful";
   }else
   {
   echo "Error in Saving Record.";
   }
}
//  Edit User Profile
if (isset($_POST['EditProfile'])) {
  $tableName = "users";
  $loginid = safehtml(trim($_POST['loginid']));
$Fullname = safehtml(trim($_POST['Fullname']));
$record["loginid"] = safehtml(trim($_POST['loginid']));
$record["Fullname"] = safehtml(trim($_POST['Fullname']));
$record["Phone"] = safehtml(trim($_POST['Phone']));
$record["Email"] = safehtml(trim($_POST['Email']));
$record["Position"] = safehtml(trim($_POST['Position']));
$record["PhoneExt"] = safehtml(trim($_POST['PhoneExt']));  
$randompswd = generatePassword(8,5);

foreach ($record as $ckey => $cval) {
       $cval = is_array($cval) ? implode(',', $cval) : $cval;
       $record[$ckey] = $cval;
     }
    $userid     =$db->GetOne("select S_ROWID from users where loginid='$loginid'");
    $auditLog   = doAuditLog($record,$userid,$tableName);
    $record     = $auditLog[0];
    $LogChanges = $auditLog[1];

     $arg = array_filter($record);

     if (empty($arg)) {
       echo "No Change to Update";
       exit();
     }
     
        $criteria = "loginid = '$loginid'";
        $table    = "users";
        $action   = "UPDATE";
          $db->AutoExecute($table,$record,$action,$criteria);

   if($db)
   { 
    $rand = md5(rand());
    
   logAction($userid,$tableName,$user,$action,$LogChanges);
     echo "Profile Successfully Updated";
   }else
   {
   echo "Error in Saving Record.";
   }
}

   if(isset($_POST['DeleteUser']))
   {
     $userid = safehtml(trim($_POST['userid']));
	 if($_SESSION['user']==$userid )
	 {
	 echo "Error, you cannot delete a logged in user Please try again!";
	 }else
	 {
    $S_ROWID =$db->GetOne("select S_ROWID from users where loginid='$userid'");
	  $delUsers = $db->Execute("delete from listitems where ItemDescription='$userid' and ItemType='Groups'");
    logAction($S_ROWID,"users",$user,"Delete");
	 }
    
   }

   if (isset($_POST['ResetPswd'])) {
   	   $userid = safehtml(trim($_POST['ResetPswd']));
       $cols = $rs->getCols("users");
	     $useremail= $db->Execute("select * from users where S_ROWID='$userid'");
			  $fname = $useremail->fields[$cols["Fullname"]];
			  $femail = $useremail->fields[$cols["Email"]];
			  $loginid = $useremail->fields[$cols["loginid"]];
	
    $newpswd = $rs->GetConf("DefaultPassword","UserSetting");
	
	$newpswd2 = md5($newpswd.$loginid.'GodFirst');
	$getpswd =$db->Execute("update users set pswd='$newpswd2' where S_ROWID='$userid' ");  
  $pswdChange["PasswordReset"] = $newpswd2;
  logAction($userid,"users",$user,"PasswordReset",$pswdChange,38);
  echo "Password Changed successfully ";

  $EmailTemp = $rs->row("dh_emailtemplates","TempName='PasswordReset'");
  $TempBody = $EmailTemp["TempBody"];
  $TempCss = $EmailTemp["TempCss"]; 
  $TempBody = "<div style='$TempCss'>".$TempBody."</div>";
  $TempBody = str_replace('@Fullname@',$fname, $TempBody);
  $TempBody = str_replace('@pswd@',$newpswd , $TempBody);
  $TempBody = str_replace('@loginid@',$loginid , $TempBody);
  $TempBody = str_replace('@USERID@',$rs->UserInfo($user,"Fullname"), $TempBody);

      $recMail["MsgBody"]    = $TempBody;
      $recMail["MsgSubject"] = $EmailTemp["TempSubject"];
      $recMail["MsgType"] = "Mail";
      $recMail["MsgRecipient"] = $femail;
      $rs->AddAlert($recMail);
  

   }
 // Change User Password
 if(isset($_POST['ChangePassword']))
 {
 

  $user = $_SESSION['user'];
  $oldpswd = safehtml(trim($_POST['oldpswd']));
  $newpswd = safehtml(trim($_POST['newpswd']));
  $confirmpswd = safehtml(trim($_POST['confirmpswd']));
  $oldpswd2 = md5($oldpswd.$user.'GodFirst');
  $newpswd2 = md5($newpswd.$user.'GodFirst');
  
  if($confirmpswd != $newpswd){
    echo "New password and Confirm Password don't match! <br/>Please try again.";
  }else
  {
    $getpswd =$db->Execute("select *from users where loginid='$user' and pswd='$oldpswd2' ");
         if(!$getpswd->EOF)
       {
      $getpswd =$db->Execute("update users set pswd='$newpswd2' where loginid='$user' ");  
      $S_ROWID =$db->GetOne("select S_ROWID from users where loginid='$user'");
      $logChanges["UserchangedPassword"] = $newpswd2;
      logAction($S_ROWID,"users",$user,"ChangedPassword",$logChanges,"6");
      echo "Password successfully Changed";
      //log_action($user,"Changed Password");
         }else
       {
        echo "Invalid Old Password. Please try Again";
       }
  }
 } 

 if (isset($_POST['DeActivateUser'])) {
   $UserID  = safehtml($_POST['userid']);
   $ModCode = safehtml($_POST['ModCode']);
   $Status  = safehtml($_POST['DeActivateUser']);
    $record["DeActivateReason"] =  safehtml($_POST['Reason']);;
    $record["DateDeActivated"] = $db->GetOne("select current_timeStamp");
    $record["DeActivatedBy"] = $user;
    $record["UserStatus"] = $Status == "DeActivate" ? "DeActivated" : "Active";

    $rs->SetValues($record,$UserID,"users",$user,$ModCode);
 }
?>