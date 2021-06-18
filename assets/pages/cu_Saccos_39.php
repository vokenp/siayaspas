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
		dotoken();
	//  Sacco Users
  $("#frmsaccoNewUser").validate({
debug: false,
rules: {

},
messages: {
  
},
submitHandler: function(form) {
// do other stuff for a valid form

   $.post('assets/bin/ManageSaccos.php', $("#frmsaccoNewUser").serialize(), function(data) {
       
    if (data.length < 30)
    {
    $(".close").click();
    var frm = "#frmsaccoNewUser";
    $(frm)[0].reset();
    $(frm).trigger("reset");
    $(frm).find(":submit").prop('disabled', false);
    $(frm).find(":submit").html("<i class='fa fa-plus'></i> Create User"); 
    $(frm).data('submitted', false);
    $(frm).modal("hide");
     dotoken();
    $('#tblSaccousers').DataTable().draw();
        Swal.fire({
                type: 'success',
                title: 'Save Successful',
                showConfirmButton: false,
                timer: 1500
                });
    }
    else
    {
    dotoken();
    Swal.fire(
                  'Oops!',
                  data,
                  'error'
                );
             
    }
});
}
});

    $("#frmsaccoUpdateUser").validate({
debug: false,
rules: {

},
messages: {
  
},
submitHandler: function(form) {
// do other stuff for a valid form

   $.post('assets/bin/ManageSaccos.php', $("#frmsaccoUpdateUser").serialize(), function(data) {
       
    if (data.length < 30)
    {
    $(".close").click();
    var frm = "#frmsaccoUpdateUser";
    $(frm)[0].reset();
    $(frm).trigger("reset");
    $(frm).find(":submit").prop('disabled', false);
    $(frm).find(":submit").html("<i class='fa fa-edit'></i> Update User"); 
    $(frm).data('submitted', false);
    $(frm).modal("hide");
     dotoken();
    $('#tblSaccousers').DataTable().draw();
        Swal.fire({
                type: 'success',
                title: 'Update Successful',
                showConfirmButton: false,
                timer: 1500
                });
    }
    else
    {
    dotoken();
    Swal.fire(
                  'Oops!',
                  data,
                  'error'
                );
   
    }
});
}
});

	    var dataTableSUsers = $('#tblSaccousers').DataTable({
         "Processing": true,
         "serverSide": true,
         "scrollY": "50vh",
         "scrollCollapse": true,
         "bFilter":true,
         "ordering": true,
         "bLengthChange": true,
         "bPaginate": true,
         "pagingType": "simple",
         language: {
        paginate: {
        next: '<i class="fa fa-chevron-right">',
        previous: '<i class="fa fa-chevron-left">'  
       }
       },
          
         "ajax":{
            url :"assets/bin/getadmSaccoUsers.php", // json datasource
            type: "post",  // type of method  , by default would be get
           "data":function(data) {
            data.SaccoCode = $('#SaccoCode').val();
            data.token = $('#token').val();
            
            },

            error: function(et){  // error handling code
              //$("#tblSaccousers_processing").css("display","none");
              alert(JSON.stringify(et));
            }
          }
    });
	//End Sacco Users

	
	});

	function DoEditRecord(RowID)
       {
       	var RowInfo = eval('(' + $("#row-"+RowID).attr('data-value') + ')');
       	$("#PhoneNo2").val(RowInfo.PhoneNo);
       	$("#FirstName2").val(RowInfo.FirstName);
       	$("#OtherNames2").val(RowInfo.OtherNames);
       	$("#UserEmail2").val(RowInfo.UserEmail);
          
       	$("#S_ROWID2").val(RowInfo.S_ROWID);
        
       	$("#UserRole2 option[value='']").remove();
       	$('#UserRole2 option[value='+RowInfo.UserRole+']').attr('selected','selected');
       //	$("#ItemType2").trigger("chosen:updated");
        $("#UpdateSaccoUser").modal("show");
       }

  function doResetPswd(RowID)
       {
            bootbox.confirm({
                centerVertical: true,
            message: "Are you sure you want reset User Password?",
            buttons: {
              confirm: {
               label: "Reset Password",
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
                
                
                 var dialog = bootbox.dialog({
                  title: "Reset Password",
                  centerVertical: true,
             message: '<p class="text-center mb-0"><i class="fa fa-spin fa-cog bigger-240"></i> <h3>Please wait while password is been reset...</h3></p>',
             closeButton: false
               });
                 var postdata = $("#myForm").serializeArray();
    postdata.push({name: '_token', value: $("#token").val()});
    postdata.push({name: 'btnUserPswdReset', value: RowID});
    $.post("assets/bin/ManageRecords.php", postdata, function(data){ 
         dialog.modal('hide');
         dotoken();
           Swal.fire({
                type: 'success',
                title: 'Reset Successful',
                showConfirmButton: false,
                timer: 1500
                });
    });
              
              }
            }
            });
       }

