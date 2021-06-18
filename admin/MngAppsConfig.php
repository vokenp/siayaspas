<script type="text/javascript">
	$(document).ready(function(){

      $("#confName").keyup(function(){
   var AppName = $(this).val();
     if (AppName != "")
     {
      $("#AppCode").val(AppName.replace(' ', ''));
     }
   });

		$("#frmAddAppConf").validate({
                debug: false,
                rules: {

                },
                messages: {

                },
                submitHandler: function(form) {
                // do other stuff for a valid form
                //showLoader();

                $.post('bin/ManageRecords.php', $("#frmAddAppConf").serialize(),
                function(data) {

                if(data.length < 30)
                {

                  $('#tblApps').DataTable().draw();
                  var frm = "#frmAddAppConf";
                  $(frm).find(":submit").prop('disabled', false);
    			  $(frm).find(":submit").html("Save Application");
    			  $(frm).data('submitted', false);
                  $(frm).trigger("reset");
				  $('#AddAppConf').modal('hide')


                }else
                {
                 alert(data);
                   /* $('#error_box').fadeIn(200);
                    $('#error_box').html(data);*/

                    //hideLoader();
                }
                });
                }
                });  // End Form Submission

     var dataTable = $('#tblApps').DataTable({
         "Processing": true,
         "serverSide": true,
         "scrollY": "60vh",
         "scrollCollapse": true,
         "bFilter":true,
         "ordering": true,
         "order": [[ 1, 'desc' ]],
         "lengthMenu": [[-1], ["All"]],
          "columnDefs": [
      { "targets": 0,"title": "#"},
      { "targets": 1,"title": "confName" },
      { "targets": 2,"title": "confType"},
      { "targets": 3,"title": "AttribLabel"},
      { "targets": 4,"title": "AttribType"},
      { "targets": 6,"title": "AttribRequired"},
      { "targets": 6,"title": "DateCreated"},
      { "targets": 7,"title": "Actions"}
      ],


         "ajax":{
            url :"bin/getAppConfigs.php", // json datasource
            type: "post",  // type of method  , by default would be get
           "data":function(data) {
            data.SearchQry = $('#SearchQry').val();
                //alert(JSON.stringify(data));
            },

            error: function(){  // error handling code
              $("#tblApps_processing").css("display","none");
            }
          }
    });


	});

	function DoDeleteRecord(RecID)
	{
     bootbox.confirm({
						message: "Are you sure you want to Delete this Record",
						buttons: {
						  confirm: {
							 label: "Delete Record",
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
								var tblName = "appconfigs";
								$.post("bin/ManageRecords.php", {DeleteRecord: ""+tblName+"",RecID: ""+RecID+""}, function(data){
									$('#tblApps').DataTable().draw();

									});
							}
						}
					  }
					);
   }

</script>
<div class="page-content">
		<div class="page-header">
			<h1>Manage Applications</h1>
		</div><!-- /.page-header -->
		<div class="row">
			<div class="col-xs-12">

              <div class="col-xs-12">
				<div class="widget-box">
					<div class="widget-header widget-header-flat">
						<h4 class="widget-title smaller">
							<i class="ace-icon fa fa-list smaller-80"></i>
						</h4>
						<div class="widget-toolbar no-border">
						  <a data-toggle="modal" href="#AddAppConf" class="btn btn-xs btn-purple bigger">
								<i class="ace-icon fa fa-plus"></i>
								Add New Application
							</a>
					   </div>

					</div>
				<div class="widget-body">

					<table id="tblApps" class="table table-bordered table-striped"></table>

				</div>
				</div><!-- WidgetBox -->
	     </div>  <!-- End col-xs-12 -->
	    </div><!-- End Row -->
	 </div><!-- End Page-content -->



	  <div id="AddAppConf" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="Colh3" class="smaller lighter blue no-margin">Create AppConfig  </h3>
				</div>
				<form name="frmAddAppConf" id="frmAddAppConf" class="form-horizontal" role="form">
				<div class="modal-body">

					<div id="colAlert"></div>

          <div class="form-group">
            <label class="col-sm-3 control-label " for="confType"> Attrib Type </label>
            <div class="col-sm-9">
              <select name="confType" id="confType" class="col-xs-10 col-sm-10"  required="true">
                <?php echo $rs->GetListItems($rst["confType"],"ConfigurationType","add");?>
              </select>
            </div>
          </div>

					<div class="form-group">
						<label class="col-sm-3 control-label " for="confName"> ConfName </label>
						<div class="col-sm-9">
							<input type="text" id="confName" name="confName" placeholder="Enter ConfName" class="col-xs-10 col-sm-10"  required="true" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label " for="AttribLabel"> Attrib Label </label>
						<div class="col-sm-9">
							<input type="text" id="AttribLabel" name="AttribLabel" placeholder="Enter Attribute Label" class="col-xs-10 col-sm-10"  required="true" />
						</div>
					</div>

          <div class="form-group">
            <label class="col-sm-3 control-label " for="AttribType"> Attrib Type </label>
            <div class="col-sm-9">
              <select name="AttribType" id="AttribType" class="col-xs-10 col-sm-10"  required="true">
                <?php echo $rs->GetListItems($rst["AttribType"],"AttribType","add");?>
              </select>
            </div>
          </div>

          <div class="form-group">
						<label class="col-sm-3 control-label " for="AttribRequired"> Attrib Required </label>
						<div class="col-sm-9">
              <select name="AttribRequired" id="AttribRequired" class="col-xs-10 col-sm-10"  required="true">
								<?php echo $rs->GetListItems($rst["AttribRequired"],"AttribRequired","add");?>
							</select>
						</div>
					</div>


				</div><!-- End ModalBody -->
                 	<div class="modal-footer">
	<button type="submit" id="btnSaveRecord" name="btnSaveRecord" value="appconfigs" class="btn btn-sm btn-success">
		Save AppConfig
					<i class="ace-icon fa fa-plus icon-on-right bigger-110"></i>
				</button>
					</div>
				</form>
			</div><!-- Modal-content -->
		</div><!-- Modal-Dialog -->
	 </div><!-- Modal-Div -->
