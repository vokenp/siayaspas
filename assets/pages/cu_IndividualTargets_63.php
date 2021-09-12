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
  $AppUserID = $rst["UserID"];
  $AppUserInfo = $rs->row("vw_userslist","loginid='$AppUserID'");
  $USectionID = $AppUserInfo["Section"] ;
  $UDeptID = $AppUserInfo["Department"] ;
     if ($USectionID !="") {
       $getSectionInfo = $rs->row("vw_sections","S_ROWID='$USectionID'");
       $DirectorateName = $getSectionInfo["DirectorateName"];
       $DepartmentName = $getSectionInfo["DepartmentName"];
       $SectionName = $getSectionInfo["SectionName"];
     }
     else {
       $getDeptInfo = $rs->row("vw_departments","S_ROWID='$UDeptID'");
       $DirectorateName = $getDeptInfo["DirectorateName"];
       $DepartmentName = $getDeptInfo["DepartmentName"];
       $SectionName = "";
     }
$S_ROWID = "<input type='hidden' name='S_ROWID' id='S_ROWID' value='$cid'>";
$btn = "<button type='submit' name='btnUpdateRecord' id='btnUpdateRecord' class='btn btn-sm btn-success' ><i class='fa fa-edit'></i> Update Record</button>";

  }

  ?>
