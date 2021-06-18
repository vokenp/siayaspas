	<div class="col-xs-12">
				<div class="widget-box">
					<div class="widget-header widget-header-flat">
						<h4 class="widget-title smaller">
							<i class="ace-icon fa fa-list smaller-80"></i>
							  List of Sacco Users
						</h4>
						<div class="widget-toolbar no-border">
							<a data-toggle='modal' href='#CreateNewUser' class='dt-button btn  btn-success btn-bold' title='Add New'><i class='fa fa-plus  fa-lg'></i> Create New User </a>
					   </div>
					</div>
				<div class="widget-body">  
					<table id="tblSaccousers" class="table table-bordered table-striped">
			        <thead>
			            <tr>
			              <th>#</th>
			              <th>PhoneNo</th>
			              <th>Full Name</th> 
						  <th>Email</th> 
						  <th>UserRole</th> 
						  <th>UserStatus</th>
						  <th>CteatedBy</th> 
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

