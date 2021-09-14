<script type="text/javascript">

	$(document).ready(function(){
    $("#frmChangeSuper").validate({
  debug: false,
  rules: {

  },
  messages: {

  },
  submitHandler: function(form) {
  // do other stuff for a valid form
  $.post('assets/bin/ManageRecords.php', $("#frmChangeSuper").serialize(), function(data) {

    if (data.length < 15)
{
$(".close").click();
var frm = "#frmChangeSuper";
$(frm)[0].reset();
$(frm).trigger("reset");
$(frm).find(":submit").prop('disabled', false);
$(frm).find(":submit").html("<i class='fa fa-send'></i> Change Supervisor");
$(frm).data('submitted', false);
$(frm).modal("hide");
Swal.fire({
        type: 'success',
        title: 'Save Successful',
        showConfirmButton: false,
        timer: 1500
        });
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
  </script>
<div>
  <h3 class="header smaller lighter blue">Section 1 : PERSONAL PARTICULARS</h3>
  <div class="alert alert-info">
			This Section should be completed by the Appraisee
	</div>

  <div class="row">
    <div class="col-xs-12 col-sm-6">
   <div class="profile-user-info profile-user-info-striped ">
    <div class="profile-info-row">
      <div class="profile-info-name">Appraisee PFN0</div>
      <div class="profile-info-value">
        <span class="editable" id="username"><b><?php  echo $rst["AppraiseeUserID"];?></b></span>
      </div>
    </div>

    <div class="profile-info-row">
      <div class="profile-info-name"> FullName</div>
      <div class="profile-info-value">
        <span class="editable" id="username"><b><?php  echo $rst["Fullname"];?></b></span>
      </div>
    </div>

    <div class="profile-info-row">
      <div class="profile-info-name">  PhoneNo</div>
      <div class="profile-info-value">
        <span class="editable" id="username"><b><?php  echo $rst["Phone"];?></b></span>
      </div>
    </div>

    <div class="profile-info-row">
      <div class="profile-info-name">  Email</div>
      <div class="profile-info-value">
        <span class="editable" id="username"><b><?php  echo $rst["Email"];?></b></span>
      </div>
    </div>

    <div class="profile-info-row">
      <div class="profile-info-name"> Designation</div>
      <div class="profile-info-value">
        <span class="editable" id="username"><b><?php  echo $rst["Position"];?></b></span>
      </div>
    </div>

  </div><!-- End Profile Strip -->
</div>  <!-- End Col -->


<div class="col-xs-12 col-sm-6">
<div class="profile-user-info profile-user-info-striped ">
<div class="profile-info-row">
  <div class="profile-info-name">AppraisalPeriod</div>
  <div class="profile-info-value">
    <span class="editable" id="username"><b><?php  echo $rst["PeriodName"];?></b></span>
  </div>
</div>

<div class="profile-info-row">
  <div class="profile-info-name"> Period Begins</div>
  <div class="profile-info-value">
    <span class="editable" id="username"><b><?php  echo date('D jS M Y',strtotime($rst["PeriodBegins"]));?></b></span>
  </div>
</div>

<div class="profile-info-row">
  <div class="profile-info-name">  Period Ends</div>
  <div class="profile-info-value">
    <span class="editable" id="username"><b><?php  echo date('D jS M Y',strtotime($rst["PeriodEnds"]));?></b></span>
  </div>
</div>

<div class="profile-info-row">
  <div class="profile-info-name"> Supervisor</div>
  <div class="profile-info-value">
    <span class="editable" id="username"><b><?php  echo $rst["SupervisorName"];?></b>
    <a href="#ChangeSupv" data-toggle="modal" class="pull-right" title="Change Supervisor"> <i class="ace-icon fa fa-edit blue fa-md"></i> Change Supervisor</a></span>
  </div>
</div>

<div class="profile-info-row">
  <div class="profile-info-name"> Designation</div>
  <div class="profile-info-value">
    <span class="editable" id="username"><b><?php  echo $rst["Position"];?></b></span>
  </div>
</div>

</div><!-- End Profile Strip -->
</div>  <!-- End Col -->
</div> <!-- End Row-->
</div>


<div id="ChangeSupv" class="modal fade" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 id="Colh3" class="smaller lighter blue no-margin">Change Supervisor </h3>
        </div>
        <form name="frmChangeSuper" id="frmChangeSuper" class="form-horizontal" role="form">
        <div class="modal-body">

          <div id="colAlert"></div>
          <input type="hidden" name="_token" id="_token" value="<?php echo $token; ?>" class="token">
          <input type="hidden" name="ModCode" id="ModCode" value="<?php echo $mod;?>">
          <input type="hidden" name="S_ROWID" id="S_ROWID" value="<?php echo $cid;?>">
          <input type="hidden" name="ReturnType" id="ReturnType" value="RstID">


   <div class="row">
     <div class="form-group col-sm-10">
      <label class="col-sm-4 control-label " for="UserID" >Select Supervisor </label>
      <div class="col-sm-8">
        <select id="SupervisorUserID" name="SupervisorUserID" required="true"   class="col-xs-12 col-sm-12 chosen-select">
          <?php
          $curSupervisor = $rst["SupervisorUserID"];
              $getUsers = $db->GetArray("select *from vw_userslist where loginid<>'$user' and User_type in ('HeadofDepartments') and loginid<>'$curSupervisor' order by S_ROWID desc");
               echo "<option value=''></option>";
              foreach ($getUsers as $ukey => $uval) {
                $UserID = $uval["loginid"];
                $FullName = $uval["Fullname"];
                echo "<option value='$UserID'>$FullName</option>";
              }
          ?>
        </select>
      </div>
    </div>
  </div>

        </div><!-- End ModalBody -->
  <div class="modal-footer">
  <button type="submit" id="btnUpdateRecord" name="btnUpdateRecord"  class="btn btn-sm btn-success">
          Change Supervisor
          <i class="ace-icon fa fa-plus icon-on-right bigger-110"></i>
        </button>
          </div>
        </form>
      </div><!-- Modal-content -->
    </div><!-- Modal-Dialog -->
   </div><!-- Modal-Div -->
