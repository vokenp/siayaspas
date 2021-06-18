
<div class="row">
	<div class="col-xs-12">
		  <div class="row" id="btnset">
		  	  <div class="form-group col-sm-4">
						<label class="col-sm-4 control-label " for="MemberType"> MemberType</label>
						<div class="col-sm-8">
							 <select name="MemberType" id="MemberType" class="form-control" style="width:99%;">
							 	<?php echo $rs->GetListItems("Member","CommitteRanks","edit");?>
					    </select>
						</div>
					</div>
			   	<div class="form-group col-sm-8">
						<label class="col-sm-2 control-label " for="ComMbers"> Members</label>
						<div class="col-sm-10">
							 <select name="ComMembers[]" id="ComMembers" multiple="true" class="chosen-select form-control" style="width:99%;">
					  <?php 
					 
					   $getData = $db->Execute("select S_ROWID,FullName from committemembers where S_ROWID not in  (select MemID from vw_plenaryattendance where MeetingID='$cid' )");
					   while (!$getData->EOF) {
					    $MemID = $getData->fields["S_ROWID"];
					    $FullName = $getData->fields["FullName"];
					    echo "<option value='$MemID'>$FullName</option>";
					    $getData->MoveNext();
					   }
					  ?></select>
						</div>
					</div>
					
			   </div>
			  <div class="row btnset">
			  	<div class="form-group col-sm-4 pull-right">
						<button type="button" name="btnPlenaryAttendance" id="btnPlenaryAttendance" class="btn btn-sm btn-success">Add Selected Members</button>
					</div>
			  </div>
     <div class="row">
     	  <div class="dataTables_borderWrap">
     	  	<table id="tblMemberList" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><input type="checkbox" name="delCheckAll" id="delCheckAll"></th>
                  <th>ProfileImg</th>
                  <th>FullName</th>
                  <th>Ward</th>
                  
                  <th>InAttendancePosition</th>
                </tr>
                </thead>
         </table> 
         </div><!-- dataTables_borderWrap -->
     </div>
	</div>
</div>


