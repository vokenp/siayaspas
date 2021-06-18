<?php 
include("../assets/bin/con_db.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
  echo "<pre>";
 $MemID = "92";
      $getReminders = $db->Execute("select * from vw_committeemeetings where Posted='No' and CommitteeID  in (select  CommitteeID from vw_commMemberList where MemID='$MemID') and  MeetingDate  >= curdate()  order by MeetingDate asc");
        $response = array();
        while (!$getReminders->EOF) {
          $rst = $getReminders->fields;
          $response[] = array("Subject"=>"Meeting ".date('D jS M Y',strtotime($rst["MeetingDate"])),"Venue"=>$rst["Venue"],"Agenda"=>$rst["Agenda"],"CommitteeName"=>$rst["CommitteeName"],"MeetingTime"=>$rst["MeetingDate"],"ClerkName"=>$rst["ClerkName"],"ClerkEmail"=>$rst["ClerkEmail"]);
          $getReminders->MoveNext();
        }
  print_r($response);


?>