 <?php
$op = filter_input(INPUT_GET, "view");
//$db->debug=1;

$TableName = "dh_applications";

  if ($op == "add") {
    $S_ROWID = "";
    $cid = "";
   
    $btn = "<button type='submit' name='btnSaveRecord' id='btnSaveRecord' class='btn btn-sm btn-success' value='$TableName'><i class='fa fa-edit'></i> Save Record</button>";
    $getColumns = $db->metaColumnNames($TableName);
    foreach ($getColumns as $key => $value) {
       $rst[$value] = "";  
    }
  }
  else
  {
 $cid = filter_input(INPUT_GET, "cid");
$rst = $rs->row($TableName,"S_ROWID='$cid'");
  $arg = array_filter($rst);
    if (empty($arg)) {
      include("assets/pages/404.php");
      exit();
    }
$S_ROWID = "<input type='hidden' name='S_ROWID' id='S_ROWID' value='$cid'>";
$btn = "<button type='submit' name='btnUpdateRecord' id='btnUpdateRecord' class='btn btn-sm btn-success' value='$TableName'><i class='fa fa-edit'></i> Update AppLication</button>";
   
  }
  
  ?>
<script type="text/javascript">
	$(document).ready(function(){
		var op = $("#op").val();
		$("#frmPageTemp").validate({
			    errorElement: 'div',
				errorClass: 'help-block',
				focusInvalid: false,
				ignore: "",
				debug: false,
				debug: false,
				rules: {
				
				},
				messages: {
				  
				},
				highlight: function (e) {
						$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
					},
					success: function (e) {
						$(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
						$(e).remove();
					},
					errorPlacement: function (error, element) {
						if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
							var controls = element.closest('div[class*="col-"]');
							if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
							else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
						}
						else if(element.is('.select2')) {
							error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
						}
						else if(element.is('.chosen-select')) {
							error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
						}
						else error.insertAfter(element.parent());
					},
				submitHandler: function(form) {
				// do other stuff for a valid form
				
				$.post('bin/ManageRecords.php', $("#frmPageTemp").serialize(), 
				function(data) {
					if (data.length < 30)
					{
				
					 if(op == "add")
					 {
					 var urlstr = $("#url").val();
                     var url = urlstr.replace("view=add&", "view=edit&cid="+data+"&");
                     $(window.location).attr('href', "?"+url);
					 }
					 else
					 {
					 	location.reload();
					 }
					}
					else
					{
					alert(data);
				   
					}
				});
				}
				});
	});
</script>
<input type="hidden" name="op" id="op" value="<?php echo $op;?>">
<input type="hidden" name="url" id="url" value="<?php echo full_path();?>">

<div class="page-content">
		<div class="page-header">
			<h1>Manage Application : <b><?php echo $rst["ApplicationName"]?></b></h1>
		</div><!-- /.page-header -->
		<div class="row">
			<div class="col-xs-12">
			<div class="col-xs-12">

<div class="widget-box">
          <div class="widget-header widget-header-flat">
            <h4 class="widget-title smaller">
              <i class="ace-icon fa fa-list smaller-80"></i>
                
            </h4>
            <div id="pageToolBar" class="widget-toolbar no-border">
             

             </div>
          </div>
          <form name="frmPageTemp" id="frmPageTemp" class="form-horizontal" role="form">
          	<input type="hidden" name="ModCode" id="ModCode" value="<?php echo $mod;?>">
          	<input type="hidden" name="ReturnType" id="ReturnType" value="RstID">
            <?php echo $S_ROWID;?>
        <div class="widget-body">
           <div class="widget-main">

        	  <div class="row">
                 	<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="ApplicationName"> ApplicationName </label>
						<div class="col-sm-8">
							<input type="text" id="ApplicationName" name="ApplicationName" placeholder="Enter M" class="col-xs-12 col-sm-12" value="<?php echo $rst['ApplicationName'];?>"  required="true" />
						</div>
					</div>
					
			   </div>
			   <div class="row">
			   	<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="DisplayOrder"> DisplayOrder </label>
						<div class="col-sm-8">
							<input type="text" id="DisplayOrder" name="DisplayOrder" placeholder="Enter DisplayOrder" class="col-xs-12 col-sm-12 NumberOnly" value="<?php echo $rst['DisplayOrder'];?>"  required="true" />
						</div>
					</div>
			   </div>

			   <div class="row">
			   	<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="IconRef">IconRef </label>
						<div class="col-sm-8">
							<input type="text" id="IconRef" name="IconRef" placeholder="Enter IconRef" class="col-xs-11 col-sm-12 NumbersOnly" value="<?php echo $rst['IconRef'];?>"  required="true" />
						</div>
					</div>
			   </div>


          </div><!-- End Widget-Main -->
          <div class="widget-toolbox padding-8 clearfix text-center">
               <?php echo $btn; ?>
          </div>
        </div><!-- End Widget-body -->
         
    </form>
</div><!-- End WidgetBox -->
   </div>  <!-- End col-xs-12 -->


	     </div>  <!-- End col-xs-12 -->
	    </div><!-- End Row -->
	 </div><!-- End Page-content -->