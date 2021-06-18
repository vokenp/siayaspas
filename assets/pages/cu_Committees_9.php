 <?php
$op = filter_input(INPUT_GET, "view");
//$db->debug=1;
   $rand = md5(mt_rand());
   $addUrl = "?app=$app&mod=$mod&view=add&ptype=temp&sk=$rand";
   $listUrl = "?app=$app&mod=$mod&view=list&ptype=temp&sk=$rand";
   $TableName = "assemblycommittees";
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
$S_ROWID = "<input type='hidden' name='S_ROWID' id='S_ROWID' value='$cid'>";
$btn = "<button type='submit' name='btnUpdateRecord' id='btnUpdateRecord' class='btn btn-sm btn-success' value='$TableName'><i class='fa fa-edit'></i> Update Record</button>";
   
  }
  
  ?>
<script type="text/javascript">
	$(document).ready(function(){
		var op = $("#op").val();

			if (op == "add") 
    	 {
    	 	$("#CommitteeOptions").hide();
               
    	}
    	 
    	else
    	{
          
          $("#CommitteeOptions").show();
         
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
      
       $("#MemberType").change(function(){
       	var MemberType = $("#MemberType").val();
       	if (MemberType == "Member") 
       		{ 
               $("#ComMembers").chosen({max_selected_options: 10});
               $("#ComMembers").trigger("chosen:updated");
       		}
       		else
       		{
       			$("#ComMembers").chosen({max_selected_options: 1});
       			$("#ComMembers").trigger("chosen:updated");
       		}
       });


      $("#btnComMembers").click(function(){
    var tbl = "iko";

    var postdata = $("#myForm").serializeArray();
    postdata.push({name: 'ComMembers', value: $("#ComMembers").val()});
    postdata.push({name: 'CommitteeID', value: $("#S_ROWID").val()});
    postdata.push({name: 'MemberType', value: $("#MemberType").val()});
    postdata.push({name: 'btnComMembers', value: tbl});

   $.post("assets/bin/ManageGroups.php", postdata, function(data){ 
      location.reload();
    });
  });

       // Profile
  var comMemberTable = $('#tblMemberList').DataTable({
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
            text: '<i class="fa fa-trash text-red">  Remove Members</i>',
            titleAttr: 'Remove Selected Members',
            className: 'btn btn-sm pull-right btn-purple btn-primary btn-bold',
            name: 'delBtn',
                action: function ( e, dt, node, config ) {
                   delfromGroup(" Members");
                  }
            }
        ],
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    if ( aData[5] == "ChairPerson" )
                    {
                        $('td', nRow).css('background-color', 'Orange');
                        $('td', nRow).css('font-weight', 'bold');
                    }
                    else if ( aData[5] == "Vice ChairPerson" )
                    {
                    	$('td', nRow).css('background-color', '#b6efe4');
                        $('td', nRow).css('font-weight', 'bold');
                    }
                }, 
                //*180*5#
      
         "ajax":{
            url :"assets/bin/getComMemberList.php", // json datasource
            type: "post",  // type of method  , by default would be get
            "data":function(data) {
              data.CommitteeID = $('#S_ROWID').val();
             },

            error: function(){  // error handling code
              $("#tblMemberList_processing").css("display","none");
            }
          }
    });

  	    $("#delCheckAll").click(function(){
   if ($("#delCheckAll").is(':checked') == true) 
   {
    $('#tblMemberList .dt-checkbox').prop('checked', true);
   }
   else
   {
    $('#tblMemberList .dt-checkbox').prop('checked', false);
   }
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
            
                $.post('assets/bin/ManageGroups.php',{DelCommMembers:""+arr+""}, 
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
                <?php echo $modName;?>
            </h4>
            <div id="pageToolBar" class="widget-toolbar no-border">
                <a href="<?php echo $addUrl; ?>" class="btn btn-xs btn-info  radius-4 bigger"> <i class="ace-icon fa fa-plus bigger-80"></i> Add New </a>
               <a href="<?php echo $listUrl;?>" class="btn btn-xs btn-info  radius-4 bigger"> <i class="ace-icon fa fa-arrow-left bigger-80"></i> Back to List </a>
             </div>
          </div>
          <form name="frmPageTemp" id="frmPageTemp" class="form-horizontal" role="form">
          	<input type="hidden" name="ModCode" id="ModCode" value="<?php echo $mod;?>">
          	<input type="hidden" name="ReturnType" id="ReturnType" value="RstID">
            <?php echo $S_ROWID;?>
        <div class="widget-body">
           <div class="widget-main">
        	  <div class="row">
                 	<div class="form-group col-sm-7">
						<label class="col-sm-4 control-label " for="CommitteeName"> Committee Name </label>
						<div class="col-sm-8">
							<textarea id="CommitteeName" name="CommitteeName" placeholder="Enter Committee Name" class="col-xs-11 col-sm-11"><?php echo $rst["CommitteeName"];?></textarea>
						</div>
					</div>
					
			   </div>
			   <div class="row">
			   	<div class="form-group col-sm-7">
						<label class="col-sm-4 control-label " for="CommitteeDescription"> Committee Description </label>
						<div class="col-sm-8">
							<textarea id="CommitteeDescription" name="CommitteeDescription" placeholder="Enter Committee Description" class="col-xs-11 col-sm-11" cols="40" rows="5" required="true"><?php echo $rst["CommitteeDescription"];?></textarea>
						</div>
					</div>
			   </div>
         <div class="row">
           <div class="form-group col-sm-7">
            <label class="col-sm-4 control-label " for="ClerkResponsible"> Clerk Responsible </label>
            <div class="col-sm-8">
              <select  id="ClerkResponsible" name="ClerkResponsible"  class="col-xs-11 col-sm-11 chosen-select">
                <?php 
                $ClerkResponsible = $rst["ClerkResponsible"];
                $getFullName = $db->GetOne("select Fullname from vw_usergroups where loginid='$ClerkResponsible' and UserGroup='Clerks'");
                echo "<option value='$ClerkResponsible'>$getFullName</option>";
                $getClerks = $db->Execute("select *from vw_usergroups where loginid<>'$ClerkResponsible' and UserGroup='Clerks'");
                while (!$getClerks->EOF) {
                  $ClerkResponsible = $getClerks->fields["loginid"];
                  $Fullname = $getClerks->fields["Fullname"];
                  echo "<option value='$ClerkResponsible'>$Fullname</option>";
                  $getClerks->MoveNext();
                }
                ?>
              </select>
            </div>
          </div>
         </div>

         <div class="row">
              <div class="form-group col-sm-7">
            <label class="col-sm-4 control-label " for="CommitteeType"> Committee Type </label>
            <div class="col-sm-8">
              <select  id="CommitteeType" name="CommitteeType"  class="chosen-select col-xs-10 col-sm-10"   required="true">
                <?php echo $rs->GetListItems($rst["CommitteeType"],"CommitteeType",$op);?>
                  
              </select>
            </div>
          </div>
         </div>
          </div><!-- End Widget-Main -->
          <div class="widget-toolbox padding-8 clearfix text-center">
               <?php echo $btn; ?>
          </div>
        </div><!-- End Widget-body -->
    </form>
</div><!-- End WidgetBox -->
</div>
<div class="col-xs-12" id="CommitteeOptions">
   <div class="tabbable ">
	<ul class="nav nav-tabs tab-color-blue background-blue"  id="myTab3">
		<li class="active">
			<a data-toggle="tab" href="#CommitteeMembers">
				<i class="pink ace-icon fa fa-Users bigger-110"></i>
				Members
			</a>
		</li>

		<li>
			<a data-toggle="tab" href="#CommitteeMeetings">
				<i class="blue ace-icon fa fa-user bigger-110"></i>
				Committee Meetings
			</a>
		</li>

		
	</ul>
	<div class="tab-content">
		<div id="CommitteeMembers" class="tab-pane fade in active">
			<?php include("CommitteeMembers.php");?>
		</div>

		<div id="CommitteeMeetings"  class="tab-pane fade in ">
			<?php include("CommitteeMeetings.php");?>
		</div>
	</div><!-- tab-content -->

</div><!-- Tabbable -->
</div><!-- End colxs--12 -->
