 <?php
$op = filter_input(INPUT_GET, "view");
//$db->debug=1;

$TableName = "committeemeetings";
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
    $rst["MeetingDate"] = "";
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
  $rst["MeetingDate"] = $rst["MeetingDate"] != "" ? date('d-m-Y',strtotime($rst["MeetingDate"])) : "";
$S_ROWID = "<input type='hidden' name='S_ROWID' id='S_ROWID' value='$cid'>";
$btn = "<button type='submit' name='btnUpdateRecord' id='btnUpdateRecord' class='btn btn-sm btn-success' value='$TableName'><i class='fa fa-edit'></i> Update Record</button>";
   
  }
  
  ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#error_box').fadeOut(100);
		var op = $("#op").val();
		
        checkVenue();
		 $("#Venue").change(function(){
		 	checkVenue();
		 });


		  $("#frmAddNotification").validate({
                debug: false,
                rules: {
                
                },
                messages: {
                
                },
                submitHandler: function(form) {
                // do other stuff for a valid form
                //showLoader();
               
                $.post('assets/bin/ManageRecords.php', $("#frmAddNotification").serialize(), 
                function(data) {
                
                if(data.length < 30)
                {
                    
                  var frm = "#frmAddNotification";
                  $(frm).find(":submit").prop('disabled', false);
            $(frm).find(":submit").html("Save Notification"); 
            $(frm).data('submitted', false);
                  $(frm).trigger("reset");
          $('#modal-NewNotification').modal('hide');
          location.reload();

 
                }else
                {
                 alert(data);
                   /* $('#error_box').fadeIn(200);
                    $('#error_box').html(data);*/
                    
                    //hideLoader();
                }
                });
                }
                });  // End Form Submission

		 function checkVenue()
          {
          	var Venue = $("#Venue").val();
          	
		 	   if (Venue == "Other") 
		 	   {
		 	   	
		 	   	$("#divOtherVenue").show();
		 	   }
		 	   else
		 	   {
                $("#divOtherVenue").hide();
                $("#OtherVenue").val("");
		 	   }

          }

		function getAttendance(CommitteeID)
		{

			var MeetingID = $("#S_ROWID").val();
	     $.post('assets/bin/getAttendancelist.php', {CommitteeID: ""+CommitteeID+"",MeetingID:""+MeetingID+""}, 
				function(data) {
					$("#AttendanceTbl").html(data);
				});
		}

       if (op == "add") 
       {
       	$("#AttendanceDiv").hide();
       }
       else
       {
       	$("#AttendanceDiv").show();
       	getAttendance($("#CommitteeID").val());
       }


       var Posted = $("#Posted").val();
        if (Posted =="Yes") 
        {
        	$(":button").attr("disabled",true);
        	$(":input").attr("disabled",true);
        	$(":select").prop('disabled', 'disabled');
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
      var dateToday = new Date();
	    $("#MeetingDate").datepicker({
                    autoclose: true,
                    format: 'dd-mm-yyyy',
                    todayHighlight: true,
                    minDate : dateToday
                })
                
                .next().on(ace.click_event, function(){
                    $(this).prev().focus();
                }); 

		$('#FromTime,#ToTime').timepicker({
					minuteStep: 15,
					showSeconds: false,
					showMeridian: true,
					disableFocus: true,
					icons: {
						up: 'fa fa-chevron-up',
						down: 'fa fa-chevron-down'
					}
				}).on('focus', function() {
					$('#FromTime,#ToTime').timepicker('showWidget');
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});		

	   $("#btnUpdateAtt").click(function(){
	   	var tbl = "iko";
	   	   var postdata = $("#frmAttendance").serializeArray();
	   	     postdata.push({name: 'btnUpdateAtt', value: tbl});
	   	   $.post('assets/bin/ManageAttendance.php',postdata, 
				function(data) {
					 if (data.length > 10 ) 
					 {
					 $('#error_box').fadeIn(200);
                     $('#error_box').html(data);
					 }
					 else
					 {
					 	$('#error_box').fadeOut(100);
                    $('#error_box').html("");
					 }
				});
	   });


	    $("#btnPostAtt").click(function(){
	   	var tbl = "iko";
	   	     bootbox.confirm({
	   	     title: "Post Meeting Attendance",
            message: "<b>Are you sure you want to Post these Meeting Attendance ?<br/>NB: You shall not be able make any other changes after this Action?</b>",
            buttons: {
              confirm: {
               label: "Post Attendance",
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
     		 var postdata = $("#frmAttendance").serializeArray();
	   	     postdata.push({name: 'btnPostAtt', value: tbl});
	   	   $.post('assets/bin/ManageAttendance.php',postdata, 
				function(data) {
					location.reload();
				});

              }
            }
            });
	   	   
	   });


	});

	function DoCheckBox(PersonnelNo)
	{
		if($("#IsPresentChbx"+PersonnelNo).is(":checked")) {
			   $("#IsPresent-"+PersonnelNo).val("Y");
			}
			else {
				$("#IsPresent-"+PersonnelNo).val("N");
			}
	}
