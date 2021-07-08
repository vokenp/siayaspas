<?php
  include("assets/bin/con_db.php");
  global $db;

  error_reporting(E_ALL);
ini_set('display_errors', 0);

   echo "<pre>";
  $TransID  = filter_input(INPUT_GET, "transid");
  echo $TransID."<br/>";
  $resp = $rs->mp_transqry($TransID);

     print_r($resp);
    $db->debug=1;

    $configs = $db->GetRow("select * from tbl_trans_statusqry order by S_ROWID desc ");
    print_r($configs);
?>
