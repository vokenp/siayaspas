<?php
$getS5Vals = $db->GetArray("SELECT * FROM tbl_section5a where AppraisalID='$cid'");

$SATotalScore = 0;
 foreach ($getS5Vals as $bkey5 => $bval5) {
		$SATotalScore += $bval5["SA_ScoreValue"];
 }
?>
<script type="text/javascript">

	$(document).ready(function(){

		var valsOpts = <?php echo json_encode($getS5Vals); ?>;


		$.each(valsOpts, function( i, l ){
			 	$("#"+l.ValueType+"-"+l.SR_ScoreValue).attr("checked", "checked");
				$("#SR_Remarks-"+l.ValueType).val(l.SR_Remarks);
        $("#SA_Remarks-"+l.ValueType).html(l.SA_Remarks);
        $("#SA-"+l.ValueType).html(l.SA_ScoreValue);
     });
   S5doValuesum();

		 $("#frmValueOptions input[type=radio]").click(function() {
      S5doValuesum();
    });

		function S5doValuesum()
		{
			var total = 0;
		 $("#frmValueOptions input[type=radio]:checked").each(function() {
			 total += parseFloat($(this).val());
		 });

		 $(".TotalScore").html(total);
		}

      $("#btnPostValues").click(function(){
        var postdata = $("#frmValueOptions").serializeArray();
         postdata.push({name: 'btnPostValuesSRRates', value: $("#S_ROWID").val()});
         $.post("assets/bin/ManageGroups.php", postdata, function(data){
					 Swal.fire({
								type: 'success',
								title: 'Form Updated Successful',
								showConfirmButton: false,
								timer: 1500
								});
         });
      });

  });
  </script>
<style type="text/css">
.verticalTableHeader {
  text-align:center;
  white-space:nowrap;
  transform: rotate(270deg);
}
.verticalTableHeader p {
  margin:0 -999px;/* virtually reduce space needed on width to very little */
  display:inline-block;
}
.verticalTableHeader p:before {
  content:'';
  width:0;
  padding-top:110%;
  /* takes width as reference, + 10% for faking some extra padding */
  display:inline-block;
  vertical-align:middle;
}
</style>
<div>
  <div id="Results"></div>
  <h3 class="header smaller lighter blue">Section 5 : VALUES/STAFF COMPETENCIES</h3>
  <div class="alert alert-info">
		  How would you rate your self on Values and Core Competencies? <strong>Please Tick where Necessary</strong>
	</div>
