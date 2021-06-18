<script type="text/javascript">
	$(document).ready(function(){

    $("#bootbox-regular").on(ace.click_event, function() {
			bootbox.prompt("Enter Item type", function(result) {
				
				if (result === null) {
					
				} else {
				  $("#ItemType").append("<option value='"+result+"'>"+result+"</option>");
					$("#ItemType").val(result); 
					$("#ItemType").trigger("chosen:updated");
					$("#CurItemType").val(result);
					$("#h4Span").html(result);
					
				}
			});
		});

       $("#ItemType").change(function(){
         $("#CurItemType").val($("#ItemType").val());
         $("#h4Span").html($("#ItemType").val());
         $('#tblListItems').DataTable().draw();
       });


        var dataTableDif = $('#tblListItems').DataTable({
         "Processing": true,
         "serverSide": true,
         "scrollY": "50vh",
         "scrollCollapse": true,
         "bFilter":true,
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
            url :"bin/getListItems.php", // json datasource
            type: "post",  // type of method  , by default would be get
           "data":function(data) {
            data.CurItemType = $('#CurItemType').val();
            
            },

            error: function(){  // error handling code
              $("#tblListItems_processing").css("display","none");
            }
          }
    });

		$("#frmAddList").validate({
                debug: false,
                rules: {
                
                },
                messages: {
                
                },
                submitHandler: function(form) {
                // do other stuff for a valid form
                //showLoader();
               
                $.post('bin/ManageRecords.php', $("#frmAddList").serialize(), 
                function(data) {
                
                if(data.length < 30)
                {
                   
                  $('#tblListItems').DataTable().draw();
                  var frm = "#frmAddList";
                  $(frm).find(":submit").prop('disabled', false);
    			  $(frm).find(":submit").html("Add Item"); 
    			  $(frm).data('submitted', false);
                  $(frm).trigger("reset");
                  var CurItemType = $("#CurItemType").val();
                  $("#ItemType").val(CurItemType); 
				  $("#ItemType").trigger("chosen:updated");
				  
                }else
                {
                 alert(data);
                   
                }
                });
                }
                });  // End Form Submission

		$("#frmUpdateItem").validate({
                debug: false,
                rules: {
                
                },
                messages: {
                
                },
                submitHandler: function(form) {
                // do other stuff for a valid form
                //showLoader();
               
                $.post('bin/ManageRecords.php', $("#frmUpdateItem").serialize(), 
                function(data) {
                
                if(data.length < 30)
                {
                   
                  $('#tblListItems').DataTable().draw();
                  var frm = "#frmUpdateItem";
                  $(frm).find(":submit").prop('disabled', false);
    			  $(frm).find(":submit").html("Update Item"); 
    			  $(frm).data('submitted', false);
                  $(frm).trigger("reset");
                  $("#AddColModal").modal("hide");
				  $("#ItemType2").trigger("chosen:updated");
				  
                }else
                {
                 alert(data);
                   
                }
                });
                }
                });  // End Form Submission
	});
       
       function DoEditRecord(RowID)
       {
       	var RowInfo = eval('(' + $("#row-"+RowID).attr('data-value') + ')');
       	$("#ItemCode2").val(RowInfo.ItemCode);
       	$("#ItemDescription2").val(RowInfo.ItemDescription);
          
       	$("#S_ROWID").val(RowInfo.S_ROWID);
        $("#ItemType2").html("");
       	$('#ItemType option').each(function(){
            $("#ItemType2").append("<option value='"+this.value+"'>"+this.value+"</option>");
          }); 
       	$("#ItemType2 option[value='']").remove();
       	$('#ItemType2 option[value='+RowInfo.ItemType+']').attr('selected','selected');
       	$("#ItemType2").trigger("chosen:updated");
        $("#AddColModal").modal("show");
       }

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
								var tblName = "listitems";
								$.post("bin/ManageRecords.php", {DeleteRecord: ""+tblName+"",RecID: ""+RecID+""}, function(data){
									$('#tblListItems').DataTable().draw();
							    
									});
							}
						}
					  }
					);
   }
