 <?php
$op = filter_input(INPUT_GET, "view");
//$db->debug=1;
   $TableName = "dh_usergroups";
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
    $GroupCode=  $rst["GroupCode"];
$S_ROWID = "<input type='hidden' name='S_ROWID' id='S_ROWID' value='$cid'>";
$btn = "<button type='submit' name='btnUpdateRecord' id='btnUpdateRecord' class='btn btn-sm btn-success' value='$TableName'><i class='fa fa-edit'></i> Update Record</button>";
   
  }
  
  ?>
<script type="text/javascript">
	$(document).ready(function(){
       $("#ProfileRoles").chosen({width: '85%'});
    	 var op = $("#op").val();
    	 if (op == "add") 
    	 {
    	 	$("#RoleOptions").hide();
               $("#widget-toolbox").show();
    	}
    	 
    	else
    	{
          $("#GroupName").attr("readonly",true);
          $("#RoleOptions").show();
          $("#widget-toolbox").hide();
    	}

    	$("#GroupName").blur(function(){
   var GroupName = $(this).val();
     if (GroupName != "")
     {
      $("#GroupCode").val(GroupName.replace(' ', ''));
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
					alert(data);
				   
					}
				});
				}
				});

		var dataTable = $('#tblRoleUsers').DataTable({
        "Processing": true,
         "serverSide": true,
         "bFilter": false,
         "ordering": false,
         "pagingType": "simple",
         "lengthMenu": [[ 25, 50, 100,-1], [25, 50, 100,"All"]],

         language: {
        paginate: {
        next: 'Next',
        previous: 'Previous'  
       }
       },
       dom: 'Blfrtip',
        buttons: [
            {
            text: '<i class="fa fa-trash text-red"> Remove Users</i>',
            titleAttr: 'Remove Selected Users',
            className: 'btn btn-sm btn-purple btn-primary btn-bold pull-right',
            name: 'delBtn',
                action: function ( e, dt, node, config ) {
                    delfromGroup("Users");
                  }
            }
        ],
      
         "ajax":{
            url :"assets/bin/getRoleUserGroups.php", // json datasource
            type: "post",  // type of method  , by default would be get
            "data":function(data) {
              data.UserGroup = $('#GroupCode').val();

             },

            error: function(){  // error handling code
              $("#tblRoleUsers_processing").css("display","none");
            }
          }
    });

		 // Profile
  var ProfileTable = $('#tblRoleProfiles').DataTable({
        "Processing": true,
         "serverSide": true,
         "bFilter": false,
         "ordering": false,
         "pagingType": "simple",
         "lengthMenu": [[ 25, 50, 100,-1], [25, 50, 100,"All"]],

         language: {
        paginate: {
        next: 'Next',
        previous: 'Previous'  
       }
       },
       dom: 'Blfrtip',
        buttons: [
            {
            text: '<i class="fa fa-trash text-red">  Remove Profile</i>',
            titleAttr: 'Remove Selected Profile',
            className: 'btn btn-sm pull-right btn-purple btn-primary btn-bold',
            name: 'delBtn',
                action: function ( e, dt, node, config ) {
                   delfromGroup(" Profiles");
                  }
            }
        ],
      
         "ajax":{
            url :"assets/bin/getRoleProfiles.php", // json datasource
            type: "post",  // type of method  , by default would be get
            "data":function(data) {
              data.UserGroup = $('#GroupCode').val();
             },

            error: function(){  // error handling code
              $("#tblRoleUsers_processing").css("display","none");
            }
          }
    });
    

    $("#delCheckAll").click(function(){
   if ($("#delCheckAll").is(':checked') == true) 
   {
    $('#tblRoleUsers .dt-checkbox').prop('checked', true);
   }
   else
   {
    $('#tblRoleUsers .dt-checkbox').prop('checked', false);
   }
});

$("#delPCheckAll").click(function(){
   if ($("#delPCheckAll").is(':checked') == true) 
   {
    $('#tblRoleProfiles .dt-checkbox').prop('checked', true);
   }
   else
   {
    $('#tblRoleProfiles .dt-checkbox').prop('checked', false);
   }
});
     
      $("#btnRoleUsers").click(function(){
    var tbl = "iko";
   var postdata = $("#myForm").serializeArray();
    postdata.push({name: 'GroupUsers', value: $("#GroupUsers").val()});
    postdata.push({name: 'GroupCode', value: $("#GroupCode").val()});
    postdata.push({name: 'btnRoleUsers', value: tbl});
   $.post("assets/bin/ManageGroups.php", postdata, function(data){ 
      location.reload();
    });
  });

        $("#btnRoleProfiles").click(function(){
    var tbl = "iko";
   var postdata = $("#myForm").serializeArray();
    postdata.push({name: 'ProfileRoles', value: $("#ProfileRoles").val()});
    postdata.push({name: 'GroupCode', value: $("#GroupCode").val()});
    postdata.push({name: 'btnRoleProfiles', value: tbl});
   $.post("assets/bin/ManageGroups.php", postdata, function(data){ 
      location.reload();
    });
  });

	});