</div>
<div class="row">
  <div id="ValueOptions" class="col-xs-12">
  	<div class="row">
  		<div class="col-xs-12">
  			<div class="widget-box">
  		  <div class="widget-body">
  		  <form name="frmValueOptions" id="frmValueOptions">
  		  	<?php echo $S_ROWID;?>
  		  	  <div class="widget-toolbox padding-8 clearfix text-right">
                 	  	<button type="button" name="btnPostValues" id="btnPostValues"  class="btn btn-sm btn-purple"><i class="fa fa-save"></i> Update Form</button>
                 </div>
          <div class="widget-main">
            <table id="tableSearchResults" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th></th>
   <th class="verticalTableHeader"><p>Self-Appraisal</p></th>
   <th class="verticalTableHeader"><p>Outstanding</p></th>
   <th class="verticalTableHeader"><p>Above Satisfactory</p></th>
   <th class="verticalTableHeader"><p>Satisfactory</p></th>
   <th class="verticalTableHeader"><p>Improvement Needed</p></th>
   <th class="verticalTableHeader"><p>Not Satisfactory</p></th>
   <th ><b>Remarks</b></th>
 </tr>
     <tr>
          <th>Scores</th>
          <th></th>
          <th>5</th>
          <th>4</th>
          <th>3</th>
          <th>2</th>
          <th>1</th>
          <th><span class="TotalScore" style="color:red;font-size:22px;font-weight:bold;">0</span></th>
    </tr>
    <tr>
         <th><b><h4>(i) Values</h4></b></th>
         <th>SA</th>
         <th>SR</th>
         <th>SR</th>
         <th>SR</th>
         <th>SR</th>
         <th>SR</th>
         <th></th>
   </tr>
  </thead>

  <tbody>
    <tr>
         <td><b>(a) Integrity</b></td>
         <td><p class='text-warning smaller-110 red' id="SA-V1"></td>
         <td><input name="SR_V1" id="V1-5" value="5" type="radio" class="form-control input-sm" /></td>
         <td><input name="SR_V1" id="V1-4" value="4" type="radio" class="form-control input-sm" /></td>
         <td><input name="SR_V1" id="V1-3" value="3" type="radio" class="form-control input-sm" /></td>
         <td><input name="SR_V1" id="V1-2" value="2" type="radio" class="form-control input-sm" /></td>
         <td><input name="SR_V1" id="V1-1" value="1" type="radio" class="form-control input-sm" /></td>
         <td><p class='text-warning smaller-110 orange' id="SA_Remarks-V1"></p><input type="text" id="SR_Remarks-V1" name="SR_Remarks-V1" placeholder="Enter Remarks" class="col-xs-10 col-sm-10"  /></td>
   </tr>

   <tr>
        <td><b>(b) Respect for National Gender/Diversity</b></td>
         <td><p class='text-warning smaller-110 red' id="SA-V2"></td>
        <td><input name="SR_V2" id="V2-5" value="5" type="radio" class="form-control input-sm" /></td>
        <td><input name="SR_V2" id="V2-4" value="4" type="radio" class="form-control input-sm" /></td>
        <td><input name="SR_V2" id="V2-3" value="3" type="radio" class="form-control input-sm" /></td>
        <td><input name="SR_V2" id="V2-2" value="2" type="radio" class="form-control input-sm" /></td>
        <td><input name="SR_V2" id="V2-1" value="1" type="radio" class="form-control input-sm" /></td>
        <td><p class='text-warning smaller-110 orange' id="SA_Remarks-V2"></p><input type="text" id="SR_Remarks-V2" name="SR_Remarks-V2" placeholder="Enter Remarks" class="col-xs-10 col-sm-10"  /></td>
  </tr>
  <tr>
       <td><b>(c) Fairness</b></td>
        <td><p class='text-warning smaller-110 red' id="SA-V3"></td>
       <td><input name="SR_V3" id="V3-5" value="5" type="radio" class="form-control input-sm" /></td>
       <td><input name="SR_V3" id="V3-4" value="4" type="radio" class="form-control input-sm" /></td>
       <td><input name="SR_V3" id="V3-3" value="3" type="radio" class="form-control input-sm" /></td>
       <td><input name="SR_V3" id="V3-2" value="2" type="radio" class="form-control input-sm" /></td>
       <td><input name="SR_V3" id="V3-1" value="1" type="radio" class="form-control input-sm" /></td>
       <td><p class='text-warning smaller-110 orange' id="SA_Remarks-V3"></p><input type="text" id="SR_Remarks-V3" name="SR_Remarks-V3" placeholder="Enter Remarks" class="col-xs-10 col-sm-10"  /></td>
 </tr>
 <tr>
      <td><b>(d) Confidentiality</b></td>
       <td><p class='text-warning smaller-110 red' id="SA-V4"></td>
      <td><input name="SR_V4" id="V4-5" value="5" type="radio" class="form-control input-sm" /></td>
      <td><input name="SR_V4" id="V4-4" value="4" type="radio" class="form-control input-sm" /></td>
      <td><input name="SR_V4" id="V4-3" value="3" type="radio" class="form-control input-sm" /></td>
      <td><input name="SR_V4" id="V4-2" value="2" type="radio" class="form-control input-sm" /></td>
      <td><input name="SR_V4" id="V4-1" value="1" type="radio" class="form-control input-sm" /></td>
      <td><p class='text-warning smaller-110 orange' id="SA_Remarks-V4"></p><input type="text" id="SR_Remarks-V4" name="SR_Remarks-V4" placeholder="Enter Remarks" class="col-xs-10 col-sm-10"  /></td>
