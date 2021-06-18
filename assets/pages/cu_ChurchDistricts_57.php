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

    
      if (op != "add") 
      {
        $("#DistrictCode").attr("readonly",true);
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
                 	<div class="form-group col-sm-6">
						<label class="col-sm-4 control-label " for="DistrictCode"> District Code </label>
						<div class="col-sm-8">
							<input type="text" id="DistrictCode" name="DistrictCode" placeholder="Enter District Code" class="col-xs-12 col-sm-12" value="<?php echo $rst['DistrictCode'];?>"  required="true" />
						</div>
					</div>
		
			   </div>

         <div class="row">
            <div class="form-group col-sm-6">
            <label class="col-sm-4 control-label " for="DistrictName"> District Name </label>
            <div class="col-sm-8">
              <input type="text" id="DistrictName" name="DistrictName" placeholder="Enter DistrictName" class="col-xs-12 col-sm-12" value="<?php echo $rst['DistrictName'];?>"  required="true" />
            </div>
          </div>

          <div class="form-group col-sm-6">
            <label class="col-sm-4 control-label " for="DistrictLeader"> District Leader </label>
            <div class="col-sm-8">
              <select name="DistrictLeader" id="DistrictLeader" placeholder="Enter District Leader" class="col-xs-11 col-sm-11 chosen-select" required="true">
                <?php 
                  $DistrictLeader = $rst["DistrictLeader"];
                  $where = " where user_type = 'Deacon' ";

                  if ($DistrictLeader != "") {
                    $LeaderName = $db->GetOne("select Fullname from dh_users where loginid='$DistrictLeader'");
                    echo "<option value='$DistrictLeader'>$DistrictLeader - $LeaderName</option>";
                    $where .= " and loginid<>'$DistrictLeader'";
                  }
                  else
                  {
                    echo "<option value=''></option>";
                  }
                  $getData = $db->Execute("select loginid,Fullname from dh_users $where");
                  while (!$getData->EOF) {
                    $DistrictLeader = $getData->fields["loginid"];
                    $LeaderName = $getData->fields["Fullname"];
                    echo "<option value='$DistrictLeader'>$DistrictLeader - $LeaderName</option>";
                    $getData->MoveNext();
                  }
                  ?>
              </select>
            </div>
          </div>
         </div>

         <div class="row">
            <div class="form-group col-sm-6">
            <label class="col-sm-4 control-label " for="Deacon1"> Deacon1 </label>
            <div class="col-sm-8">
              <select name="Deacon1" id="Deacon1" placeholder="Enter Deacon Name" class="col-xs-11 col-sm-11 chosen-select" required="true">
                <?php 
                  $Deacon1 = $rst["Deacon1"];
                  $where = " where user_type = 'Deacon' ";
                 
                  if ($Deacon1 != "") {
                    $DeaconName1 = $db->GetOne("select Fullname from dh_users where loginid='$Deacon1'");
                    echo "<option value='$Deacon1'>$Deacon1 - $DeaconName1</option>";
                    $where .= " and loginid<>'$Deacon1'";
                  }
                  else
                  {
                    echo "<option value=''></option>";
                  }
                  $getData = $db->Execute("select loginid,Fullname from dh_users $where");
                  while (!$getData->EOF) {
                    $Deacon1 = $getData->fields["loginid"];
                    $DeaconName1 = $getData->fields["Fullname"];
                    echo "<option value='$Deacon1'>$Deacon1 - $DeaconName1</option>";
                    $getData->MoveNext();
                  }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group col-sm-6">
            <label class="col-sm-4 control-label " for="Deacon2"> Deacon2</label>
            <div class="col-sm-8">
             <select name="Deacon2" id="Deacon2" placeholder="Enter Deacon Name" class="col-xs-11 col-sm-11 chosen-select" required="true">
                <?php 
                $Deacon2 = $rst["Deacon2"];
                $where = " where user_type = 'Deacon' ";
               
                if ($Deacon2 != "") {
                  $DeaconName2 = $db->GetOne("select Fullname from dh_users where loginid='$Deacon2'");
                  echo "<option value='$Deacon2'>$Deacon2 - $DeaconName2</option>";
                  $where .= " and loginid<>'$Deacon2'";
                }
                else
                {
                  echo "<option value=''></option>";
                }
                $getData = $db->Execute("select loginid,Fullname from dh_users $where");
                while (!$getData->EOF) {
                  $Deacon2 = $getData->fields["loginid"];
                  $DeaconName2 = $getData->fields["Fullname"];
                  echo "<option value='$Deacon2'>$Deacon2 - $DeaconName2</option>";
                  $getData->MoveNext();
                }
              ?>
              </select>
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