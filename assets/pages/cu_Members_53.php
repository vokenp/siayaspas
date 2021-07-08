 <?php
$op = filter_input(INPUT_GET, "view");
//$db->debug=1;

   $rand = md5(mt_rand());
   $addUrl = "?app=$app&mod=$mod&view=add&ptype=temp&sk=$rand";
   $listUrl = "?app=$app&mod=$mod&view=list&ptype=temp&sk=$rand";

  if ($op == "add") {
    $S_ROWID = "";
    $cid = "";
   
    $btn = "<button type='submit' name='btnSaveRecord' id='btnSaveRecord' class='btn btn-sm btn-success' ><i class='fa fa-edit'></i> Save Record</button>";
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
$btn = "<button type='submit' name='btnUpdateRecord' id='btnUpdateRecord' class='btn btn-sm btn-success' ><i class='fa fa-edit'></i> Update Record</button>";
   
  }
  
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
					 	  Swal.fire(
				          'Oops!',
				          data,
				          'error'
				        );
				   		dotoken();
					}
				});
				}
				});
	});

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

<div class="widget-box">
          <div class="widget-header widget-header-flat">
            <h4 class="widget-title smaller">
              <i class="ace-icon fa fa-list smaller-80"></i>
                <?php echo $modName;?>
            </h4>
            <div id="pageToolBar" class="widget-toolbar no-border">
              <a href="<?php echo $addUrl; ?>" class="btn btn-xs btn-info  radius-4 bigger"> <i class="ace-icon fa fa-plus bigger-80"></i> Add New </a>
               <a href="<?php echo $listUrl;?>" class="btn btn-xs btn-info  radius-4 bigger"> <i class="ace-icon fa fa-arrow-left bigger-80"></i> Back to List </a>

             </div>
          </div>
          <form name="frmPageTemp" id="frmPageTemp" class="form-horizontal" role="form">
          	<input type="hidden" name="ModCode" id="ModCode" value="<?php echo $mod;?>">
          	<input type="hidden" name="ReturnType" id="ReturnType" value="RstID">
          	<input type="hidden" name="_token" id="_token" value="<?php echo  VToken::genT();?>" class="token">
            <?php echo $S_ROWID;?>
        <div class="widget-body">
           <div class="widget-main">

        <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-1">
         <h4 class="header blue bolder smaller">Member Info</h4>
           <div class="profile-user-info profile-user-info-striped ">
            <div class="profile-info-row">
              <div class="profile-info-name"> IDNo</div>
              <div class="profile-info-value">
                <span class="editable" id="22"><b><?php  echo $rst["IDNo"];?></b></span>
              </div>
            </div>
          </div>

          <div class="profile-user-info profile-user-info-striped ">
            <div class="profile-info-row">
              <div class="profile-info-name"> MemberType</div>
              <div class="profile-info-value">
                <span class="editable" id="22"><b><?php  echo $rst["MemberType"];?></b></span>
              </div>
            </div>
          </div>

          <div class="profile-user-info profile-user-info-striped ">
            <div class="profile-info-row">
              <div class="profile-info-name"> FullName</div>
              <div class="profile-info-value">
                <span class="editable" id="22"><b><?php  echo $rst["FullName"];?></b></span>
              </div>
            </div>
          </div>

          <div class="profile-user-info profile-user-info-striped ">
            <div class="profile-info-row">
              <div class="profile-info-name"> PhoneNo</div>
              <div class="profile-info-value">
                <span class="editable" id="22"><b><?php  echo $rst["PhoneNo"];?></b></span>
              </div>
            </div>
          </div>

          <div class="profile-user-info profile-user-info-striped ">
            <div class="profile-info-row">
              <div class="profile-info-name">Email</div>
              <div class="profile-info-value">
                <span class="editable" id="22"><b><?php  echo $rst["Email"];?></b></span>
              </div>
            </div>
          </div>

          <div class="profile-user-info profile-user-info-striped ">
            <div class="profile-info-row">
              <div class="profile-info-name"> Date of Joining</div>
              <div class="profile-info-value">
                <span class="editable" id="22"><b><?php  echo $rst["DateofJoining"];?></b></span>
              </div>
            </div>
          </div>

        </div><!-- End Col-xs-12 -->
      </div>  <!-- End Row -->

          </div><!-- End Widget-Main -->
          <div class="widget-toolbox padding-8 clearfix text-center">
               <?php echo $btn; ?>
          </div>
        </div><!-- End Widget-body -->
         
    </form>
</div><!-- End WidgetBox -->