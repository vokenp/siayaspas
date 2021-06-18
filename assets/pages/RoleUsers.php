
<div class="row">
	<div class="col-xs-12">
		  <div class="row">
			   	<div class="form-group col-sm-6">
						<label class="col-sm-4 control-label " for="GroupUsers"> Select Role Users </label>
						<div class="col-sm-8">
							 <select name="GroupUsers[]" id="GroupUsers" multiple="true" class="chosen-select form-control" style="width:99%;">
					  <?php 
					  $GroupCode = $rst['GroupCode'];
					   $getData = $db->Execute("select loginid,Fullname from dh_users where loginid not in (select ItemDescription from listitems where ItemType='RoleUser' and ItemCode='$GroupCode')");
					   while (!$getData->EOF) {
					    $loginid = $getData->fields["loginid"];
					    $FullName = $getData->fields["Fullname"];
					    echo "<option value='$loginid'>$FullName</option>";
					    $getData->MoveNext();
					   }
					  ?></select>
						</div>
					</div>
					<div class="form-group col-sm-4">
						<button type="button" name="btnRoleUsers" id="btnRoleUsers" class="btn btn-sm btn-success">Add Selected Users</button>
					</div>
			   </div>
     <div class="row">
     	  <div class="dataTables_borderWrap">
     	  	<table id="tblRoleUsers" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><input type="checkbox" name="delCheckAll" id="delCheckAll"></th>
                  <th>LoginID</th>
                  <th>FullName</th>
                  <th>User Type</th>
                </tr>
                </thead>
         </table> 
         </div><!-- dataTables_borderWrap -->
     </div>
	</div>
</div>


