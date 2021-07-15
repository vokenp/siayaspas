<?php
   include("assets/bin/con_db.php");
   global $db;
   $message ="sasa Test";
   $SendTo = array("+254712364528");
          sendSMS($SendTo,$message);
?>
