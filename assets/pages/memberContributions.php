	<div class="col-xs-12">
				<div class="widget-box">
					<div class="widget-header widget-header-flat">
						<h4 class="widget-title smaller">
							<i class="ace-icon fa fa-list smaller-80"></i>
							  <?php echo $rst["MeetingPeriod"]." Contributions";?>
						</h4>
						
					</div>
				<div class="widget-body"> 
           <div class="space-8"></div> 
          <div class="row">
            <form name="frmMemContrib" id="frmMemContrib" class="form-horizontal" role="form">
    <input type="hidden" name="MeetingID" id="MeetingID" value="<?php echo $cid;?>">
    <input type="hidden" name="_token" id="_token" value="<?php echo  VToken::genT();?>" class="token">
        <div class="row">
          
        <div class="form-group col-sm-4">
          <label class="col-sm-4 control-label " for="UserRole">Mode of Payment</label>
           <div class="col-sm-8">
             <select name="ModeofPayment" id="ModeofPayment" class="form-control"  required="true">
            <?php echo $rs->GetListItems("Cash","ModeofPayment","edit");?>
           </select>
          </div>
       </div> 

       <div class="form-group col-sm-4">
          <label class="col-sm-4 control-label " for="UserRole">Member Name</label>
           <div class="col-sm-8">
             <select name="MemberID" id="MemberID" class="form-control select2"  required="true">
            <?php 
               echo "<option value=''></option>";
              $getType = $db->GetArray("select *from tbl_members order by S_ROWID asc");
               foreach ($getType as $key => $val) {
                 $MemberName = $val["FullName"];
                 $MemberID = $val["S_ROWID"];
                 echo "<option value='$MemberID' >$MemberName</option>";
               }
            ?>
           </select>
          </div>
       </div>
      
        
        </div>

        <div class="row">
           

        <div class="form-group col-sm-4">
          <label class="col-sm-4 control-label " for="UserRole">Contribution Type</label>
           <div class="col-sm-8">
             <select name="ContributionType" id="ContributionType" class="form-control"  required="true">
            <?php 
              echo "<option value=''></option>";
              $getType = $db->GetArray("select *from tbl_contributiontypes");
               foreach ($getType as $key => $val) {
                 $CNType = $val["ContributionName"];
                 $CNAmount = $val["ContributionAmount"];
                 echo "<option value='$CNType' data-value='$CNAmount'>$CNType - $CNAmount</option>";
               }
            ?>
           </select>
          </div>
       </div>

       <div class="form-group col-sm-4">
          <label class="col-sm-4 control-label " for="AmountContributed"> Amount</label>
           <div class="col-sm-8">
             <input type="text" name="AmountContributed" required="true" id="AmountContributed" class="form-control NumbersOnly" >
          </div>
        </div> 

       
        </div> 
        <div class="row">
          <div class="form-group col-sm-4 pull-right">
            <button type="submit" name="btnSaveContrib" id="btnSaveContrib" class="btn btn-success btn-sm"><i class="fa fa-plus "></i> Add</button>
         </div> 
        </div>
              
            </form>
          </div>
					<table id="tblMembersContrib" class="table table-bordered table-striped">
			        <thead>
			            <tr>
			              <th>#</th>
			              <th>Member Name</th>
			              <th>Mode of Payment</th> 
                    <?php
                      $getTypes = $db->GetArray("select distinct ContributionType from tbl_contributions where MeetingID=$cid");
                         foreach ($getTypes as $key => $cvalue) {
                          $contriType = $cvalue["ContributionType"];
                           echo "<th>$contriType</th>";
                         }
                    ?>
						        <th>Amount</th> 
						        <th>Action</th>
			            </tr>
			          </thead>
			      </table>

				</div>
		</div><!-- WidgetBox -->
	</div><!-- RightSide -->


	<div id="CreateNewUser" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 id="Colh3" class="smaller lighter blue no-margin"><i class="ace-icon fa fa-user icon-on-right bigger-110"></i> Create New User </h3>
        </div>
   <form name="frmsaccoNewUser" id="frmsaccoNewUser" class="form-horizontal" role="form">
    <div class="modal-body">
    <input type="hidden" name="SaccoCode" id="SaccoCode" value="<?php echo $rst["SaccoCode"];?>">
     <input type="hidden" name="_token" id="_token2" class="token" >
      <div id="colAlert"></div>
          <input type="hidden" name="ReturnType" id="ReturnType2" value="RstID">

      <div class="form-group">
          <label class="col-sm-3 control-label " for="PhoneNo"> PhoneNo</label>
           <div class="col-sm-9">
             <input type="text" name="PhoneNo" required="true" id="PhoneNo" class="form-control" placeholder="2547123456789" >
          </div>
        </div>     


      <div class="form-group">
          <label class="col-sm-3 control-label " for="FirstName"> First Name </label>
           <div class="col-sm-9">
             <input type="text" name="FirstName" required="true" id="FirstName" class="form-control" >
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3 control-label " for="OtherNames"> Other Names </label>
           <div class="col-sm-9">
             <input type="text" name="OtherNames" required="true" id="OtherNames" class="form-control" >
          </div>
        </div>

      <div class="form-group">
          <label class="col-sm-3 control-label " for="UserEmail"> Email </label>
           <div class="col-sm-9">
             <input type="text" name="UserEmail" required="true" id="UserEmail" class="form-control" >
          </div>
        </div>  

      <div class="form-group">
          <label class="col-sm-3 control-label " for="UserRole">User Role</label>
           <div class="col-sm-9">
             <select name="UserRole" id="UserRole" class="form-control"  required="true">
				<?php echo $rs->GetListItems("","SaccoUserRoles","add");?>
			</select>
          </div>
       </div> 

        </div><!-- End ModalBody -->
