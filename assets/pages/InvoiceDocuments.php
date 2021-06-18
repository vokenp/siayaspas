	<div class="col-xs-12">
				<div class="widget-box">
					<div class="widget-header widget-header-flat">
						<h4 class="widget-title smaller">
							<i class="ace-icon fa fa-list smaller-80"></i>
							  Invoice Documents
						</h4>
						<div class="widget-toolbar no-border">
							<a data-toggle='modal' href='#DocUploadModal' class='dt-button btn  btn-success btn-bold' title='Uload New'><i class='fa fa-plus  fa-lg'></i> Upload Document </a>
					   </div>
					</div>
				<div class="widget-body">  
					<table id="tblDocuments" class="table table-bordered table-striped">
			        <thead>
			            <tr>
			              <th>#</th>
			              <th>Document Name</th>
						        <th>CreatedBy</th> 
						        <th>Action</th>
			            </tr>
			          </thead>
			      </table>

				</div>
		</div><!-- WidgetBox -->
	</div><!-- RightSide -->
  

    <div id="DocUploadModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 id="Colh3" class="smaller lighter blue no-margin">Upload Invoice </h3>
        </div>
      <form  name="frmUpload" id="frmUpload"   class="form-horizontal">
        <div class="modal-body">

          <div id="colAlert"></div>

            <input type="hidden" name="DocumentTitle" id="DocumentTitle">
            
            <input type="hidden" name="StoragePool" id="StoragePool" value="<?php echo "Invoice-$cid";?>" >

            <div class="row">
            <div class="form-group">
            <label class="col-sm-3 control-label " for="InvoiceNo"> Select Document </label>
            <div class="col-sm-9">
              <input type="file" name="uploadedfile" id="uploadedfile" accept=".pdf" />
            </div>
          </div>
         </div> 

          <div class="row">
            <div class="form-group">
            <label class="col-sm-3 control-label " for="InvoiceDate"> Document Name </label>
            <div class="col-sm-9">
              <textarea  id="DocDescription" name="DocDescription" placeholder="Enter Document description" class="col-xs-10 col-sm-10"  required="true"></textarea>
            </div>
          </div>
          </div>
     


        
          
        </div><!-- End ModalBody -->
                  <div class="modal-footer">      
        <button type="submit" id="btnUploadDoc" name="btnUploadDoc" class="btn btn-sm btn-success">
          <i class="ace-icon fa fa-plus icon-on-right bigger-110"> </i>
          Upload Document
          
        </button>
          </div>
        </form>
      </div><!-- Modal-content -->
    </div><!-- Modal-Dialog -->
   </div><!-- Modal-Div -->