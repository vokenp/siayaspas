#!/usr/bin/php
<?php
 include("assets/bin/con_db.php");
  global $db;
  //$db->debug=1;
  error_reporting(E_ALL);
ini_set('display_errors', 1);

  $msg ="Continue talking! Buy airtime for any network via MPESA PaybillNo: 528864 and put your PhoneNo as AccNo.\r Call us on 0712364528";


  $getlist = $db->GetArray("select *from smsblastlist where ContactedTimes=9 limit 250");
  //$getlist = $db->GetArray("select *from smsblastlist where S_ROWID=1 limit 25");
  foreach ($getlist as $key => $val) {
   $nlist = "+".$val["PhoneNo"];
   $S_ROWID = $val["S_ROWID"];

  if ($val["Source"] == "LazTech") {
    $FullName = explode(' ',$val["FullName"]);
    $FirstName = $FullName[0];
    $msg ="Hi $FirstName don't stop talking! Buy airtime for any network via MPESA PaybillNo: 528864 and put your PhoneNo as AccNo.\r Call us on 0712364528";
  }

  $SendTo = array($nlist);
  $response =  sendSMS($SendTo,$msg);
foreach ($response as $rkey => $rval) {
$rst = json_decode(json_encode($rval),true);
   $table  = "smsresponse";
   $action = "INSERT";
   $db->AutoExecute($table,$rst,$action);
 }
  $exex = $db->Execute("update smsblastlist set ContactedTimes = ContactedTimes +1 where S_ROWID=$S_ROWID");
  }




?>
