 <?php
   $getPerfTargets = $db->GetArray("select *from tbl_section3 where AppraisalID='$cid' order by S_ROWID asc");
	    $arg = array_filter($getPerfTargets);

			if (empty($arg)) {
				$AppPeriodID = $rst["AppPeriodID"];
				$AppraiseeUserID = $rst["AppraiseeUserID"];
				$DoTargets = $db->Execute("insert into tbl_section3(CreatedBy,AppraisalID,TargetDescription,WeightPercentage,NoOfTargets) select '$user',$cid,TargetDescription,WeightPercentage,NoOfTargets from tbl_targetlists  where TargetID = (select S_ROWID from tbl_individualtargets where PeriodID='$AppPeriodID' and UserID='$AppraiseeUserID')");
				$getPerfTargets = $db->GetArray("select *from tbl_section3 where AppraisalID='$cid' order by S_ROWID asc");
			}
 ?>
<script type="text/javascript">
	$(document).ready(function(){

	});


  </script>
<div>

  <h3 class="header smaller lighter blue">Section 3 : PERFORMANCE TARGETS</h3>
  <div class="alert alert-info">
			This Section should be completed by the Appraisee in consultation with the Supervisor
	</div>
</div>
<div class="row">
  <div id="ValueOptions" class="col-xs-12">
  	<div class="row">
  		<div class="col-xs-12">
  			<div class="widget-box">
  		  <div class="widget-body">
  		  <form name="frmValueSection3" id="frmValueSection3">
  		  	<?php echo $S_ROWID;?>
  		  	  <div class="widget-toolbox padding-8 clearfix text-right">
                 	  	<button type="button" name="btnPostValues" id="btnPostValues" value="dh_modules" class="btn btn-sm btn-purple"><i class="fa fa-save"></i> Update Form</button>
                 </div>
          <div class="widget-main">
            <table id="tableSection3" class="table table-bordered table-striped">
  <thead>
    <tr>
      	<th>#</th>
      	<th><b>Performance Targets/Activities</b></th>
    		<th><b>AgreedNo of Targets</b></th>
	  		<th><b>Set Weight(%)</b></th>
				<th><b>Results Achieved(%)</b></th>
   			<th><b>Remarks</b></th>
 </tr>
	</thead>
		<tbody>
       <?php
			    $html = "";
					$i = 0;
			    foreach ($getPerfTargets as $pkey => $pval) {
						$i += 1;
						$TTID = $pval["S_ROWID"];
						$TargetDescription = $pval["TargetDescription"];
						$WeightPercentage = $pval["WeightPercentage"];
						$NoOfTargets = $pval["NoOfTargets"];
						$SA_ResultsAchieved = $pval["SA_ResultsAchieved"];
						$SA_Remarks = $pval["SA_Remarks"];
						$html .= "<tr>";
						$html .= "<td>$i</td>";
						$html .= "<td>$TargetDescription</td>";
						$html .= "<td>$NoOfTargets</td>";
						$html .= "<td>$WeightPercentage</td>";
						$html .= "<td><input type='text' id='SA_ResultsAchieved-$TTID' name='SA_ResultsAchieved[]' placeholder='Enter Max value $WeightPercentage' class='col-xs-10 col-sm-10' max='$WeightPercentage' value='$SA_ResultsAchieved' required='true'  /></td>";
						$html .= "<td><input type='text' id='SA_Remarks-$TTID' name='SA_Remarks[]' placeholder='Enter Remarks' class='col-xs-10 col-sm-10'  value='$SA_Remarks'  /></td>";
						$html .= "</tr>";
			    }
					echo $html;
			 ?>
		</tbody>
  </table>

				</div> <!--  End Widget-Main-->
			</form>
		</div> <!--  End Widget-Body-->
		</div> <!--  End Widget-Box-->
</div> <!--  End colx-cs-12 -->

</div> <!--  End row -->

</div> <!--  End colx-cs-12 -->
