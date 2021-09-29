<?php
$AppraisalID = $rst["S_ROWID"];
$UserType = $rst["user_type"];
$Section3  = $db->GetOne("select round(sum(PA_Ratings),2) as PA_Ratings from tbl_section3 where AppraisalID=$AppraisalID");
$Section5a = $db->GetOne("select round(sum(SR_ScoreValue),2) as SR_ScoreValue from tbl_section5a where AppraisalID=$AppraisalID");

$S3Score = $Section3 * 0.7;
$S5aScore = $Section5a * 0.5;
$S10ATotal = $S3Score + $S5aScore;


  $Section5b = 0;
  $S5bScore = 0;
  $S3BScore = 0;
  $S5abScore = 0;
  $S10BTotal = 0;
  $Section3b = 0;
  $Section5ab = 0;
   if($UserType == "HeadofDepartments")
   {
     $Section3b = $Section3;
     $Section5ab = $Section5a;
     $Section5b = $db->GetOne("select round(sum(SR_ScoreValue),2) as SR_ScoreValue from tbl_section5b where AppraisalID=$AppraisalID");
     $S5bScore = $Section5b * 0.5;
     $S3BScore = $Section3 * 0.5;
     $S5abScore = $Section5ab * 0.5;
     $S10BTotal = $S3BScore + $S5abScore + $S5bScore;
   }
?>
<div>
  <div id="Results"></div>
  <h3 class="header smaller lighter blue">Section 10 : OVERALL RATING</h3>

</div>

<div class="row">
  <div id="ValueOptions" class="col-xs-12">
  	<div class="row">
  		<div class="col-xs-12">
  			<div class="widget-box">
  		  <div class="widget-body">
  		  <form name="frmValueOptions" id="frmValueOptions">
  		  	<?php echo $S_ROWID;?>
  		  	  <div class="widget-toolbox padding-8 clearfix text-right">
              Ratings
            </div>
          <div class="widget-main">
            <table id="tableSearchResults" class="table table-bordered table-striped">
              <caption><h3 >A. STAFF WITHOUT SUPERVISORY ROLES</h3></caption>
            <thead>
              <tr>
                <th>Section 3</th>
                <th>Section 5A</th>
                <th>Score</th>
            </thead>
            <tbody>
              <tr>
                  <td><h4><?php echo "PA Ratings Score : ".$Section3." x 0.7 = ".$S3Score;?></h4></td>
                  <td><h4><?php echo "Score : ".$Section5a." x 0.5 = ".$S5aScore;?></h4></td>
                  <td><h4><?php echo "Total Score : ".$S10ATotal." % ";?></h4></td>
              </tr>
            </tbody>

            </table>


            <table id="tableSearchResults" class="table table-bordered table-striped">
              <caption><h3>B. STAFF WITH SUPERVISORY ROLES</h3></caption>
            <thead>
              <tr>
                <th>Section 3</th>
                <th>Section 5A</th>
                <th>Section 5B</th>
                <th>Score</th>
            </thead>
            <tbody>
              <tr>
                  <td><h4><?php echo "PA Ratings Score : ".$Section3b." x 0.5 = ".$S3BScore;?></h4></td>
                  <td><h4><?php echo "Score : ".$Section5ab." x 0.5 = ".$S5abScore;?></h4></td>
                  <td><h4><?php echo "Score : ".$Section5b." x 0.5 = ".$S5bScore;?></h4></td>
                  <td><h4><?php echo "Total Score : ".$S10BTotal." % ";?></h4></td>
              </tr>
            </tbody>

            </table>

</div> <!-- WidgetMain -->

</div> <!-- Widget-Body -->

</div> <!-- Widget-Box -->

</div> <!-- col-xs-12 -->
</div> <!-- Row -->

</div> <!-- ValueOptions -->

</div> <!-- Row -->
