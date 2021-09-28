<?php
$getS5BVals = $db->GetArray("SELECT * FROM tbl_section5b where AppraisalID='$cid'");
 $SATotalScore5B = 0;
  foreach ($getS5BVals as $bkey => $bval) {
     $SATotalScore5B += $bval["SA_ScoreValue"];
  }


?>
<script type="text/javascript">

	$(document).ready(function(){

		var valsOpts = <?php echo json_encode($getS5BVals); ?>;


		$.each(valsOpts, function( i, l ){
			 	$("#"+l.ValueType+"-"+l.SR_ScoreValue).attr("checked", "checked");
				$("#SR_Remarks-"+l.ValueType).val(l.SR_Remarks);
        $("#SA_Remarks-"+l.ValueType).html(l.SA_Remarks);
        $("#SA_"+l.ValueType).html(l.SA_ScoreValue);

     });
   S5BdoValuesum();

		 $("#frmValueOptions5B input[type=radio]").click(function() {
      S5BdoValuesum();
    });

		function S5BdoValuesum()
		{
			var total = 0;
		 $("#frmValueOptions5B input[type=radio]:checked").each(function() {
			 total += parseFloat($(this).val());
		 });

		 $(".TotalScore5B").html(total);
		}

      $("#btnPostValues5B").click(function(){
        var postdata = $("#frmValueOptions5B").serializeArray();
         postdata.push({name: 'btnPostValuesSR5BRates', value: $("#S_ROWID").val()});
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
  <h3 class="header smaller lighter blue">Section 5B : Managerial and Supervisory Competencies</h3>
  <div class="alert alert-info">
    HOW WOULD YOU RATE THE APPRAISEE’S MANAGERIAL AND SUPERVISORY RESPONSIBILITIES <strong>Please Tick where Necessary</strong>
	</div>
</div>
<div class="row">
  <div id="ValueOptions" class="col-xs-12">
  	<div class="row">
  		<div class="col-xs-12">
  			<div class="widget-box">
  		  <div class="widget-body">
  		  <form name="frmValueOptions5B" id="frmValueOptions5B">
  		  	<?php echo $S_ROWID;?>
  		  	  <div class="widget-toolbox padding-8 clearfix text-right">
                 	  	<button type="button" name="btnPostValues5B" id="btnPostValues5B" value="dh_modules" class="btn btn-sm btn-purple"><i class="fa fa-save"></i> Update Form</button>
                 </div>
          <div class="widget-main">
            <table id="tableSearchResults5B" class="table table-bordered table-striped">
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
          <th><span class="TotalScore5B" style="color:red;font-size:22px;font-weight:bold;">0</span></th>
    </tr>

  </thead>

  <tbody>
    <tr>
         <td><b>Leadership/Management Accountability Framework</b></td>
         <td><p class='text-warning smaller-110 red' id="SA_5B_V1"></td>
         <td><input name="SR_5B_V1" id="5B_V1-5" value="5" type="radio" class="form-control input-sm" /></td>
         <td><input name="SR_5B_V1" id="5B_V1-4" value="4" type="radio" class="form-control input-sm" /></td>
         <td><input name="SR_5B_V1" id="5B_V1-3" value="3" type="radio" class="form-control input-sm" /></td>
         <td><input name="SR_5B_V1" id="5B_V1-2" value="2" type="radio" class="form-control input-sm" /></td>
         <td><input name="SR_5B_V1" id="5B_V1-1" value="1" type="radio" class="form-control input-sm" /></td>
         <td><p class='text-warning smaller-110 orange' id="SA_Remarks-5B_V1"></p><input type="text" id="SR_Remarks-5B_V1" name="SR_Remarks-5B_V1" placeholder="Enter Remarks" class="col-xs-10 col-sm-10"  /></td>
   </tr>
    <tr>
         <td><b>Planning and Organizing</b></td>
         <td><p class='text-warning smaller-110 red' id="SA_5B_V2"></td>
         <td><input name="SR_5B_V2" id="5B_V2-5" value="5" type="radio" class="form-control input-sm" /></td>
         <td><input name="SR_5B_V2" id="5B_V2-4" value="4" type="radio" class="form-control input-sm" /></td>
         <td><input name="SR_5B_V2" id="5B_V2-3" value="3" type="radio" class="form-control input-sm" /></td>
         <td><input name="SR_5B_V2" id="5B_V2-2" value="2" type="radio" class="form-control input-sm" /></td>
         <td><input name="SR_5B_V2" id="5B_V2-1" value="1" type="radio" class="form-control input-sm" /></td>
         <td><p class='text-warning smaller-110 orange' id="SA_Remarks-5B_V2"></p><input type="text" id="SR_Remarks-5B_V2" name="SR_Remarks-5B_V2" placeholder="Enter Remarks" class="col-xs-10 col-sm-10"  /></td>
   </tr>

   <tr>
        <td><b>Training and Developing Staff</b></td>
        <td><p class='text-warning smaller-110 red' id="SA_5B_V3"></td>
        <td><input name="SR_5B_V3" id="5B_V3-5" value="5" type="radio" class="form-control input-sm" /></td>
        <td><input name="SR_5B_V3" id="5B_V3-4" value="4" type="radio" class="form-control input-sm" /></td>
        <td><input name="SR_5B_V3" id="5B_V3-3" value="3" type="radio" class="form-control input-sm" /></td>
        <td><input name="SR_5B_V3" id="5B_V3-2" value="2" type="radio" class="form-control input-sm" /></td>
        <td><input name="SR_5B_V3" id="5B_V3-1" value="1" type="radio" class="form-control input-sm" /></td>
        <td><p class='text-warning smaller-110 orange' id="SA_Remarks-5B_V3"></p><input type="text" id="SR_Remarks-5B_V3" name="SR_Remarks-5B_V3" placeholder="Enter Remarks" class="col-xs-10 col-sm-10"  /></td>
  </tr>
  <tr>
       <td><b>Managing Resources and Accountability</b></td>
       <td><p class='text-warning smaller-110 red' id="SA_5B_V4"></td>
       <td><input name="SR_5B_V4" id="5B_V4-5" value="5" type="radio" class="form-control input-sm" /></td>
       <td><input name="SR_5B_V4" id="5B_V4-4" value="4" type="radio" class="form-control input-sm" /></td>
       <td><input name="SR_5B_V4" id="5B_V4-3" value="3" type="radio" class="form-control input-sm" /></td>
       <td><input name="SR_5B_V4" id="5B_V4-2" value="2" type="radio" class="form-control input-sm" /></td>
       <td><input name="SR_5B_V4" id="5B_V4-1" value="1" type="radio" class="form-control input-sm" /></td>
       <td><p class='text-warning smaller-110 orange' id="SA_Remarks-5B_V4"></p><input type="text" id="SR_Remarks-5B_V4" name="SR_Remarks-5B_V4" placeholder="Enter Remarks" class="col-xs-10 col-sm-10"  /></td>
 </tr>
 <tr>
      <td><b>Risk Management</b></td>
      <td><p class='text-warning smaller-110 red' id="SA_5B_V5"></td>
      <td><input name="SR_5B_V5" id="5B_V5-5" value="5" type="radio" class="form-control input-sm" /></td>
      <td><input name="SR_5B_V5" id="5B_V5-4" value="4" type="radio" class="form-control input-sm" /></td>
      <td><input name="SR_5B_V5" id="5B_V5-3" value="3" type="radio" class="form-control input-sm" /></td>
      <td><input name="SR_5B_V5" id="5B_V5-2" value="2" type="radio" class="form-control input-sm" /></td>
      <td><input name="SR_5B_V5" id="5B_V5-1" value="1" type="radio" class="form-control input-sm" /></td>
      <td><p class='text-warning smaller-110 orange' id="SA_Remarks-5B_V5"></p><input type="text" id="SR_Remarks-5B_V5" name="SR_Remarks-5B_V5" placeholder="Enter Remarks" class="col-xs-10 col-sm-10"  /></td>
</tr>

    <tr>
         <td><b>Judgment and objectivity</b></td>
         <td><p class='text-warning smaller-110 red' id="SA_5B_V6"></td>
         <td><input name="SR_5B_V6" id="5B_V6-5" value="5" type="radio" class="form-control input-sm" /></td>
         <td><input name="SR_5B_V6" id="5B_V6-4" value="4" type="radio" class="form-control input-sm" /></td>
         <td><input name="SR_5B_V6" id="5B_V6-3" value="3" type="radio" class="form-control input-sm" /></td>
         <td><input name="SR_5B_V6" id="5B_V6-2" value="2" type="radio" class="form-control input-sm" /></td>
         <td><input name="SR_5B_V6" id="5B_V6-1" value="1" type="radio" class="form-control input-sm" /></td>
         <td><p class='text-warning smaller-110 orange' id="SA_Remarks-5B_V6"></p><input type="text" id="SR_Remarks-5B_V6" name="SR_Remarks-5B_V6" placeholder="Enter Remarks" class="col-xs-10 col-sm-10"  /></td>
   </tr>
   <tr>
        <td><b>Managing and evaluating performance</b></td>
        <td><p class='text-warning smaller-110 red' id="SA_5B_V7"></td>
        <td><input name="SR_5B_V7" id="5B_V7-5" value="5" type="radio" class="form-control input-sm" /></td>
        <td><input name="SR_5B_V7" id="5B_V7-4" value="4" type="radio" class="form-control input-sm" /></td>
        <td><input name="SR_5B_V7" id="5B_V7-3" value="3" type="radio" class="form-control input-sm" /></td>
        <td><input name="SR_5B_V7" id="5B_V7-2" value="2" type="radio" class="form-control input-sm" /></td>
        <td><input name="SR_5B_V7" id="5B_V7-1" value="1" type="radio" class="form-control input-sm" /></td>
        <td><p class='text-warning smaller-110 orange' id="SA_Remarks-5B_V7"></p><input type="text" id="SR_Remarks-5B_V7" name="SR_Remarks-5B_V7" placeholder="Enter Remarks" class="col-xs-10 col-sm-10"  /></td>
  </tr>
  <tr>
       <td><b>Promoting use of Information Technology</b></td>
       <td><p class='text-warning smaller-110 red' id="SA_5B_V8"></td>
       <td><input name="SR_5B_V8" id="5B_V8-5" value="5" type="radio" class="form-control input-sm" /></td>
       <td><input name="SR_5B_V8" id="5B_V8-4" value="4" type="radio" class="form-control input-sm" /></td>
       <td><input name="SR_5B_V8" id="5B_V8-3" value="3" type="radio" class="form-control input-sm" /></td>
       <td><input name="SR_5B_V8" id="5B_V8-2" value="2" type="radio" class="form-control input-sm" /></td>
       <td><input name="SR_5B_V8" id="5B_V8-1" value="1" type="radio" class="form-control input-sm" /></td>
       <td><p class='text-warning smaller-110 orange' id="SA_Remarks-5B_V8"></p><input type="text" id="SR_Remarks-5B_V8" name="SR_Remarks-5B_V8" placeholder="Enter Remarks" class="col-xs-10 col-sm-10"  /></td>
 </tr>

<tr>
     <td ><b>Total Score</b></td>
     <td><span class="SATotalScore5B" style="color:orange;font-size:22px;font-weight:bold;"><?php echo $SATotalScore5B;?></span></td>
     <td></td>
     <td></td>
     <td></td>
     <td></td>
     <td></td>
     <td><span class="TotalScore5B" style="color:red;font-size:22px;font-weight:bold;">0</span></td>
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

</div>  <!-- End Row   select (select round(sum(PA_Ratings)*0.7,2) from tbl_section3 where AppraisalID=1)  as Section3;
select (select round(sum(SR_ScoreValue)*0.7,2) from tbl_section5a where AppraisalID=1)  as Section5a;-->
