<script type="text/javascript">
	$(document).ready(function(){
      
      $("#ApplicationName").keyup(function(){
   var AppName = $(this).val();
     if (AppName != "")
     {
      $("#AppCode").val(AppName.replace(' ', ''));
     }
   });

		$("#frmAddApp").validate({
                debug: false,
                rules: {
                
                },
                messages: {
                
                },
                submitHandler: function(form) {
                // do other stuff for a valid form
                //showLoader();
               
                $.post('bin/ManageRecords.php', $("#frmAddApp").serialize(), 
                function(data) {
                
                if(data.length < 30)
                {
                   
                  $('#tblApps').DataTable().draw();
                  var frm = "#frmAddApp";
                  $(frm).find(":submit").prop('disabled', false);
    			  $(frm).find(":submit").html("Save Application"); 
    			  $(frm).data('submitted', false);
                  $(frm).trigger("reset");
				  $('#AddApp').modal('hide')

 
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
      { "targets": 1,"title": "ApplicationName" },
      { "targets": 2,"title": "IconRef" },
      { "targets": 3,"title": "DisplayOrder"},
      { "targets": 4,"title": "CreatedBy"},
      { "targets": 5,"title": "DateCreated"},
      { "targets": 6,"title": "Actions"}
      ],
         
          
         "ajax":{
            url :"bin/getApplications.php", // json datasource
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
								var tblName = "dh_applications";
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
						  <a data-toggle="modal" href="#AddApp" class="btn btn-xs btn-purple bigger">
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



	  <div id="AddApp" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="Colh3" class="smaller lighter blue no-margin">Create New Application  </h3>
				</div>
				<form name="frmAddApp" id="frmAddApp" class="form-horizontal" role="form">
				<div class="modal-body">

					<div id="colAlert"></div>
                    <input type="hidden" name="AppCode" id="AppCode">
					<div class="form-group">
						<label class="col-sm-3 control-label " for="ApplicationName"> Application Name </label>
						<div class="col-sm-9">
							<input type="text" id="ApplicationName" name="ApplicationName" placeholder="Enter Application Name" class="col-xs-10 col-sm-10"  required="true" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label " for="IconRef"> Icon Ref </label>
						<div class="col-sm-9">
							<input type="text" id="IconRef" name="IconRef" placeholder="Enter Application Name" class="col-xs-10 col-sm-10"  required="true" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label " for="IconRef">  Display Order </label>
						<div class="col-sm-9">
							<input type="text" id="DisplayOrder" name="DisplayOrder" placeholder="Enter DisplayOrder" class="col-xs-10 col-sm-10 NumberOnly"  required="true" />
						</div>
					</div>
					

				</div><!-- End ModalBody -->
                 	<div class="modal-footer">			
	<button type="submit" id="btnSaveRecord" name="btnSaveRecord" value="dh_applications" class="btn btn-sm btn-success">
		Save Application
					<i class="ace-icon fa fa-plus icon-on-right bigger-110"></i>
				</button>
					</div>
				</form>
			</div><!-- Modal-content -->
		</div><!-- Modal-Dialog -->
	 </div><!-- Modal-Div -->