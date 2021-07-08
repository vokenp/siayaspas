<?php
session_start();
 include("assets/bin/con_db.php");
 global $db;
 //$db->debug=1;
   $user = $_SESSION['user'];
  $modCode = safehtml($_POST['ModCode']);


  $MView = $rs->getDataTblView($modCode);
  $cols =  $MView["ViewCols"];
  $tableName = $MView["ModInfo"]["TableName"];
  $ModuleCode = $MView["ModInfo"]["ModuleCode"];
  $ModuleName = $MView["ModInfo"]["ModuleName"];
  $EnablePreview = $MView["ModInfo"]["EnablePreview"];

  $search = $_POST['search'];
  $SearchValue = safehtml(trim($search["value"]));
   $where = " where 1=1 ";

  $userType = isset($_POST['userType']) ? $_POST['userType'] : "";




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

  $getdata = $db->SelectLimit("select * from $tableName $where order by $OrderColName $OrderDire ",$_POST['length'],$_POST['start']);

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
      $record[0] = $rst["S_ROWID"];
      $S_ROWID = $rst["S_ROWID"];
      $cidlink = "&cid=$S_ROWID&sk";
      $LinkUrl = str_replace('&sk', $cidlink, $modUrl);
      $editLink = "<a href='$LinkUrl' title='Open Record'><i class='fa fa-eye fa-lg'></i></a>";
      $editLink = $EnablePreview == "Y" ? $editLink : $i;

      if ($ModuleName == "Members1") {
         $ProfileImg = $rst["ProfileImg"];
         $ImgPath = $ProfileImg == "" ? "assets/profilepics/NoImage.png" : $ProfileImg;
       $record[1] = "<a href='$LinkUrl' title='Open Record'><img class='profile-user-img img-responsive img-circle' src='$ImgPath' style='height:100px;width:100px;' ></a>";
      }
      else
      {
        $record[1] = $editLink;
      }


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
