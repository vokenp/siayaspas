<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
 //$db->debug=1;
  $cid = filter_input(INPUT_GET, "cid");
  $tableName = "dh_modules";
  $rst = $rs->row($tableName,"S_ROWID=$cid");
  $op = "edit";
  $ModTableName = $rst["TableName"];
  $ModuleCode = $rst["ModuleCode"];
  $ExemptRole = $rst["ExemptRole"] =='Y' ? "checked='true'" : "";
  $ExcludePermsList = $rst["ExcludePermsList"] == 'Y' ? "checked='true'" : "";
  $EnableCreation = $rst["EnableCreation"] == 'Y' ? "checked='true'" : "";
  $DeleteItems = $rst["DeleteItems"] == 'Y' ? "checked='true'" : "";
  $EnablePreview = $rst["EnablePreview"] == 'Y' ? "checked='true'" : "";
?>

<script type="text/javascript">
	$(document).ready(function(){
  
    $('#btnExemptRole').on('click', function(){
		
			if(this.checked) {
			   	$("#ExemptRole").val("Y");
			}
			else {
				$("#ExemptRole").val("N");
			}
		});
    $('#btnEnablePreview').on('click', function(){
		
			if(this.checked) {
			   	$("#EnablePreview").val("Y");
			}
			else {
				$("#EnablePreview").val("N");
			}
		});

    $('#btnDeleteItems').on('click', function(){
		
			if(this.checked) {
			   	$("#DeleteItems").val("Y");
			}
			else {
				$("#DeleteItems").val("N");
			}
		});
   
   $('#btnEnableCreation').on('click', function(){
		
			if(this.checked) {
			   	$("#EnableCreation").val("Y");
			}
			else {
				$("#EnableCreation").val("N");
			}
		});
   $('#btnExcludePermsList').on('click', function(){
		
			if(this.checked) {
			   	$("#ExcludePermsList").val("Y");
			}
			else {
				$("#ExcludePermsList").val("N");
			}
		});

$("#frmMods").validate({
				debug: false,
				rules: {
				
				},
				messages: {
				  
				},
				submitHandler: function(form) {
				// do other stuff for a valid form
				
				$.post('bin/ManageRecords.php', $("#frmMods").serialize(), 
				function(data) {
					if (data.length < 30)
					{
				
					 location.reload();
					}
					else
					{
					alert(data);
				   
					}
				});
				}
				});

   //Save ListView
    $("#frmlistview").validate({
				debug: false,
				rules: {
				//FilmSize: "required",
				},
				messages: {
				  
				},
				submitHandler: function(form) {
				// do other stuff for a valid form
				
				$.post('bin/ManageModules.php', $("#frmlistview").serialize(), 
				function(data) {
					if (data.length < 30)
					{
			
					 location.reload();
					}
					else
					{
					
				   
					}
				});
				}
				});

    //Save ListView Query
     $("#frmlistQuery").validate({
				debug: false,
				rules: {
				//FilmSize: "required",
				},
				messages: {
				  
				},
				submitHandler: function(form) {
				// do other stuff for a valid form
				
				$.post('bin/ManageModules.php', $("#frmlistQuery").serialize(), 
				function(data) {
					if (data.length < 30)
					{
					
					 location.reload();
					}
					else
					{
					alert(data);
				   
					}
				});
				}
				});

      $("#frmHelp").validate({
				debug: false,
				rules: {
		
				},
				messages: {
				  
				},
				submitHandler: function(form) {
				// do other stuff for a valid form
				var postdata = $("#frmHelp").serializeArray();
        
           var Helpcontext = CKEDITOR.instances.Helpcontext.getData();
             postdata.push({name: 'Helpcontext', value: Helpcontext});
             postdata.push({name: 'S_ROWID', value: $("#S_ROWID").val()});
        
				$.post('bin/ManageRecords.php', postdata, 
				function(data) {
					location.reload();
				});
				}
				});


    });
</script>

