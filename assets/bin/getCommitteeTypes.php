<?php 

include("../timeout.php");
 include("con_db.php");
global $db;
//$db->debug=1;
$user = $_SESSION['user'];

      $CurTable = "assemblycommittees";
   $recdata = array();
   $cols = $db->metaColumnNames($CurTable,true);
   $k = 0;

  /*$Order = $_POST['order'];
  $OrderColumn = $cols[$Order[0]["column"]];
  $OrderDire = $Order[0]["dir"];  

   $where = "where ItemType='$ItemType'  ";
  if ($q != "") {
    $where .= " and $SearchField like '%$q%'";
  }*/

  $userType = isset($_POST['userType']) ? $_POST['userType'] : "";
     $where = "";
    if ($userType != "") {
      $where .= $userType == "Admin" ? "" : " where ClerkResponsible='$user'";

    }

   $getData = $db->Execute("select *from $CurTable $where   order by CommitteeName asc");
   $count = $getData->RecordCount();
    while (!$getData->EOF) {
      $rst = array();
    
        $rst = $getData->fields;
      
      $S_ROWID = $rst["S_ROWID"];
      
  
      $k +=1;
      $record = array();
     // $record[] = $k;

      $DocumentCategory = $rst["CommitteeName"];
      $link = "<a href='#' id='CatID-$S_ROWID' data-value='$DocumentCategory' onclick='OpenDocType(\"$S_ROWID\"); return false;'>$DocumentCategory </a>";
      $record[] = $k; 
      $record[] = $link; 
      $recdata[] = $record;
         
    $getData->MoveNext();
    }
 
   $array = array();
   $array["draw"] = $_POST['draw'];
   $array["recordsTotal"] = $count;
   $array["recordsFiltered"] = $count;
   $array["data"] =  $recdata;
   echo json_encode($array);
?>