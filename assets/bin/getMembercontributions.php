<?php 
include("../timeout.php");
 include("con_db.php");
global $db;
//$db->debug=1;

      $CurTable = "vw_contributions";
      $search = $_POST['search'];
      $MeetingID = $_POST['MeetingID'];
     $q = safehtml(trim($search["value"]));
     $SearchField = "FullName";
   $recdata = array();
   $cols = $db->metaColumnNames($CurTable,true);
   $k = 0;

   $Order = $_POST['order'];
  $OrderColumn = $cols[$Order[0]["column"]];
  $OrderDire = $Order[0]["dir"];  

   $where = "where MeetingID='$MeetingID'  ";
  if ($q != "") {
    $where .= " and $SearchField like '%$q%'";
  }

   $getData = $db->SelectLimit("select *from $CurTable $where order by S_ROWID desc",$_POST['length'],$_POST['start']);
   $count = $getData->RecordCount();
   $list = array();
     $getTypes = $db->GetArray("select distinct ContributionType from tbl_contributions where MeetingID=$MeetingID");
       foreach ($getTypes as $ctkey => $ctvalue) {
        $ContriTypes[$ctvalue["ContributionType"]] = 0;
       }

    while (!$getData->EOF) {
      $rst = array();
    
        $rst = $getData->fields;
         
      $MemberID = $rst["MemberID"];
      
      $list[$MemberID][] = $rst;
         
    $getData->MoveNext();
    }
   $count = count($list);
    $k = 0;
    foreach ($list as $key => $val) {
      $k += 1;
      $rst = array();
      $rowData = json_encode($val);

      $ResetPswd = "<a href='#' onclick='doResetPswd(\"$key\"); return false;' title='Reset Password'><span class='red'><i class='ace-icon fa fa-key bigger-120'></i></span></a>";
     $EditColumn = "<a id='row-$key' href='#' onclick='DoEditRecord(\"$key\");  return false;' title='Edit Record' data-value='$rowData'><span class='yellow'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a>";

      $ActionList =  $EditColumn.str_repeat("&nbsp;", 5).$ResetPswd;

      $rst["num"] = $k;
      $rst["FullName"] = $val[0]["FullName"];
      $rst["ModeofPayment"] = $val[0]["ModeofPayment"];
         $tt = 0;
         $Ctype = array();
         for ($i=0; $i < count($val); $i++) { 
          $remarks = $val[$i]["Remarks"];
          $toolTip = $remarks !="" ? "<i class='fa fa-info-circle pull-right' data-rel='tooltip' title='$remarks'></i>" : "";
          $Ctype[$val[$i]["ContributionType"]] = $val[$i]["AmountContributed"].$toolTip;
          $tt += $val[$i]["AmountContributed"];
         }
       $ct = array_merge($rst,$ContriTypes,$Ctype);
         $record = array();
         
        
        foreach ($ct as $fkey => $fvalue) {
          $record[] =  $fvalue;
        }
         $record[] = $tt; 
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