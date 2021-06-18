<script type="text/javascript">
	jQuery(function($) {
	$("#tblToolBar").hide();
$("#bootbox-regular").on(ace.click_event, function() {
			bootbox.prompt("Create New Table, Enter Table Name.", function(result) {
				var tblName = result;
				if (result === null) {
					
				} else {
				  
				   $.post("bin/ManageDBfields.php", {CreateNewTbl: ""+result+""}, function(data){

				    if(data.length < 15)
				    {
				    	$('#TableFinder').DataTable().draw();
				    	OpenTblDef(result);
				    }
				    else
				    {
				    	alert(data);
				    }
  					});
				}
			});
		});
});

   $(document).ready(function(){
     var dataTable = $('#TableFinder').DataTable({
         "Processing": true,
         "serverSide": true,
         "scrollY": "60vh",
         "scrollCollapse": true,
         "bFilter":false,
         "ordering": true,
         "pagingType": "simple",
         "bLengthChange": false,
         "bPaginate": false,
         language: {
        paginate: {
        next: '<i class="fa fa-chevron-right">',
        previous: '<i class="fa fa-chevron-left">'  
       }
       },
          
         "ajax":{
            url :"bin/getTables.php", // json datasource
            type: "post",  // type of method  , by default would be get
           "data":function(data) {
            //data.FileID = $('#FileID').val();
            //data.SearchQry = $('#SearchQry').val();
            //data.SearchField = $('#SearchField').val();
            },

            error: function(){  // error handling code
              $("#TableFinder_processing").css("display","none");
            }
          }
    });

     //Table Definations
       var dataTableDif = $('#TableDefination').DataTable({
         "Processing": true,
         "serverSide": true,
         "scrollY": "60vh",
         "scrollCollapse": true,
         "bFilter":false,
         "ordering": true,
         "bLengthChange": false,
         "bPaginate": false,
         "pagingType": "simple",
         language: {
        paginate: {
        next: '<i class="fa fa-chevron-right">',
        previous: '<i class="fa fa-chevron-left">'  
       }
       },
          
         "ajax":{
            url :"bin/getTableDef.php", // json datasource
            type: "post",  // type of method  , by default would be get
           "data":function(data) {
            data.CurTable = $('#CurTable').val();
      
            },

            error: function(){  // error handling code
              $("#TableDefination_processing").css("display","none");
            }
          }
    });


       $("#frmAddColumn").validate({
                debug: false,
                rules: {
                
                },
                messages: {
                
                },
                submitHandler: function(form) {
                // do other stuff for a valid form
                //showLoader();
               
                $.post('bin/ManageDBfields.php', $("#frmAddColumn").serialize(), 
                function(data) {
                
                 if(data.length < 15)
                {
                   
                  $('#TableDefination').DataTable().draw();
                  var frm = "#frmAddColumn";
                  $(frm).find(":submit").prop('disabled', false);
    			  $(frm).find(":submit").html("Add Column"); 
    			  $(frm).data('submitted', false);
                  $(frm).trigger("reset");
				  //$('#AddColModal').modal('hide')

 
                }else
                {
                 alert(data);
                   /* $('#error_box').fadeIn(200);
                    $('#error_box').html(data);*/
                    
                    //hideLoader();
                }
                });
                }
                });


     

   });

   function OpenTblDef(TblName)
   {
       $("#tDef").html("Table Defination : <b>"+TblName+"</b>");
       $("#Colh3").html("Create Columns in table : <b>"+TblName+"</b>");
       $("#CurTable,#CurrentTable").val(TblName);
       $("#TableDefination").DataTable().draw();
       $("#tblToolBar").show();
   }

   function DoalterColumn(ColName)
   {

   }

   function DoRenameColumn(ColName)
   {
   		bootbox.prompt("Rename column: "+ColName+", Enter New Column Name.", function(result) {
				var tblName = $("#CurTable").val();
				if (result === null) {
					
				} else {
				  
				   $.post("bin/ManageDBfields.php", {RenameColumn: ""+tblName+"",OldColName: ""+ColName+"",NewColName: ""+result+""}, function(data){

				     if(data.length < 15)
				    {
				    	$('#TableDefination').DataTable().draw();
				    	
				    }
				    else
				    {
				    	alert(data);
				    }
  					});
				}
			});
   }

   function DoDropColumn(ColName)
   {
     bootbox.confirm({
						message: "Are you sure you want to Drop this Column : "+ColName,
						buttons: {
						  confirm: {
							 label: "Drop Column",
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
								var tblName = $("#CurTable").val();
								$.post("bin/ManageDBfields.php", {DropColumn: ""+tblName+"",ColName: ""+ColName+""}, function(data){

							     if(data.length < 15)
							    {
							    	$('#TableDefination').DataTable().draw();

							    	
							    }
							    else
							    {
							    	alert(data);
							    }
									});
							}
						}
					  }
					);
   }
