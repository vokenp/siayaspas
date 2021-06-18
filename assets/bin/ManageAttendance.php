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
    

     if (isset($_POST['btnPostAtt']) or isset($_POST['btnUpdateAtt'])) {
       $curDate = $db->GetOne("select current_timeStamp");
     $CommitteeID = safehtml($_POST['AttCommitteeID']);
     $MemCounts = $db->GetOne("select count(*) from vw_commMemberList where CommitteeID='$CommitteeID'");
     $AttQuorum = ceil($MemCounts /3 ) +1;


     $PresentChairs = 0;
     $PresentViceChairs = 0;
    foreach ($_POST['InAttendancePosition'] as $key => $val) {
      if ($_POST['IsPresent'][$key] =="Y") {
          if ($_POST['InAttendancePosition'][$key] == "ChairPerson") {
            $PresentChairs +=1;
          }

          if ($_POST['InAttendancePosition'][$key] == "Vice ChairPerson") {
            $PresentViceChairs +=1;
          }
        
      }
    }
    
    $PresentArray  = array_count_values($_POST['IsPresent']);
    $countPresent  = isset($PresentArray["Y"]) ? $PresentArray["Y"] : 0;
     if ($countPresent < $AttQuorum) {
      echo "<div class='alert alert-danger' style='text-align:center;'><b><i class='ace-icon fa fa-exclamation-triangle bigger-120'></i> Error! The Meeting attendance is below the Expected Quorum of <b>$AttQuorum Members</b></b></div>";
      exit();
     }

  
      $ChairsCount = $PresentChairs  + $PresentViceChairs;
     if ($ChairsCount  == 0) {
      echo "<div class='alert alert-danger' style='text-align:center;'><b><i class='ace-icon fa fa-exclamation-triangle bigger-120'></i> Error! Please select atleast one Member as a ChairPerson or a Vice ChairPerson</b></div>";
      exit();
     }

     if ($PresentChairs > 1) {
      echo "<div class='alert alert-danger' style='text-align:center;'><b><i class='ace-icon fa fa-exclamation-triangle bigger-120'></i> Error! Only Select One Member as ChairPerson</b></div>";
      exit();
     }


     }  //End If

    
     if (isset($_POST['btnUpdateAtt'])) {
     $CommitteeID = safehtml($_POST['AttCommitteeID']);
     $MeetingID = safehtml($_POST['MeetingID']);
     $IsPresent = $_POST['IsPresent'];
     $InAttendancePosition = $_POST['InAttendancePosition'];
     $MemberType = $_POST['MemberType'];

   $delAtt = $db->Execute("delete from committeeattendance where MeetingID='$MeetingID' and MeetingType='Committee'");
  
      foreach ($InAttendancePosition as $key => $val) {
        $record["CommitteeID"] = $CommitteeID;
      	$record["MeetingID"]   = $MeetingID;
      	$record["MemID"]   = $key;
      	$record["MemberType"]   = $MemberType[$key];
      	$record["InAttendancePosition"]   = $InAttendancePosition[$key];
      	$record["InAttendance"]   = $IsPresent[$key];
      	$record["CreatedBy"] = $user;
      	$record["DateCreated"] = $curDate;
        $record["MeetingType"] = "Committee";

        if ($IsPresent[$key] =='Y') {
         $table  = "committeeattendance";
         $action = "INSERT";
         $db->AutoExecute($table,$record,$action);
        }
      	
      }
   
    echo "<div class='alert alert-success' style='text-align:center;'><i class='ace-icon fa fa-check'></i> <b> Attendance Updated Successfully </b></div>";
     
     }

   //Post Attendance
      if (isset($_POST['btnPostAtt'])) {
     $CommitteeID = safehtml($_POST['AttCommitteeID']);
     $MeetingID = safehtml($_POST['MeetingID']);
     $IsPresent = $_POST['IsPresent'];
     $InAttendancePosition = $_POST['InAttendancePosition'];
     $MemberType = $_POST['MemberType'];

   $delAtt = $db->Execute("delete from committeeattendance where MeetingID='$MeetingID' and MeetingType='Committee'");

     $RankPayOut = array();
   $Allowances = $db->GetArray("select AllowanceRank,AllowanceAmount from allowancesrate");
   foreach ($Allowances as $key => $val) {
   	$RankPayOut[$val["AllowanceRank"]] = $val["AllowanceAmount"];
   }

      foreach ($InAttendancePosition as $key => $val) {
        $record["CommitteeID"] = $CommitteeID;
      	$record["MeetingID"]   = $MeetingID;
      	$record["MemID"]   = $key;
      	$record["MemberType"]   = $MemberType[$key];
      	$record["InAttendancePosition"]   = $InAttendancePosition[$key];
      	$record["InAttendance"]   = $IsPresent[$key];
      	$record["CreatedBy"] = $user;
      	$record["DateCreated"] = $curDate;
      	$record["PayOutAmount"] = $RankPayOut[$InAttendancePosition[$key]];
        $record["MeetingType"] = "Committee";
      	if ($IsPresent[$key] =='Y') {
         $table  = "committeeattendance";
         $action = "INSERT";
         $db->AutoExecute($table,$record,$action);
        }
      }

       $rec["Posted"] = "Yes";
       $rec["ModifiedBy"] = $user;
       $rec["DatePosted"] = $db->GetOne("select current_timeStamp");
       $criteria = "S_ROWID='$MeetingID'";
       $table  = "committeemeetings";
       $action = "UPDATE";
       $db->AutoExecute($table,$rec,$action,$criteria);
     
     }

// Post Plenary Attendance
     if (isset($_POST['btnPostPlenaryAtt'])) {
       $MeetingID = safehtml($_POST['MeetingID']);
       $InAtt = Array();
     $InAtt["ChairPerson"] = 0;
     $InAtt["Member"] = 0;
     $InAtt["Vice ChairPerson"] = 0;
    $getNums = $db->GetArray("select InAttendancePosition,count(*) as numb  from vw_plenaryattendance where MeetingID='$MeetingID' group by InAttendancePosition");
      foreach ($getNums as $key => $val) {
        $InAtt[$val["InAttendancePosition"]] = $val["numb"];
      }
      
      $ChairsCount =  $InAtt["ChairPerson"] + $InAtt["Vice ChairPerson"];
     if ($ChairsCount  == 0) {
      echo "<div class='alert alert-danger' style='text-align:center;'><b><i class='ace-icon fa fa-exclamation-triangle bigger-120'></i> Error! Please select atleast one Member as a ChairPerson or a Vice ChairPerson</b></div>";
      exit();
     }

      if ($InAtt["ChairPerson"] > 1) {
      echo "<div class='alert alert-danger' style='text-align:center;'><b><i class='ace-icon fa fa-exclamation-triangle bigger-120'></i> Error! Only Select One Member as ChairPerson</b></div>";
      exit();
     }

     if ($InAtt["Vice ChairPerson"] > 1) {
      echo "<div class='alert alert-danger' style='text-align:center;'><b><i class='ace-icon fa fa-exclamation-triangle bigger-120'></i> Error! Only Select One Member as Vice ChairPerson</b></div>";
      exit();
     }

       $rec["Posted"] = "Yes";
       $rec["ModifiedBy"] = $user;
       $rec["DatePosted"] = $db->GetOne("select current_timeStamp");
       $criteria = "S_ROWID='$MeetingID'";
       $table  = "plenarymeetings";
       $action = "UPDATE";
       $db->AutoExecute($table,$rec,$action,$criteria);

     }

      
?>