</tr>
    <tr>
         <td colspan="7"><b><h4>(ii) Core Competencies</h4></b></td>
    </tr>
    <tr>
         <td><b>(a) Professionalism</b></td>
          <td><p class='text-warning smaller-110 red' id="SA-V5"></td>
         <td><input name="SR_V5" id="V5-5" value="5" type="radio" class="form-control input-sm" /></td>
         <td><input name="SR_V5" id="V5-4" value="4" type="radio" class="form-control input-sm" /></td>
         <td><input name="SR_V5" id="V5-3" value="3" type="radio" class="form-control input-sm" /></td>
         <td><input name="SR_V5" id="V5-2" value="2" type="radio" class="form-control input-sm" /></td>
         <td><input name="SR_V5" id="V5-1" value="1" type="radio" class="form-control input-sm" /></td>
         <td><p class='text-warning smaller-110 orange' id="SA_Remarks-V5"></p><input type="text" id="SR_Remarks-V5" name="SR_Remarks-V5" placeholder="Enter Remarks" class="col-xs-10 col-sm-10"  /></td>
   </tr>
   <tr>
        <td><b>(b) Technical Competency</b></td>
         <td><p class='text-warning smaller-110 red' id="SA-V6"></td>
        <td><input name="SR_V6" id="V6-5" value="5" type="radio" class="form-control input-sm" /></td>
        <td><input name="SR_V6" id="V6-4" value="4" type="radio" class="form-control input-sm" /></td>
        <td><input name="SR_V6" id="V6-3" value="3" type="radio" class="form-control input-sm" /></td>
        <td><input name="SR_V6" id="V6-2" value="2" type="radio" class="form-control input-sm" /></td>
        <td><input name="SR_V6" id="V6-1" value="1" type="radio" class="form-control input-sm" /></td>
        <td><p class='text-warning smaller-110 orange' id="SA_Remarks-V6"></p><input type="text" id="SR_Remarks-V6" name="SR_Remarks-V6" placeholder="Enter Remarks" class="col-xs-10 col-sm-10"  /></td>
  </tr>
  <tr>
       <td><b>(c) Communication</b></td>
        <td><p class='text-warning smaller-110 red' id="SA-V7"></td>
       <td><input name="SR_V7" id="V7-5" value="5" type="radio" class="form-control input-sm" /></td>
       <td><input name="SR_V7" id="V7-4" value="4" type="radio" class="form-control input-sm" /></td>
       <td><input name="SR_V7" id="V7-3" value="3" type="radio" class="form-control input-sm" /></td>
       <td><input name="SR_V7" id="V7-2" value="2" type="radio" class="form-control input-sm" /></td>
       <td><input name="SR_V7" id="V7-1" value="1" type="radio" class="form-control input-sm" /></td>
       <td><p class='text-warning smaller-110 orange' id="SA_Remarks-V7"></p><input type="text" id="SR_Remarks-V7" name="SR_Remarks-V7" placeholder="Enter Remarks" class="col-xs-10 col-sm-10"  /></td>
 </tr>
 <tr>
      <td><b>(d) Teamwork</b></td>
       <td><p class='text-warning smaller-110 red' id="SA-V8"></td>
      <td><input name="SR_V8" id="V8-5" value="5" type="radio" class="form-control input-sm" /></td>
      <td><input name="SR_V8" id="V8-4" value="4" type="radio" class="form-control input-sm" /></td>
      <td><input name="SR_V8" id="V8-3" value="3" type="radio" class="form-control input-sm" /></td>
      <td><input name="SR_V8" id="V8-2" value="2" type="radio" class="form-control input-sm" /></td>
      <td><input name="SR_V8" id="V8-1" value="1" type="radio" class="form-control input-sm" /></td>
      <td><p class='text-warning smaller-110 orange' id="SA_Remarks-V8"></p><input type="text" id="SR_Remarks-V8" name="SR_Remarks-V8" placeholder="Enter Remarks" class="col-xs-10 col-sm-10"  /></td>
</tr>
<tr>
     <td><b>(e) Time Management</b></td>
      <td><p class='text-warning smaller-110 red' id="SA-V9"></td>
     <td><input name="SR_V9" id="V9-5" value="5" type="radio" class="form-control input-sm" /></td>
     <td><input name="SR_V9" id="V9-4" value="4" type="radio" class="form-control input-sm" /></td>
     <td><input name="SR_V9" id="V9-3" value="3" type="radio" class="form-control input-sm" /></td>
     <td><input name="SR_V9" id="V9-2" value="2" type="radio" class="form-control input-sm" /></td>
     <td><input name="SR_V9" id="V9-1" value="1" type="radio" class="form-control input-sm" /></td>
     <td><p class='text-warning smaller-110 orange' id="SA_Remarks-V9"></p><input type="text" id="SR_Remarks-V9" name="SR_Remarks-V9" placeholder="Enter Remarks" class="col-xs-10 col-sm-10"  /></td>
