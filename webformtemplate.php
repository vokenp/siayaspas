
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('keyup keypress', 'form input[type="text"]', function(e) {
if(e.which == 13) {
e.preventDefault();
return false;
}
});
  });
</script>
<?php 
  $app = filter_input(INPUT_GET, "app");
  $mod = filter_input(INPUT_GET, "mod");
  $op = filter_input(INPUT_GET, "view");
  $ptype = filter_input(INPUT_GET, "ptype");

  $rst = $rs->row("dh_modules","S_ROWID='$mod'");
  $ExemptRole = $rst["ExemptRole"];
  $modName = $rst["ModuleName"];
  $AppName = $rst["AppName"];
  $AppInfo = $db->GetRow("select * from dh_applications where S_ROWID='$app'");
  $ApplicationName = $AppInfo["ApplicationName"];
  $AppIconRef = $AppInfo["IconRef"];
  $IconRef = $AppIconRef != "" ? "<i class='menu-icon $IconRef ' ></i>" : "";
  $modCode = $rst["ModuleCode"];
  $TableName = $rst["TableName"];
  $modType =    $rst["ModuleType"];
  $ParentTable =    $rst["ParentTable"];
  $ModuleListView =    $rst["ModuleListView"];
   $Helpcontext = $rst["Helpcontext"] == "" ? "<h2>No Content for now</h3>" : $rst["Helpcontext"];
  $ButtonDisplay = $rst["DisplayButton"] != "" ? $rst["DisplayButton"] : "Create New ".$modName;
  $rand = sha1($modCode);
$EnableCreation = $rst["EnableCreation"];
      $Modbtn = "";
  if ($EnableCreation == 'Y') {
    
    if ($rst["ButtonType"] == "OpenLink") 
    {
      $btnLink = "?app=$app&mod=$mod&view=add&ptype=temp&sk=$rand";
      $Modbtn = "<a href='$btnLink' class='btn btn-default btn-sm bg-navy' title='$ButtonDisplay' ><i class='fa fa-plus'> $ButtonDisplay</i></a>";
    }
    elseif ($rst["ButtonType"] == "ModalOpen") 
    {
      $btnLink = "#";
      $btnAttrib = $rst["ButtonAttributes"];
      $Modbtn = "<a href='#' class='btn btn-default bg-navy btn-sm ' $btnAttrib title='$ButtonDisplay' ><i class='fa fa-plus'> $ButtonDisplay</i></a>";
       $Modbtn = $op == "list" ? $Modbtn : "";
    }
  }
?>
  
<?php 
    
     if ($app == "") {
        include("dashboard.php");
        exit();
      }

   if ($ExemptRole != "Y") {
     $ActionList = $rs->getUserAction($user,$mod,"RoleUser");
     
    if (!isset($ActionList['View'])) {
      include("assets/pages/403.php");
      exit();
     }
     elseif($ActionList['View'] == 0)
     {
      include("assets/pages/403.php");
      exit();
     }
   }

  $rand = md5(mt_rand());    
      if ($rst["S_ROWID"] == "") {
        include("assets/pages/404.php");
        exit();
      } 

 
?>


<div class="page-header">
  <h1>
    <?php echo $ApplicationName;?>
    <small>
      <i class="ace-icon fa fa-angle-double-right"></i>
      <?php echo $modName;?>
    </small>
    <span class="pull-right"><a href="#" data-toggle="modal" data-target="#modal-helpContext" title="<?php echo "Know more about ".$modName;?>">Help <i class="ace-icon fa fa fa-question-circle"></i></a></span>
  </h1>
  
</div><!-- /.page-header -->


 <div class="page-content">
  <div class="row">
    <div class="col-xs-12">
      <?php 
   
   
  if ($op == "list") {
        if ($ModuleListView == 'Custom') {
          $listViewName = "assets/pages/lstview_".$modCode.".php";
            $exist = file_exists($listViewName);
      if ($exist) {
        include($listViewName);
      }
      else
      {
       $content = '<h2>This is for file content</h2>';
       $handle = file_put_contents($listViewName,$content);
       chmod($listViewName, 0777);
       copy("mnglistview.php",$listViewName);
       include($listViewName);
      }
    
        }
        else
        {
          include("mnglistview.php");
        }
    }
    else
    {
      $pageName = "assets/pages/cu_".$modCode.".php";
      $exist = file_exists($pageName);
      if ($exist) {
        include($pageName);
      }
      else
      {
       $content = '<h2>This is for file content</h2>';
       $handle = file_put_contents($pageName,$content);
       chmod($pageName, 0777);
       copy("assets/pages/pageTemplate.php",$pageName);
       include($pageName);
      }
    
    }
       
  ;?>
     
    </div><!-- End Col-xs-12 -->
  </div><!-- End Row -->
</div><!-- page-content -->


  <div class="modal fade" id="modal-helpContext">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-navy">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo $modName." Help Context"; ?></h4>
              </div>
              <div class="modal-body" style="overflow-y:auto;max-height:500px;">
                  <?php echo $Helpcontext;?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-right" data-dismiss="modal">Close</button>
                
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
