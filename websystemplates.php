


   <div class="page-content">
     <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
              <li>
                <i class="ace-icon fa fa-gears"></i>
                <b>System Settings</b>
              </li>
              <li>
                 <button data-target="#sidebar2" data-toggle="collapse" type="button" class=" navbar-toggle collapsed"><span class="sr-only">Toggle sidebar</span>
                    <i class="ace-icon fa fa-dashboard purple"></i></button>
              </li>
            </ul><!-- /.breadcrumb -->
           

          </div>
  <div class="row m-0">
    <div class="col-xs-12">

      <?php 
   if (!in_array($user, $rs->RoleUsers("SysManager"))) {
         include("pages/403.php");
         exit();
        }
  $app = filter_input(INPUT_GET, "app");
  $mod = filter_input(INPUT_GET, "mod");
  $op = filter_input(INPUT_GET, "view");
  $ptype = filter_input(INPUT_GET, "ptype");
  $rand = md5(mt_rand());
  $appName = $db->GetOne("select ApplicationName from dh_applications where S_ROWID='$app'");
  $modInfo = $db->GetRow("select * from dh_modules where S_ROWID='$mod'");
    $argMod = array_filter($modInfo);
      if (!empty($argMod)) {
         $rst = array();
          $rst = $modInfo;
        $ModuleName = $rst["ModuleName"];
        $ModuleCode = $rst["ModuleCode"];
        $TableName = $rst["TableName"];
        $ParentTable = $rst["ParentTable"];
        $modType =    $rst["ModuleType"];
        $ModuleListView =    $rst["ModuleListView"];
        $ButtonDisplay = $rst["DisplayButton"] != "" ? $rst["DisplayButton"] : "Create New ".$ModuleName;
        $ModACL = $rst["ACL"];
        $EnableCreation = $rst["EnableCreation"];
        $modNamebtn = "";
  if ($ModuleName != "" && $EnableCreation == 'Y') {
    $modNamebtn = "<li><a href='?app=$app&mod=$mod&view=add&ptype=temp&sk=$rand' class='btn bg-navy fa fa-plus'> $ButtonDisplay </a></li>";
  }
      }
      
      if (empty($argMod)) {
        include("assets/pages/404.php");
       exit();
      } 

     
  if ($op == "list") {
        if ($ModuleListView == 'Custom') {
          include("mngDataTblView.php");
          include("assets/pages/lstview_".$ModuleCode.".php");
        }
        else
        {
          include("mnglistview.php");
        }
    }
    else
    {
      $pageName = "assets/pages/cu_".$ModuleCode.".php";
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



  
  