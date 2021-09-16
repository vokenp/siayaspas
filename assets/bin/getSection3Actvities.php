<?php
include("../timeout.php");
 include("con_db.php");
global $db;
//$db->debug=1;

      $CurTable = "tbl_section3";
      $search = $_POST['search'];
      $AppraisalID = $_POST['AppraisalID'];

   $recdata = array();
   $cols = $db->metaColumnNames($CurTable,true);
   $k = 0;

   $Order = $_POST['order'];
  $OrderColumn = $cols[$Order[0]["column"]];
  $OrderDire = $Order[0]["dir"];

   $where = "where AppraisalID='$AppraisalID'  ";

   $getData = $db->SelectLimit("select *from $CurTable $where order by S_ROWID asc",$_POST['length'],$_POST['start']);
   $count = $getData->RecordCount();
    while (!$getData->EOF) {
      $rst = array();

        $rst = $getData->fields;

      $S_ROWID = $rst["S_ROWID"];
      $rowData = json_encode($rst);

     $ResetPswd = "<a href='#' onclick='doRemoveActivity(\"$S_ROWID\"); return false;' title='Remove Activity'><span class='red'><i class='ace-icon fa fa-trash bigger-120'></i></span></a>";
     $EditColumn = "<a id='row-$S_ROWID' href='#' onclick='DoEditActivity(\"$S_ROWID\");  return false;' title='Edit Activity' data-value='$rowData'><span class='yellow'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a>";

      $ActionList =  $EditColumn.str_repeat("&nbsp;", 5).$ResetPswd;


     // $ActionList = $AppCode == "General" ? "" : $ActionList;
      $k +=1;
      $record = array();
      $record[] = $k;
      $record[] = $rst["ActivityDescription"];
      $record[] = $rst["TargetNo"];
      $record[] = $rst["WeightPercentage"];
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
