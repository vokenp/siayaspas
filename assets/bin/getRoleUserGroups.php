<?php 
include("../timeout.php");
include("con_db.php");
global $db;
//$db->debug=1;
$user = $_SESSION['user'];
$tableName = "vw_usergroups"; 
$UserGroup = safehtml($_POST['UserGroup']); 


   $where = " where UserGroup='$UserGroup'";
   $getdata = $db->SelectLimit("select * from $tableName $where order by Fullname asc",$_POST['length'],$_POST['start']);
   $count = $db->GetOne("select count(*) from $tableName $where");
   $recdata = array();
   $pages = ceil($count/$_POST['length']);
   while (!$getdata->EOF) {
    $rst = array();
         $rst = $getdata->fields;
        $S_ROWID = $rst["S_ROWID"];
        $record = array();
        $record[] = "<input type='checkbox' name='tblchbx[]' id='rowid_$S_ROWID' value='$S_ROWID' class='dt-checkbox'>";
        $record[] = $rst["loginid"];
        $record[] = $rst["Fullname"];
        $record[] = $rst["user_type"];
       
       $recdata[] = $record;
    $getdata->MoveNext();
   }
   $array = array();
   $array["draw"] = $_POST['draw'];
   $array["recordsTotal"] = $count;
   $array["recordsFiltered"] = $count;
   $array["data"] =  $recdata;
   echo json_encode($array);
?>