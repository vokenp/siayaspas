<?php 
session_start();
include("assets/bin/con_db.php");
global $db;
//$db->debug=1;
  $user = $_SESSION['user'];
  $UserInfo = $rs->row("users","loginid='$user'");
  $Division = $UserInfo["Division"];
$strsort = "";
  $postvals = $_GET['postvals'];
$postexp = explode(',', $postvals);
foreach ($postexp as $key => $value) {
  $valexp = explode(':',$value);
  $_GET[$valexp[0]] = $valexp[1];
}
$mod = $_GET['mod'];
$app = $_GET['app'];
$ptype = $_GET['ptype'];
  if ($ptype == "wf") {
   $wfid   = $_GET['wfid'];
   $wfstep = $_GET['wfstep'];
   $custfilter = " WFStepName = '$wfstep' ";
  if($wfid == "2")
   {
    $StepInfo   = $rs->row("DH_workFlowSteps","S_ROWID = '$wfstep'");
   $StepCode = $StepInfo["wfStepCode"];
   if ($StepCode == "Headof Department" || $StepCode == "WorkBasket") {
      $filterscount  = isset($_GET['filterscount']) ? $_GET['filterscount'] : "0";
         $_GET["filterdatafield".$filterscount] = "ForwardTo";
         $_GET["filteroperator".$filterscount] = "0";
         $_GET["filtercondition".$filterscount] = "CONTAINS";
         $_GET["filtervalue".$filterscount] = $user;
         $_GET['filterscount'] += 1;
   }

   }
   
  }
  else
  {
    $custfilter = "  1=1 ";
  }
  
    unset($_GET['mod']);
    unset($_GET['app']);
    unset($_GET['wfid']);
    unset($_GET['wfstep']);
    unset($_GET['postvals']);
    unset($_GET['view']);
    unset($_GET['ptype']);
    unset($_GET['allpages']);
    unset($_GET['TotalCount']);
    unset($_GET['CountRst']);

    $backurl = str_replace(":", "=", $postvals);
