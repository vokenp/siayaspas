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

    $("#btnCorrectNo").click(function(){
      bootbox.prompt("Please Enter the Correct PhoneNo", function(rst) {

        if (rst === null) {

        } else {
          bootbox.confirm({
                 message: "Are you sure you want to change the PhoneNo to : "+rst,
                 buttons: {
                   confirm: {
                    label: "Yes Continue",
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
                     var postdata = $("#frmPageTemp").serializeArray();
                      postdata.push({name: 'ScheduleType', value: "ChangedPhoneNo"});
                      postdata.push({name: 'ChangePhoneNo', value: rst});
                      postdata.push({name: 'btnSchedule', value: "ChnNo"});
                     $.post("assets/bin/ManageRecords.php", postdata, function(data){
                        	if (data.length < 5)
                          {

                          $(window.location).attr('href', $("#listurl").val());
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
                 }
               });
        }
      });

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
<input type="hidden" name="listurl" id="listurl" value="<?php echo $listUrl;?>">
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
          <form name="frmPageTemp" id="frmPageTemp" class="form-horizontal" role="form">
          	<input type="hidden" name="ModCode" id="ModCode" value="<?php echo $mod;?>">
          	<input type="hidden" name="ReturnType" id="ReturnType" value="RstID">
          	<input type="hidden" name="_token" id="_token" value="<?php echo  VToken::genT();?>" class="token">
            <?php echo $S_ROWID;?>
        <div class="widget-body">
           <div class="widget-main">

             <div class="row">

            <div class="col-xs-12 col-sm-6">
           <div class="profile-user-info profile-user-info-striped ">
            <div class="profile-info-row">
              <div class="profile-info-name">  TimeCompleted</div>
              <div class="profile-info-value">
                <span class="editable" id="username"><b><?php  echo $rst["TimeCompleted"];?></b></span>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name">  PurchasedBy</div>
              <div class="profile-info-value">
                <span class="editable" id="username"><b><?php  echo $rst["FullName"]."-".$rst["CreatedBy"];?></b></span>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name">  TopupPhoneNo</div>
              <div class="profile-info-value">
                <span class="editable" id="username"><b><?php  echo $rst["TopUpPhoneNo"];?></b></span>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name">  TopupAmount</div>
              <div class="profile-info-value">
                <span class="editable" id="username"><b><?php  echo $rst["TopUpAmount"];?></b></span>
              </div>
            </div>

          </div><!-- End Profile Strip -->
        </div>  <!-- End Col -->



        <div class="col-xs-12 col-sm-6">
       <div class="profile-user-info profile-user-info-striped ">
        <div class="profile-info-row">
          <div class="profile-info-name">PaymentMethod</div>
          <div class="profile-info-value">
            <span class="editable" id="username"><b><?php  echo $rst["PaymentMethod"];?></b></span>
          </div>
        </div>

        <div class="profile-info-row">
          <div class="profile-info-name">MobileOperator</div>
          <div class="profile-info-value">
            <span class="editable" id="username"><b><?php  echo $rst["MobileOperator"]?></b></span>
          </div>
        </div>

        <div class="profile-info-row">
          <div class="profile-info-name">  TransID</div>
          <div class="profile-info-value">
            <span class="editable" id="username"><b><?php  echo $rst["TransID"];?></b></span>
          </div>
        </div>

        <div class="profile-info-row">
          <div class="profile-info-name">ErrorDescription</div>
          <div class="profile-info-value">
            <span class="editable" id="username"><b><?php  echo $rst["StatusDescription"];?></b></span>
          </div>
        </div>



      </div><!-- End Profile Strip -->
    </div>  <!-- End Col -->


      </div>  <!--  End Row   -->

          </div><!-- End Widget-Main -->
          <div class="widget-toolbox padding-8 clearfix text-center">
              <button type="button" name="btnCloseError" id="btnCloseError"  class='btn btn-sm btn-danger' ><i class='fa fa-edit'></i> Resolve </button>

                <button type="button" name="btnSendSMS" id="btnSendSMS"  class='btn btn-sm btn-success' ><i class='fa fa-send'></i> Send SMS </button>

                <button  type="button" name="btnCorrectNo" id="btnCorrectNo"  class='btn btn-sm btn-info' ><i class='fa fa-send'></i> Enter Correct PhoneNo</button>
          </div>
        </div><!-- End Widget-body -->

    </form>
</div><!-- End WidgetBox -->