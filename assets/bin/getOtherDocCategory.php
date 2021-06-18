<?php 

include("../timeout.php");
 include("con_db.php");
global $db;
//$db->debug=1;

      $CurTable = "listitems";
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

   $getData = $db->Execute("select *from $CurTable where ItemType='OtherDocCategory' order by S_ROWID asc");
   $count = $getData->RecordCount();
    while (!$getData->EOF) {
      $rst = array();
    
        $rst = $getData->fields;
      
      $S_ROWID = $rst["S_ROWID"];
      
  
      $k +=1;
      $record = array();
     // $record[] = $k;

      $DocumentCategory = $rst["ItemDescription"];
      $link = "<a href='#' id='CatID-$S_ROWID' onclick='OpenDocType(\"$DocumentCategory\",\"$S_ROWID\"); return false;'>$DocumentCategory</a>";
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