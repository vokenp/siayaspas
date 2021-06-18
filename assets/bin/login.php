<?php
    session_start();
	include('con_db.php');
	global $db;
    //$db->debug=1;
    
    if (!VToken::checkT(trim($_POST['_token']))) {
    echo "InvalidRequest";
    exit();
  }

	
 if (isset($_POST['btnLogin'])) {
 	$username = safehtml(trim($_POST['username']));
	$psw 	  = safehtml(trim($_POST['pswd']));
	$pswd 	  = safehtml(trim(md5($psw.$username.'GodFirst')));

	   $getuser =$rs->row("dh_users","loginid='$username' and pswd='$pswd'");
	        $arg = array_filter($getuser);
	       if(!empty($getuser["S_ROWID"]))
		   {
		   	 if ($getuser["UserStatus"] != "Active") {
		   	 	echo "<p>Your account has been suspened. Consult ICT Support for Assistance!</p>";
		   	 	exit();
		   	 }
          $_SESSION['TYear'] = date('Y');
          $_SESSION['TPeriod'] = "Term1";
          $_SESSION['UserID'] = $getuser["S_ROWID"];
		  $_SESSION['user']     =  $getuser["loginid"];
			 $_SESSION['Fullname'] = $getuser["Fullname"];
		     $_SESSION['UserType'] = $getuser["user_type"];
			 $_SESSION['sessionid'] = md5(session_id().$_SESSION['UserID']);
			 $newid = $_SESSION['sessionid'];
			$host = $_SERVER['REMOTE_ADDR'];
			$browser = $_SERVER['HTTP_USER_AGENT'];
			$log =$db->Execute("insert into syslogin(logged_user,session_id,host,browser) values ('$username','$newid','$host','$browser')");
			echo "Success";
			
		   }
		   else
		   {
		       echo "Wrong UserName or Password Please Try Again";
		   }
    }

 if (isset($_POST['btnforgotpswd'])) {
 	$uName = safehtml($_POST['username']);
 	$UserInfo = $rs->row("dh_users","loginid='$uName'");
 	$response = array();
 	  if ($UserInfo["S_ROWID"] != "") {
 	  $userid = $UserInfo["S_ROWID"];

       $newpswd = generatePassword(8,10);
	
	$newpswd2 = md5($newpswd.$uName.'GodFirst');
	$getpswd =$db->Execute("update dh_users set pswd='$newpswd2' where S_ROWID='$userid' ");  
  $pswdChange["ForgotPasswordReset"] = $newpswd2;
  logAction($userid,"users",$uName,"ForgotPasswordReset",$pswdChange,38);

  $EmailTemp = $rs->row("dh_emailtemplates","TempName='ForgotPasswordReset'");
  $TempBody = $EmailTemp["TempBody"];
  $TempCss = $EmailTemp["TempCss"]; 
  $TempBody = "<div style='$TempCss'>".$TempBody."</div>";
  $TempBody = str_replace('@Fullname@',$UserInfo["Fullname"], $TempBody);
  $TempBody = str_replace('@pswd@',$newpswd , $TempBody);
  $TempBody = str_replace('@loginid@',$uName , $TempBody);

      $recMail["MsgBody"]    = $TempBody;
      $recMail["MsgSubject"] = $EmailTemp["TempSubject"];
      $recMail["MsgType"] = "Mail";
      $recMail["MsgRecipient"] = $UserInfo["Email"];
      $rs->AddAlert($recMail);
      
      list($eName,$domain) = explode('@', $UserInfo["Email"]);
      $ename = substr_replace($eName, str_repeat('*', strlen($eName)-2), 1, strlen($eName)-2)."@".$domain;

 	  	$response["aClass"] ="alert-success";
 	  	$response["html"] = "Password successfully reset. And sent to your email <b>$ename</b>.";
 	  }
 	  else{
 	  	
 	  	$response["aClass"] ="alert-danger";
 	  	$response["html"] = "UserName does not exist, Please try again.";
 	  }

 	  echo json_encode($response);
 }
?>