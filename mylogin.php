 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" type="image/png" href="favicon.png">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="description" content=".">
<meta name="site" content="emed">

<meta name="keywords" content="">
<title>Trinit - Admin Panel</title>
<link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
			$(document).ready(function(){
			$('.error_box').fadeOut(200);
			  function showLoader(){
			$('.search-background').fadeIn(200);
			}
			function hideLoader(){
				$('.search-background').fadeOut(200);
				};
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
				};

				$("#clogin").validate({
				debug: false,
				rules: {
				username: "required",
		        pswd: "required",
				},
				messages: {
				
				},
				submitHandler: function(form) {
				// do other stuff for a valid form
				showLoader();
				$.post('bin/login.php', $("#clogin").serialize(), 
				function(data) {
				if(data == "Success")
				{
				 
                   $(window.location).attr('href', './');
				   hideLoader();
				}else
				{
				    $('.error_box').fadeIn(200);
					$('.error_box').html(data);
					clearForm('#clogin');
					hideLoader();
				}
				});
				}
				});
			});
	</script>
</head>
<body>
 <img src="img/wall1.jpg" class="bg"> 
  <div id="login">
   <h4>Trinit - Admin Panel</h4>
    <div class="search-background">
    	<label><img src="img/loader.gif" alt="" align="center" /> &nbsp;&nbsp;Logging......</label>
    </div>
     <div class="error_box"></div>
   <form name="clogin" id="clogin">
   <table>
    <tr>
		<td>
	    <img src="img/reset.png" width="100%" height="100%"/>
		</td>
		<td>
			<table>
			  
			   <tr>
					<td>UserName</td><td><Input type="text" name="username" id="username" /></td>
			   </tr>
			   <tr>
					<td>Password</td><td><Input type="password" name="pswd" id="pswd" /></td>
			   </tr>
			  
			   <tr>
					<td></td><td><button type="submit" class="button" >Login</button></td>
			   </tr>
			   
			   </table>
		</td>
	 </tr>
   </table>
   </form>

   </div>
  <footer >
  <p><small>&copy; Copyright <?php echo date('Y');?>, <a href="http://www.intellihub.co.ke">Intellihub Technology Systems Ltd</a></small></p>
</footer>
 
</body>
</html>
  