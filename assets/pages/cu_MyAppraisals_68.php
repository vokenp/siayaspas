 <?php
$op = filter_input(INPUT_GET, "view");
//$db->debug=1;
  $UserType = $UserInfo["user_type"];
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
$AppStep = $rst["AppStage"];
$S_ROWID = "<input type='hidden' name='S_ROWID' id='S_ROWID' value='$cid'>";
$btn = "<button type='submit' name='btnUpdateRecord' id='btnUpdateRecord' class='btn btn-sm btn-success' ><i class='fa fa-edit'></i> Update Record</button>";

  }

  ?>
<script type="text/javascript">

	$(document).ready(function(){
		var op = $("#op").val();
    dotoken();
     $('.chosen-container').css({ 'width':'100%' });
    //Start wizard
    var StepIndex = $("#currentStep").val();

    $('#fuelux-wizard-container').wizard('selectedItem', { step: StepIndex});
    $('#fuelux-wizard-container').wizard({
      //  step: 4 ,//optional argument. wizard will jump to step "2" at first
        //buttons: '.wizard-actions:eq(3)'
      }).on('actionclicked.fu.wizard' , function(e, info){

         var index = info.step;
          if(info.direction === 'next')
          {
             index += 1;
           }
           else {
               index -= 1;
           }

           var postdata = $("#myForm").serializeArray();
            postdata.push({name: 'AppStage', value: "Section"+index});
            postdata.push({name: 'btnUpdateStep', value: $("#S_ROWID").val()});
            $.post("assets/bin/ManageGroups.php", postdata, function(data){});

      }).on('changed.fu.wizard', function(e, info) {
        //  $("#test").html(info.step);
      })
      .on('finished.fu.wizard', function(e) {
        bootbox.dialog({
          message: "Thank you! Your information was successfully saved!",
          buttons: {
            "success" : {
              "label" : "OK",
              "className" : "btn-sm btn-primary"
            }
          }
        });
      }).on('stepclick.fu.wizard', function(e){
        //e.preventDefault();//this will prevent clicking and selecting steps
      });


      //jump to a step
      /**
      var wizard = $('#fuelux-wizard-container').data('fu.wizard')
      wizard.currentStep = 3;
      wizard.setState();
      */

      //determine selected step
      //wizard.selectedItem().step



      //hide or show the other form which requires validation
      //this is for demo only, you usullay want just one form in your application
      /*$('#skip-validation').removeAttr('checked').on('click', function(){
        $validation = this.checked;
        if(this.checked) {
          $('#sample-form').hide();
          $('#validation-form').removeClass('hide');
        }
        else {
          $('#validation-form').addClass('hide');
          $('#sample-form').show();
        }
      }) */
    //End Wizard

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
<input type="hidden" name="currentStep" id="currentStep" value="<?php echo str_replace('Section','',$rst["AppStage"]);?>">

<div class="widget-box">
          <div class="widget-header widget-header-flat">
            <h4 class="widget-title smaller">
              <i class="ace-icon fa fa-list smaller-80"></i>
                My Appraisal for <?php echo $rst["PeriodName"];?> <span id="test"></span>
            </h4>
            <div id="pageToolBar" class="widget-toolbar no-border">
               <a href="<?php echo $listUrl;?>" class="btn btn-xs btn-info  radius-4 bigger"> <i class="ace-icon fa fa-arrow-left bigger-80"></i> Back to List </a>

             </div>
          </div>

          	<input type="hidden" name="ModCode" id="ModCode" value="<?php echo $mod;?>">
          	<input type="hidden" name="ReturnType" id="ReturnType" value="RstID">
          	<input type="hidden" name="_token" id="_token" value="<?php echo  VToken::genT();?>" class="token">
            <?php echo $S_ROWID;?>
        <div class="widget-body">
           <div id="fuelux-wizard-container">
           <div class="widget-main">
                   <div>
                     <ul class="steps">
                       <li data-step="1" class="active">
                         <span class="step">1</span>
                         <span class="title">Personal Particulars</span>
                       </li>
                       <li data-step="2">
                         <span class="step">2</span>
                         <span class="title">Departmental Objectives</span>
                       </li>

                       <li data-step="3">
                         <span class="step">3</span>
                         <span class="title">Performance Targets</span>
                       </li>

                       <li data-step="4">
                         <span class="step">4</span>
                         <span class="title">Staff Training</span>
                       </li>

                       <li data-step="5">
                         <span class="step">5A</span>
                         <span class="title">Staff Values</span>
                       </li>

                       <li data-step="6">
                         <span class="step">5B</span>
                         <span class="title">Managerial and Supervisory Competencies</span>
                       </li>

                       <li data-step="7">
                         <span class="step">7</span>
                         <span class="title">Appraisee Comments</span>
                       </li>


                     </ul>
                   </div>  <!-- End Steps Section -->

                   <div class="step-content pos-rel">

                      <div class="step-pane active" data-step="1">
                         <?php  include("AppSection1.php");?>
                      </div> <!-- End Step 1 -->

                      <div class="step-pane" data-step="2">
                        <?php  include("AppSection2.php");?>
                      </div> <!-- End Step 2 -->

                      <div class="step-pane" data-step="3">
                        <?php  include("AppSection3.php");?>
                      </div> <!-- End Step 3 -->

                      <div class="step-pane" data-step="4">
                        <?php  include("AppSection4.php");?>
                      </div> <!-- End Step 4 -->

                      <div class="step-pane" data-step="5">
                        <?php  include("AppSection5a.php");?>
                      </div> <!-- End Step 5 -->

                      <div class="step-pane" data-step="6">
                       <?php  include("AppSection5b.php");?>
                      </div> <!-- End Step 6 -->

                      <div class="step-pane" data-step="7">
                        <?php  include("AppSection6.php");?>
                      </div> <!-- End Step 6 -->

                   </div> <!-- End Steps Content -->

          </div><!-- End Widget-Main -->
          <div class="widget-toolbox  clearfix text-center">
            <div class="wizard-actions">
              <button type="button" class="btn btn-prev pull-left">
                <i class="ace-icon fa fa-arrow-left"></i>
                Prev
              </button>

              <button type="button" class="btn btn-success btn-next pull-right" data-last="Finish">
                Next
                <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
              </button>
            </div>
          </div>
        </div> <!-- End fueluxWizard -->
    </div> <!-- End widget-body -->



</div><!-- End WidgetBox -->
