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

               <a href="<?php echo $listUrl;?>" class="btn btn-xs btn-info  radius-4 bigger"> <i class="ace-icon fa fa-arrow-left bigger-80"></i> Back to List </a>

             </div>
          </div>

          	<input type="hidden" name="ModCode" id="ModCode" value="<?php echo $mod;?>">
          	<input type="hidden" name="ReturnType" id="ReturnType" value="RstID">
          	<input type="hidden" name="_token" id="_token" value="<?php echo  VToken::genT();?>" class="token">
            <?php echo $S_ROWID;?>
        <div class="widget-body">
           <div class="widget-main">
             <div class="space"></div>
             <div class="tabbable ">
           <ul class="nav nav-tabs padding-16">
             <li class="active">
               <a data-toggle="tab" href="#Section1">
                 <i class="green ace-icon fa fa-check bigger-125"></i>
                 <b>Section 1:</b> Personal Particulars
               </a>
             </li>

             <li>
               <a data-toggle="tab" href="#Section3">
                 <i class="blue ace-icon fa fa-check bigger-125"></i>
                 <b>Section 3:</b> Performance Targets
               </a>
             </li>

             <li>
               <a data-toggle="tab" href="#Section4">
                 <i class="blue ace-icon fa fa-check bigger-125"></i>
                 <b>Section 4:</b> Training Needs
               </a>
             </li>

             <li>
               <a data-toggle="tab" href="#Section5A">
                 <i class="blue ace-icon fa fa-check bigger-125"></i>
                 <b>Section 5A:</b> Staff Values
               </a>
             </li>

             <li>
               <a data-toggle="tab" href="#Section5B">
                 <i class="blue ace-icon fa fa-check bigger-125"></i>
                 <b>Section 5B:</b> Managerial Competencies
               </a>
             </li>

             <li>
               <a data-toggle="tab" href="#Section8">
                 <i class="blue ace-icon fa fa-check bigger-125"></i>
                 <b>Section 8:</b> Appraisees Comments
               </a>
             </li>
             <li>
               <a data-toggle="tab" href="#Section10">
                 <i class="blue ace-icon fa fa-check bigger-125"></i>
                 <b>Section 10:</b> Overall Ratings
               </a>
             </li>
           </ul>

             <div class="tab-content profile-edit-tab-content">
                 <div id="Section1" class="tab-pane in active">
                   <?php include("pastrptSection1.php");?>
                 </div>  <!-- End Section1-->

                 <div id="Section3" class="tab-pane in">
                     <?php include("pastrptSection3.php");?>
                 </div>  <!-- End Section3-->

                 <div id="Section4" class="tab-pane in ">
                   <?php include("pastrptSection4.php");?>
                 </div>  <!-- End Section4-->

                 <div id="Section5A" class="tab-pane in ">
                   <?php include("pastrptSection5A.php");?>
                 </div>  <!-- End Section4-->

                 <div id="Section5B" class="tab-pane in ">
                     <?php include("pastrptSection5B.php");?>
                 </div>  <!-- End Section4-->

                 <div id="Section8" class="tab-pane in ">
                     <?php include("pastrptSection8.php");?>
                 </div>  <!-- End Section4-->

                 <div id="Section10" class="tab-pane in ">
                     <?php include("AppSection10.php");?>
                 </div>  <!-- End Section4-->

             </div> <!--tab-content -->

           </div>  <!-- End tabbable-->

          </div><!-- End Widget-Main -->
          <div class="widget-toolbox padding-8 clearfix text-center">

          </div>
        </div><!-- End Widget-body -->
</div><!-- End WidgetBox -->
