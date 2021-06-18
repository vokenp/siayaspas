 <?php
$op = filter_input(INPUT_GET, "view");
//$db->debug=1;
$protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
   $rand = md5(mt_rand());
   $addUrl = "?app=$app&mod=$mod&view=add&ptype=temp&sk=$rand";
   $listUrl = "?app=$app&mod=$mod&view=list&ptype=temp&sk=$rand";

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

         $("#DocumentDate").datepicker({
                    autoclose: true,
                    format: 'dd-mm-yyyy',
                    todayHighlight: true
                    
                })
                
                .next().on(ace.click_event, function(){
                    $(this).prev().focus();
                }); 
	});
</script>
<input type="hidden" name="op" id="op" value="<?php echo $op;?>">
<input type="hidden" name="url" id="url" value="<?php echo full_path();?>">
<input type="hidden" name="curDocID" id="curDocID" value="<?php echo $rst["DocID"];?>">
<div class="widget-box">
          <div class="widget-header widget-header-flat">
            <h4 class="widget-title smaller">
              <i class="ace-icon fa fa-list smaller-80"></i>
                <?php echo $rst["DocumentTitle"];?>
            </h4>
            <div id="pageToolBar" class="widget-toolbar no-border">
            
               <a href="<?php echo $listUrl;?>" class="btn btn-xs btn-info  radius-4 bigger"> <i class="ace-icon fa fa-arrow-left bigger-80"></i> Back to List </a>

             </div>
          </div>
          
            <?php echo $S_ROWID;?>
        <div class="widget-body">
           <div class="widget-main">
             <div class="row">
             	<div class="col-sm-8">
             		<div class="table-responsive" id="documentview" style='width:100%;height:500px'>

<?php 
   $pathUrl = strtolower($protocol)."://www.".$_SERVER['HTTP_HOST']."/".basename(dirname(dirname(__dir__)))."/getDocIndex.php?docid=".$rst["DocID"];
?>
   
             		 <iframe src="<?php echo $pathUrl;?>" style="width:100%; height:100%;" frameborder="0"></iframe>
             		  	


             		  	
             		</div>


             	</div>

             	<div class="col-sm-4">
             		<form name="frmPageTemp" id="frmPageTemp" class="form-horizontal" role="form">
          	<input type="hidden" name="ModCode" id="ModCode" value="<?php echo $mod;?>">
          	<input type="hidden" name="ReturnType" id="ReturnType" value="RstID">
          
            <?php echo $S_ROWID ; ?>
             <div>
            <label class="control-label " for="DocumentCategory"> Document Category</label>
               <select name="DocumentCategory" id="DocumentCategory" class="col-xs-12 col-sm-12 chosen-select">
                 <?php 
   
                 $DocCategory = $rst["DocumentCategory"];
                  list($CatName,$CategoryID) = explode('-',$rst["DocumentCategory"]);
                  $getCatName = $db->GetOne("select DocumentCategory from assemblybusiness where S_ROWID='$CategoryID'");
                  $getList = $db->Execute("select *from assemblybusiness where S_ROWID<>'$CategoryID' order by DisplayOrder asc");
                  echo "<option value='$DocCategory'>$getCatName</option>";
                    while (!$getList->EOF) {
                      $DocCateName = $getList->fields["DocumentCategory"];
                      $CategoryID = $CatName."-".$getList->fields["S_ROWID"];
                      echo "<option value='$CategoryID'>$DocCateName</option>";
                      $getList->MoveNext();
                    }
                 ?>
               </select>
          </div><hr/>

        	  <div>
						<label class="control-label " for="DocumentTitle"> Document Title </label>
							<input type="text" id="DocumentTitle" name="DocumentTitle" placeholder="Enter Document Title" class="col-xs-12 col-sm-12" value="<?php echo $rst['DocumentTitle'];?>"  required="true" />
					</div><hr/>

           <div>
            <label class="control-label " for="DocumentDate"> Document Date </label>
              <input type="text" id="DocumentDate" name="DocumentDate" placeholder="Enter Document Date" class="col-xs-12 col-sm-12" value="<?php echo date('d-m-Y',strtotime($rst['DocumentDate']));?>"  required="true" />
          </div><hr/>
		       
		    
         <div class="row text-center">
              <?php echo $btn; ?>

         </div>
            </form>
             	</div>
             </div>



          </div><!-- End Widget-Main -->
          <div class="widget-toolbox padding-8 clearfix text-center">
             
          </div>
        </div><!-- End Widget-body -->
         
  
</div><!-- End WidgetBox -->