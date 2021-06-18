 <?php
$op = filter_input(INPUT_GET, "view");
//$db->debug=1;

   $rand = md5(mt_rand());
   $addUrl = "?app=$app&mod=$mod&view=add&ptype=temp&sk=$rand";
   $listUrl = "?app=$app&mod=$mod&view=list&ptype=temp&sk=$rand";

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
$btn = "<button type='submit' name='btnUpdateRecord' id='btnUpdateRecord' class='btn btn-sm btn-success' value='$TableName'><i class='fa fa-edit'></i> Update Record</button>";
   
  }
  
  ?>
<script type="text/javascript">
	$(document).ready(function(){
		var op = $("#op").val();

		CKEDITOR.instances['TempBody'].on('change', function(e) {
    if (e.editor.checkDirty()) {
       $("#ckChanged").val("Yes"); 
    }
});

		
		$("#frmPageTemp").validate({
				debug: false,
				rules: {
				
				},
				messages: {
				  
				},
				submitHandler: function(form) {
				// do other stuff for a valid form
				
				$.post('assets/bin/ManageRecords.php', $("#frmPageTemp").serialize(), 
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
<input type="hidden" name="ckChanged" id="ckChanged" value="No">
<div class="widget-box">
          <div class="widget-header widget-header-flat">
            <h4 class="widget-title smaller">
              <i class="ace-icon fa fa-list smaller-80"></i>
                 Manage Email Templates
            </h4>
            <div id="pageToolBar" class="widget-toolbar no-border">
              <a href="<?php echo $addUrl; ?>" class="btn btn-xs btn-info  radius-4 bigger"> <i class="ace-icon fa fa-plus bigger-80"></i> Add New </a>
               <a href="<?php echo $listUrl;?>" class="btn btn-xs btn-info  radius-4 bigger"> <i class="ace-icon fa fa-arrow-left bigger-80"></i> Back to List </a>

             </div>
          </div>
          <form name="frmPageTemp" id="frmPageTemp" class="form-horizontal message-form" role="form">
          	<input type="hidden" name="ModCode" id="ModCode" value="<?php echo $mod;?>">
          	<input type="hidden" name="ReturnType" id="ReturnType" value="RstID">
            <?php echo $S_ROWID;?>
        <div class="widget-body">
           <div class="widget-main">

        	  <div class="row">
                 	<div class="form-group ">
						<label class="col-sm-4 control-label " for="TempName"> TempName </label>
						<div class="col-sm-8">
							<input type="text" id="TempName" name="TempName" placeholder="Enter Template Name" class="col-xs-12 col-sm-9" value="<?php echo $rst['TempName'];?>"  required="true" />
						</div>
					</div>
					
			   </div>
    <div class="hr hr-18 dotted"></div>
			   <div class="row">
			   	<div class="form-group">
						<label class="col-sm-4 control-label " for="TempSubject"> TempSubject </label>
						<div class="col-sm-8">
							<input type="text" id="TempSubject" name="TempSubject" placeholder="Enter Template Subject" class="col-xs-11 col-sm-9" value="<?php echo $rst['TempSubject'];?>"  required="true" />
						</div>
					</div>
			   </div>
             <div class="hr hr-18 dotted"></div>
			    <div class="row">
                 	<div class="form-group ">
						<label class="col-sm-4 control-label " for="TempCss"> Template Css </label>
						<div class="col-sm-8">
							<textarea id="TempCss" name="TempCss" class="col-xs-11 col-sm-9"  rows="8"><?php echo $rst["TempCss"];?></textarea>
						</div>
					</div>
					
			   </div>

			   <div class="row">
			   	  <div class="hr hr-18 dotted"></div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">
						<span class="inline space-24 hidden-480"></span>
						Template Body
					</label>

					<div class="col-sm-7">
						  <textarea name="TempBody" id="TempBody" rows="10" cols="80">
                       <?php echo $rst["TempBody"]; ?>
                    </textarea>
                 <script>
                    CKEDITOR.replace('TempBody',{
                     height: 310,
                   });
                 </script>
					</div>
				</div>

				<div class="hr hr-18 dotted"></div>
			   </div>

			    


          </div><!-- End Widget-Main -->
          <div class="widget-toolbox padding-8 clearfix text-center">
               <?php echo $btn; ?>
          </div>
        </div><!-- End Widget-body -->
         
    </form>
</div><!-- End WidgetBox -->



