<script type="text/javascript">
	$(document).ready(function(){
      $('#error_box').fadeOut(100);
      $('#success_box').fadeOut(100);
		$("#conType").change(function(){
		  var confType = $("#conType").val();
           $('#error_box').fadeOut(50);
         $('#success_box').fadeOut(50);
		  if (confType != "") 
		  {
		  $.post('assets/pages/MngAppConfigs.php',{confType: ""+confType+""},function(data) {
		  
		  	$("#results").html(data);
		  });
		  }
		  else
		  {
		  	$(".results").html("");
		  }
		});
	});
</script>
<div class="widget-box">
          <div class="widget-header widget-header-flat">
            <h4 class="widget-title smaller">
              <i class="ace-icon fa fa-list smaller-80"></i>
                General Sittings
            </h4>
            <div id="pageToolBar" class="widget-toolbar no-border">
            
            
             </div>
          </div>
         
          	
        <div class="widget-body">
           <div class="widget-main">
         <div class="row">
           <div class="form-group col-sm-7">
            <label class="col-sm-3 control-label " for="confType"> Configuration Type </label>
            <div class="col-sm-9">
              <select name="conType" id="conType" >
   			   <?php
   			   $getConf = $db->Execute("select distinct confType from appconfigs");
   			   echo "<option value=''></option>";
   			   while (!$getConf->EOF) {
   			   	$confType = $getConf->fields["confType"];
   			   	echo "<option value='$confType'>$confType</option>";
   			   	$getConf->MoveNext();
   			   }
   			   ?>
   			</select>
            </div>
          </div>
          
         </div>
         <div class="alert alert-success" id="success_box"></div>
             <div class="alert alert-danger" id="error_box"></div>
        	  	<h4 class="header blue bolder smaller"></h4>
         <div id="results"></div>
          </div><!-- End Widget-Main -->
        
        </div><!-- End Widget-body -->
         
 
</div><!-- End WidgetBox -->