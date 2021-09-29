<script type="text/javascript">
	$(document).ready(function(){
		var op = $("#op").val();
    dotoken();

  // Update Objectives
  $("#frmUpdateTrainingNeed").validate({
debug: false,
rules: {

},
messages: {

},
submitHandler: function(form) {
// do other stuff for a valid form

 $.post('assets/bin/ManageRecords.php', $("#frmUpdateTrainingNeed").serialize(), function(data) {

  if (data.length < 30)
  {
  $(".close").click();
  var frm = "#frmUpdateTrainingNeed";
  $(frm)[0].reset();
  $(frm).trigger("reset");
  $(frm).find(":submit").prop('disabled', false);
  $(frm).find(":submit").html("<i class='fa fa-edit'></i> Update Training Need");
  $(frm).data('submitted', false);
  $(frm).modal("hide");
   dotoken();
  $('#tblTrainingNeed').DataTable().draw();
      Swal.fire({
              type: 'success',
              title: 'Training Need Update Successful',
              showConfirmButton: false,
              timer: 1500
              });
  }
  else
  {
  dotoken();
  Swal.fire(
                'Oops!',
                data,
                'error'
              );

  }
});
}
});

    //Start TABLE
    var dataTableActivites = $('#tblTrainingNeed').DataTable({
       "Processing": true,
       "serverSide": true,
       "scrollY": "50vh",
       "scrollCollapse": true,
       "bFilter":false,
       "ordering": true,
       "bLengthChange": true,
       "bPaginate": true,
       "pagingType": "simple",
       language: {
      paginate: {
      next: '<i class="fa fa-chevron-right">',
      previous: '<i class="fa fa-chevron-left">'
     }
     },

       "ajax":{
          url :"assets/bin/getSectionSR4TrainingNeed.php", // json datasource
          type: "post",  // type of method  , by default would be get
         "data":function(data) {
          data.AppraisalID   = $('#S_ROWID').val();

          },

          error: function(et){  // error handling code
            $("#tblTrainingNeed_processing").css("display","none");
            alert(JSON.stringify(et));
          }
        },

  });
    //End Table


  });


  function DoEditTrainingNeed(RowID)
       {
        var RowInfo = eval('(' + $("#row-"+RowID).attr('data-value') + ')');

        $("#SR_Comments2").val(RowInfo.SR_Comments);
        $("#S_ROWID_Training").val(RowInfo.S_ROWID);
       //	$("#ItemType2").trigger("chosen:updated");
        $("#UpdateTrainingNeed").modal("show");
       }



  </script>
<div>

  <h3 class="header smaller lighter blue">Section 4 : STAFF TRAINING AND DEVELOPMENT PLAN</h3>

</div>
<div class="row">
  <div class="col-xs-12">
        <div class="widget-box">
          <div class="widget-header widget-header-flat">
            <h4 class="widget-title smaller">
              <i class="ace-icon fa fa-list smaller-80"></i>
                Training and Development Needs
            </h4>
            <div class="widget-toolbar no-border">

             </div>
          </div>
        <div class="widget-body">
          <table id="tblTrainingNeed" class="table table-bordered table-striped">
              <thead>
                  <tr>
                    <th>#</th>
                    <th>Training Need</th>
                    <th>Training Duration</th>
                    <th>Appraisee Comment</th>
                    <th>Supervisor Comment</th>
                    <th>Action</th>
                  </tr>
                </thead>

            </table>

        </div>
    </div><!-- WidgetBox -->
  </div><!-- RightSide -->
</div>


 <div id="UpdateTrainingNeed" class="modal fade" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 id="Colh3" class="smaller lighter blue no-margin"><i class="ace-icon fa fa-user icon-on-right bigger-110"></i> Update Training Need</h3>
      </div>
 <form name="frmUpdateTrainingNeed" id="frmUpdateTrainingNeed" class="form-horizontal" role="form">
  <div class="modal-body">
   <input type="hidden" name="ModCode" id="ModCode" value="70">
   <input type="hidden" name="_token" id="_token2" class="token" >
    <div id="colAlert"></div>
        <input type="hidden" name="ReturnType" id="ReturnType2" value="RstID">
     <input type="hidden" name="S_ROWID" id="S_ROWID_Training" >


      <div class="row">
       <div class="form-group col-sm-12">
           <label class="col-sm-4 control-label " for="SA_Comments"> Appraisee Comments</label>
            <div class="col-sm-8">
              <textarea name="SR_Comments" id="SR_Comments2" class="form-control" rows="3"></textarea>
           </div>
         </div>
       </div>

      </div><!-- End ModalBody -->
<div class="modal-footer text-center">
  <button type="submit" id="btnUpdateRecord" name="btnUpdateRecord"  class="btn btn-sm btn-success">
        Update Training Need
        <i class="ace-icon fa fa-edit icon-on-right bigger-110"></i>
      </button>
        </div>
      </form>
    </div><!-- Modal-content -->
  </div><!-- Modal-Dialog -->
 </div><!-- Modal-Div -->