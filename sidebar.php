<div id="sidebar" class="sidebar h-sidebar responsive ace-save-state ">
	<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->
   
   <ul class="nav nav-list ">
	<li class="">
		<a href="./">
			<i class="menu-icon fa fa-tachometer"></i>
			<span class="menu-text"> Dashboard </span>
		</a>

		<b class="arrow"></b>
	</li>
	
	<?php 
    $html ="";
    $htmlist = $rs->getUserMenuList($user,"RoleUser");
      foreach ($htmlist as $key => $valu) {
        $Mkey = key($valu);
      $AppName = $valu[$Mkey]["ApplicationName"];
       $IconRef = $valu[$Mkey]["AppIcon"];
       $AppSROWID = $valu[$Mkey]["AppS_ROWID"];
       $IsActive = $app == $AppSROWID ? "class='active hover'" : "class='hover'";
       $IconRef = $IconRef != "" ? "<i class='menu-icon $IconRef ' ></i>" : "";
       $html .= "<li $IsActive><a href='#' class='dropdown-toggle'> $IconRef <span> $AppName </span><b class='arrow fa fa-angle-down'></b></a><b class='arrow'></b>";
       $html .= "<ul class='submenu'>";
        foreach ($valu as $key => $mods) {
          $rand = md5(mt_rand());
          $ModuleCode = $mods["ModuleCode"];
          $ModuleName = $mods["ModuleName"];
          $IconMod = $mods["ModIcon"];
          $ModSROWID = $mods["ModCode"];
          $IconMod = $IconMod != "" ? "<i class='menu-icon $IconMod '></i>" : "";
          $html .= "<li><a href='?app=$AppSROWID&mod=$ModSROWID&view=list&ptype=temp&sk=$rand'>  $ModuleName</a><b class='arrow'></b></li>";
        }
       $html .= "</ul></li>";
      }
      echo $html;
  ?> 

</ul>

</div>