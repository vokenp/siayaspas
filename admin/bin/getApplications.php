<?php 

include("../../timeout.php");
 include("../../assets/bin/con_db.php");
global $db;
//$db->debug=1;

   $CurTable = "dh_applications";
      $search = $_POST['search'];
     $q = safehtml(trim($search["value"]));
     $SearchField = "ApplicationName";
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

   $getData = $db->SelectLimit("select *from $CurTable $where order by ApplicationName $OrderDire",$_POST['length'],$_POST['start']);
   $count = $getData->RecordCount();
    while (!$getData->EOF) {
      $rst = array();
    
        $rst = $getData->fields;
      
      $S_ROWID = $rst["S_ROWID"];
      $AppCode = $rst["AppCode"];
     $ExemptList = array("UserProfile","SystemApps");
      $link = "?page=132&cid=$S_ROWID&sk=".sha1($S_ROWID);
     $DeleteColumn = "<a href='#' onclick='DoDeleteRecord(\"$S_ROWID\"); return false;' title='Delete  Record'><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>";
     $EditColumn = "<a href='$link' onclick='DoEditRecord(\"$S_ROWID\"); return false;' title='Edit Record'><span class='yellow'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a>";
      
      $DeleteColumn = in_array($AppCode, $ExemptList) ? "" : $DeleteColumn;
      $ActionList =  $EditColumn.str_repeat("&nbsp;", 5).$DeleteColumn;

      $ActionList = $AppCode == "General" ? "" : $ActionList;
      $k +=1;
      $record = array();
      $record[] = $k;
      $record[] = $rst["ApplicationName"]; 
      $record[] = $rst["IconRef"]; 
      $record[] = $rst["DisplayOrder"]; 
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