<script type="text/javascript">
	$(document).ready(function(){
		var op = $("#op").val();
    dotoken();
    //Create New tblObjectives
    $("#frmNewObjectives").validate({
  debug: false,
  rules: {

  },
  messages: {

  },
  submitHandler: function(form) {
  // do other stuff for a valid form

     $.post('assets/bin/ManageRecords.php', $("#frmNewObjectives").serialize(), function(data) {

      if (data.length < 30)
      {
      $(".close").click();
      var frm = "#frmNewObjectives";
      $(frm)[0].reset();
      $(frm).trigger("reset");
      $(frm).find(":submit").prop('disabled', false);
      $(frm).find(":submit").html("<i class='fa fa-plus'></i> Create User");
      $(frm).data('submitted', false);
      $(frm).modal("hide");
       dotoken();
      $('#tblObjectives').DataTable().draw();
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

  // Update Objectives
  $("#frmUpdateObjectives").validate({
debug: false,
rules: {

},
messages: {

},
submitHandler: function(form) {
// do other stuff for a valid form

 $.post('assets/bin/ManageRecords.php', $("#frmUpdateObjectives").serialize(), function(data) {

  if (data.length < 30)
  {
  $(".close").click();
  var frm = "#frmUpdateObjectives";
  $(frm)[0].reset();
  $(frm).trigger("reset");
  $(frm).find(":submit").prop('disabled', false);
  $(frm).find(":submit").html("<i class='fa fa-edit'></i> Update Objective");
  $(frm).data('submitted', false);
  $(frm).modal("hide");
   dotoken();
  $('#tblObjectives').DataTable().draw();
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
   //Start TABLE
   var dataTableObjectives = $('#tblObjectives').DataTable({
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
         url :"assets/bin/getTargets.php", // json datasource
         type: "post",  // type of method  , by default would be get
        "data":function(data) {
         data.TargetID   = $('#S_ROWID').val();
         data.SourceType = $('#SourceType').val();
         },

         error: function(et){  // error handling code
           $("#tblObjectives_processing").css("display","none");
           alert(JSON.stringify(et));
         }
       }
 });
   //End Table

	});

  function DoEditRecord(RowID)
       {
       	var RowInfo = eval('(' + $("#row-"+RowID).attr('data-value') + ')');
       	$("#TargetDescription2").val(RowInfo.TargetDescription);
       	$("#S_ROWID2").val(RowInfo.S_ROWID);
       //	$("#ItemType2").trigger("chosen:updated");
        $("#UpdateObjectives").modal("show");
       }


       function doRemoveItem(RowID)
            {
                 bootbox.confirm({
                     centerVertical: true,
                 message: "Are you sure you want remove this Item?",
                 buttons: {
                   confirm: {
                    label: "Remove Item",
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
                       title: "Remove Objective",
                       centerVertical: true,
                  message: '<p class="text-center mb-0"><i class="fa fa-spin fa-cog bigger-240"></i> <h3>Please wait ...</h3></p>',
                  closeButton: false
                    });
         var postdata = $("#myForm").serializeArray();
         postdata.push({name: '_token', value: $("#_token").val()});
          postdata.push({name: 'ModCode', value: "67"});
         postdata.push({name: 'DeleteRecord', value: RowID});
         $.post("assets/bin/ManageRecords.php", postdata, function(data){

              dialog.modal('hide');
              $('#tblObjectives').DataTable().draw();
              dotoken();
                Swal.fire({
                     type: 'success',
                     title: 'Record Removed Successful',
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

<div class="widget-box">
          <div class="widget-header widget-header-flat">
            <h4 class="widget-title smaller">
              <i class="ace-icon fa fa-list smaller-80"></i>
                <?php echo $modName;?>
            </h4>
            <div id="pageToolBar" class="widget-toolbar no-border">
              <!-- <a href="<?php echo $addUrl; ?>" class="btn btn-xs btn-info  radius-4 bigger"> <i class="ace-icon fa fa-plus bigger-80"></i> Add New </a> -->
               <a href="<?php echo $listUrl;?>" class="btn btn-xs btn-info  radius-4 bigger"> <i class="ace-icon fa fa-arrow-left bigger-80"></i> Back to List </a>

             </div>
          </div>
          <form name="frmPageTemp" id="frmPageTemp" class="form-horizontal" role="form">
            <input type="hidden" name="SourceType" id="SourceType" value="Individual">
          	<input type="hidden" name="ModCode" id="ModCode" value="<?php echo $mod;?>">
          	<input type="hidden" name="ReturnType" id="ReturnType" value="RstID">
          	<input type="hidden" name="_token" id="_token" value="<?php echo  VToken::genT();?>" class="token">
            <?php echo $S_ROWID;?>
        <div class="widget-body">
           <div class="widget-main">

        	  <div class="row">
                 <div class="col-xs-12 col-sm-10">
                   <div class="profile-user-info profile-user-info-striped ">
                    <div class="profile-info-row">
                      <div class="profile-info-name"> Period Name</div>
                      <div class="profile-info-value">
                        <span class="editable" id="username"><b><?php  echo $rst["PeriodName"];?></b></span>
                      </div>
                    </div>
                  </div>

                  <div class="profile-user-info profile-user-info-striped ">
                   <div class="profile-info-row">
                     <div class="profile-info-name"> Appraisal Period</div>
                     <div class="profile-info-value">
                       <span class="editable" id="username"><?php  echo "<b>Starts : </b>".date('D jS M Y',strtotime($rst["PeriodBegins"]))."<br/><b> Ends: </b>".date('D jS M Y',strtotime($rst["PeriodEnds"]));?></span>
                     </div>
                   </div>
                 </div>

                 <div class="profile-user-info profile-user-info-striped ">
                  <div class="profile-info-row">
                    <div class="profile-info-name"> Appraisee Name</div>
                    <div class="profile-info-value">
                      <span class="editable" id="username"><b><?php  echo $rst["Appraisee"];?></b></span>
                    </div>
                  </div>
                </div>

                <div class="profile-user-info profile-user-info-striped ">
                 <div class="profile-info-row">
                   <div class="profile-info-name">Designation</div>
                   <div class="profile-info-value">
                     <span class="editable" id="username"><b><?php  echo $AppUserInfo["Position"];?></b></span>
                   </div>
                 </div>
               </div>

                <div class="profile-user-info profile-user-info-striped ">
                 <div class="profile-info-row">
                   <div class="profile-info-name">Directorate Name</div>
                   <div class="profile-info-value">
                     <span class="editable" id="username"><b><?php  echo $DirectorateName;?></b></span>
                   </div>
                 </div>
               </div>

               <div class="profile-user-info profile-user-info-striped ">
                <div class="profile-info-row">
                  <div class="profile-info-name">Department Name</div>
                  <div class="profile-info-value">
                    <span class="editable" id="username"><b><?php  echo $DepartmentName;?></b></span>
                  </div>
                </div>
              </div>

              <div class="profile-user-info profile-user-info-striped ">
               <div class="profile-info-row">
                 <div class="profile-info-name">Section Name</div>
                 <div class="profile-info-value">
                   <span class="editable" id="username"><b><?php  echo $SectionName;?></b></span>
                 </div>
               </div>
             </div>
                 </div>
			      </div>


          </div><!-- End Widget-Main -->
          </form>
          <div class="widget-toolbox padding-8 clearfix ">
              	<div class="space-8"></div>
                <?php include("IndividualTargets.php");?>
          </div>
        </div><!-- End Widget-body -->

</div><!-- End WidgetBox -->
