<?php
include("assets/bin/con_db.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
    echo "<pre>";
    $config = array();
    $getArray = $db->GetArray("select *from appconfigs where confType='SMSAPI'");
       foreach ($getArray as $key => $val) {
          $config[$val["confName"]] = $val["confValue"];
       }

       print_r($config);
?>
