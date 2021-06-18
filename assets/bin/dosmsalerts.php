#!/usr/bin/php
<?php 
include("con_db.php");

global $db;
//$db->debug=1;
$TableName = "tbl_bulksms";

$getSMS = $db->SelectLimit("select * from $TableName where SMSStatus='Pending' and ScheduledDate < current_timestamp order by S_ROWID asc",50,0);
  while(!$getSMS->EOF)
  {
   $rst = array();
  	 $rst = $getSMS->fields;
       $SendTo = array();
          $str = str_replace(' ', '', $rst["SMSTo"]); 
          $SendTo[] = str_replace('-', '', $str);
          $response = sendSMS($SendTo,$rst["Message"]);
     
       foreach($response as $result) {
      $record = array();
      list($currency,$SMScost) = explode(' ', $result->cost);
    $record["SMSTo"] = $result->number;
    $record["SMSStatus"] = $result->status;
    $record["MessageID"] = $result->messageId;
    $record["SMSCost"]    = $SMScost;
    $record["StatusCode"] = $result->statusCode;
  }
       $arg = array_filter($record);
       if (!empty($arg)) {
       	$S_ROWID = $rst["S_ROWID"];
       $record["DateModified"] = $db->GetOne("select current_timestamp");
       $criteria = "S_ROWID = '$S_ROWID'";
       $table  = $TableName;
       $action = "UPDATE";
       $db->AutoExecute($table,$record,$action,$criteria);
       }
    $getSMS->MoveNext();
  }
?>