$backurl = str_replace(",", "&", $backurl);
$backurl = str_replace("list", "edit", $backurl);

     $modInfo = $db->GetRow("select ModuleCode,TableName from dh_modules where S_ROWID='$mod'");
     $ModuleCode = $modInfo["ModuleCode"];
     $TableName = $modInfo["TableName"];
     $getCols = $db->Execute("select FieldName,DisplayName from dh_listview where TableName='$TableName' and ModuleCode='$ModuleCode'  and ListType='Main' order by DisplayOrder asc");
     $Flds = array();
     $disFlds = array();
    
     $where1 = "";
    $dateTypes = array('date','timestamp','datetime');
    $MetaColumns = $db->MetaColumns($TableName);
   $MetaType = array();
   foreach ($MetaColumns as $key => $vals) {
     $ColDef = (array)$vals;
     $MetaType[$ColDef["name"]] = $ColDef["type"];
   }
   
   while(!$getCols->EOF) {
        $Flds[] = $getCols->fields["FieldName"];
        $disFlds[] = $getCols->fields["DisplayName"];
        $getCols->MoveNext();
       }
       $Flds[] = "S_ROWID"; 
    $columns = implode(',',$Flds);
   // get first visible row.
  $firstvisiblerow = $_GET['recordstartindex'];
  // get the last visible row.
  $lastvisiblerow =  $_GET['recordendindex'];
  $rowscount = $lastvisiblerow - $firstvisiblerow;
  $pagesize = $rowscount;
  $start = $firstvisiblerow;
    $rstList = array();
    $total_rows = "0";
    $where = "";

      $getqry = $db->GetArray("select FieldName,FilterCondition,FilterValue from dh_listquery where ModuleCode='$ModuleCode' and TableName='$TableName'");
      
      
      $argQ = array_filter($getqry);
         $qryCount = count($getqry);
       if (!empty($argQ)) {
        
        $filterscount  = isset($_GET['filterscount']) ? $_GET['filterscount'] : "0";
        foreach ($getqry as $keyQ => $valQ) {
           $qryValue = $valQ[2] == "@UserID@" ? $user : $valQ["FilterValue"];
         $_GET["filterdatafield".$filterscount] = $valQ["FieldName"];
         $_GET["filteroperator".$filterscount] = "0";
         $_GET["filtercondition".$filterscount] = $valQ["FilterCondition"];
         $_GET["filtervalue".$filterscount] = $qryValue;
         $filterscount += 1;
        }
        $_GET['filterscount'] += $qryCount;
       }
        

    if (isset($_GET['filterscount']))
  {
    $filterscount = $_GET['filterscount'];
    
    if ($filterscount > 0)
    {
      $where = " Where (";
      $tmpdatafield = "";
      $tmpfilteroperator = "";
      for ($i=0; $i < $filterscount; $i++)
        {
        // get the filter's value.
        $filtervalue = $_GET["filtervalue" . $i];
        // get the filter's condition.
        $filtercondition = $_GET["filtercondition" . $i];
        // get the filter's column.
        $filterdatafield = $_GET["filterdatafield" . $i];
        // get the filter's operator.
        $filteroperator = $_GET["filteroperator" . $i];
        
        if ($tmpdatafield == "")
        {
          $tmpdatafield = $filterdatafield;     
        }
        else if ($tmpdatafield <> $filterdatafield)
        {
          $where .= ")AND(";
        }
        else if ($tmpdatafield == $filterdatafield)
        {
          if ($tmpfilteroperator == 0)
          {
            $where .= " AND ";
          }
          else $where .= " OR ";  
        }
        $type = $MetaType[$filterdatafield];
        if (in_array($type, $dateTypes)) {
          $filterdatafield = DB_DRIVER =="mysqli" ? " date($filterdatafield) " : " convert(DATE, $filterdatafield)";
          $filtervalue = date('Y-m-d',strtotime($filtervalue));
        }
        // build the "WHERE" clause depending on the filter's condition, value and datafield.
        switch($filtercondition)
        {
          case "NOT_EMPTY":
          case "NOT_NULL":
            $where .= " " . $filterdatafield . " NOT LIKE '" . "" ."'";
            break;
          case "EMPTY":
          case "NULL":
            $where .= " " . $filterdatafield . " LIKE '" . "" ."'";
            break;
          case "CONTAINS_CASE_SENSITIVE":
            $where .= " BINARY  " . $filterdatafield . " LIKE '%" . $filtervalue ."%'";
            break;
          case "CONTAINS":
            $where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."%'";
            break;
          case "DOES_NOT_CONTAIN_CASE_SENSITIVE":
            $where .= " BINARY " . $filterdatafield . " NOT LIKE '%" . $filtervalue ."%'";
            break;
          case "DOES_NOT_CONTAIN":
            $where .= " " . $filterdatafield . " NOT LIKE '%" . $filtervalue ."%'";
            break;
          case "EQUAL_CASE_SENSITIVE":
            $where .= " BINARY " . $filterdatafield . " = '" . $filtervalue ."'";
            break;
          case "EQUAL":
            $where .= " " . $filterdatafield . " = '" . $filtervalue ."'";
            break;
          case "NOT_EQUAL_CASE_SENSITIVE":
            $where .= " BINARY " . $filterdatafield . " <> '" . $filtervalue ."'";
            break;
          case "NOT_EQUAL":
            $where .= " " . $filterdatafield . " <> '" . $filtervalue ."'";
            break;
          case "GREATER_THAN":
            $where .= " " . $filterdatafield . " > '" . $filtervalue ."'";
            break;
          case "LESS_THAN":
            $where .= " " . $filterdatafield . " < '" . $filtervalue ."'";
            break;
          case "GREATER_THAN_OR_EQUAL":
            $where .= " " . $filterdatafield . " >= '" . $filtervalue ."'";
            break;
          case "LESS_THAN_OR_EQUAL":
            $where .= " " . $filterdatafield . " <= '" . $filtervalue ."'";
            break;
          case "STARTS_WITH_CASE_SENSITIVE":
            $where .= " BINARY " . $filterdatafield . " LIKE '" . $filtervalue ."%'";
            break;
          case "STARTS_WITH":
            $where .= " " . $filterdatafield . " LIKE '" . $filtervalue ."%'";
            break;
          case "ENDS_WITH_CASE_SENSITIVE":
            $where .= " BINARY " . $filterdatafield . " LIKE '%" . $filtervalue ."'";
            break;
          case "ENDS_WITH":
            $where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."'";
            break;
        }
                
        if ($i == $filterscount - 1)
        {
          if ($ptype == "wf") {
           $where .= " and ".$custfilter;
          }
          $where .= ")";
        }
        
        $tmpfilteroperator = $filteroperator;
        $tmpdatafield = $filterdatafield;     
      }
            
    }
  }//end Filter
 
 if ($where == "" && $ptype == "wf") {
    $where = "where ".$custfilter;
 }elseif ($where == "" && $ptype != "wf") {
    $where = "where ".$custfilter;
 }

    if (isset($_GET['sortdatafield']))
  { 
    $sortfield = $_GET['sortdatafield'];
    $sortorder = $_GET['sortorder'];
  $filterquery ="";
    if ($sortorder != '')
    {
      if ($_GET['filterscount'] == 0)
      {
        if ($sortorder == "desc")
        {
          $strsort = " ORDER BY" . " " . $sortfield . " DESC ";
        }
        else if ($sortorder == "asc")
        {
          $strsort = " ORDER BY" . " " . $sortfield . " ASC ";
        }
      }
      else
      {
        if ($sortorder == "desc")
        {
          $filterquery .= " ORDER BY" . " " . $sortfield . " DESC ";
        }
        else if ($sortorder == "asc") 
        {
          $filterquery .= " ORDER BY" . " " . $sortfield . " ASC ";
        }
        $strsort = $filterquery;
      }   
    }
  }
    $cols = explode(',', $columns);
    $where .= $where1;
    $getRecords = $db->SelectLimit("select $columns from $TableName $where $strsort",$pagesize,$start);
     
     $total_rows = $db->GetOne("select count(*) from $TableName $where");
   
  $userFlds = array("CreatedBy","ModifiedBy");
  while (!$getRecords->EOF) {
   //echo count($getRecords->fields);
    $S_ROWID = $getRecords->fields["S_ROWID"];
    $rand = md5($S_ROWID);
       $rst = array();
  for ($key = 0; $key < count($Flds) ; $key++) { 
          $rst[$cols[$key]] = $getRecords->fields[$cols[$key]];
          $type = $MetaType[$cols[$key]];
        
      if(in_array($type, $dateTypes)) {
        $rst[$cols[$key]] = $getRecords->fields[$cols[$key]] != "" ? date('d-m-Y',strtotime($getRecords->fields[$cols[$key]])) : "";
       }

       if(in_array($cols[$key], $userFlds)) {
        $UserInfo = $rs->UserInfo($getRecords->fields[$cols[$key]],"Fullname");
        $rst[$cols[$key]] = $UserInfo == "" ? $getRecords->fields[$cols[$key]] : $UserInfo."(".$getRecords->fields[$cols[$key]].")";
       }
        }

       $linkurl = "?$backurl&cid=$S_ROWID&sk=$rand";  
      $rst['link'] = $linkurl;
      $rstList[] = $rst;
    $getRecords->MoveNext();
  }

  $data[] = array(
       'TotalRows' => $total_rows,
     'Rows' => $rstList
  );
  echo json_encode($data);
   
?>