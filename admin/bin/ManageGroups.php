<?php 
   include("../../timeout.php");
 include("../../assets/bin/con_db.php");
 global $db;
 if (!isset($_SESSION['user'])) {
     header("Location: ../index.php");
     die();     
}
 $user = $_SESSION['user'];
//$db->debug=1;
 
   if (isset($_POST['btnUpdateRecord'])) {
    $tableName = safehtml($_POST['btnUpdateRecord']);  
    $S_ROWID = $_POST['S_ROWID'];
     unset($_POST['S_ROWID']);
     $GroupCode =  $_POST["GroupCode"];
     

     if (!isset($_POST['GroupUsers'])) {
       exit();
     }
     else
     {
      $GroupUsers = $_POST['GroupUsers'];
      unset($_POST['GroupUsers']);
      foreach ($GroupUsers as $key => $value) {
       
        $rec["ItemDescription"] = $value;
        $rec["ItemCode"] = $GroupCode;
        $rec["ItemType"] = "RoleUser";
        $rec["CreatedBy"] = $user;
        $table  = "listitems";
        $action = "INSERT";
        $db->AutoExecute($table,$rec,$action);
      }
     }
     

       $record["ModifiedBy"] = $user;
       $record["GroupDescrption"] = $_POST["GroupDescription"];
       $record["DateModified"] = $db->GetOne("select current_timestamp()");
       $criteria = "S_ROWID = '$S_ROWID'";
       $table  = $tableName;
       $action = "UPDATE";
       $db->AutoExecute($table,$record,$action,$criteria);
          
 }

 if (isset($_POST['DelGroupUsers'])) {
 
   $UserList = safehtml($_POST['DelGroupUsers']);
   $exec = $db->Execute("delete from listitems where S_ROWID IN ($UserList)");
 }

 if (isset($_POST['DelMenuActions'])) {
   $MenuList = safehtml($_POST['DelMenuActions']);
   $getList = $db->GetArray("select ItemCode,ItemDescription from listitems where S_ROWID IN ($MenuList) ");
     $arg = array_filter($getList);
     foreach ($getList as $key => $val) {
       $ModCode      = $val[0];
       $ModOperation = $val[1];
       $exec = $db->Execute("delete from dh_profilepermissions where ModCode='$ModCode' and ModOperation='$ModOperation'");
     }
   $exec = $db->Execute("delete from listitems where S_ROWID IN ($MenuList)");
 }


  if (isset($_POST['btnModActions'])) {
  
     if (!isset($_POST['ActionNames'])) {
       exit();
     }
     else
     {
      $ActionNames = $_POST['ActionNames'];
      $ModCode = $_POST['ModCode'];
     
      foreach ($ActionNames as $key => $value) {
        $rec["ItemDescription"] = $value;
        $rec["ItemCode"] = $ModCode;
        $rec["ItemType"] = "ModActions";
        $rec["CreatedBy"] = $user;
        $table  = "listitems";
        $action = "INSERT";
        $db->AutoExecute($table,$rec,$action);
      }
     }
         
 }

// Role Users
   if (isset($_POST['btnRoleUsers'])) {
     $GroupCode =  $_POST["GroupCode"];
     if ($_POST['GroupUsers'] == "") {
       exit();
     }
     else
     {
      $GroupUsers = explode(',', $_POST['GroupUsers']);
      foreach ($GroupUsers as $key => $value) {
       
        $rec["ItemDescription"] = $value;
        $rec["ItemCode"] = $GroupCode;
        $rec["ItemType"] = "RoleUser";
        $rec["CreatedBy"] = $user;
        $table  = "listitems";
        $action = "INSERT";
        $db->AutoExecute($table,$rec,$action);
      }
    }
  }

  // Role Profiles
   if (isset($_POST['btnRoleProfiles'])) {
     $GroupCode =  $_POST["GroupCode"];
      

     if ($_POST['ProfileRoles'] == "") {
       exit();
     }
     else
     {
      $RoleProfiles = explode(',', $_POST['ProfileRoles']);
      foreach ($RoleProfiles as $key => $value) {
       
        $rec["ItemDescription"] = $value;
        $rec["ItemCode"] = $GroupCode;
        $rec["ItemType"] = "RoleProfile";
        $rec["CreatedBy"] = $user;
        $table  = "listitems";
        $action = "INSERT";
        $db->AutoExecute($table,$rec,$action);
      }
    }
  }

?>