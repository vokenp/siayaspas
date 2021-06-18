<?php 
   include("assets/bin/con_db.php");
   global $db;

  $method = isset($_POST["Method"]) ? $_POST["Method"] : "";

   if ($method == "getDocCategories") {
      $getDocCategories = $db->Execute("select *from assemblybusiness order by DisplayOrder asc");
      $list = array();
      while (!$getDocCategories->EOF) {
      	
      	$list[$getDocCategories->fields["S_ROWID"]] = $getDocCategories->fields["DocumentCategory"];
      	$getDocCategories->MoveNext();
      }

      echo json_encode($list);
   }

   if ($method == "DoUserLogin") {
      $username = safehtml($_POST['UserName']);
      $psw = safehtml($_POST['Pwsd']);
      $LoginType = safehtml($_POST['LoginType']);
      $pswd      = safehtml(trim(md5($psw.$username.'GodFirst')));
      $response = array();
      $getuser["S_ROWID"] = "";
        if ($LoginType == "PFNo") {
            $getuser = $rs->row("committemembers","PersonnelNo='$username' and Pwsd_PFNo='$pswd'");
        }elseif ($LoginType == "IDNo") {
          $getuser = $rs->row("committemembers","IDNo='$username' and Pwsd_IDNo='$pswd'");
        }
           
          if($getuser["S_ROWID"] != "")
         {
             if ($getuser["UserStatus"] != "Active") {
               $response["ErrorStatus"] = 0;
               $response["Msg"] = "Your account has been suspened. Consult ICT Support for Assistance!";
               
             }
             else
             {
         $host    = $_SERVER['REMOTE_ADDR']; 
         $browser = "Android";
         $MemID  = $getuser["S_ROWID"];
         $log =$db->Execute("insert into syslogin(logged_user,host,browser) values ('$MemID','$host','$browser')");
               $response["ErrorStatus"] = 1;
               $response["Msg"] = "Login Successful";
               $response["MemID"] = $getuser["S_ROWID"];
               $response["FullName"] = $getuser["FullName"];
               $response["Email"]    = $getuser["Email"];
               $response["PhoneNo"]  = $getuser["PhoneNo"];
               $response["Ward"]  = $getuser["Ward"];
                $response["IDNo"]  = $getuser["IDNo"];
                 $response["PersonnelNo"]  = $getuser["PersonnelNo"];
               $response["ProfileImg"]  = $getuser["ProfileImg"] == "" ? "https://apps.quarto.co.ke/assemblydocs/assets/images/avatars/avatar.png" : "https://apps.quarto.co.ke/assemblydocs/".$getuser["ProfileImg"];
             }
         }
         else
         {
               $response["ErrorStatus"] = 0;
               $response["Msg"] = "Wrong UserName or Password Please Try Again"; 
         }
         echo json_encode($response);
   }

   if ($method == "getMemberCommittees") {
      $MemID = safehtml($_POST['MemID']);
      $response = array();
      $getMemComms = $db->Execute("select *from vw_commMemberList where MemID='$MemID'");
        while (!$getMemComms->EOF) {
           $response[] = array("CommitteeID"=>$getMemComms->fields["CommitteeID"],"CommitteeName"=>$getMemComms->fields["CommitteeName"]) ;
           $getMemComms->MoveNext();
        }
     echo json_encode($response);
   }


   if ($method == "getOtherDocsCategory") {
      $response = array();
      $getDocCate = $db->Execute("select *from listitems where ItemType='OtherDocCategory'");
        while (!$getDocCate->EOF) {
           $response[$getDocCate->fields["S_ROWID"]] = $getDocCate->fields["ItemDescription"];
           $getDocCate->MoveNext();
        }
     echo json_encode($response);
   }


   if ($method == "changePwsd") {
     $MemID = safehtml($_POST['MemID']);
     $OldPswd = safehtml($_POST['oldPswd']);
     $NewPswd = safehtml($_POST['newPswd']);

      $userInfo = $db->GetRow("select PersonnelNo,IDNo from committemembers where S_ROWID='$MemID'");
      $PersonnelNo = $userInfo["PersonnelNo"];
      $IDNo        = $userInfo["IDNo"];
       $Npswd_PFNo      = safehtml(trim(md5($NewPswd.$PersonnelNo.'GodFirst')));
       $Npswd_IDNo      = safehtml(trim(md5($NewPswd.$IDNo.'GodFirst')));
       $OPswd_PFNo      = safehtml(trim(md5($OldPswd.$PersonnelNo.'GodFirst')));
       $OPswd_IDNo      = safehtml(trim(md5($OldPswd.$IDNo.'GodFirst')));
      $response = array();
      $getuser = $rs->row("committemembers","PersonnelNo='$PersonnelNo' and Pwsd_PFNo='$OPswd_PFNo'");
      if($getuser["S_ROWID"] != "")
         {
          $S_ROWID = $getuser["S_ROWID"];
          $exec = $db->Execute("update committemembers set Pwsd_PFNo='$Npswd_PFNo',Pwsd_IDNo='$Npswd_IDNo' where S_ROWID='$S_ROWID'"); 
          $logChanges["UserchangedPassword"] = $Npswd_PFNo;
          logAction($S_ROWID,"users",$MemID,"ChangedPassword",$logChanges,"6");
          $response["ErrorStatus"] = 1;
          $response["Msg"] = "Password Changed Successfully"; 
         }
         else
         {
          $response["ErrorStatus"] = 0;
          $response["Msg"] = "Invalid Old Password. Please try Again."; 
         }
     echo json_encode($response);
   }


      if ($method == "resetPwsd") {
     $username = safehtml($_POST['UserName']);
     $LoginType = safehtml($_POST['LoginType']);
       if ($LoginType == "PFNo") {
         $getuser = $rs->row("committemembers","PersonnelNo='$username'");
       }
       elseif ($LoginType == "IDNo") {
         $getuser = $rs->row("committemembers","IDNo='$username'");
       }
     $randompswd = generatePassword(7,5);
     
      $response = array();
      
      if($getuser["S_ROWID"] != "")
         {
          $S_ROWID = $getuser["S_ROWID"];
          $PersonnelNo = $getuser["PersonnelNo"];
          $IDNo = $getuser["IDNo"];
          $Npswd_PFNo      = safehtml(trim(md5($randompswd.$PersonnelNo.'GodFirst')));
          $Npswd_IDNo      = safehtml(trim(md5($randompswd.$IDNo.'GodFirst')));
          $exec = $db->Execute("update committemembers set Pwsd_PFNo='$Npswd_PFNo',Pwsd_IDNo='$Npswd_IDNo' where S_ROWID='$S_ROWID'"); 
          
          $SendTo = array("+254729511569") ;
          $message = "Password Changed Successfully. New Password is $randompswd";
          sendSMS($SendTo,$message);

          $response["ErrorStatus"] = 1;
          $response["Msg"] = "Password Reset Successfully"; 
          $logChanges["PasswordReset"] = $Npswd_PFNo;
          logAction($S_ROWID,"users",$S_ROWID,"PasswordReset",$logChanges,"6");
          
         }
         else
         {
          $response["ErrorStatus"] = 0;
          $response["Msg"] = "Invalid PFNo/IDNo, Please try Again."; 
         }
     echo json_encode($response);
   }


   if ($method == "getAssemblyDocList") {
      $CategoryID = safehtml($_POST['CategoryID']);
      $DocType =  safehtml($_POST['DocType']);
      $DocumentCategory = $DocType."-".$CategoryID;
      $getDocs = $db->Execute("select *from assemblybizdocs where DocumentCategory='$DocumentCategory' order by S_ROWID desc");
      $response = array();
      while (!$getDocs->EOF) {
        $rst = $getDocs->fields;
        $DocID = $rst["DocID"];
        $Recid = $rst["DocID"];
          $getfiles = $rs->row("elementstorage"," S_ROWID='$DocID' ");
          $StoragePath = $rs->getConf("AssetPath","AssetPath");
          $FileName = $getfiles["Orginal_FileName"];
         $Version = str_pad((int)$getfiles["Version"], 5, "0", STR_PAD_LEFT);
         $LastDoc  =  $Recid < 100 ? $Recid : substr($Recid,-2);
         $RecPath  =  $rs->getFilePath($Recid);
         $FileName = $LastDoc.$Version."-".$FileName;
         $filepath = $StoragePath.$RecPath.$FileName;
         $rst["CommitteeDocType"] = $rst["CommitteeDocType"] == "" ? "UnCategorized" : $rst["CommitteeDocType"];

        $response[$DocID]["DocumentTitle"]  = $rst["DocumentTitle"];
        $response[$DocID]["DocumentDate"]   = $rst["DocumentDate"];
        $response[$DocID]["FileSize"]   = filesize_formatted($getfiles["Orginal_FileName"]);
        $response[$DocID]["DocumentPath"]   = $filepath;
      if ($DocType == "CommitteeDocs") {
         $response[$DocID]["CommitteeDocType"]  = $rst["CommitteeDocType"];
      }
        $getDocs->MoveNext();
      }

      echo json_encode($response);
   }

   if ($method == "getNewNotifications") {
      $MemID = safehtml($_POST['MemID']);
      $getNots =  $db->Execute("select *from notifications where NStatus='Pending' and NTargetedTo='$MemID'");
      $response = array();
      while (!$getNots->EOF) {
        $rst = $getNots->fields;
        $S_ROWID = $rst["S_ROWID"];
        $NBody   = $rst["NBody"];
        $DateCreated = $rst["DateCreated"];
        $response[] = array("NotificationID"=>$S_ROWID,"NBody"=>$NBody,"DateCreated"=>$DateCreated);
        $getNots->MoveNext();
      }
   }

    if ($method == "UpdateNotification") {
         $NotificationID = safehtml($_POST['NotificationID']);
        $exec = $db->Execute("update notifications set NStatus='Read',DateModified=current_timestamp where S_ROWID='$NotificationID'");
    }

?>