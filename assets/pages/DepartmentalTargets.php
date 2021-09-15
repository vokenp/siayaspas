<div class="col-xs-12">
      <div class="widget-box">
        <div class="widget-header widget-header-flat">
          <h4 class="widget-title smaller">
            <i class="ace-icon fa fa-list smaller-80"></i>
              Target List
          </h4>
          <div class="widget-toolbar no-border">
            <a data-toggle='modal' href='#CreateNewObjectives' class='dt-button btn  btn-success btn-bold' title='Add New'><i class='fa fa-plus  fa-lg'></i> Create New Objective </a>
           </div>
        </div>
      <div class="widget-body">
        <table id="tblObjectives" class="table table-bordered table-striped">
            <thead>
                <tr>
                  <th>#</th>
                  <th>Objective</th>
                  <th>AssignedTo </th>
                  <th>CreatedBy</th>
                  <th>Action</th>
                </tr>
              </thead>
          </table>

      </div>
  </div><!-- WidgetBox -->
</div><!-- RightSide -->


<div id="CreateNewObjectives" class="modal fade" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 id="Colh3" class="smaller lighter blue no-margin"><i class="ace-icon fa fa-user icon-on-right bigger-110"></i> Create New Objective </h3>
      </div>
 <form name="frmNewObjectives" id="frmNewObjectives" class="form-horizontal" role="form">
  <div class="modal-body">
  <input type="hidden" name="ModCode" id="ModCode" value="67">
  <input type="hidden" name="TargetID" id="TargetID" value="<?php echo $rst["S_ROWID"];?>">
  <input type="hidden" name="SourceType" id="SourceType" value="Departmental">
   <input type="hidden" name="_token" id="_token2" class="token" >
    <div id="colAlert"></div>
        <input type="hidden" name="ReturnType" id="ReturnType2" value="RstID">
    <div class="row">
    <div class="form-group">
        <label class="col-sm-3 control-label " for="PhoneNo"> Target Description</label>
         <div class="col-sm-9">
           <textarea name="TargetDescription" id="TargetDescription" class="form-control" rows="5"></textarea>
        </div>
      </div>

      <div class="form-group col-sm-10">
       <label class="col-sm-4 control-label " for="UserID" >Target AssignedTo</label>
       <div class="col-sm-8">
         <select id="AssignedTo" name="AssignedTo"    class="col-xs-12 col-sm-12 chosen-select">
           <?php
               $getUsers = $db->GetArray("select *from vw_userslist where loginid<>'$user'  order by S_ROWID desc");
                echo "<option value=''></option>";
               foreach ($getUsers as $ukey => $uval) {
                 $UserID = $uval["loginid"];
                 $FullName = $uval["Fullname"];
                 echo "<option value='$UserID'>$FullName</option>";
               }
           ?>
         </select>
       </div>
     </div>
   </div>

      </div><!-- End ModalBody -->
<div class="modal-footer">
  <button type="submit" id="btnSaveRecord" name="btnSaveRecord"  class="btn btn-sm btn-success">
         <i class="ace-icon fa fa-plus icon-on-right bigger-110"></i> Create Objective
      </button>
        </div>
      </form>
    </div><!-- Modal-content -->
  </div><!-- Modal-Dialog -->
</div><!-- Modal-Div   and-->

 <div id="UpdateObjectives" class="modal fade" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 id="Colh3" class="smaller lighter blue no-margin"><i class="ace-icon fa fa-user icon-on-right bigger-110"></i> Update Objective</h3>
      </div>


 <form name="frmUpdateObjectives" id="frmUpdateObjectives" class="form-horizontal" role="form">
  <div class="modal-body">
   <input type="hidden" name="ModCode" id="ModCode" value="67" >
   <input type="hidden" name="_token" id="_token2" class="token" >
    <div id="colAlert"></div>
        <input type="hidden" name="ReturnType" id="ReturnType2" value="RstID">
     <input type="hidden" name="S_ROWID" id="S_ROWID2" >
   <div class="row">
     <div class="form-group">
         <label class="col-sm-3 control-label " for="PhoneNo"> Objective</label>
          <div class="col-sm-9">
            <textarea name="TargetDescription" id="TargetDescription2" class="form-control" rows="5"></textarea>
         </div>
       </div>

       <div class="form-group col-sm-10">
        <label class="col-sm-4 control-label " for="UserID" >Target AssignedTo</label>
        <div class="col-sm-8">
          <select id="AssignedTo2" name="AssignedTo"    class="col-xs-12 col-sm-12 chosen-select">
            <?php
                $getUsers = $db->GetArray("select *from vw_userslist order by S_ROWID desc");
                 echo "<option value=''></option>";
                foreach ($getUsers as $ukey => $uval) {
                  $UserID = $uval["loginid"];
                  $FullName = $uval["Fullname"];
                  echo "<option value='$UserID'>$FullName</option>";
                }
            ?>
          </select>
        </div>
      </div>
   </div>
      </div><!-- End ModalBody -->
<div class="modal-footer text-center">
  <button type="submit" id="btnUpdateRecord" name="btnUpdateRecord"  class="btn btn-sm btn-success">
        Update Objective
        <i class="ace-icon fa fa-edit icon-on-right bigger-110"></i>
      </button>
        </div>
      </form>
    </div><!-- Modal-content -->
  </div><!-- Modal-Dialog -->
 </div><!-- Modal-Div -->
