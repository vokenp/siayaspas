<?php 
include("../timeout.php");
 include("con_db.php");
 global $db;
 //$db->debug=1;
 $user = $_SESSION['user'];
  $modCode = safehtml($_POST['ModCode']);
  $PYear = safehtml($_POST['PYear']);
  $DistrictCode = safehtml($_POST['DistrictCode']);
  $PMonth = safehtml($_POST['PMonth']);

 
  $MView = $rs->getDataTblView($modCode);
  $cols =  $MView["ViewCols"];
  $tableName = $MView["ModInfo"]["TableName"];
  $ModuleCode = $MView["ModInfo"]["ModuleCode"];
  $ModuleName = $MView["ModInfo"]["ModuleName"];
  $EnablePreview = $MView["ModInfo"]["EnablePreview"];
  
   $District = $DistrictCode == "All" ? "  and DistrictCode in (select DistrictCode from tbl_districts where MATCH(DistrictLeader,Deacon1,Deacon1) AGAINST ('$user' IN BOOLEAN MODE))" : " and DistrictCode='$DistrictCode'";
  $search = $_POST['search'];
  $SearchValue = safehtml(trim($search["value"]));

  $where = " where month(ContributionDate)='$PMonth' and year(ContributionDate)='$PYear' $District";
   $columns = $_POST['columns'];
   $keyCount  = 0;
    foreach ($columns as $key => $Colval) {
    	  $ColName = $Colval["name"];
    	if ($Colval["searchable"] == "true" && $SearchValue !="") {
    		$operator = $keyCount == 0 ? "and" : "or";
    		$where .= " $operator $ColName like '%$SearchValue%' ";
    		$keyCount +=1;
    	}
    }
 
  $Order = $_POST['order'];
  $OrderColumn = $Order[0]["column"];
  $OrderColName = $columns[$OrderColumn]["name"];

  $OrderDire = $Order[0]["dir"]; 
  
  $getdata = $db->SelectLimit("select * from $tableName $where order by $OrderColName $OrderDire",$_POST['length'],$_POST['start']);

   $count = $db->GetOne("select count(*) from $tableName $where");
   $recdata = array();
   $pages = ceil($count/$_POST['length']);
   $modUrl = $rs->Modurl($ModuleCode);
    $userFlds = array("CreatedBy","ModifiedBy");
    $i = $_POST['start'];
    $k = 0;
    unset($cols[0]);
    $MetaTypes = metatype($tableName);
    $list = array();
   while (!$getdata->EOF) {
       $rst = array();
       $i += 1;
      $rst = $getdata->fields;
       $record = array();
       $record[0] = $i;
       $record[1] = $i;
      
       $record[2] = $rst["DistrictName"];
       $record[3] = date('D jS M Y',strtotime($rst["ContributionDate"]));
       $record[4] = pesa($rst["AmtContributed"]);
      

       
    $recdata[] = $record;
    $getdata->MoveNext();
   }

   
   $searchqry = array();
   $respsmt = array();
   $respsmt["modCode"]= $modCode;
   $respsmt["wheresmt"]= $where;
  
   $FinalSmt = json_encode($respsmt);
   $_SESSION["exportParams"] = $respsmt;
   $searchqry["qrysmt"] = OpensslEncryptHelper::encrypt($FinalSmt);

   $array = array();
   $array["draw"] = $_POST['draw'];
   $array["recordsTotal"] = $count;
   $array["recordsFiltered"] = $count;
   $array["data"] =  $recdata;
   $array["QryParams"] = $searchqry;
   echo json_encode($array);
?>