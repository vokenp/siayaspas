<?php

include("../../timeout.php");
 include("../../assets/bin/con_db.php");
global $db;
//$db->debug=1;

   $CurTable = "appconfigs";
      $search = $_POST['search'];
     $q = safehtml(trim($search["value"]));
     $SearchField = "confName";
   $recdata = array();
   $cols = $db->metaColumnNames($CurTable,true);
   $k = 0;

   $Order = $_POST['order'];
  $OrderColumn = $cols[$Order[0]["column"]];
  $OrderDire = $Order[0]["dir"];

   $where = "where 1=1  ";
  if ($q != "") {
    $where .= " and $SearchField like '%$q%'";
  }

   $getData = $db->SelectLimit("select *from $CurTable $where order by confName $OrderDire",$_POST['length'],$_POST['start']);
   $count = $getData->RecordCount();
    while (!$getData->EOF) {
      $rst = array();

        $rst = $getData->fields;

      $S_ROWID = $rst["S_ROWID"];

      $link = "?page=139&cid=$S_ROWID&sk=".sha1($S_ROWID);
     $DeleteColumn = "<a href='#' onclick='DoDeleteRecord(\"$S_ROWID\"); return false;' title='Delete  Record'><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>";
     $EditColumn = "<a href='$link' onclick='DoEditRecord(\"$S_ROWID\"); return false;' title='Edit Record'><span class='yellow'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a>";


      $ActionList =  $DeleteColumn;

      $ActionList =  $ActionList;
      $k +=1;
      $record = array();
      $record[] = $k;
      $record[] = $rst["confName"];
      
      $record[] = $rst["confType"];
      $record[] = $rst["AttribLabel"];
      $record[] = $rst["AttribType"];
      $record[] = $rst["AttribRequired"];
      $record[] = date('D jS M Y g:i a',strtotime($rst["DateCreated"]));
      $record[] = $ActionList;
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
