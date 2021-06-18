 <?php
$op = filter_input(INPUT_GET, "view");
//$db->debug=1;
  if ($op == "add") {
    $S_ROWID = "";
    $cid = "";
   
    $btn = "<button type='submit' name='btnSaveRecord' id='btnSaveRecord' class='btn btn-sm btn-success' value='$TableName'><i class='fa fa-edit'></i> Save Record</button>";
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
  $getPerm = $db->GetArray("select ModCode,ModOperation,IsAllowed from dh_profilepermissions where  ProfileID='$cid' order by S_ROWID desc");
    $ModPerm = array();
   $argPerm = array_filter($getPerm);
     if (!empty($argPerm)) {
      foreach ($getPerm as $key => $val) {
        $ModPerm[$val["ModCode"]][$val["ModOperation"]] = $val["IsAllowed"];
      }
     }
$S_ROWID = "<input type='hidden' name='S_ROWID' id='S_ROWID' value='$cid'>";
$btn = "<button type='submit' name='btnUpdateRecord' id='btnUpdateRecord' class='btn btn-sm btn-success' value='$TableName'><i class='fa fa-edit'></i> Update Record</button>";
   
  }
  
  ?>
<script type="text/javascript">
   
     $(function(){
    $(".ace-switch").change(function(event){
     event.preventDefault();
      var curta = $(this).attr('id');
       if ($("."+curta).prop("checked")) 
       {
        $("#txt"+curta).val("1");
       }
       else
       {
        $("#txt"+curta).val("0");
       }
       
       });
    //

    
    });

	$(document).ready(function(){
		 var op = $("#op").val();

		  if (op == "add") 
    	 {
    	 	$("#ProfileOptions").hide();
               $("#widget-toolbox").show();
    	}
    	 
    	else
    	{
          $("#ProfileName").attr("readonly",true);
          $("#ProfileOptions").show();
          $("#widget-toolbox").hide();
    	}

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
					alert(data);
				   
					}
				});
				}
				});

       
       $("#frmProfilePerms").validate({
debug: false,
rules: {

},
messages: {
  
},
submitHandler: function(form) {
// do other stuff for a valid form
   $.post('assets/bin/MngProfilePermissions.php', $("#frmProfilePerms").serialize(), function(data) {
    

    if (data.length < 30)
    {
    var urlstr = $("#url").val();
    var url = urlstr.replace("view=edit&", "view=list&");
    $(window.location).attr('href', "?"+url);
    }
    else
    {
    $('.success_box').fadeOut(200);
    $('.error_box').fadeIn(200);
    $('.error_box').html(data);
   
    }
});
}
});
	});
</script>
<input type="hidden" name="op" id="op" value="<?php echo $op;?>">
<input type="hidden" name="url" id="url" value="<?php echo full_path();?>">
<div class="col-xs-12">
<div class="widget-box">
          <div class="widget-header widget-header-flat">
            <h4 class="widget-title smaller">
              <i class="ace-icon fa fa-list smaller-80"></i>
                <?php echo $ModuleName?>
            </h4>
            <div id="pageToolBar" class="widget-toolbar no-border">
              
             </div>
          </div>
          <form name="frmPageTemp" id="frmPageTemp" class="form-horizontal" role="form">
          		  <input type="hidden" name="ReturnType" id="ReturnType" value="RstID">
          	<input type="hidden" name="ModCode" id="ModCode" value="<?php echo $mod;?>">
            <?php echo $S_ROWID;?>
             <input type="hidden" name="_token" id="_token" class="token" value="<?php echo VToken::gent();?>">
        <div class="widget-body">
           <div class="widget-main">

        	  <div class="row">
                 	<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="ProfileName"> Profile Name </label>
						<div class="col-sm-8">
							<input type="text" id="ProfileName" name="ProfileName" placeholder="Enter Profile Name" class="col-xs-11 col-sm-11" value="<?php echo $rst['ProfileName'];?>"  required="true" />
						</div>
					</div>
					
			   </div>
			  <div class="row">
			  	<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="ProfileDescription"> ProfileDescription </label>
						<div class="col-sm-8">
							<input type="text" id="ProfileDescription" name="ProfileDescription" placeholder="Enter ProfileDescription" class="col-xs-11 col-sm-11" value="<?php echo $rst['ProfileDescription'];?>"  required="true" />
						</div>
					</div>
			  </div>


          </div><!-- End Widget-Main -->
          <div  id="widget-toolbox" class="widget-toolbox padding-8 clearfix text-center">
               <?php echo $btn; ?>
          </div>
        </div><!-- End Widget-body -->
         
    </form>
</div><!-- End WidgetBox -->
</div>
<div id="ProfileOptions" class="col-xs-12">
	<div class="row">
		<div class="col-xs-12">
			<div class="widget-box">
		  <div class="widget-body">
		  <form name="frmProfilePerms" id="frmProfilePerms">
		  	<?php echo $S_ROWID;?>
		  	  <div class="widget-toolbox padding-8 clearfix text-right">
               	  	<button type="submit" name="btnUpdateRecord" id="btnUpdateRecord" value="dh_modules" class="btn btn-sm btn-purple"><i class="fa fa-save"></i> Update Permissions</button>
               </div>
        <div class="widget-main">
          <table id="tableSearchResults" class="table table-bordered table-striped">
<thead>
    <tr>
        <th>Module Name</th>
        <th>Application Name</th>
        <th>CanView</th>
       
    </tr>
</thead>
<tbody>
    <?php 
       $getModules = $db->Execute("select m.S_ROWID,m.ModuleCode,m.ModuleName,a.ApplicationName,m.IconRef  from dh_modules m inner join dh_applications a on m.AppName=a.AppCode where m.ExcludePermsList='N' order by ApplicationName");
       $html = "";
       while (!$getModules->EOF) {
            $ModID  = $getModules->fields["S_ROWID"];
            $ModCode  = str_replace(' ', '', $getModules->fields["ModuleCode"]);
            $ModName  = $getModules->fields["ModuleName"];
            $AppName  = $getModules->fields["ApplicationName"];
            $Icon     = $getModules->fields["IconRef"];
            $IconRef = $Icon != "" ? "<i class='$Icon'></i>" : "";

      $ActionView = "View";
      $IsAllowedView =isset($ModPerm[$ModID][$ActionView]) ? $ModPerm[$ModID][$ActionView] : "0";
      $checkedView = $IsAllowedView == "1" ? "checked='true'" : "";

           $html .="<tr class='bg-gray'>";
           $html .= "<td> $IconRef <b>$ModName</b></td>";
           $html .= "<td>$AppName</td>";
           $html .= "<td>";
           $html .= "<input type='checkbox' id='ModOperation-$ModID-$ActionView' class='ModOperation-$ModID-$ActionView ace ace-switch ace-switch-5' $checkedView> <span class='lbl'></span>";
         $html .= "<input type='hidden' name='ModOperation[$ModID][$ActionView]' id='txtModOperation-$ModID-$ActionView' value='$IsAllowedView'>";
           $html .= "</td></div>";
           $html .="</tr>";
          
         $getModules->MoveNext();
       }
       echo $html;
    ?>
</tbody>
</table>
        </div>  <!-- end Widget Main -->
        </form>
    </div><!-- WidgetBody -->
</div><!-- widgetBox -->
		</div>
	</div>
</div>