</script>
<input type="hidden" name="op" id="op" value="<?php echo $op;?>">
<input type="hidden" name="url" id="url" value="<?php echo full_path();?>">
<input type="hidden" name="Posted" id="Posted" value="<?php echo $rst["Posted"];?>" >
<div class="col-xs-12">
	<div class="widget-box">
          <div class="widget-header widget-header-flat">
            <h4 class="widget-title smaller">
              <i class="ace-icon fa fa-list smaller-80"></i>
                <?php echo $modName;?>  
            </h4>
            <div id="pageToolBar" class="widget-toolbar no-border">
                 <a href="<?php echo $addUrl; ?>" class="btn btn-xs btn-info  radius-4 bigger"> <i class="ace-icon fa fa-plus bigger-80"></i> Add New </a>
               <a href="<?php echo $listUrl;?>" class="btn btn-xs btn-info  radius-4 bigger"> <i class="ace-icon fa fa-arrow-left bigger-80"></i> Back to List </a>
               <?php 
               	  if ($op != "add" && $rst["Posted"] !="Yes") {
               	  	echo "<a href='#' data-toggle='modal' data-target='#modal-NewNotification' class='btn btn-xs btn-success  radius-4 bigger'> <i class='ace-icon fa fa-bullhorn bigger-80'></i> Notifications </a>";
               	  }
               ?>
             </div>
          </div>
          <form name="frmPageTemp" id="frmPageTemp" class="form-horizontal" role="form">
          	<input type="hidden" name="ModCode" id="ModCode" value="<?php echo $mod;?>">
          	<input type="hidden" name="ReturnType" id="ReturnType" value="RstID">
            <?php echo $S_ROWID;?>
        <div class="widget-body">
           <div class="widget-main">

        	  <div class="row">
        	  	  <div class="form-group col-sm-10">
						<label class="col-sm-4 control-label " for="Agenda"> Agenda </label>
						<div class="col-sm-8">
						  <textarea id="Agenda" name="Agenda" placeholder="Enter Meeting Agenda" class="col-xs-12 col-sm-12" rows="4" required="true"><?php echo $rst["Agenda"];?></textarea>
						</div>
					</div>

	
			   </div>



			    <div class="row">
			      <div class="form-group col-sm-6">
			   		<label class="col-sm-4 control-label" for="MeetingDateTime">Meeting Date</label>
			   		<div class="col-sm-8">
					<div class="input-group">
						<input id="MeetingDate" name="MeetingDate" required="true" type="text" class="form-control" value="<?php echo $rst["MeetingDate"];?>" />
						<span class="input-group-addon">
							<i class="fa fa-clock-o bigger-110"></i>
						</span>
					</div>
				</div>
			   	</div>
			   	   
			   		<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="CommitteeID"> Committee Name </label>
						<div class="col-sm-8">
							<select name="CommitteeID" id="CommitteeID" class="chosen-select" class="col-xs-12 col-sm-12" style="width:100%;">
								<?php 
								  $CommitteeID = $rst["CommitteeID"];
								  $where = " where 1=1 ";
								  $where .= $userType == "Admin" ? "" : " and ClerkResponsible='$user'";
								  if ($CommitteeID != "") {
								  	$CommitteeName = $db->GetOne("select CommitteeName from assemblycommittees where S_ROWID='$CommitteeID'");
								  	echo "<option value='$CommitteeID'>$CommitteeName</option>";
								  	$where .= " and S_ROWID<>'$CommitteeID'";
								  }
								  else
								  {
								  	echo "<option value=''></option>";
								  }
                                  $getData = $db->Execute("select S_ROWID,CommitteeName from assemblycommittees $where");
                                  while (!$getData->EOF) {
                                  	$CommitteeID = $getData->fields["S_ROWID"];
                                  	$CommitteeName = $getData->fields["CommitteeName"];
                                  	echo "<option value='$CommitteeID'>$CommitteeName</option>";
                                  	$getData->MoveNext();
                                  }
								?>
							</select>
						</div>
					</div>

			   </div>

			    <div class="row">
                 	<div class="form-group col-sm-6">
						<label class="col-sm-4 control-label pull-left" for="FromTime"> From Time </label>
						<div class="col-sm-8 input-group bootstrap-timepicker">
							<input type="text" id="FromTime" name="FromTime" class="col-xs-12 col-sm-12"  value="<?php echo $rst["FromTime"];?>">
							<span class="input-group-addon">
									<i class="fa fa-clock-o bigger-110"></i>
							</span>

						</div>
					</div>
					<div class="form-group col-sm-6">
						<label class="col-sm-4 control-label " for="ToTime"> To Time </label>
						<div class="col-sm-8 input-group bootstrap-timepicker">
						  <input type="text" id="ToTime" name="ToTime"  class="col-xs-12 col-sm-12" value="<?php echo $rst["ToTime"];?>">
						  <span class="input-group-addon">
									<i class="fa fa-clock-o bigger-110"></i>
							</span>
						</div>
					</div>
			   </div>

			   <div class="row">
			   	<div class="form-group col-sm-6">
						<label class="col-sm-4 control-label " for="Venue"> Venue </label>
						<div class="col-sm-8">
						  <select id="Venue" name="Venue" placeholder="Enter Venue" class="col-xs-12 col-sm-12 chosen-select">
						  	<?php echo $rs->GetListItems($rst["Venue"],"MeetingVenue",$op);?>
						  </select>
						</div>
					</div>

			   <div class="form-group col-sm-6" id="divOtherVenue">
						<label class="col-sm-4 control-label " for="OtherVenue"> Other Venue </label>
						<div class="col-sm-8">
						  <input type="text" name="OtherVenue" id="OtherVenue" class="col-xs-12 col-sm-12" required="true" value="<?php echo $rst["OtherVenue"];?>" placeholder="Enter Other Venue">
						</div>
					</div>

					
			   </div>


          </div><!-- End Widget-Main -->
          <div class="widget-toolbox padding-8 clearfix text-center ">
               <?php echo $btn; ?>
          </div>
        </div><!-- End Widget-body -->
         
    </form>
