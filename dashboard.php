

<div class="page-header">
<h1>
  Dashboard
  <small>
    <i class="ace-icon fa fa-angle-double-right"></i></small>

</h1>

</div><!-- /.page-header -->
<div class="page-content">
<div class="row">

  <div class="col-sm-5">

      <div class="widget-box">
      <div class="widget-header widget-header-flat widget-header-small">
        <h5 class="widget-title">
          <i class="ace-icon fa fa-signal"></i>
          Appraisal Status
        </h5>
      </div><!-- End Widget-header -->
            <div class="widget-body">
         <div class="widget-main">
           <table id="tableSearchResults" class="table table-bordered table-striped">
           <thead>
             <tr>
               <th>#</th>
               <th>Appraisal</th>
               <th>Supervisor</th>
               <th>Appraisal Stage</th>
             </tr>
           </thead>
           <tbody>
             <?php
              $getApps = $db->GetArray("select *from vw_appraisals where AppraiseeUserID='$user'");
              $i = 0;
              $html = "";
              $labels = array("label-danger","label-success","label-info","label-warning");
                 foreach ($getApps as $akey => $Appval) {
                   $rand_keys = array_rand($labels, 1);
                   $lbl = $labels[$rand_keys];
                   $PeriodName = $Appval["PeriodName"];
                   $SupervisorName = $Appval["SupervisorName"];
                   $AppStage = $Appval["AppStage"];
                   $i += 1;
                   $html .="<tr>";
                   $html .="<td>$i</td>";
                   $html .="<td>$PeriodName</td>";
                   $html .="<td> $SupervisorName</td>";
                    $html .= "<td> <span class='label $lbl arrowed-in arrowed-in-right'>$AppStage</span></td>";
                   $html .="</tr>";
                 }
                echo $html;
             ?>
           </tbody>
          </table>
          </div><!-- Widget-main -->
      </div> <!-- End Widget-body -->
    </div> <!-- End WidgetBox -->
 </div>  <!-- End Col-6 -->

 <div class="col-sm-7">
  <div class="widget-box">
      <div class="widget-header widget-header-flat widget-header-small">
        <h5 class="widget-title">
          <i class="ace-icon fa fa-signal"></i>
          Last Appraisal Scores
        </h5>
      </div><!-- End Widget-header -->
            <div class="widget-body">
      <div class="widget-main">
        <table id="tableSearchResults" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Appraisal</th>
            <th>Section3 Score</th>
            <th>Section5A Score</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
           $getApps = $db->GetArray("select *from vw_section10 where AppraiseeUserID='$user'");
           $i = 0;
           $html = "";
           $labels = array("label-danger","label-success","label-info","label-warning");
              foreach ($getApps as $akey => $LAppval) {
                $rand_keys = array_rand($labels, 1);
                $lbl = $labels[$rand_keys];
                $PeriodName = $LAppval["PeriodName"];
                $Section3 = $LAppval["Section3"];
                $Section5A = $LAppval["Section5A"];
                $STotal = $Section3 + $Section5A;
                $i += 1;
                $html .="<tr>";
                $html .="<td>$i</td>";
                $html .="<td>$PeriodName</td>";
                $html .="<td>$Section3</td>";
                $html .="<td>$Section5A</td>";
                 $html .= "<td> <span class='label $lbl arrowed-in arrowed-in-right'>$STotal %</span></td>";
                $html .="</tr>";
              }
             echo $html;
          ?>
        </tbody>
       </table>


      </div><!-- End WidgetMain -->
    </div><!-- End Widget Body -->
  </div><!-- End Widget Box -->


 </div>

</div>

</div><!-- End Page-Content -->
