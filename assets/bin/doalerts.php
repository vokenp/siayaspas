#!/usr/bin/php
<?php  
session_start();
include("con_db.php");
global $db;
//$db->debug=1;
error_reporting(E_ALL);
ini_set('display_errors', 1);
//echo "<pre>";
$user = "admin";
$TableName = "dhalerts";
$getAlert = $db->SelectLimit("select *from $TableName where MsgStatus='Pending'",30,0);
   if ($rs->IsConnected() == "Connected") {
      while (!$getAlert->EOF) {
        $rst = array();
        $rst = $getAlert->fields;
        $POST = array();
       $S_ROWID = $rst["S_ROWID"];
       
       if ($rst["MsgType"] == "Mail") {
        
        $MsgBody = $rst["MsgBody"];
        $subject = $rst["MsgSubject"];
        $to = explode(',', $rst["MsgRecipient"]);
        $cc = explode(',', $rst["MsgRecipientCC"]);
        $respense = $rs->sendMail($MsgBody,$subject,$to,$cc);
        $POST['MsgStatus'] = $respense;
        $POST['DateModified'] = $db->GetOne("select current_timestamp");
       }
       else
       {
         
        $SendSMSTo = explode(',', $rst["MsgRecipient"]);
        foreach ($SendSMSTo as $key => $value) {
          $str = str_replace(' ', '', $value); 
          $SendTo[] = str_replace('-', '', $str);
        }
        $message = $rst["MsgBody"];
        $response = sendSMS($SendTo,$message);
        $POST['MsgStatus'] = json_encode($response);
        $POST['DateModified'] = $db->GetOne("select current_timestamp");
       }
      
       $rs->SetValues($POST,$S_ROWID,$TableName,$user);
  $getAlert->MoveNext();
 }
   }
?>