
<div class="row">
	<div class="col-xs-12">
		  <div class="row">
			   	<div class="form-group col-sm-6">
						<label class="col-sm-4 control-label " for="ProfileRoles"> Select Role Profiles </label>
						<div class="col-sm-8">
							 <select name="ProfileRoles[]" id="ProfileRoles" multiple="true" class="form-control col-sm-12">
							 	<?php 
							       $GroupCode = $rst['GroupCode'];
							       $getData = $db->Execute("select S_ROWID,ProfileName from dh_userprofiles where S_ROWID not in (select ItemDescription from listitems where ItemType='RoleProfile' and ItemCode='$GroupCode')");
							       while (!$getData->EOF) {
							        $ProfileID = $getData->fields["S_ROWID"];
							        $ProfileName = $getData->fields["ProfileName"];
							        echo "<option value='$ProfileID'>$ProfileName</option>";
							        $getData->MoveNext();
							       }
							      ?>
					 </select>
						</div>
					</div>
					<div class="form-group col-sm-4">
						<button type="button" name="btnRoleProfiles" id="btnRoleProfiles" class="btn btn-sm btn-success">Add Selected Profiles</button>
					</div>
			   </div>
     <div class="row">
     	  <div class="dataTables_borderWrap">
     	  <table id="tblRoleProfiles" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><input type="checkbox" name="delPCheckAll" id="delPCheckAll"></th>
                  <th>Profile Name</th>
                  <th>Profile Description</th>
                  <th>Created By</th>
                  <th>Date Created</th>
                  
                </tr>
                </thead>
         </table> 
         </div><!-- dataTables_borderWrap -->
     </div>
	</div>
</div>


