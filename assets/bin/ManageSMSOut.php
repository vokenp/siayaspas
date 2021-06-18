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

$curDate = $db->GetOne("select current_timestamp");
if (isset($_POST['btnSaveRecord'])) {
  $tableName = "tbl_messageout";
 
  $ReturnType = isset($_POST['ReturnType']) ? "RstID" : "Message";
   $ModCode = isset($_POST['ModCode']) ? $_POST['ModCode'] : "";
   unset($_POST['ReturnType']);
   unset($_POST['ModCode']);
   $SendChannel  = $_POST['SendChannel'];
   $GroupSMSList = isset($_POST['GroupSMSList']) ? $_POST['GroupSMSList'] : array() ;
   $MessageType  = $_POST['MessageType'];
   $TemplateID   = $_POST['TemplateID'];
   $MessageBody  = $_POST['MessageBody'];
   $SendFrequency = $_POST['SendFrequency'];
   $SendDate = $_POST['SendDate'];
   $SendTime = $_POST['SendTime'];
   
   $distList = array();

   

   if ($SendChannel == "Committees") {
   	
   	$RecList = implode(',', $GroupSMSList);
   	$getRecList = $db->Execute("select *from vw_commMemberList where CommitteeID in ($RecList)");
   	  while (!$getRecList->EOF) {
   	  	$rst = array();
   	  	$rst = $getRecList->fields;
      
       $distList[$rst['PhoneNo']] = array($rst['S_ROWID'],$rst['FullName'],$SendChannel,$rst['CommitteeName']);
   	  	$getRecList->MoveNext();
   	  }
   }
   elseif ($SendChannel == "UserGroups") {  	
   	$RecList = "'".implode("','", $GroupSMSList)."'";
   	$getRecList = $db->Execute("select *from vw_usergroups where UserGroup in ($RecList)");
   	  while (!$getRecList->EOF) {
   	  	$rst = array();
   	  	$rst = $getRecList->fields;
      
       $distList[$rst['Phone']] = array($rst['S_ROWID'],$rst['Fullname'],$SendChannel,$rst['UserGroup']);
   	  	$getRecList->MoveNext();
   	  }
   }

   elseif ($SendChannel == "Members") {    
    $RecList = implode(",", $GroupSMSList);
    $getRecList = $db->Execute("select *from committemembers where S_ROWID in ($RecList)");
      while (!$getRecList->EOF) {
        $rst = array();
        $rst = $getRecList->fields;
      
       $distList[$rst['PhoneNo']] = array($rst['S_ROWID'],$rst['FullName'],$SendChannel,$rst['Ward']);
        $getRecList->MoveNext();
      }
   }

   $record["SendChannel"] = $SendChannel ;
   $record["MessageType"] = $MessageType ;
   $record["MessageBody"] = $MessageBody ;
   $record["SendFrequency"] = $SendFrequency ;
   if ($SendFrequency == "ScheduleMessage") {
     $record["SendDate"] = date('Y-m-d',strtotime($SendDate)) ;
   $record["SendTime"] = date('H:i:s',strtotime($SendTime)) ;
   }

   $record["CreatedBy"] = $user;
    $table  = "tbl_messageout";
    $action = "INSERT";
    $db->AutoExecute($table,$record,$action);

    if ($db) {
    	$ParentMsgID = $db->GetOne("select max(S_ROWID) from tbl_messageout ");
    	foreach ($distList as $key => $value) {
    		$rec["SMSTo"] = $key;
    		$rec["Message"] = $MessageBody;
    		$rec["CharaterCount"] = strlen($MessageBody);
    		$rec["ReceiptID"] = $value[0];
        $rec["ReceiptientName"] = $value[1];
    		$rec["SendChannel"] = $SendChannel;
        $rec["SendFrequency"] = $SendFrequency;
    		$rec["GroupCode"] = $value[3];
    		$rec["ParentMsgID"] = $ParentMsgID;
    		$rec["ScheduledDate"] = $SendFrequency =="SendNow" ? $curDate : date('Y-m-d H:i:s',strtotime($SendDate." ".$SendTime));

    		$rec["CreatedBy"] = $user;
            $table  = "tbl_bulksms";
            $action = "INSERT";
            $db->AutoExecute($table,$rec,$action);
    	}
    }

 }
?>