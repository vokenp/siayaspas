 <?php
$op = filter_input(INPUT_GET, "view");
//$db->debug=1;
$protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
   $rand = md5(mt_rand());
   $addUrl = "?app=$app&mod=$mod&view=add&ptype=temp&sk=$rand";
   $listUrl = "?app=$app&mod=$mod&view=list&ptype=temp&sk=$rand";

  if ($op == "add") {
    $S_ROWID = "";
    $cid = "";
   
    $btn = "<button type='submit' name='btnSaveRecord' id='btnSaveRecord' class='btn btn-sm btn-success' value='$TableName'><i class='fa fa-edit'></i> Save Record</button>";
    $getColumns = $db->metaColumnNames($TableName);
    foreach ($getColumns as $key => $value) {
       $rst[$value] = "";  
    }
  }
  else
  {
 $cid = filter_input(INPUT_GET, "cid");
$rst = $rs->row($TableName,"S_ROWID='$cid'");
  $arg = array_filter($rst);
    if (empty($arg)) {
      include("assets/pages/404.php");
      exit();
    }
$S_ROWID = "<input type='hidden' name='S_ROWID' id='S_ROWID' value='$cid'>";
$btn = "<button type='submit' name='btnUpdateRecord' id='btnUpdateRecord' class='btn btn-sm btn-success' value='$TableName'><i class='fa fa-edit'></i> Update Record</button>";
   
  }
  
  ?>