function dotoken()
{
	 $.ajax({
      type: 'post',
      data: {tname: 1},
      success: function(resp){
       $('.token').val(resp);
      }
     });
}

</script>
<input type="hidden" name="op" id="op" value="<?php echo $op;?>">
<input type="hidden" name="url" id="url" value="<?php echo full_path();?>">
<input type="hidden" name="SaccoCode" id="SaccoCode" value="<?php echo $rst["SaccoCode"];?>">
<input type="hidden" name="token" id="token" class="token" >
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
         
          	<input type="hidden" name="ModCode" id="ModCode" value="<?php echo $mod;?>">
          	<input type="hidden" name="ReturnType" id="ReturnType" value="RstID">
            <?php echo $S_ROWID;?>
        <div class="widget-body">
           <div class="widget-main">

        <div class="row">
			   	  <div class="col-xs-12 col-sm-10">
					 <h4 class="header blue bolder smaller">Sacco Info</h4>

					  <div class="profile-user-info profile-user-info-striped ">
						<div class="profile-info-row">
							<div class="profile-info-name"> Sacco Code</div>
							<div class="profile-info-value">
								<span class="editable" id="username"><b><?php  echo $rst["SaccoCode"];?></b></span>
							</div>
						</div>
					</div> 

					 <div class="profile-user-info profile-user-info-striped ">
						<div class="profile-info-row">
							<div class="profile-info-name"> Sacco Name</div>
							<div class="profile-info-value">
								<span class="editable" id="username"><b><?php  echo $rst["SaccoName"];?></b></span>
							</div>
						</div>
					</div>

					 <div class="profile-user-info profile-user-info-striped ">
						<div class="profile-info-row">
							<div class="profile-info-name"> Sacco Route</div>
							<div class="profile-info-value">
								<span class="editable" id="username"><b><?php  echo $rst["SaccoRoute"];?></b></span>
							</div>
						</div>
					</div> 

					<div class="profile-user-info profile-user-info-striped ">
						<div class="profile-info-row">
							<div class="profile-info-name"> Sacco Email</div>
							<div class="profile-info-value">
								<span class="editable" id="username"><b><?php  echo $rst["SaccoEmail"];?></b></span>
							</div>
						</div>
					</div>

					<div class="profile-user-info profile-user-info-striped ">
						<div class="profile-info-row">
							<div class="profile-info-name"> Sacco Phone</div>
							<div class="profile-info-value">
								<span class="editable" id="username"><b><?php  echo $rst["SaccoPhone"];?></b></span>
							</div>
						</div>
					</div>

					<div class="profile-user-info profile-user-info-striped ">
						<div class="profile-info-row">
							<div class="profile-info-name"> PhysicalAddress</div>
							<div class="profile-info-value">
								<span class="editable" id="username"><b><?php  echo $rst["PhysicalAddress"];?></b></span>
							</div>
						</div>
					</div>

					

					<div class="profile-user-info profile-user-info-striped ">
						<div class="profile-info-row">
							<div class="profile-info-name"> Created</div>
							<div class="profile-info-value">
								<span class="editable" id="username"><b><?php  echo date('D jS M Y g:i a',strtotime($rst["DateCreated"]))." by ".$rst["CreatedBy"];?></b></span>
							</div>
						</div>
					</div>
				 </div>
			</div>	<!-- end Row1 -->
			<div class="space-8"></div>
        <div class="row">
      <div class="col-xs-12">
<div class="tabbable">
	<ul class="nav nav-tabs padding-18 tab-size-bigger" id="myTab">
		<li class="active">
			<a data-toggle="tab" href="#tabUsers">
				<i class="blue ace-icon fa fa-users bigger-120"></i>
				Sacco Users
			</a>
		</li>

		<li>
			<a data-toggle="tab" href="#tabFleet">
				<i class="green ace-icon fa fa-bus bigger-120"></i>
				Fleets
			</a>
		</li>

		<li>
			<a data-toggle="tab" href="#tabRoutes">
				<i class="orange ace-icon fa fa-random bigger-120"></i>
				Routes
			</a>
		</li>

	</ul>
	 <div class="tab-content no-border padding-24">
			<div id="tabUsers" class="tab-pane fade in active">
				 <?php include("SaccoUsers.php");?>
			</div>

			<div id="tabFleet" class="tab-pane fade in">
				  Fleet
			</div>

			<div id="tabRoutes" class="tab-pane fade in ">
				  Routes
			</div>
	  </div><!-- Tab-content -->
	 </div><!-- Tabbable -->
</div><!-- end col-xs-12 -->
      </div><!-- row2 -->


          </div><!-- End Widget-Main -->
          <div class="widget-toolbox padding-8 clearfix text-center">
              
          </div>
        </div><!-- End Widget-body -->
         
   
</div><!-- End WidgetBox -->