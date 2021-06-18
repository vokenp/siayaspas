<?php
include("../assets/bin/con_db.php");
global $db;
$db->debug=1;
  $filename = "list.txt";
$fd = fopen ($filename, "r");
$contents = fread ($fd,filesize ($filename));
fclose ($fd);
$delimiter = "\n";
$splitcontents = explode($delimiter, $contents);
  array_pop($splitcontents);
  foreach ($splitcontents as $key => $value) {
  	  $item = explode(':', $value);
  	  $record["FullName"] = $item[0];
  	  $record["Ward"] = $item[1];
  	  $record["PhoneNo"] = $item[2];
  	  $record["PersonnelNo"] = $item[2];

  	   $record["CreatedBy"] = "admin";
       $record["DateCreated"] = $db->GetOne("select current_timestamp");
       $table  = "committemembers";
       $action = "INSERT";
       // $db->AutoExecute($table,$record,$action);
  }
?>