<?php
$agentBal = $rs->getAgentBal();
$errorTP    =  $db->GetOne("select count(*) from vw_airtimetopup_error");
$errorMP    =  $db->GetOne("select count(*) from vw_pesatrans_nc");
$MpesaBal  =  $db->GetOne("select OrgAccountBalance from pesatrans order by S_ROWID desc");
$getData = $db->Execute("select MobileOperator,sum(TopUpAmount) as Total,count(*) as NumCount from tbl_airtimetopup where date(DateCreated)=current_date and Commission is not null group by MobileOperator ");

?>

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
          Airtime Stats
        </h5>
      </div><!-- End Widget-header -->
            <div class="widget-body">
      <div class="widget-main">
           <div class="row">
      <div class="col-sm-12 infobox-container">


        <div class="infobox infobox-pink col-sm-4">
          <div class="infobox-icon">
            <i class="ace-icon fa fa-users"></i>
          </div>

          <div class="infobox-data">
            <span class="infobox-data-number"><?php echo $errorTP;?></span>
            <div class="infobox-content">Airtime Errors</div>
          </div>
        </div>

        <div class="infobox infobox-pink col-sm-4">
          <div class="infobox-icon">
            <i class="ace-icon fa fa-users"></i>
          </div>

          <div class="infobox-data">
            <span class="infobox-data-number"><?php echo $errorMP;?></span>
            <div class="infobox-content">MPesa Errors</div>
          </div>
        </div>

        <div class="infobox infobox-blue col-sm-4">
          <div class="infobox-icon">
            <i class="ace-icon fa fa-dollar"></i>
          </div>

          <div class="infobox-data">
            <span class="infobox-data-number"><?php echo $agentBal;?></span>
            <div class="infobox-content">Agent Bal</div>
          </div>
        </div>

        <div class="infobox infobox-blue col-sm-4">
          <div class="infobox-icon">
            <i class="ace-icon fa fa-dollar"></i>
          </div>

          <div class="infobox-data">
            <span class="infobox-data-number"><?php echo $MpesaBal;?></span>
            <div class="infobox-content">Paybill Bal</div>
          </div>
        </div>
      </div><!-- End InfoBox Container -->
      </div><!-- End Row -->

      <div class="row">
        <table class="table table-bordered table-striped">
        <thead class="thin-border-bottom">
          <tr>
            <th>Mobile Network</th>
            <th>TransCount</th>
            <th>Amount Paid</th>
          </tr>
        </thead>
        <tbody>
           <?php
              $html = "";

              $tt = 0;
                $nc = 0;
                  $labels = array("Airtel"=>"label-danger","SafCom"=>"label-success","Telkom"=>"label-info","None"=>"label-warning");

                  while (!$getData->EOF) {
                    $valu = $getData->fields;
                    $MNO = $valu["MobileOperator"];
                    $lbl = $labels[$MNO];


                    $html .= "<tr>";
                     $html .= "<td> <span class='label $lbl arrowed-in arrowed-in-right'>$MNO</span></td>";
                    $html .= "<td>".$valu["NumCount"]."</td>";
                    $html .= "<td>".$valu["Total"]."</td>";
                    $html .= "</tr>";
                    $tt += $valu["Total"];
                    $nc += $valu["NumCount"];
                    $getData->MoveNext();
                  }

                  $html .= "<tr>";
                  $html .= "<td><b>Total</b></td>";
                  $html .= "<td><b>$nc</b></td>";
                  $html .= "<td><b>$tt</b></td>";
                  $html .= "</tr>";
                          echo $html;
           ?>
        </tbody>
      </table>
      </div>

          </div><!-- Widget-main -->
      </div> <!-- End Widget-body -->
    </div> <!-- End WidgetBox -->
 </div>  <!-- End Col-6 -->

 <div class="col-sm-7">
  <div class="widget-box">
      <div class="widget-header widget-header-flat widget-header-small">
        <h5 class="widget-title">
          <i class="ace-icon fa fa-signal"></i>
          Last 10 Transactions
        </h5>
      </div><!-- End Widget-header -->
            <div class="widget-body">
      <div class="widget-main">
        <table class="table table-bordered table-striped">
        <thead class="thin-border-bottom">
          <tr>
            <th>#</th>
            <th>TransRefNo</th>
            <th>PurchaseBy</th>
            <th>TopUp No</th>
            <th>TopUp Amount</th>
            <th>MNO</th>
          </tr>
        </thead>
        <tbody>
           <?php
              $html = "";
             $i = 0;
            $getData = $db->Execute("select *from vw_airtimetopup_success where date(DateCreated)=current_date order by S_ROWID DESC limit 10");

                  while (!$getData->EOF) {
                    $valu = $getData->fields;
                    $MNO = $valu["MobileOperator"];
                    $lbl = $labels[$MNO];
                    $i += 1;
                    $html .= "<tr>";
                    $html .= "<td>$i</td>";
                    $html .= "<td>".$valu["TransID"]."</td>";
                    $html .= "<td>".$valu["FullName"]." : ".$valu["CreatedBy"]."</td>";
                    $html .= "<td>".$valu["TopUpPhoneNo"]."</td>";
                    $html .= "<td>".$valu["TopUpAmount"]."</td>";
                   $html .= "<td> <span class='label $lbl arrowed-in arrowed-in-right'>$MNO</span></td>";
                    $html .= "</tr>";

                    $getData->MoveNext();
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
