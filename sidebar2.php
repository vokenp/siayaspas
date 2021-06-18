  <div id="sidebar2" class="sidebar responsive compact ace-save-state"> 
	
   
   <ul class="nav nav-list ">
	
	<?php 
         $html ="";
      // get other Modules
    $getMods = $db->Execute("select *from dh_modules where AppName='SystemApps' order by DisplayOrder asc");
             $AppSROWID = $app;
            while (!$getMods->EOF) {
              $rand = md5(mt_rand());
              $ModCode = $getMods->fields["ModuleCode"];
              $ModName = $getMods->fields["ModuleName"];
              $IconMod = $getMods->fields["IconRef"];
              $ModSROWID = $getMods->fields["S_ROWID"];
              $ModACL = $getMods->fields["ACL"];
              $IconMod = $IconMod != "" ? "<i class='menu-icon $IconMod '></i>" : "<i class='menu-icon fa fa-list '></i>";
              $RoleUsers = $rs->RoleUsers($ModACL);

              if ($ModACL == "") {
                $html .= "<li class=''><a href='?app=$AppSROWID&mod=$ModSROWID&view=list&ptype=temp&sk=$rand'>$IconMod<span class='menu-text'> $ModName </span></a><b class='arrow'></b></li>";
                  
                }
                elseif (in_array(USERID, $RoleUsers)) {
                  $html .= "<li class=''><a href='?app=$AppSROWID&mod=$ModSROWID&view=list&ptype=temp&sk=$rand'>$IconMod<span class='menu-text'> $ModName </span></a><b class='arrow'></b></li>";
                }
              $getMods->MoveNext();
            }
     
     echo $html;
        ?>

</ul>

</div>