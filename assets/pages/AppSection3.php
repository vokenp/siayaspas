 <?php
    $db->debug=1;
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

		$("#frmValueSection3 .rstAchieved").change(function() {
			var rsttotal = 0;
		 $("#frmValueSection3 .rstAchieved").each(function() {
			 var rstVal = $(this).val();
			   if(rstVal == null)
				 {
					 rstVal = 0;
				 }
			 rsttotal += parseFloat(rstVal);
		 });
     var elmId = $(this).attr("id");
     var TTNoofTargets = $("#TTNoofTargets").val();
      var curResult = $(this).val();

     var PA_ID = elmId.substring(elmId.lastIndexOf("-") + 1,elmId.length);
     var PA_val = (parseFloat(curResult) / parseFloat(TTNoofTargets)) * 100 ;
     var PA_Rate = parseFloat(PA_val.toFixed(2));
      $("#span-PA_Ratings-"+PA_ID).html(PA_Rate+' %');
      $("#PA_Ratings-"+PA_ID).val(PA_Rate+' %');
     doPASum();
		 $("#TargetAchieved").html(rsttotal);
	 });

   function doPASum()
   {
     var  PAtotal = 0;
     $("#frmValueSection3 .PAAchieved").each(function() {
			 var rstVal = $(this).val();
			   if(rstVal == null)
				 {
					 rstVal = 0;
				 }
			 PAtotal += parseFloat(rstVal);
		 });
    $("#TTPA_Ratings").html(PAtotal.toFixed()+' %');
   }

		$("#frmValueSection3").validate({
	debug: false,
  success: "valid",
	rules: {

	},
	messages: {

	},
	submitHandler: function(form) {
	// do other stuff for a valid form
		 $.post('assets/bin/ManageGroups.php', $("#frmValueSection3").serialize(), function(data) {
			 var frm = "#frmValueSection3";
       //$(frm)[0].reset();
      // $(frm).trigger("reset");
       $(frm).find(":submit").prop('disabled', false);
       $(frm).find(":submit").html("<i class='fa fa-save'></i> Update Form");
       $(frm).data('submitted', false);

			 Swal.fire({
							 type: 'success',
							 title: 'Update Successful',
							 showConfirmButton: false,
							 timer: 1500
							 });
   	});
	}
	});
	});
  </script>
<div>

  <h3 class="header smaller lighter blue">Section 3 : PERFORMANCE TARGETS</h3>

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
                 	  	<button type="submit" name="btnPostS3Values" id="btnPostS3Values"  class="btn btn-sm btn-purple"><i class="fa fa-save"></i> Update Form</button>
                 </div>
          <div class="widget-main">
            <table id="tableSection3" class="table table-bordered table-striped">
  <thead>
    <tr>
      	<th>#</th>
      	<th><b>Performance Targets/Activities</b></th>
    		<th><b>AgreedNo of Targets</b></th>
	  		<th><b>Set Weight(%)</b></th>
				<th><b>Results Achieved</b></th>
        <th><b>PA Ratings</b></th>
   			<th><b>Remarks</b></th>
 </tr>
	</thead>
		<tbody>
       <?php
			    $html = "";
					$i = 0;
					$TTWeight = 0;
					$TargetAchieved = 0;
          $TTNoofTargets = 0;
          $TTPA_Ratings = 0;
			    foreach ($getPerfTargets as $pkey => $pval) {
						$i += 1;
						$TTID = $pval["S_ROWID"];
						$TargetDescription  = $pval["TargetDescription"];
						$WeightPercentage   = $pval["WeightPercentage"];
						$NoOfTargets        = $pval["NoOfTargets"];
            $PA_Ratings         = $pval["PA_Ratings"];
						$SA_ResultsAchieved = $pval["SA_ResultsAchieved"];
						$SA_Remarks         = $pval["SA_Remarks"];
						$TTWeight           += $WeightPercentage;
						$TargetAchieved     += $SA_ResultsAchieved;
            $TTNoofTargets      += $NoOfTargets;
            $TTPA_Ratings      += $PA_Ratings;
						$html .= "<tr>";
						$html .= "<td>$i</td>";
						$html .= "<td>$TargetDescription</td>";
						$html .= "<td>$NoOfTargets</td>";
						$html .= "<td style='text-align:center;font-weight:bold;'>$WeightPercentage %</td>";
						$html .= "<td><input type='text' id='SA_ResultsAchieved-$TTID' name='SA_ResultsAchieved[$TTID]' placeholder='Enter Max value $WeightPercentage' class='col-xs-10 col-sm-10 rstAchieved' max='$NoOfTargets' value='$SA_ResultsAchieved' required='true'  /></td>";
            $html .= "<td style='text-align:center;font-weight:bold;'><span id='span-PA_Ratings-$TTID'>$PA_Ratings %</span></td>";
            $html .= "<input type='hidden' name='PA_Ratings[$TTID]' id='PA_Ratings-$TTID' value='$PA_Ratings' class='PAAchieved'>";
						$html .= "<td><input type='text' id='SA_Remarks-$TTID' name='SA_Remarks[$TTID]' placeholder='Enter Remarks' class='col-xs-10 col-sm-10'  value='$SA_Remarks'  /></td>";
						$html .= "</tr>";
			    }
            $TTPA_Ratings = round($TTPA_Ratings);
					    $html .= "<tr>";
							$html .= "<td></td>";
							$html .= "<td>Totals </td>";
              $html .= "<td style='text-align:center;'><b>$TTNoofTargets</b></td>";
							$html .= "<td style='text-align:center;'><b>$TTWeight %</b></td>";

							$html .= "<td style='text-align:center;' ><span id='TargetAchieved' style='font-weight:bold;color:red;'>$TargetAchieved</span></td>";
              $html .= "<td style='text-align:center;' ><span id='TTPA_Ratings' style='font-weight:bold;color:red;'>$TTPA_Ratings %</span></td>";
					$html .= "</tr>";
					echo $html;
			 ?>
       <input type="hidden" name="TTNoofTargets" id="TTNoofTargets" value="<?php echo $TTNoofTargets;?>">
		</tbody>
  </table>
				</div> <!--  End Widget-Main-->
			</form>
		</div> <!--  End Widget-Body-->
		</div> <!--  End Widget-Box-->
</div> <!--  End colx-cs-12 -->

</div> <!--  End row -->

</div> <!--  End colx-cs-12 -->
</div> <!--  Row -->
