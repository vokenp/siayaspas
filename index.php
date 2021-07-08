<?php
include("timeout.php");
include("assets/bin/con_db.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (!isset($_SESSION['user'])) {
   header("location: ulogin.php");
}
if(isset($_POST['tname'])){
  $list = getallheaders();
  if (isset($list["Cookie"])) {
     $Cookie = explode(';',$list["Cookie"]) ;
     list($sLabel,$sVal) = explode('=',$Cookie[0]);
     $voken = md5($sVal.$_SESSION['UserID']);
      if ($voken == $_SESSION['sessionid']) {
        echo trim(VToken::genT());
      }
  }
   exit();
}

$user = $_SESSION['user'];
$UserInfo = $rs->row("dh_users","loginid='$user'");
$displayName = $UserInfo["Fullname"];
$UserType = $UserInfo["user_type"];
$shift = $UserInfo["shift"];
$UserID =  $UserInfo["S_ROWID"];

$app = (int)filter_input(INPUT_GET, "app");
define("USERID", $_SESSION['user']);
$user = USERID;

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>County Assembly of Siaya</title>
        	<link href="assets/images/favicon.png" rel="shortcut icon" type="image/vnd.microsoft.icon" />
		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="assets/css/jquery-ui.min.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="assets/css/ui.jqgrid.min.css" />
        <link rel="stylesheet" href="assets/css/fullcalendar.min.css" />
		<!-- text fonts -->
		<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->

		<link rel="stylesheet" href="assets/css/chosen.min.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-select.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="assets/css/dataTables.checkboxes.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="assets/css/daterangepicker.min.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css" />
<link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">


		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="assets/js/ace-extra.min.js"></script>
		<!--[if !IE]> -->
			<script src="assets/js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
			<script src="assets/js/bootstrap.min.js"></script>
		<!-- <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
        <script src="assets/js/jquery.validate.min.js"></script>
		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="assets/js/jquery-ui.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
		<!-- <script src="assets/js/jquery.easypiechart.min.js"></script>
		<script src="assets/js/jquery.sparkline.index.min.js"></script>
		<script src="assets/js/jquery.flot.min.js"></script>
		<script src="assets/js/jquery.flot.pie.min.js"></script>
		<script src="assets/js/jquery.flot.resize.min.js"></script> -->



        <script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="assets/js/dataTables.buttons.min.js"></script>
		<script src="assets/js/buttons.flash.min.js"></script>
		<script src="assets/js/buttons.html5.min.js"></script>
		<script src="assets/js/buttons.print.min.js"></script>
		<script src="assets/js/buttons.colVis.min.js"></script>
		<script src="assets/js/dataTables.select.min.js"></script>
		<script src="assets/js/dataTables.checkboxes.min.js"></script>
		<script src="assets/js/jszip.min.js"></script>
		<script src="assets/js/vfs_fonts.js"></script>
		<script src="assets/js/dataTables.rowGroup.min.js"></script>

		<script src="assets/js/jquery.gritter.min.js"></script>
		<script src="assets/js/chosen.jquery.min.js"></script>
		<script src="assets/js/autosize.min.js"></script>
		<script src="assets/js/bootstrap-tag.min.js"></script>

        <script src="assets/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/js/bootstrap-timepicker.min.js"></script>
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/daterangepicker.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<script src="assets/js/jquery.maskedinput.min.js"></script>

		<script src="assets/js/jquery.jqGrid.min.js"></script>
		<script src="assets/js/grid.locale-en.js"></script>

        <script src="assets/js/fullcalendar.min.js"></script>
		<script src="assets/js/bootbox.js"></script>


        <script src="assets/plugins/ckeditor/ckeditor.js"></script>
		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>
		<script src="assets/js/jsscripts.js"></script>
		<script src="assets/js/bootbox.js"></script>
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="plugins/toastr/toastr.min.js"></script>
<script src="plugins/select2/js/select2.full.min.js"></script>
 <script type="text/javascript">
    $('.select2').select2();
</script>
		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="skin-2">
	  <?php include("header.php"); ?>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

				<?php if($app !=2 ){
				include("sidebar.php");

			}
			else{
				include("sidebar.php");
				include("sidebar2.php");
			}?>

			<div class="main-content">
            <div class="main-content-inner">
				<?php

       switch ($app) {
        case 2:
           include("websystemplates.php");
           break;
        case 0:
           include("dashboard.php");
           break;
         default:
           include("webformtemplate.php");
           break;
       }

     ?>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- main-content-inner -->
		</div><!-- Main-Content -->
	</div><!-- /.main-container -->
</body>
</html>
