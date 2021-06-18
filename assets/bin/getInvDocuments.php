<?php 
include("../timeout.php");
 include("con_db.php");
global $db;
//$db->debug=1;

      $CurTable = "elementstorage";
      $search = $_POST['search'];
      $InvID = $_POST['InvID'];
     $q = safehtml(trim($search["value"]));
     $SearchField = "FileDescription";
   $recdata = array();
   $cols = $db->metaColumnNames($CurTable,true);
   $k = 0;
   $StoragePool  = "Invoice-".$InvID;
   $Order = $_POST['order'];
  $OrderColumn = $cols[$Order[0]["column"]];
  $OrderDire = $Order[0]["dir"];  

   $where = "where StoragePool ='$StoragePool'  ";
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
     
     
     $EditColumn = "<a id='row-$S_ROWID' href='#' onclick='DoEditRecord(\"$S_ROWID\");  return false;' title='Change Document name' data-value='$rowData'><span class='yellow'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a>";

      $ActionList =  $EditColumn.str_repeat("&nbsp;", 5).$ResetPswd;
         $FileDescription = $rst["FileDescription"]; 
         $uuid = $rst["UUID"];
       $url = "<a href='previewdoc.php/?doc=$uuid' title='View Document' target='_blank'>$FileDescription</a>";
     // $ActionList = $AppCode == "General" ? "" : $ActionList;
      $k +=1;
      $record = array();
      $record[] = $k;
      $record[] = $url;
      $record[] = $rst["CreatedBy"]." on ".date('D jS M Y g:i a',strtotime($rst["DateCreated"])); 
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