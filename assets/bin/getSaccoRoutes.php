<?php 
include("../timeout.php");
 include("con_db.php");
global $db;
//$db->debug=1;


      $CurTable = "tbl_routefares";
      $search = $_POST['search'];
      $RouteID = $_POST['RouteID'];
    
   $recdata = array();
   $cols = $db->metaColumnNames($CurTable,true);
   $k = 0;


   $where = "where RouteID='$RouteID'  ";
 

   $getData = $db->SelectLimit("select *from $CurTable $where order by S_ROWID asc",$_POST['length'],$_POST['start']);
   $count = $getData->RecordCount();
    while (!$getData->EOF) {
      $rst = array();
    
        $rst = $getData->fields;
      
      $S_ROWID = $rst["S_ROWID"];
      $rowData = json_encode($rst);
     
     $DeleteColumn = "<a href='#' onclick='DoDeleteRecord(\"$S_ROWID\"); return false;' title='Delete  Record'><span class='red'><i class='fas fa-trash text-red'></i></span></a>";
     $EditColumn = "<a id='row-$S_ROWID' href='#' onclick='DoEditRecord(\"$S_ROWID\");  return false;' title='Edit Record' data-value='$rowData'><span class='yellow'><i class='fas fa-edit'></i></span></a>";

      $ActionList =  $EditColumn.str_repeat("&nbsp;", 10).$DeleteColumn;

     // $ActionList = $AppCode == "General" ? "" : $ActionList;
      $k +=1;
      $record = array();
      $record[] = $k;
      $record[] = date('g:i A',strtotime($rst["StartTime"]))." - ".date('g:i A',strtotime($rst["EndTime"])); 
      $record[] = pesa($rst["MinFare"]); 
      $record[] = pesa($rst["MaxFare"]); 
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