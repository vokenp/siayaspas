<?php 
include("../timeout.php");
include("con_db.php");
global $db;
//$db->debug=1;
$user = $_SESSION['user'];

  $q = safehtml(trim($_POST['SearchQry']));
  $SearchField = safehtml($_POST['SearchField']);

  $modCode = safehtml($_POST['ModCode']);
  $MView = $rs->getDataTblView($modCode);
  $Viewcols =  $MView["ViewCols"];
  $tableName = $MView["ModInfo"]["TableName"];
  $ModuleCode = $MView["ModInfo"]["ModuleCode"];

  $Order = $_POST['order'];
  $OrderColumn = $Viewcols[$Order[0]["column"]];
  $OrderDire = $Order[0]["dir"];  
   
   $where = "where 1=1 ";
  if ($q != "") {
    $where .= " and $SearchField like '%$q%'";
  }

   $cols = $rs->getCols($tableName);
   $getdata = $db->SelectLimit("select * from $tableName $where order by $OrderColumn $OrderDire",$_POST['length'],$_POST['start']);
 
   $count = $db->GetOne("select count(*) from $tableName $where");
   $recdata = array();
   $pages = ceil($count/$_POST['length']);
   $modUrl = $rs->Modurl($ModuleCode);
    $userFlds = array("CreatedBy","ModifiedBy");
   while (!$getdata->EOF) {
    $rst = array();
     
     for ($key =0; $key < count($cols) ; $key++) { 
          $rst[array_search($key, $cols)] = $getdata->fields[$key];

        if(in_array($rst[array_search($key, $cols)], $userFlds)) {
        $UserInfo = $rs->UserInfo($getdata->fields[$key],"Fullname");
        $rst[array_search($key, $cols)] = $UserInfo == "" ? $getdata->fields[$key] : $UserInfo."(".$getdata->fields[$key].")";
       }
        }

     $S_ROWID = $rst["S_ROWID"];
     $cidlink = "&cid=$S_ROWID&sk";
     $LinkUrl = str_replace('&sk', $cidlink, $modUrl);
     $editLink = "<a href='$LinkUrl' title='Edit UserGroup'><i class='fa fa-edit fa-lg'></i></a>";
     $rst["S_ROWID"] = $editLink;


  
     $record = array();
     foreach ($Viewcols as $rkey => $Rstval) {
      $record[] = $rst[$Rstval];
     }
        $recdata[] = $record;
    $getdata->MoveNext();
   }
   $array = array();
   $array["draw"] = $_POST['draw'];
   $array["recordsTotal"] = $count;
   $array["recordsFiltered"] = $count;
   $array["data"] =  $recdata;
   echo json_encode($array);
?>