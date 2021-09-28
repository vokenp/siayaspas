<?php
include("../timeout.php");
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

$token = preg_replace("/\r|\n/", "", $_POST['_token']);

    if (!VToken::checkT(trim($token))) {
    echo "<i class='icon fas fa-exclamation-triangle'></i>InvalidRequest: $token";
    exit();
  }

 function cleanDataHtml(&$value, $key)
  {
    $value = safehtml($value);
  }

$curDT = $db->GetOne("select current_timestamp");
unset($_POST['_token']);
  // Add New client
 if (isset($_POST['btnSaveRecord'])) {

  $ReturnType = isset($_POST['ReturnType']) ? "RstID" : "Message";

   if (isset($_POST['ModCode'])) {
      $ModCode = safehtml($_POST['ModCode']);
      $ModInfo = $rs->row("dh_modules","S_ROWID=$ModCode");
      $tableName = $rs->IsView($ModInfo["TableName"]) ? $ModInfo["ParentTable"] : $ModInfo["TableName"];
      if ($tableName == "") {
         echo "  Invalid StorageElement. Try again";
         exit();
      }
   }
   else
   {
      echo "Invalid Request. Try again";
      exit();
   }


     unset($_POST['ReturnType']);
     unset($_POST['ModCode']);
     array_pop($_POST);
     array_walk($_POST,"cleanDataHtml");
      /*echo "<pre>";
     print_r($_POST);
     exit();*/

      $getPrefix = $db->GetRow("select  TblColumn,PaddingSize,Prefix from dh_templateprefix where TableName='$tableName'");
       $arg = array_filter($getPrefix);
         if (!empty($arg)) {
            $_POST[$getPrefix["TblColumn"]] = generateUniqueCode($getPrefix["Prefix"],getID($tableName),$getPrefix["PaddingSize"]);
         }
      $CheckFld = $db->GetOne("select CheckExist from dh_modules where S_ROWID='$ModCode'");

      if ($CheckFld !="") {
        $checkValue = safehtml($_POST[$CheckFld]);
        $CheckExist = $db->GetOne("select S_ROWID from $tableName where $CheckFld ='$checkValue'");
        if ($CheckExist !="") {
          echo "Similar $CheckFld :- $checkValue. \n Already Exist, Please try Again";
          exit();
        }
      }


      if ($tableName == "dh_users") {
          $loginid = $_POST['loginid'];
          $CheckFld = $db->GetRow("select * from $tableName where loginid='$loginid'");
          $arg = array_filter($CheckFld);
           if (!empty($arg)) {
             $Fullname = $CheckFld["Fullname"];
             echo "Similar User Already Exist : $Fullname - $loginid, Please try Again;";
             exit();
           }
      }


      if ($tableName == "tbl_appraisals") {
          $AppPeriodID = $_POST['AppPeriodID'];
          $AppraiseeUserID = $_POST['AppraiseeUserID'];
        
          $CheckFld = $db->GetRow("select * from $tableName where AppPeriodID='$AppPeriodID' and AppraiseeUserID='$AppraiseeUserID'");
          $arg = array_filter($CheckFld);
           if (!empty($arg)) {

             echo "You already have a Appraisal form open for this period, Please try Again;";
             exit();
           }
      }





       $MetaTypes = metatype($tableName);
    foreach ($_POST as $column => $value) {
      $value = is_array($value) ? implode(',', $value) : $value;
    $record[$column] = checkDT($value,$MetaTypes[$column]);
    }

        if ($tableName == "dh_users") {
          $loginid = $_POST['loginid'];
          $randompswd = $rs->GetConf("DefaultPassword","UserSetting");
          $record["pswd"] =  md5($randompswd.$loginid.'GodFirst');
          $record["UserStatus"] = "Active";
        }



       $record["CreatedBy"] = $user;
       $record["DateCreated"] = $curDT;
       $table  = $tableName;
       $action = "INSERT";
       $db->AutoExecute($table,$record,$action);
       //$log->write($log->makesql($table,$record,$action));
        if ($db) {
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

 if (isset($_POST['btnUpdateRecord'])) {

  if (isset($_POST['ModCode'])) {
      $ModCode = safehtml($_POST['ModCode']);
      $ModInfo = $rs->row("dh_modules","S_ROWID=$ModCode");
      $tableName = $rs->IsView($ModInfo["TableName"]) ? $ModInfo["ParentTable"] : $ModInfo["TableName"];
      if ($tableName == "") {
         echo "Invalid StorageElement";
         exit();
      }
   }
   else
   {
      echo "Invalid Request. Try Again";
      exit();
   }

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
       if ($tableName == "listitems") {
          unset($_POST[$ckey]);
         $ckey = str_replace('2', '', $ckey);
       }
       $_POST[$ckey] = $cval;
     }

    $auditLog = doAuditLog($_POST,$S_ROWID,$tableName);
    $record   = $auditLog[0];
    $LogChanges = $auditLog[1];

     $arg = array_filter($record);

     if (empty($arg)) {
       echo "Success";
       exit();
     }

       $record["ModifiedBy"] = $user;
       $record["DateModified"] = $db->GetOne("select current_timestamp");
       $criteria = "S_ROWID = '$S_ROWID'";
       $table  = $tableName;
       $action = "UPDATE";
       $db->AutoExecute($table,$record,$action,$criteria);

        if ($db) {
         if ($table == "assemblybizdocs") {
            $DocInfo = $db->GetRow("select *from $table where S_ROWID='$S_ROWID'");
            $DocID = $DocInfo["DocID"];
            $FileInfo = $db->GetRow("select New_FileName,FileDescription from elementstorage where S_ROWID='$DocID'");
            list($CategoryName,$CategoryID) = explode('-',$DocInfo["DocumentCategory"]);
            $rec["StoragePool"]     = $DocInfo["DocumentCategory"];
            $rec["FileDescription"] = $DocInfo["DocumentTitle"];
            $rec["New_FileName"] =   str_replace($FileInfo["FileDescription"], $DocInfo["DocumentTitle"], $FileInfo["New_FileName"]);


            $criteria = "S_ROWID = '$DocID'";
          $table  = "elementstorage";
           $action = "UPDATE";
          $db->AutoExecute($table,$rec,$action,$criteria);
          }

         if ($ReturnType == "RstID") {
          echo $S_ROWID;
        }
        else
        {
          echo "Success";
        }
        logAction($S_ROWID,$tableName,$user,$action,$LogChanges,$ModCode);
        }
        else
        {
          echo "Error in saving Record reason because :".$db->ErrorMsg();
        }
 }


  if (isset($_POST['btnSaveRecordModal'])) {
  $tableName = safehtml($_POST['btnSaveRecordModal']);
     array_pop($_POST);
      /*echo "<pre>";
     print_r($_POST);
     exit();*/
     $ModCode = isset($_POST['ModCode']) ? $_POST['ModCode'] : $rs->GetOne("dh_modules","S_ROWID","TableName='$tableName'");

     $getPrefix = $db->GetRow("select  TblColumn,PaddingSize,Prefix from templateprefix where TableName='$tableName'");
       $arg = array_filter($getPrefix);
         if (!empty($arg)) {
            $_POST[$getPrefix[0]] = generateUniqueCode($getPrefix[2],getID($tableName),$getPrefix[1]);
         }

    foreach ($_POST as $column => $value) {
      $value = is_array($value) ? implode(',', $value) : $value;
    $record[$column] = checkDT($column,$value,$tableName);
    }

       $record["CreatedBy"] = $user;
       $table  = $tableName;
       $action = "INSERT";
       $db->AutoExecute($table,$record,$action);
       //$log->write($log->makesql($table,$record,$action));
        if ($db) {
        $S_ROWID = $db->GetOne("select max(S_ROWID) from $tableName");
        echo $tableName.":".$S_ROWID;
        logAction($S_ROWID,$tableName,$user,$action,$record,$ModCode);
        }
        else
        {
          echo "Error in saving Record reason because :".$db->ErrorMsg();
        }
 }

 // Delete Record
 if (isset($_POST['DeleteRecord'])) {
  $S_ROWID = $_POST['DeleteRecord'];
   if (isset($_POST['ModCode'])) {
      $ModCode = safehtml($_POST['ModCode']);
      $ModInfo = $rs->row("dh_modules","S_ROWID=$ModCode");
      $tbl = $rs->IsView($ModInfo["TableName"]) ? $ModInfo["ParentTable"] : $ModInfo["TableName"];
      if ($tbl == "") {
         echo "Invalid StorageElement";
         exit();
      }
   }
   else
   {
      echo "InvalidRequest";
      exit();
   }

  $ModCode = isset($_POST['ModCode']) ? $_POST['ModCode'] : $rs->GetOne("dh_modules","S_ROWID","TableName='$tbl'");

  if ($tbl == "dh_usergroups") {
    $GroupCode = $db->GetOne("select GroupCode from dh_usergroups where S_ROWID='$S_ROWID'");
    $exec = $db->Execute("delete from listitems where ItemType='Groups' and ItemCode='$GroupCode'");
  }
     if ($tbl == "dh_modules") {
       $ModuleCode = $db->GetOne("select ModuleCode from dh_modules where S_ROWID='$S_ROWID'");
    $exec = $db->Execute("delete from dh_listview  where ModuleCode='$ModuleCode'");
     $exec = $db->Execute("delete from dh_listquery  where ModuleCode='$ModuleCode'");
     }

   if ($tbl == "tbl_divisions") {
    $exec = $db->Execute("update users set Division='1',Department='1' where Division='$S_ROWID'");
   }

   if ($tbl == "tbl_departments") {
    $exec = $db->Execute("update users set Division='1',Department='1' where Department='$S_ROWID'");
   }

  logAction($S_ROWID,$tbl,$user,"Delete","",$ModCode);
 }

  // Delete Record
 if (isset($_POST['DeleteMultiple'])) {
  $ListID = json_decode($_POST['DeleteMultiple'],true);
  $mod = safehtml($_POST['mod']);
  $modInfo    = $rs->row("dh_modules","S_ROWID = '$mod'");
  $tbl = $rs->IsView($modInfo["TableName"]) ? $modInfo["ParentTable"] : $modInfo["TableName"];

  if ($tbl == "dh_usergroups") {
    $GroupCode = $db->GetOne("select GroupCode from dh_usergroups where S_ROWID='$S_ROWID'");
    $exec = $db->Execute("delete from listitems where ItemType='RoleUser' and ItemCode='$GroupCode'");
    $exec = $db->Execute("delete from listitems where ItemType='RoleProfile' and ItemCode='$GroupCode'");
  }

  if ($tbl == "dh_users") {
    $loginid = $db->GetOne("select loginid from dh_users where S_ROWID='$S_ROWID'");
    $exec = $db->Execute("delete from listitems where ItemType='RoleUser' and ItemDescription='$loginid'");
  }
     if ($tbl == "dh_modules") {
       $ModuleCode = $db->GetOne("select ModuleCode from dh_modules where S_ROWID='$S_ROWID'");
     $exec = $db->Execute("delete from dh_listview  where ModuleCode='$ModuleCode'");
     $exec = $db->Execute("delete from dh_listquery  where ModuleCode='$ModuleCode'");
     }



   foreach ($ListID as $key => $S_ROWID) {
     logAction($S_ROWID,$tbl,$user,"Delete","",$mod);
   }
 }

 // Delete Document
 if (isset($_POST['btnDeleteDoc'])) {
   $DocID = safehtml($_POST['DocID']);
   $Reason = safehtml($_POST['Reason']);

   $FileInfo = $rs->row("elementstorage","S_ROWID='$DocID'");
    $ModCode = isset($_POST['ModCode']) ? $_POST['ModCode'] : "";

    $StoragePath = $FileInfo["StoragePath"];
    $FileName = $FileInfo["FileName"];
    $Version = str_pad((int)$FileInfo["Version"], 5, "0", STR_PAD_LEFT);

    $LastDoc  =  $Recid < 100 ? $Recid : substr($Recid,-2);
    $RecPath =  $rs->getFilePath($Recid);
    $FileName = $LastDoc.$Version."-".$FileName;
    $filepath = $StoragePath."/".$RecPath.$FileName;
      unlink($filepath);
    logAction($DocID,"elementstorage",$user,"Delete","",$ModCode);

$logChanges["Document Description"] = $FileInfo["FileDescription"];
$logChanges["Reason"] = $Reason;
  list($childID,$childTBL) = explode("-", $FileInfo["StoragePool"]);
  logAction($childID,$childTBL,"admin","DocumentDelete",$logChanges,$ModCode);

   $rs->logFileAction($_SESSION['sessionid'],$DocID,$_SESSION['user'],"Delete",$Reason);

 }

 if (isset($_POST['btnDeleteKCADocument'])) {
    $childID = safehtml($_POST['btnDeleteKCADocument']);
    $DocInfo = $rs->row("assemblybizdocs","S_ROWID='$childID'");
    $childTBL = "assemblybizdocs";
    $DocID   = $DocInfo["DocID"];
    $Reason  = safehtml($_POST['Reason']);

   $FileInfo = $rs->row("elementstorage","S_ROWID='$DocID'");
    $ModCode = "9999";

    $StoragePath = $rs->getConf("AssetPath","AssetPath");
    $FileName = $FileInfo["Orginal_FileName"];
    $Version = str_pad((int)$FileInfo["Version"], 5, "0", STR_PAD_LEFT);

    $LastDoc  =  $DocID < 100 ? $DocID : substr($DocID,-2);
    $RecPath =  $rs->getFilePath($DocID);
    $FileName = $LastDoc.$Version."-".$FileName;
    $filepath = $StoragePath.$RecPath.$FileName;
      unlink($filepath);
    logAction($DocID,"elementstorage",$user,"Delete","",$ModCode);

$logChanges["Document Description"] = $FileInfo["FileDescription"];
$logChanges["Reason"] = $Reason;

  logAction($childID,$childTBL,"admin","DocumentDelete",$logChanges,$ModCode);
  $delDoc = $db->Execute("delete from $childTBL where S_ROWID='$childID'");

   $rs->logFileAction($_SESSION['sessionid'],$DocID,$_SESSION['user'],"Delete",$Reason);
 }

// Resolve Wrong Document Upload
 if (isset($_POST['btnMisplacedUpload'])) {
   $DocID = safehtml($_POST['DocID']);
   $MailID = safehtml($_POST['MailID']);
   $ModCode = isset($_POST['ModCode']) ? $_POST['ModCode'] : "";

   $MailInfo = $rs->row("tbl_mailfiling","S_ROWID='$MailID'");
   if ($MailInfo["S_ROWID"] != "") {
     $FileInfo = $rs->row("elementstorage","S_ROWID='$DocID'");
     list($childID,$childTBL) = explode('-', $FileInfo["StoragePool"]);
     $exec = $db->Execute("update elementstorage set StoragePool=REPLACE(StoragePool,'$childID','$MailID') where S_ROWID='$DocID'");
     $DocDescription = $FileInfo["FileDescription"];

     $logChanges["Resolved Misplaced Upload"] = "Misplaced upload: <b>$DocDescription</b></br> Resolved to MailID: <b>$MailID</b>";
     logAction($childID,$childTBL,"admin","Misplaced Upload",$logChanges,$ModCode);

     $logChanges2["Resolved Upload"] = "Resolved Upload from MailID :<b>$childID</b>";
     logAction($MailID,$childTBL,"admin","Resolved Upload",$logChanges2,$ModCode);
   }
   else
   {
    echo "Invalid MailID , Please try Again";
   }


 }


 if (isset($_POST['btnAssignStud2Slot'])) {
   $StudRegisterID = safehtml($_POST['StudRegisterID']);
   $SlotID = safehtml($_POST['SlotID']);
   $StudList = explode(',',$StudRegisterID);
   foreach ($StudList as $key => $val) {
     $record["StudRegisterID"] = $val;
     $record["SlotID"] = $SlotID;
     $record["CreatedBy"] = $user;

     $table  = "tbl_slotlist";
      $action = "INSERT";
      $db->AutoExecute($table,$record,$action);
   }
 }

  if (isset($_POST['RemoveTTStudent'])) {

     $StudSlotID = safehtml($_POST['RemoveTTStudent']);
    $exec = $db->Execute("delete from tbl_slotlist where S_ROWID='$StudSlotID'");
  }

// Remove TimeSlot
  if (isset($_POST['RemoveTimeSlot'])) {
     $SlotID = safehtml($_POST['RemoveTimeSlot']);
    $exec = $db->Execute("delete from tbl_slotlist where SlotID='$SlotID'");
    $exec = $db->Execute("delete from tbl_timeslots where S_ROWID='$SlotID'");
  }

  if (isset($_POST["btnUserPswdReset"])) {
    $UserID = safehtml($_POST["btnUserPswdReset"]);
      $psw = mt_rand(10000,99999);
      $getuser = $rs->row("tbl_saccousers","S_ROWID='$UserID'");
      $SaccoCode = $getuser["SaccoCode"];
      $PhoneNo = $getuser["PhoneNo"];
     $pswd = safehtml(trim(md5($psw.$SaccoCode.'GodFirst'.$PhoneNo)));
      $FirstName = $getuser["FirstName"];
      $exec = $db->Execute("update tbl_saccousers set DateModified=current_timestamp,AuthToken=null,UserPswd='$pswd' where S_ROWID=$UserID");

        $SendTo = array("+".$PhoneNo);
        $message = "<#> Hi $FirstName your DalaPay Account Password has been  Reset: New Passcode : $psw";
          sendSMS($SendTo,$message);
          echo "Success";
  }


if (isset($_POST['btnListItems'])) {

  $ItemCode = safehtml($_POST['ItemCode']);
  $record["ItemType"] = safehtml($_POST['btnListItems']);
  $record["ItemCode"] = safehtml($_POST['ItemCode']);
  $record["ItemDescription"] = safehtml($_POST['ItemCode']);
  $record["CreatedBy"] = $user;

      $table  = "listitems";
      $action = "INSERT";
      $db->AutoExecute($table,$record,$action);
      $S_ROWID = $db->GetOne("select  max(S_ROWID) from listitems");
      if ($db) {
         echo $S_ROWID;
      }
      else
      {
         echo "Error in saving Record reason because :".$db->ErrorMsg();
      }
}



if (isset($_POST['btnSaveNotifications'])) {
  $record["NType"] = safehtml($_POST['NType']);
  $record["CommitteeID"] = safehtml($_POST['CommitteeID']);
  $record["NBody"] = safehtml($_POST['NBody']);

  if (isset($_POST["MeetingID"])) {
    $record["MeetingID"] = $_POST["MeetingID"];
  }

  $CommitteeID = $record["CommitteeID"];

    $record["CreatedBy"] = $user;
    $record["DateCreated"] = $curDT;

      $table  = "notifications";
      $action = "INSERT";
      $db->AutoExecute($table,$record,$action);
      $S_ROWID = $db->GetOne("select  max(S_ROWID) from $table");

    $getMembers = $db->GetArray("select *from committeeMembersList where CommitteeID='$CommitteeID'");
      foreach ($getMembers as $key => $vals) {
        $MemID = $vals["MemID"];
        $exec = $db->Execute("insert into notificationlist(CreatedBy,DateCreated,NTargetedTo,NotificationID) values ('$user',current_timestamp,'$MemID','$S_ROWID')");
      }
}

   if (isset($_POST['btnUpdateDocName'])) {
     $DocID = safehtml($_POST['btnUpdateDocName']);
     $DocumentTitle = safehtml($_POST['DocumentTitle']);
     $Exec = $db->Execute("update elementstorage set FileDescription = '$DocumentTitle',DateModified=current_timestamp() where S_ROWID='$DocID'");

     echo $DocumentTitle;
   }

   if (isset($_POST['btnSaveContrib'])) {
     $tableName = "tbl_contributions";
      array_pop($_POST);

       $MetaTypes = metatype($tableName);
    foreach ($_POST as $column => $value) {
      $value = is_array($value) ? implode(',', $value) : $value;
    $record[$column] = checkDT($value,$MetaTypes[$column]);
    }

       $record["CreatedBy"] = $user;
       $record["DateCreated"] = $curDT;
       $table  = $tableName;
       $action = "INSERT";
       $db->AutoExecute($table,$record,$action);
       //$log->write($log->makesql($table,$record,$action));
        if ($db) {

         echo "Record Saved Successfully";

        }
        else
        {
          echo "Error in saving Record reason because :".$db->ErrorMsg();
        }


   }


   if (isset($_POST['btnSchedule'])) {
    $ChngPhoneNo = safehtml($_POST["ChangePhoneNo"]);
    $poolID = safehtml($_POST["S_ROWID"]);
    $ScheduleType = safehtml($_POST["ScheduleType"]);
    $whatis = $rs->formatPhoneNumber($ChngPhoneNo);

    if($whatis["ErrorCode"] == "Valid" && $whatis["NumType"] == "PhoneNo")
    {
      $ChngPhoneNo = $whatis["MSISDN"];
      $MNO = $whatis["MNO"];
        $logErr = $db->Execute("insert into schedulepool(PoolID,ScheduledTime,ScheduleType,Remarks,ChangePhoneNo) values ($poolID,current_timestamp,'$ScheduleType','$MNO','$ChngPhoneNo')");
         $exec = $db->Execute("update tbl_airtimetopup set TimeCompleted=current_timestamp,StatusCode='$ScheduleType'  where S_ROWID='$poolID'");
    }
    else
    {
      echo "Invalid PhoneNo, Please re-enter again";
    }
   }



   if (isset($_POST['btnConvert2AT'])) {
    $ChngPhoneNo = safehtml($_POST["ChangePhoneNo"]);
    $mpID = safehtml($_POST["S_ROWID"]);
    $ScheduleType = "TransConverted";
    $whatis = $rs->formatPhoneNumber($ChngPhoneNo);

    if($whatis["ErrorCode"] == "Valid" && $whatis["NumType"] == "PhoneNo")
    {
        $ChngPhoneNo = $whatis["MSISDN"];
        $MNO = $whatis["MNO"];
        list($MNOName, $OpCode) = explode('-',$MNO);

         $Params = $rs->row("pesatrans","S_ROWID=$mpID");

          $rec["TransID"]       = $Params["TransID"];
          $rec["TopUpPhoneNo"]  = $ChngPhoneNo;
          $rec["TopUpAmount"]   = (int)$Params["TransAmount"];
          $rec["PaymentMethod"] = "MpesaPayBill:".$Params["BusinessShortCode"];
          $rec["TopUpNetwork"]  = $OpCode;
          $rec["TransRefNo"]  = $Params["TransID"];
          $rec["MobileOperator"]  = $MNOName;
          $rec["CreatedBy"]     = $Params["MSISDN"];
          $rec["PaymentChannel"] = "MpesaPBApp";
          $rec["StatusCode"] = $ScheduleType;

         $PurchasedBy = $Params["MSISDN"];
          $action   = "INSERT";
          $tblName = "tbl_airtimetopup";
          $db->AutoExecute($tblName,$rec,$action);
        $poolID = $db->GetOne("select max(S_ROWID) from tbl_airtimetopup");
        $logErr = $db->Execute("insert into schedulepool(CreatedBy,PoolID,ScheduledTime,ScheduleType,Remarks,ChangePhoneNo) values ('$PurchasedBy',$poolID,current_timestamp,'$ScheduleType','$MNO','$ChngPhoneNo')");
        $exec = $db->Execute("update pesatrans set AccountType='Airtime',IsProcessed='AT : $ChngPhoneNo',DateProcessed=current_timestamp  where S_ROWID='$mpID'");

    }
    else
    {
      echo "Invalid PhoneNo, Please re-enter again";
    }
   }


   if(isset($_POST['btnSetCateg']))
   {
         $mpID = safehtml($_POST["S_ROWID"]);
       $exec = $db->Execute("update pesatrans set AccountType='General',IsProcessed='Y',DateProcessed=current_timestamp  where S_ROWID='$mpID'");
   }





?>
