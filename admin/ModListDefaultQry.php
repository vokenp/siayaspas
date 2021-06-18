<div class="row">
	<div class="col-xs-10">
		<div class="widget-box">
		  <div class="widget-body">
		  		<form name="frmlistQuery" id="frmlistQuery">
		  	  <div class="widget-toolbox padding-8 clearfix text-right">
               	  	<button type="submit" name="btnlistQuery" id="btnlistQuery" value="dh_modules" class="btn btn-sm btn-pink"><i class="fa fa-save"></i>Update List Query</button>
               </div>
		  <table class="table table-bordered table-striped">
		<thead>
		<tr>
			 <th>Use</th>
			<th>Column Name</th>
			<th>FilterCondition</th>
			<th>FilterValue</th>
		</tr>
		</thead>
		<tbody>
			<?php 
			  	$html = "<input type='hidden' name='TableName' id='TableName' value='$ModTableName'>";
				$html .= "<input type='hidden' name='ModuleCode' id='ModuleCode' value='$ModuleCode'>";
				$html .= "<input type='hidden' name='ListType' id='ListType' value='Main'>";
				$ColList = $db->MetaColumnNames($ModTableName);
				$k = 0;
				foreach ($ColList as $key => $FieldName) {


		if ($FieldName == "S_ROWID") {
           	continue;
           }
        $k +=1;
        
    			$checkField = $db->GetRow("select FilterCondition,FilterValue from dh_listquery where FieldName='$FieldName' and TableName='$ModTableName' and ModuleCode='$ModuleCode'");
     
       //print_r($checkField);
       $arg = array_filter($checkField);
       if (!empty($arg)) {
         $FilterCondition = $checkField["FilterCondition"];
         $FilterValue = $checkField["FilterValue"];
         $checked = "checked='checked'";
       }
        else
        {
     
       $FilterCondition = "EQUAL";
       $FilterValue = "";
       $checked = "";
        }

	   
		 	$html .= "<tr id='row-$FieldName'>";
		 	$html .= "<td><input type='checkbox' name='showfield[$FieldName]' id='$FieldName' $checked class='ace ace-switch ace-switch-5'><span class='lbl'></span></td>";
		  $html .= "<input type='hidden' name='FieldName[$FieldName]' id='f-$FieldName' value='$FieldName'>";
		 	$html .= "<td><b>$FieldName</b></td>";
		 	$html .= "<td><select name='FilterCondition[$FieldName]' id='f-$FieldName'>".$rs->GetListItems($FilterCondition,"filterConditions","edit")."</td>";
		 	$html .= "<td><input type='text' name='FilterValue[$FieldName]' id='o-$FieldName'  value='$FilterValue'></td>";
		 	$html .= "</tr>";
				}
				echo $html;
			?>
		</tbody>
	</table>
	</form>
</div><!-- end Widget-Body -->
</div><!-- End Widget-Box -->
	</div>
</div>