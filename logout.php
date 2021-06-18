<?php
session_start();
include("assets/bin/con_db.php");
	global $db;
	$s_id = $_SESSION['sessionid'];
	$logout =$db->Execute("update syslogin set logout_time=current_timestamp where session_id='$s_id'");
		session_destroy();   
		session_unset(); 
        header('Location: ulogin.php'); 
	 
?>