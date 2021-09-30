<?php
$USectionID = $rst["Section"] ;
$UDeptID = $rst["Department"] ;
   if ($USectionID !="") {
     $getSectionInfo = $rs->row("vw_sections","S_ROWID='$USectionID'");
     $DirectorateName = $getSectionInfo["DirectorateName"];
     $DepartmentName = $getSectionInfo["DepartmentName"];
     $SectionName = $getSectionInfo["SectionName"];
     $HeadofDirectorate = $getSectionInfo["HeadofDirectorate"];
     $HeadofDept = $getSectionInfo["HeadofDept"];
     $HeadofSection = $getSectionInfo["HeadofSection"];
   }
   else {
     $getDeptInfo = $rs->row("vw_departments","S_ROWID='$UDeptID'");
     $DirectorateName = $getDeptInfo["DirectorateName"];
     $DepartmentName = $getDeptInfo["DepartmentName"];
     $HeadofDirectorate = $getDeptInfo["HeadofDirectorate"];
     $HeadofDept = $getDeptInfo["HeadofDept"];
     $HeadofSection = "";
     $SectionName = "";
   }

?>
<div>
  <h3 class="header smaller lighter blue">Section 2 : DEPARTMENTAL OBJECTIVES</h3>


  <div class="row">
    <div class="col-xs-12 col-sm-6">

   <div class="profile-user-info profile-user-info-striped ">
    <div class="profile-info-row">
      <div class="profile-info-name">Appraisee Directorate</div>
      <div class="profile-info-value">
        <span class="editable" id="username"><b><?php  echo $DirectorateName;?></b></span>
      </div>
    </div>


    <div class="profile-info-row">
      <div class="profile-info-name">Appraisee Department</div>
      <div class="profile-info-value">
        <span class="editable" id="username"><b><?php  echo $DepartmentName;?></b></span>
      </div>
    </div>


    <div class="profile-info-row">
      <div class="profile-info-name">Appraisee Section</div>
      <div class="profile-info-value">
        <span class="editable" id="username"><b><?php  echo $SectionName;?></b></span>
      </div>
    </div>

  </div>  <!-- End Profile -->
</div>  <!-- End Col -->

<div class="col-xs-12 col-sm-6">

<div class="profile-user-info profile-user-info-striped ">
<div class="profile-info-row">
  <div class="profile-info-name">Head of Directorate</div>
  <div class="profile-info-value">
    <span class="editable" id="username"><b><?php  echo $HeadofDirectorate;?></b></span>
  </div>
</div>


<div class="profile-info-row">
  <div class="profile-info-name">Head of Department</div>
  <div class="profile-info-value">
    <span class="editable" id="username"><b><?php  echo $HeadofDept;?></b></span>
  </div>
</div>


<div class="profile-info-row">
  <div class="profile-info-name">Head of Section</div>
  <div class="profile-info-value">
    <span class="editable" id="username"><b><?php  echo $HeadofSection;?></b></span>
  </div>
</div>

</div>  <!-- End Profile -->
</div>  <!-- End Col -->
</div>  <!-- End Row -->

<div class="row">
  <h3>Departmental Objectives</h3>
  <table id="tblObjectives" class="table table-bordered table-striped">
      <thead>
          <tr>
            <th>#</th>
            <th>Objective</th>
            <th>CreatedBy</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $html .="";
            $PeriodID = $rst["AppPeriodID"];
            $getdeptObjs = $db->GetArray("select *,getuinfo(CreatedBy) as CreatedName from vw_depttargetlists where DeptID='$UDeptID' and PeriodID='$PeriodID'");
            $i = 0;
            $html  ="";
            foreach ($getdeptObjs as $okey => $oval) {
              $i += 1;
              $TargetDescription = $oval["TargetDescription"];
              $CreatedBy = $oval["CreatedName"]." on ".date('D jS M Y g:i A',strtotime($oval["DateCreated"]));
              $html .="<tr>";
                $html .="<td>$i</td>";
                $html .="<td>$TargetDescription</td>";
                $html .="<td>$CreatedBy</td>";
              $html .="</tr>";
            }

          echo $html;
          ?>
        </tbody>
    </table>
</div>

</div>  <!-- div Mains-->
