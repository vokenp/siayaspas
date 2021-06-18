<?php 
include("../timeout.php");
include("con_db.php");
global $db;
//$db->debug=1;
$user = $_SESSION['user'];
$tableName = "vw_commMemberList"; 
$CommitteeID = safehtml($_POST['CommitteeID']); 


   $where = " where CommitteeID='$CommitteeID'";
   $getdata = $db->SelectLimit("select * from $tableName $where ORDER BY FIELD(MemberType, 'Vice ChairPerson','ChairPerson') desc",$_POST['length'],$_POST['start']);
   $count = $db->GetOne("select count(*) from $tableName $where");
   $recdata = array();
   $pages = ceil($count/$_POST['length']);
   while (!$getdata->EOF) {
    $rst = array();
         $rst = $getdata->fields;
        $S_ROWID = $rst["S_ROWID"];
        $record = array();
        $record[] = "<input type='checkbox' name='tblchbx[]' id='rowid_$S_ROWID' value='$S_ROWID' class='dt-checkbox'>";
         $ProfileImg = $rst["ProfileImg"];
         $ImgPath = $ProfileImg == "" ? "assets/profilepics/NoImage.png" : $ProfileImg;
       $record[] = "<img class='profile-user-img img-responsive img-circle' src='$ImgPath' style='height:100px;width:100px;' >";
        $record[] = $rst["PersonnelNo"];
        $record[] = $rst["IDNo"];
        $record[] = $rst["FullName"];
        $record[] = $rst["MemberType"];
        $record[] = $rst["PhoneNo"];
        $record[] = $rst["Email"];
        $record[] = $rst["Ward"];
        $record[] = $rst["Designation"];
       
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