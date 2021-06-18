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

    var dateToday = new Date();
      $("#DOB,#DateofBaptism,#DateofConfirmation").datepicker({
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
                 	<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="MemberNo"> MemberNo </label>
						<div class="col-sm-8">
							<input type="text" id="MemberNo" name="MemberNo" placeholder="Enter" class="col-xs-12 col-sm-12" value="<?php echo $rst['MemberNo'];?>"  readonly="true" />
						</div>
					</div>
					<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="MemberName"> Member Name </label>
						<div class="col-sm-8">
							<input type="text" id="MemberName" name="MemberName" placeholder="Enter MemberName" class="col-xs-11 col-sm-11" value="<?php echo $rst['MemberName'];?>"  required="true" />
						</div>
					</div>
			   </div>

          <div class="row">
                  <div class="form-group col-sm-5">
            <label class="col-sm-4 control-label " for="MobileNo"> MobileNo </label>
            <div class="col-sm-8">
              <input type="text" id="MobileNo" name="MobileNo" placeholder="Enter MobileNo" class="col-xs-12 col-sm-12 mask-phoneNo" value="<?php echo $rst['MobileNo'];?>"  required="true" />
            </div>
          </div>
          <div class="form-group col-sm-5">
            <label class="col-sm-4 control-label " for="Email"> Email </label>
            <div class="col-sm-8">
              <input type="email" id="Email" name="Email" placeholder="Enter Email" class="col-xs-11 col-sm-11" value="<?php echo $rst['Email'];?>"   />
            </div>
          </div>
         </div>


         <div class="row">
          <div class="form-group col-sm-5">
            <label class="col-sm-4 control-label " for="Gender"> Gender </label>
            <div class="col-sm-8">
              <select id="Gender" name="Gender" placeholder="Enter Gender" class="col-xs-11 col-sm-11 chosen-select" required="true">
                <?php echo $rs->GetListItems($rst["Gender"],"Gender",$op);?>
              </select>
            </div>
          </div>

        <div class="form-group col-sm-5">
            <label class="col-sm-4 control-label " for="MaritalStatus"> Marital Status </label>
            <div class="col-sm-8">
              <select id="MaritalStatus" name="MaritalStatus" placeholder="Enter MaritalStatus" class="col-xs-11 col-sm-11 chosen-select">
                <?php echo $rs->GetListItems($rst["MaritalStatus"],"MaritalStatus",$op);?>
              </select>
            </div>
          </div>

         </div>


           <div class="row">
                  <div class="form-group col-sm-5">
            <label class="col-sm-4 control-label " for="DOB"> Date of Birth </label>
            <div class="col-sm-8">
              <input type="text" id="DOB" name="DOB" placeholder="Enter Date of Birth" class="col-xs-12 col-sm-12" value="<?php echo isdate($rst['DOB']);?>"   />
            </div>
          </div>
          <div class="form-group col-sm-5">
            <label class="col-sm-4 control-label " for="SpouseName">Spouse Name  </label>
            <div class="col-sm-8">
              <input type="text" id="SpouseName" name="SpouseName" placeholder="Enter Spouse Name" class="col-xs-11 col-sm-11" value="<?php echo $rst['SpouseName'];?>"  />
            </div>
          </div>
         </div>


           <div class="row">
          <div class="form-group col-sm-5">
            <label class="col-sm-4 control-label " for="District"> District </label>
            <div class="col-sm-8">
              <select id="District" name="District" placeholder="Enter District" class="col-xs-11 col-sm-11 chosen-select" required="true">
                <?php
                  $DistrictID = $rst["District"];
                  $where = " where 1=1 ";
                   $userType = $UserInfo["user_type"];
                  if($userType == "Deacon")
                  {
                    $where .= "  and DistrictCode in (select DistrictCode from tbl_districts where MATCH(DistrictLeader,Deacon1,Deacon1) AGAINST ('$user' IN BOOLEAN MODE))";
                  }

                  if ($DistrictID != "") {
                    $DistrictName = $db->GetOne("select DistrictName from tbl_districts where DistrictCode='$DistrictID'");
                    echo "<option value='$DistrictID'>$DistrictID - $DistrictName</option>";
                    $where .= " and DistrictCode<>'$DistrictID'";
                  }
                  else
                  {
                    echo "<option value=''></option>";
                  }
                  $getData = $db->Execute("select DistrictCode,DistrictName from tbl_districts $where");
                  while (!$getData->EOF) {
                    $DistrictID = $getData->fields["DistrictCode"];
                    $DistrictName = $getData->fields["DistrictName"];
                    echo "<option value='$DistrictID'>$DistrictID - $DistrictName</option>";
                    $getData->MoveNext();
                  }
                ?>
              </select>

            </div>
          </div>

        <div class="form-group col-sm-5">
            <label class="col-sm-4 control-label " for="ChurchRole"> Church Role</label>
            <div class="col-sm-8">
              <select id="ChurchRole" name="ChurchRole" placeholder="Enter Church Role" class="col-xs-11 col-sm-11 chosen-select">
                <?php echo $rs->GetListItems($rst["ChurchRole"],"ChurchRole",$op);?>
              </select>
            </div>
          </div>

         </div>

         <div class="row">
          <div class="form-group col-sm-5">
            <label class="col-sm-4 control-label " for="DateofBaptism"> Date of Baptism</label>
            <div class="col-sm-8">
              <input type="text" id="DateofBaptism" name="DateofBaptism" placeholder="Enter Date of Baptism" class="col-xs-12 col-sm-12" value="<?php echo isdate($rst['DateofBaptism']);?>"   />
            </div>
          </div>

           <div class="form-group col-sm-5">
            <label class="col-sm-4 control-label " for="Date of Confirmation"> Date of Confirmation </label>
            <div class="col-sm-8">
              <input type="text" id="DateofConfirmation" name="DateofConfirmation" placeholder="Enter Date of Confirmation" class="col-xs-12 col-sm-12" value="<?php echo isdate($rst['DateofConfirmation']);?>"   />
            </div>
          </div>

        </div>

         <div class="row">
          <div class="form-group col-sm-5">
            <label class="col-sm-4 control-label " for="HolyComNo"> HolyComNo</label>
            <div class="col-sm-8">
              <input type="text" id="HolyComNo" name="HolyComNo" placeholder="Enter Holy Communion No" class="col-xs-12 col-sm-12" value="<?php echo $rst['HolyComNo'];?>"   />
            </div>
          </div>

           <div class="form-group col-sm-5">
            <label class="col-sm-4 control-label " for="Profession"> Profession </label>
            <div class="col-sm-8">
              <input type="text" id="Profession" name="Profession" placeholder="Enter Profession" class="col-xs-12 col-sm-12" value="<?php echo $rst['Profession'];?>"   />
            </div>
          </div>

        </div>

        <div class="row">
          <div class="form-group col-sm-5">
            <label class="col-sm-4 control-label " for="ChurchGroup"> Church Group</label>
            <div class="col-sm-8">

              <select id="ChurchGroups" name="ChurchGroups[]" placeholder="Enter Church Group" class="col-xs-11 col-sm-11 chosen-select" multiple="true">
                <?php
             $MemID = $rst['S_ROWID'];
             $ChurchGroups = explode(',', $rst["ChurchGroups"]);
             $getData = $db->Execute("select ItemCode,ItemDescription from listitems where ItemType='ChurchGroups' ");
             while (!$getData->EOF) {
              $ItemCode = $getData->fields["ItemCode"];
              $ItemDescription = $getData->fields["ItemDescription"];
              $selected = in_array($ItemCode,$ChurchGroups) ? "selected" : "";
              echo "<option value='$ItemCode' $selected>$ItemDescription</option>";
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
