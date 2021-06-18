<?php 
session_start();
 include("assets/bin/con_db.php");
 global $db;
 //$db->debug=1;
   $user = $_SESSION['user'];
  $modCode = safehtml($_POST['ModCode']);
  
 /* if (!VToken::checkT(trim($_POST['token']))) {
    echo "InvalidRequest :- ".$_POST['token'];
    exit();
  }*/
  unset($_POST['token']);

  $MView = $rs->getDataTblView($modCode);
  $cols =  $MView["ViewCols"];
  $tableName = $MView["ModInfo"]["TableName"];
  $ModuleCode = $MView["ModInfo"]["ModuleCode"];
  $ModuleName = $MView["ModInfo"]["ModuleName"];
  $EnablePreview = $MView["ModInfo"]["EnablePreview"];

  $search = $_POST['search'];
  $SearchValue = safehtml(trim($search["value"]));
   $where = " where 1=1 ";
  
   $userInfo = $rs->row("dh_users","loginid = '$user'");

  $userType = isset($userInfo['user_type']) ? $userInfo['user_type'] : "";

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


     if ($userType != "") {
        $criteria = "";
         if ($ModuleName == "Members") {
             $criteria = $userType == "Deacon" ?  " and District in (select DistrictCode from tbl_districts where MATCH(DistrictLeader,Deacon1,Deacon1) AGAINST ('$user' IN BOOLEAN MODE)) " : "";
             
         }
         elseif ($ModuleName == "Manage Contributions") 
         {
          $criteria = $userType == "Deacon" ?  " and DistrictCode in (select DistrictCode from tbl_districts where MATCH(DistrictLeader,Deacon1,Deacon1) AGAINST ('$user' IN BOOLEAN MODE)) " : "";
         }
         
      
       $where .= " $criteria ";
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
   $searchqry["qrysmt"] = $userType;

   $array = array();
   $array["draw"] = $_POST['draw'];
   $array["recordsTotal"] = $count;
   $array["recordsFiltered"] = $count;
   $array["data"] =  $recdata;
   $array["QryParams"] = $searchqry;
   echo json_encode($array);
?>