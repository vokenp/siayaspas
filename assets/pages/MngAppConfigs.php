<script type="text/javascript">
	$(document).ready(function(){
  
		 $("#frmAppConf").validate({
	debug: false,
	rules: {
	
	},
	
	messages: {
	
	},
	submitHandler: function(form) {
	// do other stuff for a valid form
	//showLoader();
	$.post('assets/bin/MngAppConassfigs.php', $("#frmAppConf").serialize(), 
	function(data) {
		  
      if (data.length < 35) 
      	{ 
          $('#error_box').fadeOut(100);
      	  $('#success_box').fadeIn(200);
          $('#success_box').html(data);
      	}
      	else
      	{
      		$('#success_box').fadeOut(100);
         $('#error_box').fadeIn(200);
	       $('#error_box').html(data);
      	}
	});
	}
	});
	});
</script>
<?php 
 error_reporting(E_ALL);
ini_set('display_errors', 1);
   include("../../assets/bin/con_db.php");
   global $db;
   $ConfType = safehtml($_POST['confType']);
   $tableName = "appconfigs";
   $getConf = $db->Execute("select *from $tableName where ConfType='$ConfType'");
   $html = "<form name='frmAppConf' id='frmAppConf' class='form-horizontal'>";
   
   
   while (!$getConf->EOF) {
     $rst = array();
       $rst = $getConf->fields;
      $AttribLabel = $rst["AttribLabel"];
      $AttribType = $rst["AttribType"];
      $AttribRequired = $rst["AttribRequired"];
      $confName = $rst["confName"];
      $confValue = $rst["confValue"];
      
    $html .= "<div class='row'>";
    $html .= "<div class='form-group col-sm-7'>";
    $html .= "<label class='col-sm-4 control-label' for='$confName'>$AttribLabel</label>";
    $html .= "<div class='col-sm-8'><input type='$AttribType' name='$confName' id='$confName' required='$AttribRequired' value='$confValue' class='col-xs-11 col-sm-11'></div>";
     
    $html .= "</div></div>";
    $getConf->MoveNext();
   }
  
   $html .="<div class='row text-center'><button type='submit' name='btnSaveRecord' id='btnSaveRecord'  value='$ConfType' class='btn btn-success'>Update Settings</button></div>";
		
 
   $html .= "</form>";
   echo $html;
?>