</div><!-- End WidgetBox -->
</div> <!-- end col-xs-12 -->

<div id="AttendanceDiv" class="col-xs-12">
	<div id="divresp"></div>
		<div class="widget-box widget-color-pink">
          <div class="widget-header widget-header-flat">
            <h4 class="widget-title smaller">
              <i class="ace-icon fa fa-check-square-o smaller-80"></i>
                Meeting Attendance
            </h4>
            <div id="AttToolBar" class="widget-toolbar no-border">
              <button type="button" name="btnUpdateAtt" id="btnUpdateAtt" class="btn btn-xs btn-success bigger">
				<i class="ace-icon fa fa-edit"></i><b>Update Attendance</b></button>
             <button type="button" name="btnPostAtt" id="btnPostAtt" class="btn btn-xs btn-dark  radius-4 bigger">
				<i class="ace-icon fa fa-external-link"></i><b>Post Attendance</b></button>
             </div>
          </div>
          <div class="widget-body">
          	<div id='error_box'></div>
          	
          <form name="frmAttendance" id="frmAttendance">
          	<input type="hidden" name="AttCommitteeID" id="AttCommitteeID" value="<?php echo $rst["CommitteeID"];?>">
          	<input type="hidden" name="MeetingID" id="MeetingID" value="<?php echo $rst["S_ROWID"];?>">
            <div  id="AttendanceTbl" class="widget-main">
             
            </div>
           	</form>
           <!-- end-widget Main-->
        </div><!-- widgetBody -->
	</div>
</div>


<div class="modal fade" id="modal-NewNotification">
          <div class="modal-dialog modal-md">
            <div class="modal-content">
              <div class="modal-header bg-navy">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create New Notification</h4>
              </div>
               <form name="frmAddNotification" id="frmAddNotification" class="form-horizontal" role="form">
              <div class="modal-body" >

                 <div class="form-group">
            <label class="col-sm-4 control-label " for="NType"> Notification Type </label>
            <div class="col-sm-8">
              <select name="NType" id="NType"  class="col-xs-10 col-sm-10" style="width:100%;" required="true">
                <?php echo $rs->GetListItems("Committee Meeting","NotificationType","edit");?>
              </select>
            </div>
          </div>

              
         <input type="hidden" name="CommitteeID" id="CommitteeID2" value="<?php echo $rst["CommitteeID"];?>">
         <input type="hidden" name="MeetingID" id="MeetingID" value="<?php echo $cid;?>">
          

            <div class="form-group">
            <label class="col-sm-4 control-label " for="NBody">Notification </label>
            <div class="col-sm-8">
              <textarea name="NBody" id="NBody" rows="5" class="col-xs-10 col-sm-10" required="true"><?php echo "There shall be a Meeting on ".date('D jS M Y',strtotime($rst["MeetingDate"]))." between ".date('g:i a',strtotime($rst["FromTime"]))." and ".date('g:i a',strtotime($rst["ToTime"]))." for $CommitteeName  at ".$rst["Venue"]." the agenda Will be ".$rst["Agenda"];?></textarea>
            </div>
          </div>

              </div><!-- ModalBody -->
              <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default " data-dismiss="modal">Close</button>
                 <button type="submit" id="btnSaveNotifications" name="btnSaveNotifications"  class="btn btn-sm btn-success pull-left"> Save  Notification
          <i class="ace-icon fa fa-plus icon-on-right bigger-110"></i>
        </button>
              </div>
                </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