</script>
<input type="hidden" name="CurTable" id="CurTable" >
<div class="page-content">
		<div class="page-header">
			<h1>Manage Tables
				
		</h1>

		</div><!-- /.page-header -->
		<div class="row">
			<div class="col-xs-12">
				<div class="col-xs-3">
				<div class="widget-box">
					<div class="widget-header widget-header-flat">
						<h4 class="widget-title smaller">
							<i class="ace-icon fa fa-list smaller-80"></i>
							Table List
						</h4>
						<div class="widget-toolbar no-border">
							<button class="btn btn-xs btn-purple bigger" data-toggle="tab" id="bootbox-regular" data-target="write">
								<i class="ace-icon fa fa-plus"></i>
								Add Table
							</button>
					   </div>

					</div>
				<div class="widget-body">
					<table id="TableFinder" class="table table-bordered table-striped">
			        <thead>
			            <tr>
			              <th>#</th>
			              <th>Table Name</th>
			            </tr>
			          </thead>
			      </table>

				</div>





				</div><!-- WidgetBox -->
				</div><!-- LeftSide -->

		      <div class="col-xs-9">
                <div class=" widget-box">
                	<div class="widget-header widget-header-flat">
						<h4 class="widget-title smaller">
							<i class="ace-icon fa fa-list smaller-80"></i>
							<span id="tDef">Table Defination : </span>
						</h4>

						<div id="tblToolBar" class="widget-toolbar no-border">
							<a data-toggle="modal" href="#AddColModal" class="btn btn-xs btn-success bigger">
								<i class="ace-icon fa fa-plus"></i>
								Add Column
							</a>
							<button id="btnRenameTable" class="btn btn-xs btn-info bigger">
								<i class="ace-icon fa fa-edit"></i>
								Rename Table
							</button>
					   </div>

					<div class="widget-body">
					

					<table id="TableDefination" class="table table-bordered table-striped">
			        <thead>
			            <tr>
			              <th>#</th>
			              <th>Name</th>
			              <th>DataType</th> 
						  <th>MaxLenght</th> 
						  <th>Actions</th> 
							 
			            </tr>
			          </thead>
			      </table>
				</div>


                </div><!-- WidgetBox -->
                </div><!-- RightSide -->
 

	     </div>  <!-- End col-xs-12 -->
	    </div><!-- End Row -->
	 </div><!-- End Page-content -->

	 <div id="AddColModal" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="Colh3" class="smaller lighter blue no-margin">Create Columns in table : </h3>
				</div>
				<form name="frmAddColumn" id="frmAddColumn" class="form-horizontal" role="form">
				<div class="modal-body">

					<div id="colAlert"></div>

					
						<input type="hidden" name="CurrentTable" id="CurrentTable">
					<div class="form-group">
						<label class="col-sm-3 control-label " for="ColumnName"> Column Name </label>
						<div class="col-sm-9">
							<input type="text" id="ColumnName" name="ColumnName" placeholder="Column Name" class="col-xs-10 col-sm-10"  required="true" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label " for="ColumnName"> Display Name </label>
						<div class="col-sm-9">
							<input type="text" id="DisplayName" name="DisplayName" placeholder="Display Name" class="col-xs-10 col-sm-10" required="true" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label " for="DataType"> DataType </label>
						<div class="col-sm-9">
						  <select name="DataType" id="DataType" required="true" class="col-xs-10 col-sm-10">
						  	<option></option>
						  	<option value="C">Text</option>
						  	<option value="X">Long Text</option>
						  	<option value="D">Date</option>
						  	<option value="T">DateTime</option>
						  	<option value="I">Integer</option>
						  	<option value="N">Numeric</option>
						  	<option value="B">Binary Image/Blob</option>
						  </select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label " for="MaxLenght"> Default Value </label>
						<div class="col-sm-9">
							<input type="text" id="DefaultValue" name="DefaultValue" placeholder="DefaultValue"  class="col-xs-10 col-sm-10" />
						</div>
					</div>
					
	


					

				</div><!-- End ModalBody -->
                 	<div class="modal-footer">			
	<button type="submit" id="btnAddColumn" name="btnAddColumn" class="btn btn-sm btn-success">
					Add Column
					<i class="ace-icon fa fa-plus icon-on-right bigger-110"></i>
				</button>
					</div>
				</form>
			</div><!-- Modal-content -->
		</div><!-- Modal-Dialog -->
	 </div><!-- Modal-Div -->