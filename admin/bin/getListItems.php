<?php 

include("../../timeout.php");
 include("../../assets/bin/con_db.php");
global $db;
//$db->debug=1;

   $CurTable = "listitems";
      $search = $_POST['search'];
      $ItemType = $_POST['CurItemType'];
     $q = safehtml(trim($search["value"]));
     $SearchField = "ItemDescription";
   $recdata = array();
   $cols = $db->metaColumnNames($CurTable,true);
   $k = 0;

   $Order = $_POST['order'];
  $OrderColumn = $cols[$Order[0]["column"]];
  $OrderDire = $Order[0]["dir"];  

   $where = "where ItemType='$ItemType'  ";
  if ($q != "") {
    $where .= " and $SearchField like '%$q%'";
  }

   $getData = $db->SelectLimit("select *from $CurTable $where order by S_ROWID desc",$_POST['length'],$_POST['start']);
   $count = $getData->RecordCount();
    while (!$getData->EOF) {
      $rst = array();
    
        $rst = $getData->fields;
      
      $S_ROWID = $rst["S_ROWID"];
      $rowData = json_encode($rst);
     
     $DeleteColumn = "<a href='#' onclick='DoDeleteRecord(\"$S_ROWID\"); return false;' title='Delete  Record'><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>";
     $EditColumn = "<a id='row-$S_ROWID' href='#' onclick='DoEditRecord(\"$S_ROWID\");  return false;' title='Edit Record' data-value='$rowData'><span class='yellow'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a>";

      $ActionList =  $EditColumn.str_repeat("&nbsp;", 5).$DeleteColumn;

     // $ActionList = $AppCode == "General" ? "" : $ActionList;
      $k +=1;
      $record = array();
      $record[] = $k;
      $record[] = $rst["ItemType"]; 
      $record[] = $rst["ItemCode"]; 
      $record[] = $rst["ItemDescription"]; 
      $record[] = $rst["CreatedBy"]; 
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