<?php
$IsPerformanceDiscussion =isset($rst["IsPerformanceDiscussion"]) ? $rst["IsPerformanceDiscussion"] : "No";
$checkedView = $IsPerformanceDiscussion == "Yes" ? "checked='true'" : "";

?>
<script type="text/javascript">
$(function(){
$(".ace-switch").change(function(event){
event.preventDefault();

  if ($("#IsPerformanceDiscussionChk").prop("checked"))
  {
    $("#IsPerformanceDiscussion").val("Yes");
  }
  else
  {
    $("#IsPerformanceDiscussion").val("No");
  }

  });
//
});
	$(document).ready(function(){

    $("#frmSAFinalComments").validate({
  debug: false,
  rules: {

  },
  messages: {

  },
  submitHandler: function(form) {
  // do other stuff for a valid form
     $.post('assets/bin/ManageGroups.php', $("#frmSAFinalComments").serialize(), function(data) {
       var frm = "#frmSAFinalComments";
       //$(frm)[0].reset();
      // $(frm).trigger("reset");
       $(frm).find(":submit").prop('disabled', false);
       $(frm).find(":submit").html("<i class='fa fa-save'></i> Update Form");
       $(frm).data('submitted', false);
       alert(data);
       // Swal.fire({
       //         type: 'success',
       //         title: 'Update Successful',
       //         showConfirmButton: false,
       //         timer: 1500
       //         });
    });
  }
  });

  });
  </script>
<div>
  <h3 class="header smaller lighter blue">Section 7 : Appraisees Comments on Appraisal by the Supervisor</h3>
  <div class="alert alert-info">
			This Section should be completed by the Appraisee after the Performance Appraisal
	</div>
</div>
<div class="row">
  <div id="ValueOptions" class="col-xs-12">
    <div class="row">
      <div class="col-xs-12">
        <div class="widget-box">
        <div class="widget-body">
        <form name="frmSAFinalComments" id="frmSAFinalComments">
          <?php echo $S_ROWID;?>
            <div class="widget-toolbox padding-8 clearfix text-right">
                      <button type="submit" name="btnPostSAComments" id="btnPostSAComments"  class="btn btn-sm btn-purple"><i class="fa fa-save"></i> Update Form</button>
                 </div>
          <div class="widget-main">
            <table id="tableSearchResults" class="table table-bordered table-striped">
  <tbody>
    <tr>
      <td>8A</td>
      <td><p style="font-weight:bold;">DID PERFORMANCE-RELATED DISCUSSIONS TAKE PLACE DURING THE REPORTING PERIOD WITH YOUR SUPERVISOR?</p></td>
      <td><input type='checkbox' id='IsPerformanceDiscussionChk' class='ace ace-switch ace-switch-5 input-lg' $checkedView> <span class='lbl bigger-120'></span>
        <input type='hidden' name='IsPerformanceDiscussion' id='IsPerformanceDiscussion' value='<?php echo $IsPerformanceDiscussion;?>'>
      </td>
   </tr>
   <tr>
     <td>8B</td>
     <td><p style="font-weight:bold;">General Comments (if any) on your overall performance</p></td>
     <td><textarea name="SA_FinalComments" id="SA_FinalComments" class="form-control col-xs-10 col-sm-10" cols="40" rows="4" required="true"><?php $rst["SA_FinalComments"];?></textarea></td>
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
</div>