<div class="page-content">
		<div class="page-header">
			<h1>Manage Module : <b><?php echo $rst["ModuleName"]?></b></h1>
		</div><!-- /.page-header -->
		<div class="row">
			<div class="col-xs-12">
			<div class="col-xs-12">
				<div class="widget-box">
					<div class="widget-header widget-header-flat">
						<h4 class="widget-title smaller">
							<i class="ace-icon fa fa-list smaller-80"></i>
							Module Properties
						</h4>
						
					</div>
					<form name="frmMods" id="frmMods" class="form-horizontal" role="form">
				<div class="widget-body">
					
						<br>
				 <input type="hidden" name="S_ROWID" id="S_ROWID" value="<?php echo $cid; ?>">
         <div class="row">
         		<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="ModuleType"> Module Type </label>
						<div class="col-sm-8">
							<select name="ModuleType" id="ModuleType" class="col-xs-11 col-sm-11"  required="true">
								<?php echo $rs->GetListItems($rst["ModuleType"],"ModuleType",$op);?>
							</select>
						</div>
					</div>

					<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="ModuleListView"> Module ListView </label>
						<div class="col-sm-8">
							<select name="ModuleListView" id="ModuleListView" class="col-xs-11 col-sm-11"  required="true">
								<?php echo $rs->GetListItems($rst["ModuleListView"],"ModuleListView",$op);?>
							</select>
						</div>
					</div>

         </div>

		    <div class="row">
                 	<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="ModuleName"> Module Name </label>
						<div class="col-sm-8">
							<input type="text" id="ModuleName" name="ModuleName" placeholder="Enter Module Name" class="col-xs-11 col-sm-11" value="<?php echo $rst['ModuleName'];?>"  readonly="true" />
						</div>
					</div>
					<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="TableName"> Table Name </label>
						<div class="col-sm-8">
							<input type="text" id="TableName" name="TableName" placeholder="Enter Table Name" class="col-xs-11 col-sm-11" value="<?php echo $rst['TableName'];?>"  readonly="true" />
						</div>
					</div>
			   </div>

			   <div class="row">
			   		<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="AppName"> Application Name </label>
						<div class="col-sm-8">
							<select name="AppName" id="AppName" class="col-xs-11 col-sm-11">
						      <?php  
						        $AppCode = $rst["AppName"];
						        $ApplicationName = $db->GetOne("select ApplicationName from dh_applications where AppCode='$AppCode'");
						         $getApps = $db->Execute("select AppCode,ApplicationName from dh_applications where AppCode<>'$AppCode'");
						          echo "<option value='$AppCode'>$ApplicationName</option>";
						           while (!$getApps->EOF) {
						            $ApplicationName = $getApps->fields["ApplicationName"];
						            $AppCode = $getApps->fields["AppCode"];
						            echo "<option value='$AppCode'>$ApplicationName</option>";
						            $getApps->MoveNext();
						           }
						      ?>
						    </select>
						</div>
					</div>

					<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="ACL"> Role Group </label>
						<div class="col-sm-8">
							<select name="ACL" id="ACL" class="col-xs-11 col-sm-11">
						     <?php 
         						echo $rs->getGroups($rst["ACL"]);
    						?>
						    </select>
						</div>
					</div>
			   </div>

			   <div class="row">
			   	<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="IconRef"> Icon Ref </label>
						<div class="col-sm-8">
							<input type="text" d="IconRef" name="IconRef" placeholder="Enter Icon Ref"  class="col-xs-11 col-sm-11" value="<?php echo $rst['IconRef'];?>">
						</div>
					</div>

					<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="DisplayOrder"> Display Order </label>
						<div class="col-sm-8">
							<input type="text" id="DisplayOrder" name="DisplayOrder" placeholder="Enter DisplayOrder" class="col-xs-11 col-sm-11 NumberOnly" value="<?php echo $rst['DisplayOrder'];?>"   />
						</div>
					</div>
			   </div>


			   <div class="row">
			   		<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="CheckExist"> CheckExist </label>
						<div class="col-sm-8">
							<select name="CheckExist" id="CheckExist" class="col-xs-11 col-sm-11">
						     <?php 
						       echo "<option value=''></option>";
         						$ColList = $db->metaColumnNames($rst["TableName"]);
         						foreach ($ColList as $key => $value) {
         							echo "<option value='$value'>$value</option>";
         						}
    						?>
						    </select>
						</div>
					</div>

					<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="DisplayButton"> DisplayButton </label>
						<div class="col-sm-8">
							<input type="text" id="DisplayButton" name="DisplayButton" placeholder="<?php echo "Create New ".$rst['ModuleName'];?>" class="col-xs-11 col-sm-11 "    />
						</div>
					</div>
			   </div>
			 <div class="row">
			 		<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="ListingType"> ListingType </label>
						<div class="col-sm-8">
							<select  id="ListingType" name="ListingType" placeholder="Enter ListingType" class="chosen-select col-xs-10 col-sm-10"   required="true">
								<?php echo $rs->GetListItems($rst["ListingType"],"ListingType","edit");?>

							</select>
						</div>
					</div>

					<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="CreateBtnType"> Created Btn Type </label>
						<div class="col-sm-8">
							<select  id="CreateBtnType" name="CreateBtnType"  class="chosen-select col-xs-10 col-sm-10"   required="true">
								<?php echo $rs->GetListItems($rst["CreateBtnType"],"CreateBtnType","edit");?>

							</select>
						</div>
					</div>

			 </div>

			   <div class="row">
			   	<div class="form-group col-sm-4">
						<label class="col-sm-6 control-label " for="DisplayButton">Exclude Permissions List </label>
						<div class="col-sm-5">
							<input  id="btnExcludePermsList" class="ace ace-switch ace-switch-5" type="checkbox" <?php echo $ExcludePermsList; ?> />
							<span class="lbl"></span>
							 <input type="hidden" name="ExcludePermsList" id="ExcludePermsList" value="<?php echo $rst["ExcludePermsList"];?>">
						</div>
					</div>

				<div class="form-group col-sm-4">
						<label class="col-sm-6 control-label " for="DisplayButton">Exempt Role </label>
						<div class="col-sm-5">
							<input  id="btnExemptRole" class="ace ace-switch ace-switch-5" type="checkbox" <?php echo $ExemptRole; ?> />
							<span class="lbl"></span>
                         <input type="hidden" name="ExemptRole" id="ExemptRole" value="<?php echo $rst["ExemptRole"];?>">
						</div>
					</div>

				<div class="form-group col-sm-4">
						<label class="col-sm-6 control-label " for="DisplayButton">Enable Creation </label>
						<div class="col-sm-5">
							<input  id="btnEnableCreation" class="ace ace-switch ace-switch-5" type="checkbox" <?php echo $EnableCreation; ?> />
							<span class="lbl"></span>
                          <input type="hidden" name="EnableCreation" id="EnableCreation" value="<?php echo $rst["EnableCreation"];?>" >
						</div>
					</div>
			   </div>
             <div class="row">
             	<div class="form-group col-sm-4">
						<label class="col-sm-6 control-label " for="DisplayButton">Enable Delete</label>
						<div class="col-sm-5">
							<input  id="btnDeleteItems" class="ace ace-switch ace-switch-5" type="checkbox" <?php echo $DeleteItems; ?> />
							<span class="lbl"></span>
                          <input type="hidden" name="DeleteItems" id="DeleteItems" value="<?php echo $rst["DeleteItems"];?>" >
						</div>
					</div>

					<div class="form-group col-sm-4">
						<label class="col-sm-6 control-label " for="DisplayButton">Enable Preview</label>
						<div class="col-sm-5">
							<input  id="btnEnablePreview" class="ace ace-switch ace-switch-5" type="checkbox" <?php echo $EnablePreview; ?> />
							<span class="lbl"></span>
                          <input type="hidden" name="EnablePreview" id="EnablePreview" value="<?php echo $rst["EnablePreview"];?>" >
						</div>
					</div>
             </div>
             

					
					
				</div><!-- End WidgeBody -->
				  <div class="widget-toolbox padding-8 clearfix text-center">
               	  	<button type="submit" id="btnUpdateRecord" name="btnUpdateRecord" value="dh_modules" class="btn btn-sm btn-success "><i class="fa fa-save"></i> Update Module</button>
               </div>
                </form>
				</div><!-- WidgetBox -->	
	     </div>  <!-- End col-xs-12 -->




	     		<div class="col-xs-12">
				<div class="widget-box">
					<div class="widget-header widget-header-flat">
						<h4 class="widget-title smaller">
							<i class="ace-icon fa fa-list smaller-80"></i>
							Module Items
						</h4>
						
					</div>