function delfromGroup(qitem)
   {

   	     var arr = [];
  $('input.dt-checkbox:checkbox:checked').each(function () {
    arr.push($(this).val());
  });
    if (arr !=0) 
    {
        bootbox.confirm({
            message: "Are you sure you want to Delete selected Records?",
            buttons: {
              confirm: {
               label: "Delete Records",
               className: "btn-danger btn-sm",
              },
              cancel: {
               label: "Cancel",
               className: "btn-sm",
              }
            },
            callback: function(result) {
              if(result)
              {
            
                $.post('assets/bin/ManageGroups.php',{DelGroupUsers:""+arr+""}, 
        function(data) {
          location.reload();
        });
              }
            }
            });
      }
   }
</script>
<input type="hidden" name="op" id="op" value="<?php echo $op;?>">
<input type="hidden" name="url" id="url" value="<?php echo full_path();?>">
<div class="col-xs-12">
<div class="widget-box">
          <div class="widget-header widget-header-flat">
            <h4 class="widget-title smaller">
              <i class="ace-icon fa fa-list smaller-80"></i>
                <?php echo $ModuleName;?>
            </h4>
            <div id="pageToolBar" class="widget-toolbar no-border">
              
             </div>
          </div>
          <form name="frmPageTemp" id="frmPageTemp" class="form-horizontal" role="form">
          	<input type="hidden" name="ModCode" id="ModCode" value="<?php echo $mod;?>">
          	  <input type="hidden" name="ReturnType" id="ReturnType" value="RstID">
          	  <input type="hidden" id="GroupCode" name="GroupCode"  class="col-xs-11 col-sm-11" value="<?php echo $rst['GroupCode'];?>">
            <?php echo $S_ROWID;?>
            <input type="hidden" name="_token" id="_token" class="token" value="<?php echo VToken::gent();?>"> 
        <div class="widget-body">
           <div class="widget-main">

        	  <div class="row">
                 	<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="GroupName"> Group Name </label>
						<div class="col-sm-8">
							<input type="text" id="GroupName" name="GroupName" placeholder="Enter Group Name" class="col-xs-11 col-sm-11" value="<?php echo $rst['GroupName'];?>"  required="true" />
						</div>
					</div>
					
			   </div>
			   <div class="row">
			   	<div class="form-group col-sm-5">
						<label class="col-sm-4 control-label " for="GroupDescription"> Group Description </label>
						<div class="col-sm-8">
							<textarea  id="GroupDescription" name="GroupDescription" placeholder="Enter Group Description" class="col-xs-11 col-sm-11"><?php echo $rst['GroupDescription'];?></textarea>
						</div>
					</div>
			   </div>


          </div><!-- End Widget-Main -->
          <div id="widget-toolbox" class="widget-toolbox padding-8 clearfix text-center">
               <?php echo $btn; ?>
          </div>
        </div><!-- End Widget-body -->
         
    </form>
</div><!-- End WidgetBox -->
</div>

<div class="col-xs-12" id="RoleOptions">
   <div class="tabbable ">
	<ul class="nav nav-tabs tab-color-blue background-blue"  id="myTab3">
		<li class="active">
			<a data-toggle="tab" href="#RoleUsers">
				<i class="pink ace-icon fa fa-Users bigger-110"></i>
				Role Users
			</a>
		</li>

		<li>
			<a data-toggle="tab" href="#RoleProfiles">
				<i class="blue ace-icon fa fa-user bigger-110"></i>
				Role Profiles
			</a>
		</li>

		
	</ul>
	<div class="tab-content">
		<div id="RoleUsers" class="tab-pane fade in active">
			<?php include("RoleUsers.php");?>
		</div>

		<div id="RoleProfiles"  class="tab-pane fade in ">
			<?php include("Roleprofiles.php");?>
		</div>
	</div><!-- tab-content -->

</div><!-- Tabbable -->
</div><!-- End colxs--12 -->