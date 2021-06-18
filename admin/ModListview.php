<script type="text/javascript">
	function DoCheckBox(searchBoxID){
        
       if($("#searchableChbx"+searchBoxID).is(":checked")) {
			   	$("#SearchableID-"+searchBoxID).val("Y");
			}
			else {
				$("#SearchableID-"+searchBoxID).val("N");
			}
	}
</script>
<div class="row">
	<div class="col-xs-10">
		<div class="widget-box">
		  <div class="widget-body">
		  		<form name="frmlistview" id="frmlistview">
		  	  <div class="widget-toolbox padding-8 clearfix text-right">
               	  	<button type="submit" name="btnlistview" id="btnlistview" value="dh_modules" class="btn btn-sm btn-purple"><i class="fa fa-save"></i>Update List View</button>
               </div>
		  <table class="table table-bordered table-striped">
		<thead>
		<tr>
			 <th>#</th>
			<th>Column Name</th>
			<th>Display Name</th>
			<th>Display Order</th>
			 <th>Show</th>
			 <th>Searchable</th>
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
    $checkField = $db->GetRow("select DisplayName,DisplayOrder,searchable from dh_listview where FieldName='$FieldName' and TableName='$ModTableName' and ModuleCode='$ModuleCode'");
     
       //print_r($checkField);
       $arg = array_filter($checkField);
       if (!empty($arg)) {
         $DisplayName = $checkField["DisplayName"];
         $searchable = $checkField["searchable"];
         $DisplayName = $DisplayName != "" ? $DisplayName : $FieldName;
         $DisplayOrder = $checkField["DisplayOrder"];
         $checked = "checked='checked'";
         $ISsearchable = $searchable == "Y" ? "checked='checked'" : "";
       }
        else
        {
      $DisplayName = $db->GetOne("select DisplayName from tbl_columns where ModTableName='$ModTableName' and FieldName='$FieldName'");
       $DisplayName = $DisplayName != "" ? $DisplayName : $FieldName;
       $DisplayOrder = "";
       $checked = "";
       $ISsearchable = "";
       $searchable = "N";
        }

	   
		 	$html .= "<tr id='row-$FieldName'>";
		 	$html .= "<td>$k</td>";
		  $html .= "<input type='hidden' name='FieldName[$FieldName]' id='f-$FieldName' value='$FieldName'>";
		 	$html .= "<td><b>$FieldName</b></td>";
		 	$html .= "<td><input type='text' name='DisplayName[$FieldName]' id='f-$FieldName' value='$DisplayName'></td>";
		 	$html .= "<td><input type='text' name='DisplayOrder[$FieldName]' id='o-$FieldName' class='NumberOnly' value='$DisplayOrder'></td>";
		 	$html .= "<td><input type='checkbox' name='showfield[$FieldName]' id='$FieldName' $checked class='ace ace-switch ace-switch-5'><span class='lbl'></span></td>";
		 	$html .= "<td><input type='checkbox' onclick='DoCheckBox(\"$FieldName\");' id='searchableChbx$FieldName' $ISsearchable class='ace ace-switch ace-switch-5'><span class='lbl'><input type='hidden' name='searchable[$FieldName]' id='SearchableID-$FieldName' value='$searchable'></span></td>";
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