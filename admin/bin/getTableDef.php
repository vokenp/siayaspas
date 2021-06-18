<?php 
include("../../timeout.php");
 include("../../assets/bin/con_db.php");
global $db;
//$db->debug=1;

  $CurTable = safehtml($_POST['CurTable']);
    if ($CurTable != "") {
      $Cols = $db->metaColumns($CurTable);
    }
    else
    {
      $Cols = array();
    }
  
   $count = count($Cols);
   $recdata = array();


   $k = 0;
  foreach ($Cols as $key => $ColNames) {
    $ColNames = (array)$ColNames;
   $record = array();
   $k += 1;

   $DefaultCols = array("S_ROWID","CreatedBy","DateCreated","ModifiedBy","DateModified");

   $ColumnName = $ColNames["name"] ;
   $DefaultValue = isset($ColNames["default_value"]) ? $ColNames["default_value"] : "";
   $PLabel = $ColNames["primary_key"] == "true" ? "<span class='label label-sm label-success' title='Primary Key'>Primary</span>" : "";
    $HasDefault = $ColNames["has_default"] == "true" ? "<span class='label label-sm label-danger' title='Has Default: $DefaultValue'><i class='fa fa-check-square-o'></i></span>" : "";
    $DropColumn = "<a href='#' onclick='DoDropColumn(\"$ColumnName\"); return false;' title='Drop Column'><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>";
   $ReNameColumn = "<a href='#' onclick='DoRenameColumn(\"$ColumnName\"); return false;' title='Rename Column'><span class='yellow'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a>";

   $alterColumn = "<a href='#' onclick='DoalterColumn(\"$ColumnName\"); return false;' title='Alter Column'><span class='blue'><i class='ace-icon fa fa-bookmark bigger-120'></i></span></a>";

   $ActionList =  $alterColumn.str_repeat("&nbsp;", 5).$ReNameColumn.str_repeat("&nbsp;", 5).$DropColumn;
   $ActionList = in_array($ColumnName, $DefaultCols) ? "" : $ActionList;

$record[] = $k;
$record[] = $ColNames["name"]." ".$PLabel." ".$HasDefault; 
$record[] = $ColNames["type"]; 
$record[] = $ColNames["max_length"]; 
$record[] = $ActionList;

   $recdata[] = $record;
  }
 
   $array = array();
   $array["draw"] = $_POST['draw'];
   $array["recordsTotal"] = $count;
   $array["recordsFiltered"] = $count;
   $array["data"] =  $recdata;
   echo json_encode($array);
?>