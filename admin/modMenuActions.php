<script type="text/javascript">
	$(document).ready(function(){


		 var dataTable = $('#tblModActions').DataTable({
         "Processing": true,
         "serverSide": true,
         "scrollY": "60vh",
         "bFilter": false,
         "ordering": false,
         "pagingType": "simple",
         "lengthMenu": [[ 25, 50, 100,-1], [25, 50, 100,"All"]],
         "columnDefs": [
      { "targets": 0,"title": "<input type='checkbox' name='delCheckAll' id='delCheckAll'>"},
      { "targets": 1,"title": "ApplicationName" },
      { "targets": 2,"title": "IconRef" },
      { "targets": 3,"title": "DisplayOrder"}
     
      ],

         language: {
        paginate: {
        next: 'Next',
        previous: 'Previous'  
       }
       },
      
      
         "ajax":{
            url :"bin/getModActions.php", // json datasource
            type: "post",  // type of method  , by default would be get
            "data":function(data) {
              data.ModCode = $('#ModCode').val();
             },
            error: function(){  // error handling code
              $("#tblModActions_processing").css("display","none");
            }
          }
    });

			$("#frmModActions").validate({
				debug: false,
				rules: {
				
				},
				messages: {
				  
				},
				submitHandler: function(form) {
				// do other stuff for a valid form
				
				$.post('bin/ManageGroups.php', $("#frmModActions").serialize(), 
				function(data) {
					if (data.length < 30)
					{
					 location.reload();
					}
					else
					{
					alert(data);
				   
					}
				});
				}
				});	 

	 $("#delCheckAll").click(function(){
   if ($("#delCheckAll").is(':checked') == true) 
   {
    $('#tblModActions .dt-checkbox').prop('checked', true);
   }
   else
   {
    $('#tblModActions .dt-checkbox').prop('checked', false);
   }
});
	});


	function delfromGroup()
   {
     jConfirm('Are you sure you want to Remove this Action Menu?', 'Remove Action', function(r) {
if(r){
  	   var arr = [];
  $('input.dt-checkbox:checkbox:checked').each(function () {
    arr.push($(this).val());
  });
    if (arr !=0) 
    {
       $.post('bin/ManageGroups.php',{DelMenuActions:""+arr+""}, 
        function(data) {
        	
          location.reload();
        });
    }
  }
});
   }
</script>
<div class="row">
	<div class="col-xs-10">
		<div class="widget-box">
		  <div class="widget-body">

  	  <div class="widget-toolbox padding-8 clearfix text-left">
  	  	<form name="frmModActions" id="frmModActions" class="form-horizontal" role="form">
  	  		<input type="hidden" name="ModCode" id="ModCode" value="<?php echo $cid;?>">
  	  		<div class="row">
  	  			<div class="form-group col-sm-8">
						<label class="col-sm-4 control-label " for="ActionNames"> Select Menu Actions </label>
						<div class="col-sm-8">
					<select name="ActionNames[]" id="ActionNames" class="chosen-select tag-input-style col-xs-10 col-sm-10"  multiple="true"  required="true">
					<?php 
			 		$getData = $db->Execute("select ActionName,MenuDescription from menuactions where ActionName not in (select ItemDescription from listitems where ItemType='ModActions' and ItemCode='$cid')");
			    	while (!$getData->EOF) {
			    	$ActionName = $getData->fields["ActionName"];
			    	$DisplayName = $getData->fields["MenuDescription"];
			    	echo "<option value='$ActionName'>$DisplayName</option>";

			     	$getData->MoveNext();
			    }
			   ?>
							</select>
						</div>
					</div>
				<div class="form-group col-sm-4">
					<button type='submit' name='btnModActions' id='btnModActions' class="btn btn-sm btn-success" ><i class="fa fa-plus"></i> Add Menu Actions</button>
				</div>
  	  		</div>
  	  	</form>
  	  </div>

  	   <table id="tblModActions" class="table table-bordered table-striped"></table>

		  </div><!-- End Widget-Body -->
		</div><!-- End WidgetBox -->
	</div><!-- End Col-xs-10 -->
</div><!-- EndRow -->