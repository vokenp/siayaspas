<?php 
session_start();
 include("../assets/bin/con_db.php");
 global $db;
 //$db->debug=1;
  $modCode = safehtml($_POST['ModCode']);
  $StartDate = safehtml($_POST['StartDate']);
  $EndDate = safehtml($_POST['EndDate']);
  
  $MView = $rs->getDataTblView($modCode);
  $cols =  $MView["ViewCols"];
  $tableName = $MView["ModInfo"]["TableName"];
  $ModuleCode = $MView["ModInfo"]["ModuleCode"];
  $ModuleName = $MView["ModInfo"]["ModuleName"];
  $EnablePreview = $MView["ModInfo"]["EnablePreview"];
  $AppCode = $MView["ModInfo"]["AppName"];
  $app = $db->GetOne("select S_ROWID from dh_applications where AppCode='$AppCode'");
  $search = $_POST['search'];
  $SearchValue = safehtml(trim($search["value"]));

  $SaccoCode = isset($_SESSION['SaccoCode']) ? $_SESSION['SaccoCode'] : md5(uniqid());
 
  $where = " where SaccoCode='$SaccoCode' and DateCreated between '$StartDate' and '$EndDate' ";

   $columns = $_POST['columns'];
   $keyCount  = 0;
   $SearchCol = array();
    foreach ($columns as $key => $Colval) {
    	  $ColName = $Colval["name"];
    	if ($Colval["searchable"] == "true" && $SearchValue !="" && $ColName != "") {
    	  $SearchCol[] = $ColName;
    		$keyCount +=1;
    	}
    }
       $arg = array_filter($SearchCol);
      if (!empty($arg)) {
        $SCols = implode(',', $SearchCol);
        $where .= " and CONCAT_ws('-',$SCols) like '%$SearchValue%'";
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
   while (!$getdata->EOF) {
      $i += 1;
      $rst = array();
      $rst = $getdata->fields;
      array_walk($rst,"DoDateConvert",$MetaTypes);
      $record = array();

      $record[0] = $i;
      $S_ROWID = $rst["S_ROWID"];
        $rand = md5($S_ROWID);
      $cidlink = "&cid=$S_ROWID&sk";
      $LinkUrl = "?app=$app&mod=$modCode&view=edit&ptype=temp&cid=$S_ROWID&sk=$rand";
      $editLink = "<a href='$LinkUrl' title='Open Record'><i class='fa fa-eye fa-lg'></i></a>";
      $editLink = $EnablePreview == "Y" ? $editLink : $i;
       $record[1] = $editLink;
       foreach ($cols as $key => $val) {
        $key += 1;
       	$record[$key] = $rst[$val];
       }
       
    $recdata[] = $record;
    $getdata->MoveNext();
   }
   
   $searchqry = array();
   $respsmt = array();
   $respsmt["modCode"]= $modCode;
   $respsmt["wheresmt"]= $where;
   $respsmt["SaccoCode"] = $SaccoCode;
   $respsmt["StartDate"] = $StartDate;
   $respsmt["EndDate"] = $EndDate;
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