<div class="widget-body">
<div class="row">
<div class="col-sm-12">
<div class="tabbable ">
	<ul class="nav nav-tabs" id="myTab3">
		<li class="active">
			<a data-toggle="tab" href="#modListView">
				<i class="pink ace-icon fa fa-tachometer bigger-110"></i>
				List View
			</a>
		</li>

		<li>
			<a data-toggle="tab" href="#ModListDefaultQry">
				<i class="blue ace-icon fa fa-user bigger-110"></i>
				List Default Query
			</a>
		</li>

		<li>
			<a data-toggle="tab" href="#modMenuActions">
				<i class="ace-icon fa fa-rocket"></i>
				Menu Actions
			</a>
		</li>

		<li>
			<a data-toggle="tab" href="#modHelpContext">
				<i class="ace-icon fa fa-rocket"></i>
				Module Help Context
			</a>
		</li>
	</ul>

	<div class="tab-content">
		<div id="modListView" class="tab-pane fade in active">
			<?php include("ModListview.php");?>
		</div>

		<div id="ModListDefaultQry"  class="tab-pane fade in ">
			<?php include("ModListDefaultQry.php");?>
		</div>

		<div id="modMenuActions" class="tab-pane fade in ">
			<?php include("modMenuActions.php");?>
		</div>
		<div id="modHelpContext" class="tab-pane fade in ">
			<?php include("modHelpContext.php");?>
		</div>

	</div><!-- tab-content -->

</div><!-- tabble -->
</div><!-- col-xs-12 -->
</div><!-- end row -->



</div>
</div><!-- WidgetBox -->	
	     </div>  <!-- End col-xs-12 -->


	     </div>  <!-- End col-xs-12 -->
	    </div><!-- End Row -->
	 </div><!-- End Page-content -->