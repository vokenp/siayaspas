<?php 

include("../../timeout.php");
 include("../../assets/bin/con_db.php");
global $db;
//$db->debug=1;

   $CurTable = "dh_modules";
      $search = $_POST['search'];
     $q = safehtml(trim($search["value"]));
     $SearchField = "ModuleName";
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

   $getData = $db->SelectLimit("select *from $CurTable $where order by ModuleName $OrderDire",$_POST['length'],$_POST['start']);
   $count = $getData->RecordCount();
    while (!$getData->EOF) {
              $rst = $getData->fields;
      
      $S_ROWID = $rst["S_ROWID"];
      $AppName = $rst["AppName"];
      $link = "?page=134&cid=$S_ROWID&sk=".sha1($S_ROWID);
     $ExemptList = array("UserProfile","SystemApps");
     $DeleteColumn = "<a href='#' onclick='DoDeleteRecord(\"$S_ROWID\"); return false;' title='Delete  Record'><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>";
     $EditColumn = "<a href='$link'  title='Edit Record'><span class='yellow'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a>";

       $DeleteColumn = in_array($AppName, $ExemptList) ? "" : $DeleteColumn;

      $ActionList =  $EditColumn.str_repeat("&nbsp;", 5).$DeleteColumn;


      $k +=1;
      $record = array();
      $record[] = $k;
      $record[] = $rst["AppName"]; 
      $record[] = "<a href='$link' title='Edit Module'>".$rst["ModuleName"]."</a>"; 
      $record[] = $rst["ListingType"]; 
      $record[] = $rst["ModDest"]; 
      $record[] = $rst["ModuleType"]; 
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