</script>
<div class="page-content">
		<div class="page-header">
			<h1>Manage ListItems</h1>
		</div><!-- /.page-header -->
		<div class="row">
			<div class="col-xs-12">
		 <div class="col-xs-4">
				<div class="widget-box">
					<div class="widget-header widget-header-flat">
						<h4 class="widget-title smaller">
							<i class="ace-icon fa fa-list smaller-80"></i>
					
						</h4>
						<div class="widget-toolbar no-border">
							<button class="btn btn-xs btn-purple bigger" data-toggle="tab" id="bootbox-regular" data-target="write">
								<i class="ace-icon fa fa-plus"></i>
								Add Item Type
							</button>
					   </div>
					</div>
			<form name="frmAddList" id="frmAddList" class="form-horizontal" role="form">
				<div class="widget-body">
                   <div class="widget-main">

				<div class="row">
					<div class="col-xs-11">
						<div class="form-group">
						<label class="col-sm-4 control-label " for="DataType"> Item Type </label>
						<div class="col-sm-8">
						  <select name="ItemType" id="ItemType" required="true" class="chosen-select form-control" style="width:90%">
						  	<?php 
							    $getData = $db->Execute("select distinct ItemType from listitems where ItemType not in ('Gender','Country','filterConditions','AppType','usertype','RoleUser','RoleProfile')");
							     echo "<option value=''></option>";
							      while (!$getData->EOF) {
							      	$ItemType = $getData->fields["ItemType"];
							      	echo "<option value='$ItemType'>$ItemType</option>";
							      	$getData->MoveNext();
							      }
							  ?>
						  	
						  </select>
						</div>
					</div>
					</div>
					
				</div>

			   <div class="row">
			   	<div class="form-group">
						<label class="col-sm-4 control-label " for="ItemCode"> ItemCode</label>
						<div class="col-sm-8">
							<input type="text" id="ItemCode" name="ItemCode" placeholder="ItemCode"  class="col-xs-10 col-sm-10" required="true" />
						</div>
					</div>
			   </div>
                <div class="row">
                	<div class="form-group">
						<label class="col-sm-4 control-label " for="ItemDescription"> Item Description</label>
						<div class="col-sm-8">
							<input type="text" id="ItemDescription" name="ItemDescription" placeholder="Item Description" required="true" class="col-xs-10 col-sm-10" />
						</div>
					</div>
                </div>

                   </div> <!-- End MainWidget -->
					<div class="widget-toolbox padding-8 no-border clearfix text-center">
							<button type="submit" name="btnSaveRecord" id="btnSaveRecord" value="listitems" class="btn btn-sm btn-success bigger"  id="bootbox-regular" >
								<i class="ace-icon fa fa-plus"></i>
								Add Item
							</button>
					   </div>

			
				</div><!-- End WidgetBody -->
			</form>		
		</div><!-- WidgetBox -->
	</div><!-- LeftSide -->

	<div class="col-xs-8">
				<div class="widget-box">
					<div class="widget-header widget-header-flat">
						<h4 class="widget-title smaller">
							<i class="ace-icon fa fa-list smaller-80"></i>
							Item List for : <span id="h4Span"></span>
						</h4>
						<div class="widget-toolbar no-border">
							
					   </div>
					</div>
				<div class="widget-body">
				   <input type="hidden" name="CurItemType" id="CurItemType">
					<table id="tblListItems" class="table table-bordered table-striped">
			        <thead>
			            <tr>
			              <th>#</th>
			              <th>ItemType</th>
			              <th>ItemCode</th> 
						  <th>ItemDescription</th> 
						  <th>CreatedBy</th> 
						  <th>DateCreated</th> 
						  <th>Action</th>
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
					<h3 id="Colh3" class="smaller lighter blue no-margin">Update Item : </h3>
				</div>
				<form name="frmUpdateItem" id="frmUpdateItem" class="form-horizontal" role="form">
				<div class="modal-body">

					<div id="colAlert"></div>
					<input type="hidden" name="S_ROWID" ID="S_ROWID">
				<input type="hidden" name="" id="CurrentTable">
				<div class="col-xs-11">
				  <div class="form-group">
				  	<label class="col-sm-3 control-label"  >Item Type</label>
				  	<div class="col-sm-9">
						  <select name="ItemType2" id="ItemType2" class="col-xs-10 col-sm-10" required="true"></select>
						</div>
				  </div>
				 </div>
					<div class="form-group">
						<label class="col-sm-3 control-label " for="ItemCode2"> ItemCode </label>
						<div class="col-sm-9">
							<input type="text" id="ItemCode2" name="ItemCode2" placeholder="ItemCode" class="col-xs-10 col-sm-10"  required="true" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label " for="ItemDescription2">Item Description</label>
						<div class="col-sm-9">
							<textarea id="ItemDescription2" name="ItemDescription2" class="col-xs-10 col-sm-10" rows="2"></textarea>
						</div>
					</div>

				
					
				</div><!-- End ModalBody -->
                 	<div class="modal-footer">			
	<button type="submit" id="btnUpdateRecord" name="btnUpdateRecord" class="btn btn-sm btn-success" value="listitems">
				 Update Item
					<i class="ace-icon fa fa-edit icon-on-right bigger-110"></i>
				</button>
					</div>
				</form>
			</div><!-- Modal-content -->
		</div><!-- Modal-Dialog -->
	 </div><!-- Modal-Div -->