<script type="text/javascript">
  $(document).ready(function(){
    var op = $("#op").val();
    $("#frmPageTemp").validate({
        debug: false,
        rules: {
        
        },
        messages: {
          
        },
        submitHandler: function(form) {
        // do other stuff for a valid form
         
        $.post('assets/bin/ManageRecords.php', $("#frmPageTemp").serialize(), 
        function(data) {
          if (data.length < 30)
          {
           
           if(op == "add")
           {
           var urlstr = $("#url").val();
                     var url = urlstr.replace("view=add&", "view=edit&cid="+data+"&");
                     $(window.location).attr('href', "?"+url);
           }
           else
           {
            location.reload();
           }
          }
          else
          {
              Swal.fire(
                  'Oops!',
                  data,
                  'error'
                );
              dotoken();
           
          }
        });
        }
        });

         $("#InvoiceDate").datepicker({
                    autoclose: true,
                    format: 'dd-mm-yyyy',
                    todayHighlight: true
                    
                })
                
                .next().on(ace.click_event, function(){
                    $(this).prev().focus();
                }); 

     //form Submit
       function getFileName(path) {
    var fileNameIndex = path.lastIndexOf("\\") + 1;
    var filenamex = path.substr(fileNameIndex);
    var filename = filenamex.substr(0, filenamex.lastIndexOf('.'));
    return filename;
    }

      $("#uploadedfile").change(function(){
        var fileName = $("#uploadedfile").val();
        $("#DocumentTitle").val(getFileName(fileName));
        $("#DocDescription").html(getFileName(fileName));
      });

   $("#frmUpload").submit(function(evt){   
      evt.preventDefault();
      var formData = new FormData($(this)[0]);
   $.ajax({
       url: 'assets/pages/file-echo2.php',
       type: 'POST',
       data: formData,
       async: false,
       cache: false,
       contentType: false,
       enctype: 'multipart/form-data',
       processData: false,
       success: function (data) {
      var frm = "#frmUpload";  
      $(frm)[0].reset();
      $(frm).trigger("reset");
      $(frm).find(":submit").prop('disabled', false);
      $(frm).find(":submit").html("<i class='ace-icon fa fa-plus icon-on-right bigger-110'> </i> Upload Document"); 
      $(frm).data('submitted', false);
      $("#tblDocuments").DataTable().draw();
       $('#DocUploadModal').modal('hide');
      $("#DocDescription").html("");
       Swal.fire(
                  'Success',
                  data,
                  'success'
                );
              dotoken();
       }
   });
   return false;
 });

   //Get Invoices
    var dataTableInvDocs = $('#tblDocuments').DataTable({
         "Processing": true,
         "serverSide": true,
         "scrollY": "50vh",
         "scrollCollapse": true,
         "bFilter":true,
         "ordering": true,
         "bLengthChange": true,
         "bPaginate": true,
         "pagingType": "simple",
         language: {
        paginate: {
        next: '<i class="fa fa-chevron-right">',
        previous: '<i class="fa fa-chevron-left">'  
       }
       },
          
         "ajax":{
            url :"assets/bin/getInvDocuments.php", // json datasource
            type: "post",  // type of method  , by default would be get
           "data":function(data) {
            data.InvID = $('#InvID').val();
            data.token = $('#token').val();
            
            },

            error: function(et){  // error handling code
              //$("#tblSaccousers_processing").css("display","none");
              alert(JSON.stringify(et));
            }
          }
    });


  });

  function DoEditRecord(RowID)
   {

    bootbox.prompt({
    title: "Please enter new Document name", 
    centerVertical: true,
    callback: function(result){ 
      if (result) 
        { 
               var dialog = bootbox.dialog({
                  title: "Update document",
                  centerVertical: true,
             message: '<p class="text-center mb-0"><i class="fa fa-spin fa-cog bigger-240"></i> <h3>Please wait while we Update Document...</h3></p>',
             closeButton: false
               });
                 var postdata = $("#myForm").serializeArray();
    postdata.push({name: '_token', value: $("#token").val()});
    postdata.push({name: 'DocumentTitle', value: result});
    postdata.push({name: 'btnUpdateDocName', value: RowID});
    $.post("assets/bin/ManageRecords.php", postdata, function(data){ 
         dialog.modal('hide');
         dotoken();
          $("#tblDocuments").DataTable().draw();
           Swal.fire({
                type: 'success',
                title: 'Update Successful',
                showConfirmButton: false,
                timer: 1500
                });
    });
              
              }
            }
            });
        }
   
          

  function dotoken()
{
   $.ajax({
      type: 'post',
      data: {tname: 1},
      success: function(resp){
       $('.token').val(resp);
      }
     });
}
</script>
<input type="hidden" name="op" id="op" value="<?php echo $op;?>">
<input type="hidden" name="url" id="url" value="<?php echo full_path();?>">
<input type="hidden" name="InvID" id="InvID" value="<?php echo $rst["S_ROWID"];?>">
<input type="hidden" name="token" id="token" value="<?php echo  VToken::genT();?>" class="token">
<div class="widget-box">
          <div class="widget-header widget-header-flat">
            <h4 class="widget-title smaller">
              <i class="ace-icon fa fa-list smaller-80"></i>
                <?php echo $rst["InvoiceNo"]."-".$rst["InvoiceDescription"];?>
            </h4>
            <div id="pageToolBar" class="widget-toolbar no-border">
            
               <a href="<?php echo $listUrl;?>" class="btn btn-xs btn-info  radius-4 bigger"> <i class="ace-icon fa fa-arrow-left bigger-80"></i> Back to List </a>

             </div>
          </div>
          
            <?php echo $S_ROWID;?>
        <div class="widget-body">
           <div class="widget-main">
         <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-offset-1">
         <h4 class="header blue bolder smaller">Invoice Info</h4>

           <div class="profile-user-info profile-user-info-striped ">
            <div class="profile-info-row">
              <div class="profile-info-name"> Invoice Type</div>
              <div class="profile-info-value">
                <span class="editable" id="22"><b><?php  echo $rst["InvoiceType"];?></b></span>
              </div>
            </div>
          </div>


           <div class="profile-user-info profile-user-info-striped ">
            <div class="profile-info-row">
              <div class="profile-info-name"> InvoiceNo</div>
              <div class="profile-info-value">
                <span class="editable" id="22"><b><?php  echo $rst["InvoiceNo"];?></b></span>
              </div>
            </div>
          </div>

          <div class="profile-user-info profile-user-info-striped ">
            <div class="profile-info-row">
              <div class="profile-info-name"> Invoice Date</div>
              <div class="profile-info-value">
                <span class="editable" id="22"><b><?php  echo $rst["InvoiceDate"];?></b></span>
              </div>
            </div>
          </div>
          <div class="profile-user-info profile-user-info-striped ">
            <div class="profile-info-row">
              <div class="profile-info-name"> InvoiceAmount</div>
              <div class="profile-info-value">
                <span class="editable" id="22"><b><?php  echo $rst["InvoiceAmount"];?></b></span>
              </div>
            </div>
          </div>
          <div class="profile-user-info profile-user-info-striped ">
            <div class="profile-info-row">
              <div class="profile-info-name"> Description</div>
              <div class="profile-info-value">
                <span class="editable" id="22"><b><?php  echo $rst["InvoiceDescription"];?></b></span>
              </div>
            </div>
          </div>
          <div class="profile-user-info profile-user-info-striped ">
            <div class="profile-info-row">
              <div class="profile-info-name"> InvoiceStatus</div>
              <div class="profile-info-value">
                <span class="editable" id="22"><b><?php  echo $rst["InvoiceStatus"];?></b></span>
              </div>
            </div>
          </div>
        <div class="profile-user-info profile-user-info-striped ">
            <div class="profile-info-row">
              <div class="profile-info-name"> DateCreated</div>
              <div class="profile-info-value">
                <span class="editable" id="22"><b><?php  echo date("D jS M Y g:i A",strtotime($rst["DateCreated"]));?></b></span>
              </div>
            </div>
          </div>
        </div>  <!-- End Col 12 -->

      </div><!-- End Row1 -->
    <div class="space-8"></div>
         <div class="row">
      <div class="col-xs-12">
<div class="tabbable">
  <ul class="nav nav-tabs padding-18 tab-size-bigger" id="myTab">
    <li class="active">
      <a data-toggle="tab" href="#tabDocuments">
        <i class="blue ace-icon fa fa-book bigger-120"></i>
        Documents
      </a>
    </li>

    <li>
      <a data-toggle="tab" href="#tabFleet">
        <i class="green ace-icon  fa fa-comments bigger-120"></i>
         Correspondenses
      </a>
    </li>

   

  </ul>
   <div class="tab-content no-border padding-24">
      <div id="tabDocuments" class="tab-pane fade in active">
         <?php include("InvoiceDocuments.php");?>
      </div>

      <div id="tabFleet" class="tab-pane fade in">
          Here we shall have all the list of Correnspondes
      </div>

      <div id="tabRoutes" class="tab-pane fade in ">
          Routes
      </div>
    </div><!-- Tab-content -->
   </div><!-- Tabbable -->
</div><!-- end col-xs-12 -->
      </div><!-- row2 -->


          </div><!-- End Widget-Main -->
          <div class="widget-toolbox padding-8 clearfix text-center">
             
          </div>
        </div><!-- End Widget-body -->
         
  
</div><!-- End WidgetBox -->