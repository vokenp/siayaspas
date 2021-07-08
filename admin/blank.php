<div class="main-content-inner">
	<?php
		$page = filter_input(INPUT_GET, "page");
		switch ($page) {
			case 131:
				include("MngApplications.php");
				break;
			case 132:
				include("CU_Applications.php");
				break;
			case 133:
				include("MngModules.php");
				break;
			case 134:
				include("ModulesPanel.php");
				break;
			case 135:
				include("MngTables.php");
				break;
			case 137:
				include("MngListItems.php");
				break;
			
			default:
				
				break;
		}
	?>
</div><!-- End Main-content-inner -->