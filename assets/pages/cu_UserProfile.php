 <?php
$op = filter_input(INPUT_GET, "view");
//$db->debug=1;
$TableName = "dh_users";

 $cid =  $UserInfo["S_ROWID"];
$rst = $UserInfo;
  
  
$S_ROWID = "<input type='hidden' name='S_ROWID' id='S_ROWID' value='$cid'>";
$btn = "<button type='submit' name='btnUpdateRecord' id='btnUpdateRecord' class='btn btn-sm btn-success' value='$TableName'><i class='fa fa-edit'></i> Update Record</button>";
   
  
  
  ?>
<script type="text/javascript">
	$(document).ready(function(){
		var op = $("#op").val();
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

<div class="widget-box">
          <div class="widget-header widget-header-flat">
            <h4 class="widget-title smaller">
              <i class="ace-icon fa fa-list smaller-80"></i>
                <?php echo $modName;?>
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
						<label class="col-sm-4 control-label " for="loginid"> LoginID </label>
						<div class="col-sm-8">
							<input type="text" id="loginid" name="loginid" placeholder="Enter LoginID" class="col-xs-11 col-sm-11" value="<?php echo $rst['loginid'];?>"  readonly="true" />
						</div>
					</div>
					<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="Fullname"> Fullname </label>
						<div class="col-sm-8">
							<input type="text" id="Fullname" name="Fullname" placeholder="Enter Name" class="col-xs-11 col-sm-11" value="<?php echo $rst['Fullname'];?>"  required="true" />
						</div>
					</div>
			   </div>
          
           <div class="row">
                 	<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="Phone"> Phone </label>
						<div class="col-sm-8">
							<input type="text" id="Phone" name="Phone" placeholder="Enter PhoneNo" class="col-xs-11 col-sm-11 mask-phoneNo" value="<?php echo $rst['Phone'];?>"  required="false" />
						</div>
					</div>
					<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="Email"> Email </label>
						<div class="col-sm-8">
							<input type="email" id="Email" name="Email" placeholder="Enter Email Address" class="col-xs-11 col-sm-11" value="<?php echo $rst['Email'];?>"  required="false" />
						</div>
					</div>
			   </div>

			   <div class="row">
                 	<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="Position"> Position </label>
						<div class="col-sm-8">
							<input type="text" id="Position" name="Position" placeholder="Enter Position" class="col-xs-11 col-sm-11" value="<?php echo $rst['Position'];?>"  required="false" />
						</div>
					</div>
					<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="PhoneExt">PhoneExt </label>
						<div class="col-sm-8">
							<input type="text" id="PhoneExt" name="PhoneExt" placeholder="Enter PhoneExt" class="col-xs-11 col-sm-11" value="<?php echo $rst['PhoneExt'];?>"  required="false" />
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