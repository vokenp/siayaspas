<script type="text/javascript">
	$(document).ready(function(){
		var op = $("#op").val();
    dotoken();
  

    //Create New tblActivities
    $("#frmNewActivity").validate({
  debug: false,
  rules: {

  },
  messages: {

  },
  submitHandler: function(form) {
  // do other stuff for a valid form

     $.post('assets/bin/ManageRecords.php', $("#frmNewActivity").serialize(), function(data) {

      if (data.length < 30)
      {
      $(".close").click();
      var frm = "#frmNewActivity";
      $(frm)[0].reset();
      $(frm).trigger("reset");
      $(frm).find(":submit").prop('disabled', false);
      $(frm).find(":submit").html("<i class='fa fa-plus'></i> Create Activity");
      $(frm).data('submitted', false);
      $(frm).modal("hide");
       dotoken();
      $('#tblActivities').DataTable().draw();
          Swal.fire({
                  type: 'success',
                  title: 'Activity Save Successful',
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


  // Update Objectives
  $("#frmUpdateActivity").validate({
debug: false,
rules: {

},
messages: {

},
submitHandler: function(form) {
// do other stuff for a valid form

 $.post('assets/bin/ManageRecords.php', $("#frmUpdateActivity").serialize(), function(data) {

  if (data.length < 30)
  {
  $(".close").click();
  var frm = "#frmUpdateActivity";
  $(frm)[0].reset();
  $(frm).trigger("reset");
  $(frm).find(":submit").prop('disabled', false);
  $(frm).find(":submit").html("<i class='fa fa-edit'></i> Update Activity");
  $(frm).data('submitted', false);
  $(frm).modal("hide");
   dotoken();
  $('#tblActivities').DataTable().draw();
      Swal.fire({
              type: 'success',
              title: 'Activity Update Successful',
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
    var dataTableActivites = $('#tblActivities').DataTable({
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
          url :"assets/bin/getSection3Actvities.php", // json datasource
          type: "post",  // type of method  , by default would be get
         "data":function(data) {
          data.AppraisalID   = $('#S_ROWID').val();

          },

          error: function(et){  // error handling code
            $("#tblActivities_processing").css("display","none");
            alert(JSON.stringify(et));
          }
        },

        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            total = api
                .column(3)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            pageTotal = api
                .column(3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api.column(3).footer() ).html(
                pageTotal +' (%)'
            );
        }
  });
    //End Table


  });


  function DoEditActivity(RowID)
       {
        var RowInfo = eval('(' + $("#row-"+RowID).attr('data-value') + ')');
        $("#ActivityDescription2").html(RowInfo.ActivityDescription);
        $("#WeightPercentage2").val(RowInfo.WeightPercentage);
        $("#TargetNo2").val(RowInfo.TargetNo);
        $("#S_ROWID2").val(RowInfo.S_ROWID);
       //	$("#ItemType2").trigger("chosen:updated");
        $("#UpdateObjectives").modal("show");
       }

  function doRemoveActivity(RowID)
       {
            bootbox.confirm({
                centerVertical: true,
            message: "Are you sure you want remove this Activity?",
            buttons: {
              confirm: {
               label: "Remove Item",
               className: "btn-danger btn-sm",
              },
              cancel: {
               label: "Cancel",
               className: "btn-sm",
              }
            },
            callback: function(result) {
              if(result)
              {


                 var dialog = bootbox.dialog({
                  title: "Remove Objective",
                  centerVertical: true,
             message: '<p class="text-center mb-0"><i class="fa fa-spin fa-cog bigger-240"></i> <h3>Please wait ...</h3></p>',
             closeButton: false
               });
    var postdata = $("#myForm").serializeArray();
    postdata.push({name: '_token', value: $("#_token").val()});
     postdata.push({name: 'ModCode', value: "69"});
    postdata.push({name: 'DeleteRecord', value: RowID});
    $.post("assets/bin/ManageRecords.php", postdata, function(data){

         dialog.modal('hide');
         $('#tblActivities').DataTable().draw();
         dotoken();
           Swal.fire({
                type: 'success',
                title: 'Activity Removed Successful',
                showConfirmButton: false,
                timer: 1500
                });
    });

              }
            }
            });
       }

  </script>
<div>

  <h3 class="header smaller lighter blue">Section 3 : PERFORMANCE TARGETS</h3>
  <div class="alert alert-info">
			This Section should be completed by the Appraisee in consultation with the Supervisor
	</div>
</div>
<div class="row">
  <div class="col-xs-12">
        <div class="widget-box">
          <div class="widget-header widget-header-flat">
            <h4 class="widget-title smaller">
              <i class="ace-icon fa fa-list smaller-80"></i>
                Performance Targets List
            </h4>
            <div class="widget-toolbar no-border">
              <a data-toggle='modal' href='#CreateNewActivity' class='dt-button btn  btn-success btn-bold' title='Add New'><i class='fa fa-plus  fa-lg'></i> Create New Activity </a>
             </div>
          </div>
        <div class="widget-body">
          <table id="tblActivities" class="table table-bordered table-striped">
              <thead>
                  <tr>
                    <th>#</th>
                    <th>Performance Targets/Activities</th>
                    <th>AgreedNo /Targets</th>
                    <th>Weight(%)</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                    <th colspan="3" style="text-align:right"><span class="text-danger pull-left">NB: Total Weight Should Sum to 100%</span>Total Weight:</th>
                    <th></th>
                  </tr>
                </tfoot>
            </table>

        </div>
    </div><!-- WidgetBox -->
  </div><!-- RightSide -->
</div>


<div id="CreateNewActivity" class="modal fade" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 id="Colh3" class="smaller lighter blue no-margin"><i class="ace-icon fa fa-user icon-on-right bigger-110"></i> Create New Activity </h3>
      </div>
 <form name="frmNewActivity" id="frmNewActivity" class="form-horizontal" role="form">
  <div class="modal-body">
  <input type="hidden" name="ModCode" id="ModCode" value="69">
  <input type="hidden" name="AppraisalID" id="AppraisalID" value="<?php echo $rst["S_ROWID"];?>">

   <input type="hidden" name="_token" id="_token2" class="token" >
    <div id="colAlert"></div>
        <input type="hidden" name="ReturnType" id="ReturnType2" value="RstID">
   <div class="row">
    <div class="form-group col-sm-12">
        <label class="col-sm-4 control-label " for="PhoneNo"> Performance Target</label>
         <div class="col-sm-8">
           <textarea name="ActivityDescription" id="ActivityDescription" class="form-control" rows="3"></textarea>
        </div>
      </div>
    </div>

  <div class="row">
    <div class="form-group col-sm-12">
      <label class="col-sm-4 control-label " for="TargetNo"> Agreed Targets </label>
      <div class="col-sm-8">
        <input type="text" id="TargetNo" name="TargetNo" placeholder="Enter Number of Targets" class="col-xs-12 col-sm-12 NumberOnly"   required="true" />
      </div>
    </div>
  </div>

  <div class="row">
    <div class="form-group col-sm-12">
      <label class="col-sm-4 control-label " for="WeightPercentage"> WeightPercentage (%) </label>
      <div class="col-sm-8">
        <input type="text" id="WeightPercentage" name="WeightPercentage" placeholder="Enter Weight" class="col-xs-12 col-sm-12 NumberOnly"   required="true" />
      </div>
    </div>
  </div>




      </div><!-- End ModalBody -->
<div class="modal-footer">
  <button type="submit" id="btnSaveRecord" name="btnSaveRecord"  class="btn btn-sm btn-success">
         <i class="ace-icon fa fa-plus icon-on-right bigger-110"></i> Create Activity
      </button>
        </div>
      </form>
    </div><!-- Modal-content -->
  </div><!-- Modal-Dialog -->
 </div><!-- Modal-Div -->



 <div id="UpdateObjectives" class="modal fade" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 id="Colh3" class="smaller lighter blue no-margin"><i class="ace-icon fa fa-user icon-on-right bigger-110"></i> Update Activity</h3>
      </div>
 <form name="frmUpdateActivity" id="frmUpdateActivity" class="form-horizontal" role="form">
  <div class="modal-body">
   <input type="hidden" name="ModCode" id="ModCode" value="69">
   <input type="hidden" name="_token" id="_token2" class="token" >
    <div id="colAlert"></div>
        <input type="hidden" name="ReturnType" id="ReturnType2" value="RstID">
     <input type="hidden" name="S_ROWID" id="S_ROWID2" >

     <div class="row">
      <div class="form-group col-sm-12">
          <label class="col-sm-4 control-label " for="PhoneNo"> Performance Target</label>
           <div class="col-sm-8">
             <textarea name="ActivityDescription" id="ActivityDescription2" class="form-control" rows="3"></textarea>
          </div>
        </div>
      </div>

    <div class="row">
      <div class="form-group col-sm-12">
        <label class="col-sm-4 control-label " for="TargetNo"> Agreed Targets </label>
        <div class="col-sm-8">
          <input type="text" id="TargetNo2" name="TargetNo" placeholder="Enter Number of Targets" class="col-xs-12 col-sm-12 NumberOnly"   required="true" />
        </div>
      </div>
    </div>

    <div class="row">
      <div class="form-group col-sm-12">
        <label class="col-sm-4 control-label " for="WeightPercentage"> WeightPercentage (%) </label>
        <div class="col-sm-8">
          <input type="text" id="WeightPercentage2" name="WeightPercentage" placeholder="Enter Weight" class="col-xs-12 col-sm-12 NumberOnly"   required="true" />
        </div>
      </div>
    </div>

      </div><!-- End ModalBody -->
<div class="modal-footer text-center">
  <button type="submit" id="btnUpdateRecord" name="btnUpdateRecord"  class="btn btn-sm btn-success">
        Update Activity
        <i class="ace-icon fa fa-edit icon-on-right bigger-110"></i>
      </button>
        </div>
      </form>
    </div><!-- Modal-content -->
  </div><!-- Modal-Dialog -->
 </div><!-- Modal-Div -->
