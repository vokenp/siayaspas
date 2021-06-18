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
              <i class="ace-icon fa fa-comment smaller-80"></i>
                 Sent SMS List
            </h4>
            <div id="pageToolBar" class="widget-toolbar no-border">
            
               <a href="<?php echo $listUrl;?>" class="btn btn-xs btn-info  radius-4 bigger"> <i class="ace-icon fa fa-arrow-left bigger-80"></i> Back to List </a>

             </div>
          </div>
          <form name="frmPageTemp" id="frmPageTemp" class="form-horizontal" role="form">
          	<input type="hidden" name="ModCode" id="ModCode" value="<?php echo $mod;?>">
          	<input type="hidden" name="ReturnType" id="ReturnType" value="RstID">
            <?php echo $S_ROWID;?>
        <div class="widget-body">
           <div class="widget-main col-sm-offset-1">
            <div class="row">
			   	  <div class="col-xs-12 col-sm-10">
					 <h4 class="header blue bolder smaller">Message Info</h4>
					 <div class="profile-user-info profile-user-info-striped ">
						<div class="profile-info-row">
							<div class="profile-info-name">  Send Channel</div>
							<div class="profile-info-value">
								<span class="editable" id="username"><b><?php  echo $rst["SendChannel"];?></b></span>
							</div>
						</div>
					</div>

					 <div class="profile-user-info profile-user-info-striped ">
						<div class="profile-info-row">
							<div class="profile-info-name"> Message Type</div>
							<div class="profile-info-value">
								<span class="editable" id="username"><b><?php  echo $rst["MessageType"];?></b></span>
							</div>
						</div>
					</div> 

					<div class="profile-user-info profile-user-info-striped ">
						<div class="profile-info-row">
							<div class="profile-info-name"> Message Body</div>
							<div class="profile-info-value">
								<span class="editable" id="username"><b><?php  echo $rst["MessageBody"];?></b></span>
							</div>
						</div>
					</div>

					<div class="profile-user-info profile-user-info-striped ">
						<div class="profile-info-row">
							<div class="profile-info-name"> SendFrequency</div>
							<div class="profile-info-value">
								<span class="editable" id="username"><b>
									<?php  
								   if ($rst["SendFrequency"] == "ScheduleMessage") {
								   	   echo "Scheduled to be Sent on : ".date('D jS M Y',strtotime($rst["SendDate"]))." at ".$rst["SendTime"];
								   }
								   else
								   {
								   	echo "Urgent";
								   }

								?></b></span>
							</div>
						</div>
					</div>

					<div class="profile-user-info profile-user-info-striped ">
						<div class="profile-info-row">
							<div class="profile-info-name"> Message Created</div>
							<div class="profile-info-value">
								<span class="editable" id="username"><b><?php  echo date('D jS M Y g:i a',strtotime($rst["DateCreated"]))." by ".$rst["CreatedBy"];?></b></span>
							</div>
						</div>
					</div>
				 </div>
			</div>

			<div class="row">
			   	  <div class="col-xs-12 col-sm-10">
					 <h4 class="header blue bolder smaller">Distribution List</h4>

					 <table id="simple-table" class="table  table-bordered table-hover table-striped">
							<thead>
							<tr>
								<th>#</th>
								<th>Receiptient Name</th>
								<th>Phone</th>
								<th>Group Name</th>
								<th>Status</th>
								
							</tr>
						</thead>
						<tbody>
							<?php
							$html = "";
							   $i = 0;
								$getData = $db->Execute("select *from tbl_bulksms where ParentMsgID='$cid'");
								while (!$getData->EOF) {
									$i += 1;
									$rst = array();
									$rst = $getData->fields;
                                    
									$lbl = $rst["SMSStatus"] == "Pending" ? "label-warning" : "label-success";
									$html .="<tr>";
									$html .="<td>$i</td>";
									$html .="<td>".$rst["ReceiptientName"]."</td>";
									$html .="<td>".$rst["SMSTo"]."</td>";
									$html .="<td>".$rst["GroupCode"]."</td>";
									$html .="<td><span class='label label-sm $lbl'>".$rst["SMSStatus"]."</span></td>";
									$html .="</tr>";
									$getData->MoveNext();
								}
                               echo $html;
							?>

						</tbody>
					</table>
				  </div>
			</div>
        	 
          </div><!-- End Widget-Main -->
          <div class="widget-toolbox padding-8 clearfix text-center">
             
          </div>
        </div><!-- End Widget-body -->
         
    </form>
</div><!-- End WidgetBox -->