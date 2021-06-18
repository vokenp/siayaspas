<?php 
include("../timeout.php");
 include("con_db.php");
 global $db;
 //$db->debug=1;
  $modCode = safehtml($_POST['ModCode']);
  $PYear = safehtml($_POST['PYear']);
  $PMonth = safehtml($_POST['PMonth']);

 
  $MView = $rs->getDataTblView($modCode);
  $cols =  $MView["ViewCols"];
  $tableName = $MView["ModInfo"]["TableName"];
  $ModuleCode = $MView["ModInfo"]["ModuleCode"];
  $ModuleName = $MView["ModInfo"]["ModuleName"];
  $EnablePreview = $MView["ModInfo"]["EnablePreview"];

  $search = $_POST['search'];
  $SearchValue = safehtml(trim($search["value"]));

  $where = " where month(MeetingDate)='$PMonth' and year(MeetingDate)='$PYear'";
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
      $rst = $getdata->fields;
      $MemID = $rst["MemID"];

      $list[$MemID][] = $rst;
    $getdata->MoveNext();
   }

    $i = 0;
      $recdata = array();
   foreach ($list as $Memkey => $rst1) {
      $i += 1;

      $record = array();
      $record[0] = $i;
      $record[1] = $i;
      $monthName = date("F", mktime(0, 0, 0, $PMonth, 10));
        $MemID = $rst["MemID"];
      $PayOutAmount = 0 ;
      $SittingsCount = 0;
       
      foreach ($rst1 as $key => $rstvalue) {
      if ($key == 15) break;
         $PayOutAmount  += $rstvalue["PayOutAmount"];
          $SittingsCount += 1;
      }
        
       $record[2] = $rst1[0]["FullName"];
       $record[3] = $SittingsCount;
       $record[4] = $monthName."-".$PYear;
       $record[5] = $PayOutAmount;

       
    $recdata[] = $record;
   }
   
   $searchqry = array();
   $searchqry["qrysmt"] = $where;

   $array = array();
   $array["draw"] = $_POST['draw'];
   $array["recordsTotal"] = $count;
   $array["recordsFiltered"] = $count;
   $array["data"] =  $recdata;
   $array["QryParams"] = $searchqry;
   echo json_encode($array);
?>