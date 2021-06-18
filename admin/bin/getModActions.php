<?php 
include("../../timeout.php");
 include("../../assets/bin/con_db.php");
global $db;
//$db->debug=1;
$user = $_SESSION['user'];
$tableName = "listitems"; 
$ModCode = safehtml($_POST['ModCode']); 

   $where = " where ItemType='ModActions' and ItemCode='$ModCode'";
   $getdata = $db->SelectLimit("select * from $tableName $where order by S_ROWID asc",$_POST['length'],$_POST['start']);
   $count = $getdata->RecordCount();
   $recdata = array();
   $pages = ceil($count/$_POST['length']);
   while (!$getdata->EOF) {
    $rst = array();
     $rst = $getdata->fields;
        $S_ROWID = $rst["S_ROWID"];
        $ActionName = $rst["ItemDescription"];
        $record = array();
         $checkBox = "<input type='checkbox' name='tblchbx[]' id='rowid_$S_ROWID' value='$S_ROWID' class='dt-checkbox form-control'>";
        $record[] = $ActionName == "View" ? "" : $checkBox ;
      $ActionInfo = $rs->row("menuactions","ActionName='$ActionName'");
        $record[] = $ActionName;
        $record[] = $ActionInfo["MenuDescription"];
        $record[] = $ActionInfo["MenuType"];
        
       
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