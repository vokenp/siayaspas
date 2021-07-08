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


     var dataTableSMembersContrib = $('#tblMembersContrib').DataTable({
         "Processing": true,
         "serverSide": true,
         "scrollY": "50vh",
         "scrollCollapse": true,
         "bFilter":true,
         "ordering": true,
         "bLengthChange": false,
         "bPaginate": false,
         "pagingType": "simple",
         language: {
        paginate: {
        next: '<i class="fa fa-chevron-right">',
        previous: '<i class="fa fa-chevron-left">'  
       }
       },
          
         "ajax":{
            url :"assets/bin/getMembercontributions.php", // json datasource
            type: "post",  // type of method  , by default would be get
           "data":function(data) {
            data.MeetingID = $('#MeetingID').val();
            data.token = $('#token').val();
            
            },

            error: function(et){  // error handling code
              //$("#tblSaccousers_processing").css("display","none");
              alert(JSON.stringify(et));
            }
          }
    });
  //End Sacco Users

  $('#ContributionType').change(function(){
  $('#AmountContributed').val($(this).children('option:selected').data('value'));
});

      $("#frmMemContrib").validate({
debug: false,
rules: {

},
messages: {
  
},
submitHandler: function(form) {
// do other stuff for a valid form
   var postdata = $("#frmMemContrib").serializeArray();
   $.post('assets/bin/ManageRecords.php', $("#frmMemContrib").serialize(), function(data) {
       
    if (data.length < 30)
    {
    
    var frm = "#frmMemContrib";
    $(frm)[0].reset();
    $(frm).trigger("reset");
    $(frm).find(":submit").prop('disabled', false);
    $(frm).find(":submit").html("<i class='fa fa-plus'></i> Add"); 
    $(frm).data('submitted', false);
    
     dotoken();
    $('#tblMembersContrib').DataTable().draw();
        Swal.fire({
                type: 'success',
                title: data,
                showConfirmButton: false,
                timer: 1500
                });
    }
    else
    {
    dotoken();
    Swal.fire(
                  'Oops!',
                  data,
                  'error'
                );
   
    }
});
}
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
<input type="hidden" name="MeetingID" id="MeetingID" value="<?php echo $cid;?>">
<input type="hidden" name="url" id="url" value="<?php echo full_path();?>">
<input type="hidden" name="_token" id="_token" value="<?php echo  VToken::genT();?>" class="token">
<div class="widget-box">
          <div class="widget-header widget-header-flat">
            <h4 class="widget-title smaller">
              <i class="ace-icon fa fa-list smaller-80"></i>
                <?php echo $modName;?>
            </h4>
            <div id="pageToolBar" class="widget-toolbar no-border">
               <a href="<?php echo $listUrl;?>" class="btn btn-xs btn-info  radius-4 bigger"> <i class="ace-icon fa fa-arrow-left bigger-80"></i> Back to List </a>

             </div>
          </div>
        
            <input type="hidden" name="ModCode" id="ModCode" value="<?php echo $mod;?>">
            <input type="hidden" name="ReturnType" id="ReturnType" value="RstID">
            
            <?php echo $S_ROWID;?>
        <div class="widget-body">
           <div class="widget-main">

        <div class="row">
        <div class="col-xs-6">
         <h4 class="header blue bolder smaller">Meeting Info</h4>
           <div class="profile-user-info profile-user-info-striped ">
            <div class="profile-info-row">
              <div class="profile-info-name"> Period</div>
              <div class="profile-info-value">
                <span class="editable" id="22"><b><?php  echo $rst["MeetingPeriod"];?></b></span>
              </div>
            </div>
          </div>

          <div class="profile-user-info profile-user-info-striped ">
            <div class="profile-info-row">
              <div class="profile-info-name"> Meeting Venue</div>
              <div class="profile-info-value">
                <span class="editable" id="22"><b><?php  echo $rst["MeetingVenue"];?></b></span>
              </div>
            </div>
          </div>

          <div class="profile-user-info profile-user-info-striped ">
            <div class="profile-info-row">
              <div class="profile-info-name"> Description</div>
              <div class="profile-info-value">
                <span class="editable" id="22"><b><?php  echo $rst["MeetingDescription"];?></b></span>
              </div>
            </div>
          </div>

      
        </div><!-- End Col-xs-6 -->

        <div class="col-xs-6 ">
         <h4 class="header blue bolder smaller">Meeting Contributions</h4>
           <table id="simple-table" class="table  table-bordered table-hover">
            <thead>
              <tr>  
                <th>#</th>
                <th>Contribution Type</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
            <?php 
        $getCData = $db->GetArray("select ContributionType,sum(AmountContributed) as AmtContributed from tbl_contributions where MeetingID=$cid group by contributionType");
            $html = "";
            $tt = 0;
            foreach ($getCData as $key => $val) {
              $key += 1;
              $ContrType = $val["ContributionType"];
              $AmtContributed = $val["AmtContributed"];
              $tt += $AmtContributed;
             $html .= "<tr><td>$key</td><td>$ContrType</td><td>$AmtContributed</td></tr>";
            }
            
        ?> 
        </tbody>
        <tfoot>
           <?php 
        $getMPData = $db->GetArray("select ModeofPayment,sum(AmountContributed) as AmtContributed from tbl_contributions where MeetingID=$cid group by ModeofPayment");
            
            foreach ($getMPData as $key => $mval) {
              
              $ContrType = $mval["ModeofPayment"];
              $AmtContributed = $mval["AmtContributed"];
             
             $html .= "<tr><td>$ContrType</td><td><b>$AmtContributed</b></td></tr>";
            }
            echo $html;
        ?> 
          <tr><td colspan="2"><b>Total </b></td><td><b><?php echo pesa($tt);?></b></td></tr>
        </tfoot>
        </table>

       </div>
      </div>  <!-- End Row -->

        <div class="space-8"></div>
        <div class="row">
      <div class="col-xs-12">
<div class="tabbable">
  <ul class="nav nav-tabs padding-18 tab-size-bigger" id="myTab">
    <li class="active">
      <a data-toggle="tab" href="#tabUsers">
        <i class="blue ace-icon fa fa-users bigger-120"></i>
        Contributions
      </a>
    </li>

    <li>
      <a data-toggle="tab" href="#tabFleet">
        <i class="green ace-icon fa fa-random bigger-120"></i>
        Merry-go-Round
      </a>
    </li>

    <li>
      <a data-toggle="tab" href="#tabRoutes">
        <i class="orange ace-icon fa fa-bank bigger-120"></i>
        Banking
      </a>
    </li>

  </ul>
   <div class="tab-content no-border padding-24">
      <div id="tabUsers" class="tab-pane fade in active">
         <?php include("memberContributions.php");?>
      </div>

      <div id="tabFleet" class="tab-pane fade in">
          Fleet
      </div>

      <div id="tabRoutes" class="tab-pane fade in ">
          Routes
      </div>
    </div><!-- Tab-content -->
   </div><!-- Tabbable -->
</div><!-- end col-xs-12 -->
      </div><!-- row2 -->

          </div><!-- End Widget-Main -->
          
        </div><!-- End Widget-body -->
         
   
</div><!-- End WidgetBox -->