 <?php
$op = filter_input(INPUT_GET, "view");
//$db->debug=1;
   $rand = md5(mt_rand());
   $addUrl = "?app=$app&mod=$mod&view=add&ptype=temp&sk=$rand";
   $listUrl = "?app=$app&mod=$mod&view=list&ptype=temp&sk=$rand";
$TableName = "committemembers";
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
  $ProfileImg = $rst["ProfileImg"];
  $ImgPath = $ProfileImg == "" ? "assets/profilepics/NoImage.png" : $ProfileImg;
  $rst["ProfileImg"] = "<img class='profile-user-img img-responsive img-circle' src='$ImgPath' style='height:250px;width:250px;' >";

$S_ROWID = "<input type='hidden' name='S_ROWID' id='S_ROWID' value='$cid'>";
$btn = "<button type='submit' name='btnUpdateRecord' id='btnUpdateRecord' class='btn btn-sm btn-success' value='$TableName'><i class='fa fa-edit'></i> Update Record</button>";
   
  }
  
  ?>
<script type="text/javascript">
	$(document).ready(function(){
		var op = $("#op").val();
         if (op == "edit") 
         {
         	$("#PersonnelNo").prop("disabled",false);
         }

		
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
<input type="hidden" name="PoolID" id="PoolID" value="<?php echo $TableName.":".$cid;?>">

<div class="widget-box">
          <div class="widget-header widget-header-flat">
            <h4 class="widget-title smaller">
              <i class="ace-icon fa fa-list smaller-80"></i>
                <?php echo $modName;?>
            </h4>
            <div id="pageToolBar" class="widget-toolbar no-border">
               
               <a href="<?php echo $listUrl;?>" class="btn btn-xs btn-info  radius-4 bigger"> <i class="ace-icon fa fa-arrow-left bigger-80"></i> Back to List </a>
             </div>
          </div>
         
          	

        <div class="widget-body">
          <div class="row"></div>
        	<div class="space"></div>
        	<div class="tabbable ">
				<ul class="nav nav-tabs padding-16">
					<li class="active">
						<a data-toggle="tab" href="#edit-basic">
							<i class="green ace-icon fa fa-pencil-square-o bigger-125"></i>
							Basic Info
						</a>
					</li>


					<li>
						<a data-toggle="tab" href="#edit-password">
							<i class="blue ace-icon fa fa-key bigger-125"></i>
							Password
						</a>
					</li>
				</ul>
				<div class="tab-content profile-edit-tab-content">
                   <div id="edit-basic" class="tab-pane in active">
                   		<h4 class="header blue bolder smaller">General</h4>
                   		<div class="row">
							<div class="col-xs-12 col-sm-3">
                                <?php echo $rst["ProfileImg"];?> 
                                <a href='#' class='btn  pull-right' data-toggle='modal' data-target='#ProfImg-modal' title="Upload Photo"><i class='fa fa-camera-retro fa-2x'></i></a>  
							</div>
							
							  <div class="col-xs-12 col-sm-9">
							   <form name="frmPageTemp" id="frmPageTemp" class="form-horizontal" role="form">
							   	<input type="hidden" name="ModCode" id="ModCode" value="<?php echo $mod;?>">
          	<input type="hidden" name="ReturnType" id="ReturnType" value="RstID">
            <?php echo $S_ROWID;?>
                                 <div class="row">
                                 	<div class="form-group col-sm-6">
										<label class="col-sm-3 control-label " for="IDNo"> IDNo </label>
										<div class="col-sm-9">
											<input type="text" id="IDNo" name="IDNo" placeholder="Enter IDNo" class="col-xs-11 col-sm-11" value="<?php echo $rst['IDNo'];?>"  required="true" />
										</div>
									</div>
                                 </div>
							  	  <div class="row">
					             	<div class="form-group col-sm-6">
										<label class="col-sm-3 control-label " for="PersonnelNo"> PFNo </label>
										<div class="col-sm-9">
											<input type="text" id="PersonnelNo" name="PersonnelNo" placeholder="Enter PersonnelNo" class="col-xs-11 col-sm-11" value="<?php echo $rst['PersonnelNo'];?>"  required="true" />
										</div>
									</div>
								<div class="form-group col-sm-6">
									<label class="col-sm-3 control-label " for="FullName"> Full Name </label>
									<div class="col-sm-9">
										<input type="text" id="FullName" name="FullName" placeholder="Enter FullName" class="col-xs-11 col-sm-11" value="<?php echo $rst['FullName'];?>"  required="true" />
									</div>
								</div>
			                  </div><!-- End Row -->

			                    <div class="row">
					             	<div class="form-group col-sm-6">
										<label class="col-sm-3 control-label " for="PhoneNo"> PhoneNo</label>
										<div class="col-sm-9">
											<input type="text" id="PhoneNo" name="PhoneNo" placeholder="Enter PhoneNo" class="col-xs-11 col-sm-11" value="<?php echo $rst['PhoneNo'];?>"  required="true" />
										</div>
									</div>
								<div class="form-group col-sm-6">
									<label class="col-sm-3 control-label " for="Email"> Email </label>
									<div class="col-sm-9">
										<input type="email" id="Email" name="Email" placeholder="Enter Email" class="col-xs-11 col-sm-11" value="<?php echo $rst['Email'];?>"  required="true" />
									</div>
								</div>
			                  </div><!-- End Row -->

			                  <div class="row">
					             	<div class="form-group col-sm-6">
										<label class="col-sm-3 control-label " for="Designation"> Designation</label>
										<div class="col-sm-9">
											<input type="text" id="Designation" name="Designation" placeholder="Enter Designation" class="col-xs-11 col-sm-11" value="<?php echo $rst['Designation'];?>"  required="true" />
										</div>
									</div>
								<div class="form-group col-sm-6">
									<label class="col-sm-3 control-label " for="Ward"> Ward </label>
									<div class="col-sm-9">
										<select id="Ward" name="Ward"  class="chosen-select col-xs-11 col-sm-11">
											<?php echo $rs->GetListItems($rst["Ward"],"Wards022",$op);?>
										</select>
									</div>
								</div>
			                  </div><!-- End Row -->

			                  <div class="row">
			                  	<div class="form-group col-sm-12 text-center">
			                  		 <?php echo $btn; ?>
			                  	</div>
			                  </div>


							  </form>
							  </div>

						</div>

					<div class="row">
						<h4 class="header blue bolder smaller">Committees</h4>
						<div class="col-sm-8">
							<dl id="dt-list-1" >
								<?php 
								$PersonnelNo = $rst["PersonnelNo"];
									$getComm = $db->Execute("select *from vw_commMemberList where MemID='$cid'");
									$html = "";
									while (!$getComm->EOF) {
										$rst = array();
										$rst = $getComm->fields;
										$MemberType = $rst["MemberType"];
										$CommitteeID = $rst["CommitteeID"];
										$CommitteeName = $rst["CommitteeName"];
										$html .= "<dt><h4>$CommitteeName</h4></dt>";
										$html .= "<dd><span class='label label-xlg label-info arrowed arrowed-right'>$MemberType</span></dd>";
										$getComm->MoveNext();
									}
									echo $html;
								?>
							</dl>

						</div>
					</div>
                   </div><!-- End Basic -->

            
				 <div id="edit-password" class="tab-pane">
					<div class="space-10"></div>
					<h4 class="header blue bolder smaller">Change Password</h4>
				</div><!-- End Edit-settings -->


				</div><!-- End Tab Content -->

			</div><!-- End Tabble -->
			</div><!-- End Offset -->
         </div>  <!-- End Widget Body -->

</div><!-- End WidgetBox -->

<!-- Topic MESSAGE MODAL -->
<div class="modal fade" id="ProfImg-modal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" style="width:75%;">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title"><i class="glyphicon glyphicon"> Upload Profile Picture </i></h4>
</div>
<div class="modal-body">
     <div class="row">
        <div class="col-md-4 text-center">
        <div id="upload-demo" style="width:320px"></div>
        </div>
        <div class="col-md-2" style="padding-top:30px;margin-left:20px;">
        <strong>Choosen Image:</strong>
        <br/>
        <input type="file" id="upload" >
        <br/>
        <button class="btn btn-success upload-Preview">Preview Image</button>
        </div>
        <div class="col-md-4" style="">
        <div id="upload-demo-i" style="background:#e1e1e1;width:320px;padding:10px;height:320px;margin-top:30px"></div><br/>
        <button id="upload-result" class="btn btn-success upload-result">Upload This One</button>
        </div>
      </div>
</div><!-- End Modal Body -->
<div class="modal-footer clearfix">
    <button type="button" id="btnclose" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 300,
        height: 300,
        type: 'square'
    },
    boundary: {
        width: 320,
        height: 320
    }
});

$('#upload').on('change', function () { 
  var reader = new FileReader();
    reader.onload = function (e) {
      $uploadCrop.croppie('bind', {
        url: e.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
      
    }
    reader.readAsDataURL(this.files[0]);
});

$('.upload-Preview').on('click', function (ev) {
  $uploadCrop.croppie('result', {
    type: 'canvas',
    size: 'viewport'
  }).then(function (resp) {
        html = '<img src="' + resp + '" />';
        $("#upload-demo-i").html(html);
  });
});

$('#upload-result').on('click', function (ev) {
	$("#upload-result").prop("disabled",true);
	$("#upload-result").html("Uploading....");
  $uploadCrop.croppie('result', {
    type: 'canvas',
    size: 'viewport'
  }).then(function (resp) {
      
    $.ajax({
      url: "assets/bin/classfunctions.php",
      type: "POST",
      data: {"ProFileimage":resp,"PoolID":$("#PoolID").val()},
      success: function (data) {
      	   
      	     $(this).prop("disabled",false);
            location.reload();
      }
    });
  });
});

</script>