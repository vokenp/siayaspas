<h4 class="header blue bolder smaller">Personal Particulars</h4>
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
    <span class="editable" id="username"><b><?php  echo $rst["HeadofDept"];?></b>

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
