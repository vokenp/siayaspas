 <?php
$op = filter_input(INPUT_GET, "view");
//$db->debug=1;
  $TableName = "dh_users";
  if ($op == "add") {
    $S_ROWID = "";
    $cid = "";

    $btn = "<button type='submit' name='btnSaveRecord' id='btnSaveRecord' class='btn btn-sm btn-success' value='$TableName'><i class='fa fa-edit'></i> Save Record</button>";
    $getColumns = $db->metaColumnNames($TableName);
    foreach ($getColumns as $key => $value) {
       $rst[$value] = "";
    }
    $reqState = "required='true'";
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
$reqState = "readonly='true'";

  }

  ?>
<script type="text/javascript">
	$(document).ready(function(){

    $("#Department").change(function(){
        getSection();
    });

    var dateToday = new Date();
      $("#EffectDate").datepicker({
                    autoclose: true,
                    format: 'dd-mm-yyyy',
                    todayHighlight: true,
                    minDate : dateToday
                })

                .next().on(ace.click_event, function(){
                    $(this).prev().focus();
                });
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
					 location.reload();
					}
					else
					{
            Swal.fire(
                'Oops!',
                data,
                'error'
              );
          location.reload();

					}
				});
				}
				});
	});


  function getSection()
  {
    var DeptID  = $("#Department").val();
    var op  = $("#op").val();
   if (DeptID != "")
   {
      $("#Section").html("");
    $.post('assets/bin/ManageGroups.php', {getSection: ""+DeptID+"",op: ""+op+""},
        function(data) {
        $('#Section').empty(); //remove all child nodes
        $('#Section').append(data);
        $('#Section').trigger("chosen:updated");
        });

   }
  }
</script>
<input type="hidden" name="op" id="op" value="<?php echo $op;?>">
<input type="hidden" name="url" id="url" value="<?php echo full_path();?>">

<div class="widget-box">
          <div class="widget-header widget-header-flat">
            <h4 class="widget-title smaller">
              <i class="ace-icon fa fa-user smaller-80"></i>
                <?php echo "Manage Profile for ".$rst["Fullname"];?>
            </h4>
            <div id="pageToolBar" class="widget-toolbar no-border">

             </div>
          </div>
          <form name="frmPageTemp" id="frmPageTemp" class="form-horizontal" role="form">
          	<input type="hidden" name="ModCode" id="ModCode" value="<?php echo $mod;?>">
            <?php echo $S_ROWID;?>
      <input type="hidden" name="_token" id="_token" class="token" value="<?php echo VToken::gent();?>">
        <div class="widget-body">
           <div class="widget-main">

         	<h4 class="header blue bolder smaller col-sm-offset-1">User BioInfo</h4>
        	  <div class="row">
                 	<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="loginid"> LoginID </label>
						<div class="col-sm-8">
							<input type="text" id="loginid" name="loginid" placeholder="Enter LoginID" class="col-xs-11 col-sm-11" value="<?php echo $rst['loginid'];?>"  <?php echo $reqState;?> />
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
						<label class="col-sm-4 control-label " for="PhoneExt">PhoneExt </label>
						<div class="col-sm-8">
							<input type="text" id="PhoneExt" name="PhoneExt" placeholder="Enter PhoneExt" class="col-xs-11 col-sm-11" value="<?php echo $rst['PhoneExt'];?>"  required="false" />
						</div>
					</div>

          <div class="form-group col-sm-5">
          <label class="col-sm-4 control-label " for="user_type" >User Type </label>
          <div class="col-sm-8">
            <select id="user_type" name="user_type" required="true"  class="col-xs-11 col-sm-11 chosen-select">
              <?php echo $rs->GetListItems($rst["user_type"],"usertype",$op);?>
            </select>
          </div>
        </div>
			   </div>

         <h4 class="header blue bolder smaller col-sm-offset-1">User Job Info</h4>

         <div class="row">
           <div class="form-group col-sm-5">
             <label class="col-sm-4 control-label " for="Department"> Department</label>
             <div class="col-sm-8">
               <select name="Department" id="Department" placeholder="Enter Department " class="col-xs-10 col-sm-10 chosen-select" required="true">
                 <?php
                   $DepartmentID = $rst["Department"];
                   $where = " where 1=1 ";

                   if ($DepartmentID != "") {
                     $DepartmentName = $db->GetOne("select DepartmentName from tbl_departments where S_ROWID='$DepartmentID'");
                     echo "<option value='$DepartmentID'>$DepartmentName</option>";
                     $where .= " and S_ROWID<>'$DepartmentID'";
                   }
                   else
                   {
                     echo "<option value=''></option>";
                   }
                   $getData = $db->Execute("select S_ROWID,DepartmentName from tbl_departments $where");
                   while (!$getData->EOF) {
                     $DepartmentID = $getData->fields["S_ROWID"];
                     $DepartmentName = $getData->fields["DepartmentName"];
                     echo "<option value='$DepartmentID'>$DepartmentName</option>";
                     $getData->MoveNext();
                   }
                   ?>
               </select>
             </div>
           </div>


           <div class="form-group col-sm-5">
             <label class="col-sm-4 control-label " for="Section"> Section</label>
             <div class="col-sm-8">
               <select name="Section" id="Section" placeholder="Enter Section " class="col-xs-11 col-sm-11 chosen-select" required="true">
                  <?php
                  if ($op !="Add") {
                 $SectionID = $rst["Section"];
                 $DeptID = $rst["Department"];
                 $getSec = $rs->row("tbl_sections","S_ROWID='$SectionID'");
                 $SecID = $getSec["S_ROWID"];
                  $SecName = $getSec["SectionName"];
                   echo "<option value='$SecID'>$SecName</option>";
                $getData = $db->Execute("select * from tbl_sections where  DepartmentID= '$DeptID' and S_ROWID<>'$SectionID'");
                while (!$getData->EOF) {
                 $SectionID2 = $getData->fields["S_ROWID"];
                 $SectionName = $getData->fields["SectionName"];

                 echo "<option value='$SectionID2'>$SectionName</option>";
                 $getData->MoveNext();
                }
                  }
                  ?>
               </select>
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
						<label class="col-sm-4 control-label " for="TermsofService" >Terms of Service </label>
						<div class="col-sm-8">
							<select id="TermsofService" name="TermsofService" required="true"  class="col-xs-11 col-sm-11 chosen-select">
								<?php echo $rs->GetListItems($rst["TermsofService"],"TermsofService",$op);?>
							</select>
						</div>
					</div>
			   </div>

         <div class="row">
           <div class="form-group col-sm-5">
              <label class="col-sm-4 control-label " for="JobGroup"> Job Group/Scale </label>
                <div class="col-sm-8">
                  <input type="text" id="JobGroup" name="JobGroup" placeholder="Enter JobGroup" class="col-xs-11 col-sm-11" value="<?php echo $rst['JobGroup'];?>"  required="false" />
                </div>
              </div>

              <div class="form-group col-sm-5">
                 <label class="col-sm-4 control-label " for="EffectDate"> Effective Date </label>
                   <div class="col-sm-8">
                     <input type="text" id="EffectDate" name="EffectDate" placeholder="Enter EffectiveDate" class="col-xs-11 col-sm-11 DDate" value="<?php echo isdate($rst['EffectDate']);?>"  required="false" />
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
