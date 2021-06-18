<?php 
include("../timeout.php");
include("con_db.php");
global $db;
//$db->debug=1;
error_reporting(E_ALL);
ini_set('display_errors', 1);

$CommitteeID = safehtml($_POST['CommitteeID']);
$MeetingID   = safehtml($_POST['MeetingID']);

$html = "<table class='table table-bordered table-striped'>";
$html .= "<thead><tr>";
$html .= "<th>#</th>";
$html .= "<th>ProfileImg</th>";

$html .= "<th>FullName</th>";
$html .= "<th>MemberType</th>";
$html .= "<th>InAttendance</th>";
$html .= "<th>InAttendance Position</th>";
$html .= "</tr></thead>";
$html .= "<tbody>";
  
  $getList = $db->Execute("select *from vw_commMemberList where CommitteeID='$CommitteeID' ORDER BY FIELD(MemberType, 'Vice ChairPerson','ChairPerson') desc");
  $MemAttendance = array();

   $getMemAttendance = $db->GetArray("select *from committeeattendance where MeetingID='$MeetingID' and CommitteeID='$CommitteeID'");
      foreach ($getMemAttendance as $key => $val) {
      	$MemAttendance[$val["MemID"]] = array($val["InAttendancePosition"],$val["InAttendance"],$val["MemberType"]);
      }
  $i = 0;
  while (!$getList->EOF) {
  	$rst = array();
  	$rst = $getList->fields;
  	$i +=1;
  	$MemID = $rst["MemID"];
  	$Options = "";
    
          $arg = array_filter($MemAttendance);
          if (!empty($arg)) {
          	if (isset($MemAttendance[$MemID])) {
               $IsPresent = $MemAttendance[$MemID][1] == "Y" ? "checked='checked'" : "";
               $AttPosition = $MemAttendance[$MemID][0];
               $PresentVal = $MemAttendance[$MemID][1];

            }
            else
            {
            $AttPosition = "";
            $PresentVal = 'N';
            $IsPresent = "";
            }
          }
          else
          {
          	$AttPosition = "";
          	$PresentVal = 'N';
            $IsPresent = "";
          }
    $ded = "2";
  	$MemberType = $rst["MemberType"];
  	  if ($MemberType == "ChairPerson") {
  	  	$Options .= "<option value='ChairPerson'>ChairPerson</option>"; 
  	  }
  	  elseif ($MemberType == "Vice ChairPerson") {
  	  	$Options .= "<option value='Vice ChairPerson'>Vice ChairPerson</option>"; 
  	  	
  	  }elseif ($MemberType == "Member") {
       if ($PresentVal == "Y") {
            if ($AttPosition == $MemberType) {
              
              $Options .= "<option value='Member'>Member</option>";
              $Options .= "<option value='ChairPerson'>ChairPerson</option>";
            }
            else
            {
              
              $Options .= "<option value='ChairPerson'>ChairPerson</option>";
              $Options .= "<option value='Member'>Member</option>";
            }
         
       }
       else {
         $Options .= "<option value='Member'>Member</option>";
         $Options .= "<option value='ChairPerson'>ChairPerson</option>";
       }
        
      
        
  	  	
  	  	
  	  }

      $ProfileImg = $rst["ProfileImg"];
         $ImgPath = $ProfileImg == "" ? "assets/profilepics/NoImage.png" : $ProfileImg;
       $ProImg = "<img class='profile-user-img img-responsive img-circle' src='$ImgPath' style='height:100px;width:100px;' >";

  	$html .= "<tr>";
  	$html .= "<td>$i</td>";
    $html .= "<td>$ProImg</td>";
    
    $html .= "<td> <b>".$rst["FullName"]."</b><br/>PFNo: <b>".$rst["PersonnelNo"]."</b><br/>IDNo: <b>".$rst["IDNo"]."</b></td>";
    $html .= "<td>".$rst["MemberType"]."</td><input type='hidden' name='MemberType[$MemID]' id='MemberType-$MemID' value='$MemberType'>";
    $html .= "<td><input type='checkbox' onclick='DoCheckBox(\"$MemID\");' id='IsPresentChbx$MemID'  class='ace ace-switch ace-switch-5' $IsPresent><span class='lbl'><input type='hidden' name='IsPresent[$MemID]' id='IsPresent-$MemID' value='$PresentVal'></span></td>";
    $html .= "<td><select name='InAttendancePosition[$MemID]' id='InAttendancePosition-$MemID' class='form-control'>$Options</select></td>";
    $html .= "</tr>";
  	$getList->MoveNext();
  }

$html .= "</tbody>";
$html .= "</table>";
echo  $html;
?>