<div class="modal-footer">      
    <button type="submit" id="btnSaveSaccoUsers" name="btnSaveSaccoUsers"  class="btn btn-sm btn-success">
         Create User
          <i class="ace-icon fa fa-plus icon-on-right bigger-110"></i>
        </button>
          </div>
        </form>
      </div><!-- Modal-content -->
    </div><!-- Modal-Dialog -->
   </div><!-- Modal-Div -->



   <div id="UpdateSaccoUser" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 id="Colh3" class="smaller lighter blue no-margin"><i class="ace-icon fa fa-user icon-on-right bigger-110"></i> Update User</h3>
        </div>
   <form name="frmsaccoUpdateUser" id="frmsaccoUpdateUser" class="form-horizontal" role="form">
    <div class="modal-body">
   
     <input type="hidden" name="_token" id="_token2" class="token" >
      <div id="colAlert"></div>
          <input type="hidden" name="ReturnType" id="ReturnType2" value="RstID">
       <input type="hidden" name="S_ROWID" id="S_ROWID2" >
      <div class="form-group">
          <label class="col-sm-3 control-label " for="PhoneNo"> PhoneNo</label>
           <div class="col-sm-9">
             <input type="text" name="PhoneNo" required="true" id="PhoneNo2" class="form-control" placeholder="2547123456789"  readonly="true">
          </div>
        </div>     


      <div class="form-group">
          <label class="col-sm-3 control-label " for="FirstName"> First Name </label>
           <div class="col-sm-9">
             <input type="text" name="FirstName" required="true" id="FirstName2" class="form-control" >
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3 control-label " for="OtherNames2"> Other Names </label>
           <div class="col-sm-9">
             <input type="text" name="OtherNames" required="true" id="OtherNames2" class="form-control" >
          </div>
        </div>

      <div class="form-group">
          <label class="col-sm-3 control-label " for="UserEmail"> Email </label>
           <div class="col-sm-9">
             <input type="text" name="UserEmail" required="true" id="UserEmail2" class="form-control" >
          </div>
        </div>  

      <div class="form-group">
          <label class="col-sm-3 control-label " for="UserRole">User Role</label>
           <div class="col-sm-9">
             <select name="UserRole" id="UserRole2" class="form-control"  required="true">
				<?php echo $rs->GetListItems("","SaccoUserRoles","add");?>
			</select>
          </div>
       </div> 

        </div><!-- End ModalBody -->
<div class="modal-footer">      
    <button type="submit" id="btnUpdateSaccoUsers" name="btnUpdateSaccoUsers"  class="btn btn-sm btn-success">
          Update User
          <i class="ace-icon fa fa-edit icon-on-right bigger-110"></i>
        </button>
          </div>
        </form>
      </div><!-- Modal-content -->
    </div><!-- Modal-Dialog -->
   </div><!-- Modal-Div -->

