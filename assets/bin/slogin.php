<?php
    session_start();
	include('con_db.php');
	global $db;
    //$db->debug=1;
   
    if (!VToken::checkT(trim($_POST['_token']))) {
    echo "<i class='icon fas fa-exclamation-triangle'></i>InvalidRequest";
    exit();
  }

	
 if (isset($_POST['btnlogin'])) {
 	$username  = safehtml(trim($_POST['UserName']));
 	$SaccoCode = safehtml(trim(strtoupper($_POST['SaccoCode'])));
	$psw 	   = safehtml(trim($_POST['Pswd']));
	$pswd 	  = safehtml(trim(md5($psw.$SaccoCode.'GodFirst'.$username)));

	  //$db->debug=1;

	   $getuser =$rs->row("tbl_saccousers","PhoneNo='$username' and UserPswd='$pswd' and SaccoCode='$SaccoCode' and UserRole in ('SaccoAdmin','SaccoAuditor') ");
	        $arg = array_filter($getuser);
	       if(!empty($getuser["S_ROWID"]))
		   {
		   	 if ($getuser["UserStatus"] != "Active") {
		   	 	echo "<p>Your account has been suspened. Consult Admin for Assistance!</p>";
		   	 	exit();
		   	 }
        
             $_SESSION['UserID'] = $getuser["S_ROWID"];
             $_SESSION['user'] = $getuser["PhoneNo"];
		     $_SESSION['UserType'] = $getuser["user_type"];
			 $_SESSION['sessionid'] = md5(session_id().$_SESSION['UserID']."Sacco");
			$newid = $_SESSION['sessionid'];
			$host = $_SERVER['REMOTE_ADDR'];
			$browser = $_SERVER['HTTP_USER_AGENT'];
			$log =$db->Execute("insert into syslogin(logged_user,session_id,host,browser,LoginType) values ('$username','$newid','$host','$browser','SaccoApp')");
			echo "Success";
			
		   }
		   else
		   {
		       echo "<i class='icon fas fa-exclamation-triangle'></i>Wrong UserName or Password Please Try Again";
		   }
    }

 if (isset($_POST['btnforgotpswd'])) {
 	$username  = safehtml(trim($_POST['UserName']));
 	$SaccoCode = safehtml(trim(strtoupper($_POST['SaccoCode'])));

 	 $getuser =$rs->row("tbl_saccousers","PhoneNo='$username'  and SaccoCode='$SaccoCode' and UserRole in ('SaccoAdmin','SaccoAuditor') ");
	        $arg = array_filter($getuser);
	       if(!empty($getuser["S_ROWID"]))
		   {
		   	 if ($getuser["UserStatus"] != "Active") {
		   	 	echo "Your account has been suspened. Consult Admin for Assistance!";
		   	 	exit();
		   	 }

		   	 $psw = mt_rand(10000,99999);
      $SaccoCode = $getuser["SaccoCode"];
      $PhoneNo = $getuser["PhoneNo"];
      $UserID = $getuser["S_ROWID"];
     $pswd = safehtml(trim(md5($psw.$SaccoCode.'GodFirst'.$PhoneNo)));     
      $FirstName = $getuser["FirstName"];     
      $exec = $db->Execute("update tbl_saccousers set DateModified=current_timestamp,AuthToken=null,UserPswd='$pswd' where S_ROWID=$UserID");

        $SendTo = array("+".$PhoneNo);
        $message = "Hi $FirstName your DalaPay Account Password has been  Reset: New Passcode : $psw";
          sendSMS($SendTo,$message);
          echo "Success";
		  }
		  else
		  {
		  	echo "Invalid Details, account does not exist!";
		  }
 }
?>