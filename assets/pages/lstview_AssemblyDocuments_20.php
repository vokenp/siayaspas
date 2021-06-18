<script type="text/javascript">
  $(document).ready(function(){

   var CurDocType = $("#CurDocType").val();
   if (CurDocType == "") 
   {
    $("#btnUpNew").hide();
   }
   else
   {
     $("#btnUpNew").show();
   }

    var dataTable = $('#TblDocTypes').DataTable({
         "Processing": true,
         "serverSide": true,
         "scrollY": "60vh",
         "scrollCollapse": true,
         "bFilter":false,
         "ordering": true,
         "pagingType": "simple",
         "bLengthChange": false,
         "bPaginate": false,
         language: {
        paginate: {
        next: '<i class="fa fa-chevron-right">',
        previous: '<i class="fa fa-chevron-left">'  
       }
       },
          
         "ajax":{
            url :"assets/bin/getAssemblyDocTypes.php", // json datasource
            type: "post",  // type of method  , by default would be get
           "data":function(data) {
            //data.FileID = $('#FileID').val();
            //data.SearchQry = $('#SearchQry').val();
            //data.SearchField = $('#SearchField').val();
            },

            error: function(){  // error handling code
              $("#TblDocTypes_processing").css("display","none");
            }
          }
    });

    


  });


   function OpenDocType(DocType)
   {
       $("#tDef").html("Document Panel : <b>"+DocType+"</b>");
       $("#Colh3").html("<b>Upload new: "+DocType+"</b>");
       $("#CurDocType,#DocumentCategory").val(DocType);
       $("#TblDocuments").DataTable().draw();
       $("#btnUpNew").show();;
      // $("#tblToolBar").show();
   }

     function RemoveDocument(DocumentID)
   {
       
     bootbox.prompt({
    title: "Enter reason for deleting this Document", 
    centerVertical: true,
    callback: function(result){ 
         if (result) 
          { 
              var dialog = bootbox.dialog({
                  title: "Delete Records",
                  centerVertical: true,
             message: '<p class="text-center mb-0"><i class="fa fa-spin fa-cog bigger-240"></i> <h3>Please wait while the Document is been deleted...</h3></p>',
             closeButton: false
               });
                 $.post("assets/bin/ManageRecords.php", {btnDeleteKCADocument: ""+DocumentID+"",Reason: ""+result+""}, function(data){
                 
                  $("#error_box").html(data);
                  $("#TblDocuments").DataTable().draw();
                  dialog.modal('hide');
                  });
          }

    }
});        
    }
</script>
<div class="row">
  <input type="hidden" name="CurDocType" id="CurDocType">
      <div class="col-xs-12">
        <div class="col-xs-3">
        <div class="widget-box">
          <div class="widget-header widget-header-flat">
            <h4 class="widget-title smaller">
              <i class="ace-icon fa fa-list smaller-80"></i>
              Document Category
            </h4>
            <div class="widget-toolbar no-border">
      
             </div>

          </div>
        <div class="widget-body">
          <table id="TblDocTypes" class="table table-bordered table-striped">
              <thead>
                  <tr>

                    <th>Document Category</th>
                  </tr>
                </thead>
            </table>

        </div>





        </div><!-- WidgetBox -->
        </div><!-- LeftSide -->

          <div class="col-xs-9">
                <div class=" widget-box">
                  <div class="widget-header widget-header-flat">
            <h4 class="widget-title smaller">
              <i class="ace-icon fa fa-list smaller-80"></i>
              <span id="tDef">Document Panel : </span>
            </h4>

            <div id="tblToolBar" class="widget-toolbar no-border">
              <a data-toggle="modal" id="btnUpNew" href="#DocUploadModal" class="btn btn-xs btn-success bigger">
                <i class="ace-icon fa fa-plus"></i>
                Upload New Document
              </a>
             
             </div>

          <div class="widget-body">
          

          <table id="TblDocuments" class="table table-bordered table-striped">
              <thead>
                  <tr>
                    <th>#</th>
                    <th>Document Name</th>
                    <th>Document Date</th> 
                    <th>CreatedBy</th> 
                    <th>DateCreated</th> 
                    <th>Actions</th> 
               
                  </tr>
                </thead>
            </table>
        </div>


                </div><!-- WidgetBox -->
                </div><!-- RightSide -->
 

       </div>  <!-- End col-xs-12 -->
      </div><!-- End Row -->
   </div><!-- End Page-content -->

   <div id="DocUploadModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 id="Colh3" class="smaller lighter blue no-margin">Upload : </h3>
        </div>
        <form name="frmUploadNew" id="frmUploadNew" class="form-horizontal" role="form">
        <div class="modal-body">

          <div id="colAlert"></div>
            <input type="hidden" name="DocumentCategory" id="DocumentCategory">
          <div class="form-group">
            <label class="col-sm-3 control-label " for="DocumentDate"> Document Date </label>
            <div class="col-sm-9">
              <input type="text" id="DocumentDate" name="DocumentDate" placeholder="Select Document Date" class="col-xs-10 col-sm-10 date-picker"  required="true" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label " for="DocumentTitle"> DocumentTitle </label>
            <div class="col-sm-9">
              <input type="text" id="DocumentTitle" name="DocumentTitle" placeholder="DocumentTitle" class="col-xs-10 col-sm-10" required="true" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label " for="DocumentTitle"> Select Document </label>
            <div class="col-sm-9">
              <input type="file" id="DocFile" name="DocFile" accept=".pdf" />
            </div>
          </div>

  
        </div><!-- End ModalBody -->
                  <div class="modal-footer">      
  <button type="submit" id="btnUploadDoc" name="btnUploadDoc" class="btn btn-sm btn-success">
          Upload Document
          <i class="ace-icon fa fa-plus icon-on-right bigger-110"></i>
        </button>
          </div>
        </form>
      </div><!-- Modal-content -->
    </div><!-- Modal-Dialog -->
   </div><!-- Modal-Div -->


   <script type="text/javascript">
     $('#DocFile').ace_file_input({
          no_file:'No File ...',
          btn_choose:'Choose',
          btn_change:'Change',
          droppable:false,
          onchange:null,
          thumbnail:false //| true | large
          whitelist:'pdf',
          //blacklist:'exe|php'
          //onchange:''
          //
        });
   </script>