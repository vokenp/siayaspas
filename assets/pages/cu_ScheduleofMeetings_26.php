 <?php
$op = filter_input(INPUT_GET, "view");
//$db->debug=1;
     $TableName = "scheduleofmeetings";
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
		 
          
		 checkVenue();
		 $("#Venue").change(function(){
		 	checkVenue();
		 });

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
              <a href="<?php echo $addUrl; ?>" class="btn btn-xs btn-info  radius-4 bigger"> <i class="ace-icon fa fa-plus bigger-80"></i> Add New </a>
               <a href="<?php echo $listUrl;?>" class="btn btn-xs btn-info  radius-4 bigger"> <i class="ace-icon fa fa-arrow-left bigger-80"></i> Back to List </a>

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
						<label class="col-sm-4 control-label " for="MeetingDay"> Day of Meeting </label>
						<div class="col-sm-8">
							<select id="MeetingDay" name="MeetingDay"  class="col-xs-11 col-sm-11 chosen-select" required="true">
						  	<?php echo $rs->GetListItems($rst["MeetingDay"],"WeekDays",$op,"S_ROWID");?>
						  </select>
						</div>
					</div>
					<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="CommitteeID"> Committee </label>
						<div class="col-sm-8">
							<select  id="CommitteeID" name="CommitteeID"  class="col-xs-11 col-sm-11 chosen-select" required="true">
								<?php 
								$CommitteeID = $rst["CommitteeID"];
								$getComName = $db->GetOne("select CommitteeName from assemblycommittees where S_ROWID='$CommitteeID'");
								
								  $where = $userType == "Admin" ? "" : " and ClerkResponsible='$user'";
								echo "<option value='$CommitteeID'>$getComName</option>";
								$getList = $db->Execute("select *from assemblycommittees where S_ROWID<>'$CommitteeID' $where");
								while (!$getList->EOF) {
									$CommitteeID = $getList->fields["S_ROWID"];
									$CommitteeName = $getList->fields["CommitteeName"];
									echo "<option value='$CommitteeID'>$CommitteeName</option>";
									$getList->MoveNext();
								}
								?>
							</select>
						</div>
					</div>
					
			   </div>

			    <div class="row">
                 	<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="FromTime"> From Time </label>
						<div class="col-sm-8 input-group bootstrap-timepicker">
							<input type="text" id="FromTime" name="FromTime"  class="col-xs-11 col-sm-12" value="<?php echo $rst["FromTime"];?>">
							<span class="input-group-addon">
									<i class="fa fa-clock-o bigger-110"></i>
							</span>

						</div>
					</div>
					<div class="form-group col-sm-5">
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
                 	<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="Venue"> Venue </label>
						<div class="col-sm-8">
						  <select id="Venue" name="Venue" placeholder="Enter Venue" class="col-xs-12 col-sm-12 chosen-select" required="true">
						  	<?php echo $rs->GetListItems($rst["Venue"],"MeetingVenue",$op);?>
						  </select>
						</div>
					</div>

					<div class="form-group col-sm-5" id="divOtherVenue">
						<label class="col-sm-4 control-label " for="OtherVenue"> Other Venue </label>
						<div class="col-sm-8" >
						  <input type="text" name="OtherVenue" id="OtherVenue" class="col-xs-12 col-sm-12" required="true" value="<?php echo $rst["OtherVenue"];?>" placeholder="Enter Other Venue">
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