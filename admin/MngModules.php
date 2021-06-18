<script type="text/javascript">
	$(document).ready(function(){
      
      $("#ModuleName").blur(function(){
   var AppName = $(this).val();
     if (AppName != "")
     {
      $("#ModuleCode").val(AppName.replace(' ', ''));
     }
   });

		$("#frmAddModules").validate({
                debug: false,
                rules: {
                
                },
                messages: {
                
                },
                submitHandler: function(form) {
                // do other stuff for a valid form
                //showLoader();
               
                $.post('bin/ManageModules.php', $("#frmAddModules").serialize(), 
                function(data) {
                
                if(data.length < 30)
                {
                   
                     var urlstr = "page=134&cid="+data+"&sk=356a192b7913b04c54574d18c28d46e6395428ab";
                   
                     $(window.location).attr('href', "?"+urlstr);
         
                
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
     
     var dataTable = $('#tblModules').DataTable({
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
      { "targets": 1,"title": "AppName" },
      { "targets": 2,"title": "ModuleName" },
      { "targets": 3,"title": "ListingType" },
      { "targets": 4,"title": "ModDest"},
      { "targets": 5,"title": "ModuleType"},
      { "targets": 6,"title": "CreatedBy"},
      { "targets": 7,"title": "DateCreated"},
      { "targets": 8,"title": "Actions"}
      ],
         
          
         "ajax":{
            url :"bin/getModules.php", // json datasource
            type: "post",  // type of method  , by default would be get
           "data":function(data) {
            data.SearchQry = $('#SearchQry').val();
                //alert(JSON.stringify(data));
            },

            error: function(){  // error handling code
              $("#tblModules_processing").css("display","none");
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
								var tblName = "dh_modules";
								$.post("bin/ManageRecords.php", {DeleteRecord: ""+tblName+"",RecID: ""+RecID+""}, function(data){
									$('#tblModules').DataTable().draw();
							    
									});
							}
						}
					  }
					);
   }
	
</script>
<div class="page-content">
		<div class="page-header">
			<h1>Manage Modules</h1>
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
						  <a data-toggle="modal" href="#AddModules" class="btn btn-xs btn-purple bigger">
								<i class="ace-icon fa fa-plus"></i>
								Add New Module
							</a>
					   </div>

					</div>
				<div class="widget-body">

					<table id="tblModules" class="table table-bordered table-striped"></table>

				</div>
				</div><!-- WidgetBox -->	


	     </div>  <!-- End col-xs-12 -->
	    </div><!-- End Row -->
	 </div><!-- End Page-content -->



	  <div id="AddModules" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="Colh3" class="smaller lighter blue no-margin">Create New Module  </h3>
				</div>
				<form name="frmAddModules" id="frmAddModules" class="form-horizontal" role="form">
				<div class="modal-body">

					<div id="colAlert"></div>
                    <input type="hidden" name="ModuleCode" id="ModuleCode">
					<div class="form-group">
						<label class="col-sm-3 control-label " for="ModuleName"> Module Name </label>
						<div class="col-sm-9">
							<input type="text" id="ModuleName" name="ModuleName" placeholder="Enter Module Name" class="col-xs-10 col-sm-10"  required="true" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label " for="AppName"> Application Name </label>
						<div class="col-sm-9">
						   <select name="AppName" id="AppName" class="col-xs-10 col-sm-10"  required="true">
						   	<?php  
						   		$getApps = $db->Execute("select AppCode,ApplicationName from dh_applications order by AppCode");
						   		echo "<option value=''></option>";
						   		while (!$getApps->EOF) {
						   			$AppCode = $getApps->fields["AppCode"];
						   			$AppName = $getApps->fields["ApplicationName"];
						   			echo "<option value='$AppCode'>$AppName</option>";
						   			$getApps->MoveNext();
						   		}
						   	?>
						   </select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label " for="TableName"> Table Name </label>
						<div class="col-sm-9">
						   <select name="TableName" id="TableName" class="col-xs-10 col-sm-10"  required="true">
						   	<?php  
						   	  $Tables = $db->metaTables('TABLES');
								$Views = $db->metaTables('VIEWS');
								$TableList1 = array_merge($Tables,$Views);
						   	   $getTbls = $db->GetArray("select ItemCode from listitems where ItemType='SystemTables'");
							    $SysTbls = array();
							   foreach ($getTbls as $key => $tblName) {
							    $SysTbls[] = $tblName["ItemCode"];
							   }
							     echo "<option value=''></option>";
							    $TableList = array_diff($TableList1, $SysTbls);
							    foreach ($TableList as $key => $Tbl) {
							    	echo "<option value='$Tbl'>$Tbl</option>";
							    }
						   	?>
						   </select>
						</div>
					</div>



					<div class="form-group">
						<label class="col-sm-3 control-label " for="IconRef"> Icon Ref </label>
						<div class="col-sm-9">
							<select  id="IconRef" name="IconRef" placeholder="Enter Icon Ref" class="col-xs-10 col-sm-10"   required="true">
								<?php echo $rs->GetListItems($rst["FontAwesome"],"FontAwesome",$op);?>

							</select>
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
	<button type="submit" id="btnSaveRecord" name="btnSaveRecord" value="dh_modules" class="btn btn-sm btn-success">
		Save Module
					<i class="ace-icon fa fa-plus icon-on-right bigger-110"></i>
				</button>
					</div>
				</form>
			</div><!-- Modal-content -->
		</div><!-- Modal-Dialog -->
	 </div><!-- Modal-Div -->