</tr>
<tr>
     <td><b>(f) Creativity</b></td>
      <td><p class='text-warning smaller-110 red' id="SA-V10"></td>
     <td><input name="SR_V10" id="V10-5" value="5" type="radio" class="form-control input-sm" /></td>
     <td><input name="SR_V10" id="V10-4" value="4" type="radio" class="form-control input-sm" /></td>
     <td><input name="SR_V10" id="V10-3" value="3" type="radio" class="form-control input-sm" /></td>
     <td><input name="SR_V10" id="V10-2" value="2" type="radio" class="form-control input-sm" /></td>
     <td><input name="SR_V10" id="V10-1" value="1" type="radio" class="form-control input-sm" /></td>
     <td><p class='text-warning smaller-110 orange' id="SA_Remarks-V10"></p><input type="text" id="SR_Remarks-V10" name="SR_Remarks-V10" placeholder="Enter Remarks" class="col-xs-10 col-sm-10"  /></td>
</tr>
<tr>
     <td><b>(g) Continous Learning and Performance Improvement</b></td>
      <td><p class='text-warning smaller-110 red' id="SA-V11"></td>
     <td><input name="SR_V11" id="V11-5" value="5" type="radio" class="form-control input-sm" /></td>
     <td><input name="SR_V11" id="V11-4" value="4" type="radio" class="form-control input-sm" /></td>
     <td><input name="SR_V11" id="V11-3" value="3" type="radio" class="form-control input-sm" /></td>
     <td><input name="SR_V11" id="V11-2" value="2" type="radio" class="form-control input-sm" /></td>
     <td><input name="SR_V11" id="V11-1" value="1" type="radio" class="form-control input-sm" /></td>
     <td><p class='text-warning smaller-110 orange' id="SA_Remarks-V11"></p><input type="text" id="SR_Remarks-V11" name="SR_Remarks-V11" placeholder="Enter Remarks" class="col-xs-10 col-sm-10"  /></td>
</tr>
<tr>
     <td><b>(h) Customer/Citizen Focus</b></td>
      <td><p class='text-warning smaller-110 red' id="SA-V12"></td>
     <td><input name="SR_V12" id="V12-5" value="5" type="radio" class="form-control input-sm" /></td>
     <td><input name="SR_V12" id="V12-4" value="4" type="radio" class="form-control input-sm" /></td>
     <td><input name="SR_V12" id="V12-3" value="3" type="radio" class="form-control input-sm" /></td>
     <td><input name="SR_V12" id="V12-2" value="2" type="radio" class="form-control input-sm" /></td>
     <td><input name="SR_V12" id="V12-1" value="1" type="radio" class="form-control input-sm" /></td>
     <td><p class='text-warning smaller-110 orange' id="SA_Remarks-V12"></p><input type="text" id="SR_Remarks-V12" name="SR_Remarks-V12" placeholder="Enter Remarks" class="col-xs-10 col-sm-10"  /></td>
</tr>
<tr>
     <td ><b>Total Score</b></td>
		 <td><span  style="color:orange;font-size:22px;font-weight:bold;"><?php echo $SATotalScore;?></span></td>
     <td></td>
     <td></td>
     <td></td>
     <td></td>
     <td></td>
     <td><span class="TotalScore" style="color:red;font-size:22px;font-weight:bold;">0</span></td>
</tr>

  </tbody>
  </table>
          </div>  <!-- end Widget Main -->
          </form>
      </div><!-- WidgetBody -->
  </div><!-- widgetBox -->
  		</div>
  	</div>
</div>

</div>  <!-- End Row    select *,(select concat_ws('-',ItemDescription,right(ItemCode,1)) from listitems
where ItemType='ScoreRating' and ItemCode=concat('R',SA_ScoreValue)) as PARate from tbl_section5a-->