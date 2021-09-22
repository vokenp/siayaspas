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

   if (isset($_POST['btnUpdateRecord'])) {
    $tableName = safehtml($_POST['btnUpdateRecord']);
    $S_ROWID = $_POST['S_ROWID'];
     unset($_POST['S_ROWID']);
     $GroupCode =  $_POST["GroupCode"];


     if (!isset($_POST['GroupUsers'])) {
       exit();
     }
     else
     {
      $GroupUsers = $_POST['GroupUsers'];
      unset($_POST['GroupUsers']);
      foreach ($GroupUsers as $key => $value) {

        $rec["ItemDescription"] = $value;
        $rec["ItemCode"] = $GroupCode;
        $rec["ItemType"] = "RoleUser";
        $rec["CreatedBy"] = $user;
        $table  = "listitems";
        $action = "INSERT";
        $db->AutoExecute($table,$rec,$action);
      }
     }


       $record["ModifiedBy"] = $user;
       $record["GroupDescrption"] = $_POST["GroupDescription"];
       $record["DateModified"] = $db->GetOne("select current_timestamp()");
       $criteria = "S_ROWID = '$S_ROWID'";
       $table  = $tableName;
       $action = "UPDATE";
       $db->AutoExecute($table,$record,$action,$criteria);

 }

 if (isset($_POST['DelGroupUsers'])) {

   $UserList = safehtml($_POST['DelGroupUsers']);
   $exec = $db->Execute("delete from listitems where S_ROWID IN ($UserList)");
 }

  if (isset($_POST['DelCommMembers'])) {

   $MemberList = safehtml($_POST['DelCommMembers']);
   $exec = $db->Execute("delete from committeeMembersList where S_ROWID IN ($MemberList)");
 }

 if (isset($_POST['DelPleAttendance'])) {

   $MemberList = safehtml($_POST['DelPleAttendance']);
   $exec = $db->Execute("delete from committeeattendance where S_ROWID IN ($MemberList)");
 }

 if (isset($_POST['DelMenuActions'])) {
   $MenuList = safehtml($_POST['DelMenuActions']);
   $getList = $db->GetArray("select ItemCode,ItemDescription from listitems where S_ROWID IN ($MenuList) ");
     $arg = array_filter($getList);
     foreach ($getList as $key => $val) {
       $ModCode      = $val[0];
       $ModOperation = $val[1];
       $exec = $db->Execute("delete from dh_profilepermissions where ModCode='$ModCode' and ModOperation='$ModOperation'");
     }
   $exec = $db->Execute("delete from listitems where S_ROWID IN ($MenuList)");
 }


  if (isset($_POST['btnModActions'])) {

     if (!isset($_POST['ActionNames'])) {
       exit();
     }
     else
     {
      $ActionNames = $_POST['ActionNames'];
      $ModCode = $_POST['ModCode'];

      foreach ($ActionNames as $key => $value) {
        $rec["ItemDescription"] = $value;
        $rec["ItemCode"] = $ModCode;
        $rec["ItemType"] = "ModActions";
        $rec["CreatedBy"] = $user;
        $table  = "listitems";
        $action = "INSERT";
        $db->AutoExecute($table,$rec,$action);
      }
     }

 }

