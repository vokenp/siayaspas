<?php
session_start();
  $token =   str_shuffle(base64_encode(openssl_random_pseudo_bytes(32)));
  $_SESSION["_token"] =  $token;

  if(isset($_POST['tname'])){
    $token =   str_shuffle(base64_encode(openssl_random_pseudo_bytes(32)));
    $_SESSION["_token"] =  $token;
    echo $token;
   exit();
}
?>
<!DOCTYPE html>

<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Login - CredoHub Portal</title>
		<link href="assets/images/favicon.png" rel="shortcut icon" type="image/vnd.microsoft.icon" />
		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="login-layout light-login">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
<div class="login-container pull-right">
<div class="center">
<img src="assets/images/siayalogo.png" height="70px" width="370px;">
</div>

<div class="space-6"></div>

<div class="position-relative">


<div id="login-box" class="login-box visible widget-box no-border">
	<div class="widget-body">
		<div class="widget-main">
			<h3 class="header blue lighter bigger" style="font-weight:bold;text-align:center;">Staff Appraisal Portal</h3>
			<h4 class="header blue lighter bigger">
				<i class="ace-icon fa fa-coffee green"></i>
				Please Enter Your Information
			</h4>
         <div class="alert alert-danger" id="error_box"></div>
			<div class="space-6"></div>

<form name="frmlogin" id="frmlogin">
		   <input type="hidden" name="_token" id="_token" value="<?php echo $token;?>" class="token">
				<fieldset>
					<label class="block clearfix">
						<span class="block input-icon input-icon-right">
							<input type="text" id="username" name="username" required="true" class="form-control" placeholder="Enter UserName" />
							<i class="ace-icon fa fa-user"></i>
						</span>
					</label>

						<label class="block clearfix">
						<span class="block input-icon input-icon-right">
							<input type="password" id="pswd" name="pswd" class="form-control" placeholder="Password" required="true" />
							<i class="ace-icon fa fa-lock"></i>
						</span>
					</label>




					<div class="clearfix">
                        <button type="submit" name="btnLogin" class="button btn btn-primary btn-normal pull-right"> <i class="ace-icon fa fa-key"></i> Sign In</button>
					</div>


					<div class="space-4"></div>



				</fieldset>
			</form>

			<div class="space-6"></div>

		</div><!-- /.widget-main -->

		<div class="toolbar clearfix">
			<div>
			<a href="#" data-target="#forgot-box" class="forgot-password-link">
				<i class="ace-icon fa fa-key"></i>
				I forgot my password
			</a>
		</div>

		</div>
	</div><!-- /.widget-body -->
</div><!-- /.login-box -->

<div id="forgot-box" class="forgot-box widget-box no-border">
	<div class="widget-body">
		<div class="widget-main">
			<h4 class="header red lighter bigger">
				<i class="ace-icon fa fa-key"></i>
				Retrieve Password
			</h4>

			<div class="space-6"></div>
			<p>
				Enter your UserName and to receive instructions
			</p>

			<form name="btnforgotpswd" id="btnforgotpswd">
			<input type="hidden" name="_token" id="_token" value="<?php echo $token;?>" class="token">
				<fieldset>
					<label class="block clearfix">
						<span class="block input-icon input-icon-right">
							<input type="email" class="form-control" placeholder="Enter UserName" />
							<i class="ace-icon fa fa-envelope"></i>
						</span>
					</label>

					<div class="clearfix">
						<button type="submit" class="width-35 pull-right btn btn-sm btn-danger">
							<i class="ace-icon fa fa-lightbulb-o"></i>
							<span class="bigger-110">Send Me!</span>
						</button>
					</div>
				</fieldset>
			</form>
		</div><!-- /.widget-main -->

		<div class="toolbar center">
			<a href="#" data-target="#login-box" class="back-to-login-link">
				Back to login
				<i class="ace-icon fa fa-arrow-right"></i>
			</a>
		</div>
	</div><!-- /.widget-body -->
</div><!-- /.forgot-box -->


<div id="activate-box" class="signup-box widget-box no-border">
	<div class="widget-body">
		<div class="widget-main">
			<h4 class="header red lighter bigger">
				<i class="ace-icon fa fa-key"></i>
				Activate Account
			</h4>

			<div class="space-6"></div>
			<p>
				Enter VendorID to Activate Account
			</p>

			<form name="btnforgotpswd" id="btnforgotpswd">
			<input type="hidden" name="_token" id="_token" value="<?php echo $token;?>" class="token">
				<fieldset>
					<label class="block clearfix">
						<span class="block input-icon input-icon-right">
							<input type="email" class="form-control" placeholder="Enter VendorID" />
							<i class="ace-icon fa fa-envelope"></i>
						</span>
					</label>

					<div class="clearfix">
						<button type="submit" class="width-85 pull-right btn btn-sm btn-danger">
							<i class="ace-icon fa fa-lightbulb-o"></i>
							<span class="bigger-110">Send me Activation Code</span>
						</button>
					</div>
				</fieldset>
			</form>
		</div><!-- /.widget-main -->

		<div class="toolbar center">
			<a href="#" data-target="#login-box" class="back-to-login-link">
				Back to login
				<i class="ace-icon fa fa-arrow-right"></i>
			</a>
		</div>
	</div><!-- /.widget-body -->
</div><!-- /.forgot-box -->

</div><!-- /.position-relative -->


</div>
</div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.main-content -->
</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>
        <script src="assets/js/jquery.validate.min.js"></script>
		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});

			$(document).ready(function(){
		$('#error_box').fadeOut(100);
    function clearForm(form)
            {
            $(":input", form).each(function()
                {
                var type = this.type;
                    var tag = this.tagName.toLowerCase();
                    if (type == 'text')
                {
                    this.value = "";
                }
                if (type == 'password')
                {
                    this.value = "";
                }
                });
                }

		$("#frmlogin").validate({
                debug: false,
                rules: {
                username: "required",
                pswd: "required",
                },
                messages: {

                },
                submitHandler: function(form) {
                // do other stuff for a valid form
                //showLoader();

                $.post('assets/bin/login.php', $("#frmlogin").serialize(),
                function(data) {

                if(data == "Success")
                {
                     //hideLoader();

                   $(window.location).attr('href', './');
                  $('#alert').fadeOut(200);
                }else
                {

                    $('#error_box').fadeIn(200);
                    $('#error_box').html(data);
                    clearForm('#frmlogin');
                    dotoken();
                    //hideLoader();
                }
                });
                }
                });
	});


function dotoken()
{
	 $.ajax({
      type: 'post',
      data: {tname: 1},
      success: function(resp){
       $('.token').val(resp);
      }
     });
}

		</script>
	</body>
</html>
