<?php 
include("../timeout.php");
 include("con_db.php");
global $db;
//$db->debug=1;

      $CurTable = "tbl_saccousers";
      $search = $_POST['search'];
      $SaccoCode = $_POST['SaccoCode'];
     $q = safehtml(trim($search["value"]));
     $SearchField = "FirstName";
   $recdata = array();
   $cols = $db->metaColumnNames($CurTable,true);
   $k = 0;

   $Order = $_POST['order'];
  $OrderColumn = $cols[$Order[0]["column"]];
  $OrderDire = $Order[0]["dir"];  

   $where = "where SaccoCode='$SaccoCode'  ";
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
     
     $ResetPswd = "<a href='#' onclick='doResetPswd(\"$S_ROWID\"); return false;' title='Reset Password'><span class='red'><i class='ace-icon fa fa-key bigger-120'></i></span></a>";
     $EditColumn = "<a id='row-$S_ROWID' href='#' onclick='DoEditRecord(\"$S_ROWID\");  return false;' title='Edit Record' data-value='$rowData'><span class='yellow'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a>";

      $ActionList =  $EditColumn.str_repeat("&nbsp;", 5).$ResetPswd;

     // $ActionList = $AppCode == "General" ? "" : $ActionList;
      $k +=1;
      $record = array();
      $record[] = $k;
      $record[] = $rst["PhoneNo"]; 
      $record[] = $rst["FirstName"]." ".$rst["OtherNames"]; 
      $record[] = $rst["UserEmail"]; 
      $record[] = $rst["UserRole"]; 
      $record[] = $rst["UserStatus"]; 
      $record[] = $rst["CreatedBy"]."<br/> on ".date('D jS M Y g:i a',strtotime($rst["DateCreated"])); 
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