// Role Users
   if (isset($_POST['btnRoleUsers'])) {
     $GroupCode =  $_POST["GroupCode"];
     if ($_POST['GroupUsers'] == "") {
       exit();
     }
     else
     {
      $GroupUsers = explode(',', $_POST['GroupUsers']);
      foreach ($GroupUsers as $key => $value) {

        $rec["ItemDescription"] = $value;
        $rec["ItemCode"] = $GroupCode;
        $rec["ItemType"] = "RoleUser";
        $rec["CreatedBy"] = $user;
        $table  = "listitems";
        $action = "INSERT";
        $db->AutoExecute($table,$rec,$action);
      }
    }
  }

  // Role Profiles
   if (isset($_POST['btnRoleProfiles'])) {
     $GroupCode =  $_POST["GroupCode"];


     if ($_POST['ProfileRoles'] == "") {
       exit();
     }
     else
     {
      $RoleProfiles = explode(',', $_POST['ProfileRoles']);
      foreach ($RoleProfiles as $key => $value) {

        $rec["ItemDescription"] = $value;
        $rec["ItemCode"] = $GroupCode;
        $rec["ItemType"] = "RoleProfile";
        $rec["CreatedBy"] = $user;
        $table  = "listitems";
        $action = "INSERT";
        $db->AutoExecute($table,$rec,$action);
      }
    }
  }

  // Committee Members
   if (isset($_POST['btnComMembers'])) {
     $CommitteeID =  $_POST["CommitteeID"];
     $MemberType = $_POST['MemberType'];

     if ($_POST['ComMembers'] == "") {
       exit();
     }
     else
     {
      $ComMembers = explode(',', $_POST['ComMembers']);
      foreach ($ComMembers as $key => $value) {

        $rec["MemberType"] = $MemberType;
        $rec["MemID"] = $value;
        $rec["CommitteeID"] = $CommitteeID;
        $rec["CreatedBy"] = $user;
        $rec["DateCreated"] = $db->GetOne("select current_timestamp");
        $table  = "committeeMembersList";
        $action = "INSERT";
        $db->AutoExecute($table,$rec,$action);
      }
    }
  }

  //GetSections
  if (isset($_POST['getSection'])) {

    $DeptID = $_POST["getSection"];
   $getData = $db->Execute("select * from tbl_sections where  DepartmentID= '$DeptID'");
   $html = "<option value=''></option>";
   while (!$getData->EOF) {
    $SectionID = $getData->fields["S_ROWID"];
    $SectionName = $getData->fields["SectionName"];
    $html .= "<option value='$SectionID'>$SectionName</option>";
    $getData->MoveNext();
   }
   echo $html;
  }

  // Plenary Attendance
   if (isset($_POST['btnPlenaryAttendance'])) {
     $MeetingID =  $_POST["MeetingID"];
     $MemberType = $_POST['MemberType'];



     if ($_POST['ComMembers'] == "") {
       exit();
     }
     else
     {

      $RankPayOut = array();
   $Allowances = $db->GetArray("select AllowanceRank,AllowanceAmount from allowancesrate");
   foreach ($Allowances as $key => $val) {
    $RankPayOut[$val["AllowanceRank"]] = $val["AllowanceAmount"];
   }

      $PlenaryAttendanceMembers = explode(',', $_POST['ComMembers']);
      foreach ($PlenaryAttendanceMembers as $key => $value) {

        $rec["InAttendancePosition"] = $MemberType;
        $rec["MemID"] = $value;
        $rec["PayOutAmount"] = $RankPayOut[$MemberType];
        $rec["MeetingID"] = $MeetingID;
        $rec["CreatedBy"] = $user;
         $rec["MeetingType"] = "Plenary";
         $rec["InAttendance"] = "Y";
        $rec["DateCreated"] = $db->GetOne("select current_timestamp");
        $table  = "committeeattendance";
        $action = "INSERT";
        $db->AutoExecute($table,$rec,$action);
      }
    }
  }


    if(isset($_POST['btnUpdateStep']))
    {
      $RowID = $_POST['btnUpdateStep'];
      $AppStage = $_POST['AppStage'];
      $exec = $db->Execute("update tbl_appraisals set AppStage='$AppStage',StageDate=current_timestamp where S_ROWID='$RowID'");
    }


  if (isset($_POST['getGroupSMSList'])) {
    $ChannelType = safehtml($_POST['getGroupSMSList']);

      if ($ChannelType == "UserGroups") {
         $html = "";
      $getsendList = $db->Execute("select distinct UserGroup from vw_usergroups order by 1 asc");
            $html = "";
       while (!$getsendList->EOF) {
         $GroupCode =  $getsendList->fields["UserGroup"];
         $GroupName =  $getsendList->fields["UserGroup"];
         $GroupCount = $db->GetOne("select count(*) from listitems where ItemType='RoleUser' and ItemCode='$GroupCode'");

         $html .= "<option value='$GroupCode'>$GroupName ($GroupCount)</option>";
         $getsendList->MoveNext();
       }
    echo $html;
      }
    elseif ($ChannelType == "Committees") {
       $getGroup = $db->Execute("select S_ROWID,CommitteeName  from assemblycommittees order by CommitteeName  asc");
       $html = "";
       while (!$getGroup->EOF) {
         $GroupCode = $getGroup->fields["S_ROWID"];
         $GroupName = safehtml($getGroup->fields["CommitteeName"]);

         $html .= "<option value='$GroupCode'>$GroupName</option>";
         $getGroup->MoveNext();
       }
       echo $html;
    }

      elseif ($ChannelType == "Members") {
       $getGroup = $db->Execute("select S_ROWID,FullName  from committemembers order by FullName  asc");
       $html = "";
       while (!$getGroup->EOF) {
         $GroupCode = $getGroup->fields["S_ROWID"];
         $GroupName = $getGroup->fields["FullName"];

         $html .= "<option value='$GroupCode'>$GroupName</option>";
         $getGroup->MoveNext();
       }
       echo $html;
    }
  }

  if(isset($_POST['btnPostValuesRates']))
  {
    $AppraisalID = $_POST["S_ROWID"];
    $exec = $db->Execute("delete from tbl_section5a where AppraisalID='$AppraisalID'");
    for ($i=1; $i <= 12; $i++) {
      $record = array();
      $record["ValueType"] = "V".$i;
      $record["SA_ScoreValue"] = isset($_POST["SA_V".$i]) ? $_POST["SA_V".$i] : 1;
      $record["SA_Remarks"] = $_POST["SA_Remarks-V".$i];
      $record["AppraisalID"] = $AppraisalID;
      $record["CreatedBy"] = $user;

      $table  = "tbl_section5a";
      $action = "INSERT";
      $db->AutoExecute($table,$record,$action);
    }


  }

  if(isset($_POST['btnPostValues5BRates']))
  {
    $AppraisalID = $_POST["S_ROWID"];
    $exec = $db->Execute("delete from tbl_section5b where AppraisalID='$AppraisalID'");
    for ($i=1; $i <= 7; $i++) {
      $record = array();
      $record["ValueType"] = "5B_V".$i;
      $record["SA_ScoreValue"] = isset($_POST["SA_5B_V".$i]) ? $_POST["SA_5B_V".$i] : 1;
      $record["SA_Remarks"] = $_POST["SA_Remarks-5B_V".$i];
      $record["AppraisalID"] = $AppraisalID;
      $record["CreatedBy"] = $user;

      $table  = "tbl_section5b";
      $action = "INSERT";
      $db->AutoExecute($table,$record,$action);
    }

  }

  if (isset($_POST['btnPostS3Values'])) {
      unset($_POST['S_ROWID']);
      unset($_POST['btnPostS3Values']);
       foreach ($_POST['SA_ResultsAchieved'] as $pkey => $pval) {

         $record["SA_ResultsAchieved"] = $_POST['SA_ResultsAchieved'][$pkey];
         $record["SA_Remarks"] = $_POST['SA_Remarks'][$pkey];
         $record["ModifiedBy"] = $user;
         $criteria = "S_ROWID = $pkey";
         $table  = "tbl_section3";
         $action = "UPDATE";
         $db->AutoExecute($table,$record,$action,$criteria);
       }
  }

?>
