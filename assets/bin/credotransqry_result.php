<?php
include("con_db.php");
global $db;
$postData = file_get_contents('php://input');
//file_put_contents('index.php', $postData. ";\n\n", FILE_APPEND);
$header = json_encode(getallheaders());

    $respBody = json_decode($postData,true);


    $exec = $db->Execute("insert into csrf_tracker(postString) values ('$postData')");

      $resdata = $respBody["Result"];
      $record["ResultType"] = $resdata["ResultType"];
      $record["ResultCode"] = $resdata["ResultCode"];
      $record["ResultDesc"] = $resdata["ResultDesc"];
      $record["OriginatorConversationID"] = $resdata["OriginatorConversationID"];
      $record["ConversationID"] = $resdata["ConversationID"];
      $record["TransactionReceipt"] = $resdata["TransactionID"];
      $UUID = "";
          if ($resdata["ResultCode"] == 0) {
            $rest = $resdata["ResultParameters"]["ResultParameter"];
              foreach ($rest as $key => $val) {
              $record[$val["Key"]] = isset($val["Value"]) ? $val["Value"] : "";
              }
          }
      $RefData = $resdata["ReferenceData"]["ReferenceItem"];
      $RequestID = $RefData["Key"] == "Occasion" ? $RefData["Value"] : "999";

    $criteria = "RequestID = '$RequestID'";
    $table  = "tbl_trans_statusqry";
    $action = "UPDATE";
    $db->AutoExecute($table,$record,$action,$criteria);

     $Trans = $record;
    $ResultCode = $Trans["ResultCode"];
    if ($ResultCode == 0) {
      $ReceiptNo = $Trans["ReceiptNo"];
    $CheckTrans = $db->GetRow("select *from pesatrans where TransID='$ReceiptNo'");

      $arg = array_filter($CheckTrans);
         if(empty($arg))
         {
           $TransRec = array();
           $TransRec["TransactionType"] = $Trans["ReasonType"];
           $TransRec["TransID"] = $Trans["ReceiptNo"];
           $TransRec["TransTime"] = $Trans["InitiatedTime"];
           $TransRec["TransAmount"] = $Trans["Amount"];
           list($BusinessShortCode,$OrgName) = explode('-',$Trans["CreditPartyName"]);
           $TransRec["BusinessShortCode"] = trim($BusinessShortCode);
           $TransRec["BillRefNumber"] = "MissedTrans";
           list($MSISDN,$FullName) = explode('-',$Trans["DebitPartyName"]);
           $TransRec["MSISDN"] = trim($MSISDN);
           $TransRec["FirstName"] = trim($FullName);
           $TransRec["CreatedBy"] = $TransRec["MSISDN"];

           $table  = "pesatrans";
           $action = "INSERT";
           $db->AutoExecute($table,$TransRec,$action);
         }
      }

?>
