<?php 
  unset($_GET['sk']);
  $mod = $_GET['mod'];
  $pvals = array();
  $token = VToken::genT();
  foreach ($_GET as $key => $val) {
   $pvals[] = $key.":".$val;
  }
  $postvals = implode(',',$pvals);
  $dateTypes = array('date','timestamp','datetime');
   $modInfo    = $rs->row("dh_modules","S_ROWID = '$mod'");
   //$db->debug=1;
 $ModuleCode = $modInfo["ModuleCode"];
$ModuleName = $modInfo["ModuleName"];
$TableName = $modInfo["TableName"];
$IsDelete = $modInfo["DeleteItems"];
$EnableCreate = $modInfo["EnableCreation"];

$modUrl = $rs->Modurl($ModuleCode);
 $LinkUrl = str_replace('view=edit',"view=add", $modUrl);
 $GroupAddLink = "<a data-toggle='modal' href='#ComposeSMS' class='dt-button btn btn-white btn-primary btn-bold' title='Send To Group'><i class='fa fa-plus  fa-lg'></i> Compose SMS</a>";
 

$MetaColumns = $db->MetaColumns($TableName);
$MetaType = array();
   foreach ($MetaColumns as $key => $vals) {
     $ColDef = (array)$vals;
     $MetaType[$ColDef["name"]] = $ColDef["type"];
   }

$getCols = $db->GetArray("select FieldName,DisplayName,searchable from dh_listview where ModuleCode='$ModuleCode' and ListType='Main' order by DisplayOrder asc");
    //$colst = $rs->getCols("dh_listview");
    $dFields = array();
  $dCols = array(); 
 
     $chkbox = array();
     $chkbox["targets"] = 0;
     $chkbox["checkboxes"] = array("selectRow" => true);
     $dCols[] = $chkbox;
    $dCols[] = array("targets" => 1, "visible" => true,"sortable" => false,"searchable" => false,"name" => "View");
      $tIndex = 1;
     $exportCols = array();
     foreach ($getCols as $val) {
      $type = $MetaType[$val["FieldName"]];
      $searchable = $val["searchable"] == "Y" ? true : false;
      $dFields[] = $val["DisplayName"]; 
      $gdata[] = $val["FieldName"]; 
      $tIndex += 1;
      $dCols[] = array("targets" => $tIndex, "title" => $val["DisplayName"],"name" => $val["FieldName"],"searchable" => $searchable);
       $exportCols[$tIndex] = $tIndex;
     }
     
     $Excol = array();
     $Excol["columns"] = array_keys($exportCols);


     $btnPrint = array();
     $btnPrint["extend"] = "print";
     $btnPrint["title"] = $ModuleName." List";
     $btnPrint["text"] = "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>";
     $btnPrint["className"] =  "btn btn-white btn-primary btn-bold";
     $btnPrint["autoPrint"] = false;
     //$btnPrint["message"] = $ModuleName." List";
     $btnPrint["exportOptions"] = $Excol;

     $btnDelete = array();
    $btnDelete["text"] = "<i class='fa fa-trash bigger-110 red'></i><span class='hidden'>Copy to clipboard</span>";
    $btnDelete["className"] = "btn btn-white btn-primary btn-bold";
    $btnDelete["titleAttr"] = "Delete Selected Records";
    $btnDelete["idAttr"] = "btnDelete2";
    $btnDelete["attr"] = array("title"=> " delete Hii","id"=>"btnDelete2");
    //$btnDelete["action"] = 'function ( e, dt, node, config ) {doRecordDelete();}';

   $pdf = array();
    $pdf["extend"] = "pdfHtml5";
    $pdf["title"] = $ModuleName." List";
    $pdf["orientation"] = "portrait";
    $pdf["className"] =  "btn btn-white btn-primary btn-bold";
    $pdf["text"] = "<i class='fa fa-file-pdf-o bigger-110 red'></i>";
    $pdf["titleAttr"] = "Generate PDF Report";
    $pdf["exportOptions"] = $Excol;
  
   $btnExcel = array();
    $btnExcel["title"] = $ModuleName." List";
    $btnExcel["className"] =  "btn btn-white btn-primary btn-bold";
    $btnExcel["text"] = "<i class='fa fa-file-excel-o bigger-110 green'></i>";
    $btnExcel["titleAttr"] = "Generate Excel";
    //$btnExcel["exportOptions"] = $Excol;


      $btnlist = array();
     
      $btnlist[] = $btnPrint;
    
   
      
?>
  
        <div class="widget-box">
          <div class="widget-header widget-header-flat">
            <h4 class="widget-title smaller">
              <i class="ace-icon fa fa-list smaller-80"></i>
                <?php echo $ModuleName;?>
            </h4>
            <div id="listToolBar" class="widget-toolbar no-border">
              
             </div>

          </div>
        <div class="widget-body">
          <div class="error_box"></div>
          <div class="dataTables_borderWrap">
          <table id="tblListView" class="table table-bordered table-striped"></table>
         </div><!-- dataTables_borderWrap -->
        </div>
        </div><!-- WidgetBox -->  
<input type="hidden" id="qrysmt" name="qrysmt">

<input type="hidden" name="token" id="token" value="<?php echo $token;?>" class="token">
<input type="hidden" name="modCode" id="modCode" value="<?php echo $mod;?>">
<input type="hidden" name="enDeleteItems" id="enDeleteItems" value="<?php echo $rst["DeleteItems"];?>">
<input type="hidden" name="EnableCreation" id="EnableCreation" value="<?php echo $rst["EnableCreation"];?>">

<input type="hidden" name="" id="btnGAdd" value="<?php echo $GroupAddLink;?>">
  <script type="text/javascript">
    jQuery(function($) {
     $("#TemplateID").change(function(){
      var TempBody = $(this).find(':selected').data('value');
      $("#MessageBody").val(TempBody);
      charCount();
   });



     $('#MessageBody').keyup(function () {
      charCount();
     });

      $("#SendChannel").change(function()
  {
      var SendChannel = $(this).val();
        if (SendChannel == "Individuals") 
        {
         $('#GroupSMSList').empty(); //remove all child nodes
        }
        else
        {
          $.post('assets/bin/ManageGroups.php', {getGroupSMSList :""+SendChannel+""}, 
        function(data) {

        $('#GroupSMSList').empty(); //remove all child nodes
        $('#GroupSMSList').append(data);
        $('#GroupSMSList').trigger("chosen:updated");
        });
        }

  }); 

      var dateToday = new Date();
      $("#SendDate").datepicker({
                    autoclose: true,
                    format: 'dd-mm-yyyy',
                    todayHighlight: true,
                    minDate : dateToday
                })
                
                .next().on(ace.click_event, function(){
                    $(this).prev().focus();
                }); 
  
    

    $("#SendTime").timepicker({
      timeFormat: 'HH:i',
      showInputs: false
    });

    $("#GroupSMSList").chosen({width: '85%'});

     $("#MessageType option[value='']").remove();
      $("#SendChannel option[value='']").remove();
     $("#SendFrequency option[value='']").remove();

     $("#MessageType").change(function(){
     checkMsgType();
     
   });

      $("#SendFrequency").change(function(){
     checkSendType();
   });

      checkMsgType();
     checkSendType();
   function checkMsgType()
    {
      var MsgType = $("#MessageType").val();
     if (MsgType == "Composed") 
      { 
        $("#MessageBody").val("");
        $("#TempDiv").hide();

       }
       else
       {
        $("#TempDiv").show();
        $("#MessageBody").val("");
       }
    }

function checkSendType()
    {
      var SendType = $("#SendFrequency").val();
     if (SendType == "SendNow") 
      { 
        $("#SendDate").val("");
        $("#SendLater").hide();

       }
       else
       {
        $("#SendLater").show();
        $("#SendDate").html("");
       }
    }
    // Save SMM
      $("#frmNewSMS").validate({
debug: false,
rules: {

},
messages: {
  
},
submitHandler: function(form) {
// do other stuff for a valid form
   $.post('assets/bin/ManageSMSOut.php', $("#frmNewSMS").serialize(), function(data) {
    
    if (data.length < 30)
    {
    
    $(".close").click();
    var frm = "#frmNewSMS";
    $(frm)[0].reset();
    $(frm).trigger("reset");
    $(frm).find(":submit").prop('disabled', false);
     $('#GroupSMSList').empty(); //remove all child nodes
     $(frm).find(":submit").html("<i class='fa fa-send'></i> Send Message"); 
    $(frm).data('submitted', false);
    $(frm).modal("hide");
    $("#MsgSpan").html("");
    $('#tblListView').DataTable().draw();
    dotoken();
    }
    else
    {
    $('.success_box').fadeOut(200);
    $('.error_box').fadeIn(200);
    $('.error_box').html(data);
   
    }
});
}
});
        //initiate dataTables plugin
         var dcols = <?php echo json_encode($dCols); ?>;
        var btnlist = <?php echo json_encode($btnlist); ?>;
         
         var dtListView = $('#tblListView').wrap("<div class='dataTables_borderWrap' />").DataTable({
         "Processing": true,
         "serverSide": true,
         "scrollY": "65vh",
         "sScrollX": "100%",
         "scrollCollapse": true,
         "bFilter":true,
         "ordering": true,
         "paging": true,
         "pagingType": "full",
         "order": [[ 2, 'desc' ]],
         "columnDefs": dcols, 
         "lengthMenu": [[20,50, 100, 200], [20,50, 100, 200]],
         "select": {
         "style": "multi"
          },
          "ajax":{
            url :"getListViewData.php", // json datasource
            type: "post",  // type of method  , by default would be get
           "data":function(data) {
            data.ModCode = $('#modCode').val();
            data.token = $('#token').val();
              //alert(JSON.stringify(data));
            },

            error: function(){  // error handling code
              $("#tblListView_processing").css("display","none");
            }
          }
          
    });


    dtListView.on('xhr', function() {
  var ajaxJson = dtListView.ajax.json();
  $("#qrysmt").val(ajaxJson.QryParams.qrysmt);
   dotoken();
});

         new $.fn.dataTable.Buttons( dtListView, {
          buttons: btnlist
        } );
        dtListView.buttons().container().appendTo( $('#listToolBar') );
        var delBtn = "<a id='btnDelete' class='dt-button btn btn-white btn-primary btn-bold'> <i class='fa fa-trash bigger-110 red' title='Delete Selected Records'></i></a>";
        var excelBtn = "<a id='btnExcel' class='dt-button btn btn-white btn-primary btn-bold'> <i class='fa fa-file-excel-o bigger-110 green' title='Export to Excel'></i></a>";

        var pdfBtn = "<a id='btnPDF' class='dt-button btn btn-white btn-primary btn-bold'> <i class='fa fa-file-pdf-o bigger-110 red' title='Export to PDF'></i></a>";

        var reload = "<a id='btnReload' class='dt-button btn btn-white btn-primary btn-bold'> <i class='fa fa-refresh bigger-110 blue' title='Refresh'></i></a>";
          
          $(".dt-buttons").append($(excelBtn));
          $(".dt-buttons").append($(pdfBtn));
          if ($("#enDeleteItems").val() == "Y") 
          {
             $(".dt-buttons").append($(delBtn));
          }

          

          
        
         $(".dt-buttons").prepend($(reload));

         if ($("#EnableCreation").val() == "Y") 
          { 
           
            var btnGAdd = $("#btnGAdd").val();
             
             $(".dt-buttons").prepend($(btnGAdd));
            
          }

         $("#btnReload").click(function(){
          $('#tblListView').DataTable().draw();
         });

        $("#btnDelete").click(function(){
          doRecordDelete();
        });

        $("#btnExcel").click(function(){
            var modCode = $('#modCode').val();
            var qrysmt = $('#qrysmt').val();
             $(window.location).attr('href', "doExcelExport.php?modCode="+modCode+"&qrysmt="+qrysmt);
        });

          $("#btnPDF").click(function(){
            var modCode = $('#modCode').val();
            var qrysmt = $('#qrysmt').val();
             $(window.location).attr('href', "dopdfexport.php?modCode="+modCode+"&qrysmt="+qrysmt);
        });


         function doRecordDelete(){
          var selectedrows = new Array();
        var rows_selected = dtListView.column(0).checkboxes.selected();
        $.each(rows_selected, function(index, rowId){
            selectedrows.push(rowId);
        });
          
          if (selectedrows.length != 0) 
            {
              bootbox.confirm({
                centerVertical: true,
            message: "Are you sure you want to Delete selected Records?",
            buttons: {
              confirm: {
               label: "Delete Records",
               className: "btn-danger btn-sm",
              },
              cancel: {
               label: "Cancel",
               className: "btn-sm",
              }
            },
            callback: function(result) {
              if(result)
              {
                var q = JSON.stringify(selectedrows);
                var mod = $('#modCode').val();
                 var dialog = bootbox.dialog({
                  title: "Delete Records",
                  centerVertical: true,
             message: '<p class="text-center mb-0"><i class="fa fa-spin fa-cog bigger-240"></i> <h3>Please wait while records are been deleted...</h3></p>',
             closeButton: false
               });
                $.post("assets/bin/ManageRecords.php", {DeleteMultiple: ""+q+"",mod: ""+mod+""}, function(data){
                  $('#tblListView').DataTable().draw();
                  dialog.modal('hide');
                  });
              }
            }
            });
            }
      }
       
          });


 function charCount()
{
  var max = 500;
  var len = $("#MessageBody").val().length;
  var MsgCount = Math.ceil(len / 140);
    if (MsgCount > 1) 
    {
      $("#MsgSpan").removeClass("text-green").addClass("text-yellow");
    }
    else
    {
      $("#MsgSpan").removeClass("text-yellow").addClass("text-green");
    }

   $('#MsgSpan').text(len + ' characters, '+MsgCount+' Message(s)');
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

<div id="ComposeSMS" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 id="Colh3" class="smaller lighter blue no-margin">Compose SMS  </h3>
        </div>
        <form name="frmNewSMS" id="frmNewSMS" class="form-horizontal" role="form">
        <div class="modal-body">

          <div id="colAlert"></div>
                    <input type="hidden" name="ModCode" id="ModCode" value="<?php echo $ModuleCode;?>">
                    <input type="hidden" name="ReturnType" id="ReturnType" value="RstID">

    <div class="form-group">
      <label class="col-sm-3 control-label" for="SendChannel">Send To:</label>
      <div class="col-sm-9">
      <select name="SendChannel" id="SendChannel" required="true" class="col-xs-10 col-sm-10">
        <?php echo $rs->GetListItems("SendChannel","SendChannel","edit");?>
      </select>
     </div>
   </div>

  
   <div class="form-group">
      <label class="col-sm-3" for="GroupList">Select Recipients</label>
      <div class="col-md-9">
        <select name="GroupSMSList[]" id="GroupSMSList" multiple="true" required="true" class="form-control col-xs-10 col-md-10" > </select>
    </div>
  </div>
 

      
    <div class="form-group">
      <label class="col-sm-3 control-label" for="MessageType">MessageType:</label>
      <div class="col-sm-9">
      <select name="MessageType" id="MessageType" required="true" class="col-xs-10 col-sm-10">
        <?php echo $rs->GetListItems("Composed","MessageType","edit");?>
      </select>
     </div>
   </div>

     <div class="form-group" id="TempDiv">
      <label class="col-sm-3 control-label" for="TemplateID">SMS Template:</label>
      <div class="col-sm-9">
      <select name="TemplateID" id="TemplateID" required="true" class="col-xs-10 col-sm-10">
        <?php 
         $getTemps = $db->Execute("select S_ROWID,TemplateName,TemplateBody from tbl_smstemplates order by TemplateName asc");
         echo "<option value='' data-value=''></option>";
           while (!$getTemps->EOF) {
             $TempID = $getTemps->fields["S_ROWID"];
             $TempName = $getTemps->fields["TemplateName"];
             $TempBody = $getTemps->fields["TemplateBody"];
             echo "<option value='$TempID' data-value='$TempBody'>$TempName</option>";
             $getTemps->MoveNext();
           }
        ?>
      </select>
     </div>
    </div>
  
          
        <div class="form-group">
          <label class="col-sm-3 control-label " for="CustomerName"> Message </label>
          <span class="text-green" id="MsgSpan"></span>
           <div class="col-sm-9">
             
            <textarea id="MessageBody" name="MessageBody" class="col-xs-10 col-sm-10"></textarea>
          </div>
        </div>
        
         <div class="form-group">
            <label class="col-sm-3 control-label" for="SendFrequency">When to Send:</label>
            <div class="col-sm-9">
                <select name="SendFrequency" id="SendFrequency" required="true" class="col-xs-10 col-sm-10">
                  <?php echo $rs->GetListItems("SendNow","SendFrequency","edit");?>
                </select>
            </div>
        </div>

        <div class="form-group">
           <div class="col-md-9 col-sm-offset-2" id="SendLater">
        <div class="col-md-6" >
          <label class="control-label" for="SendDate">Send On Date:</label>
          <input type="text" name="SendDate" required="true" id="SendDate" class="form-control DDate" >
        </div>
        <div class="col-md-6 bootstrap-timepicker" >
          <label class="control-label" for="SendTime">Time:</label>
           <input type="text" name="SendTime" required="true" id="SendTime" class="form-control timepicker" >
         </div>
     </div>
        </div>

          
         

        </div><!-- End ModalBody -->
                  <div class="modal-footer">      
  <button type="submit" id="btnSaveRecord" name="btnSaveRecord" value="tbl_customers" class="btn btn-sm btn-success">
    Save Customer
          <i class="ace-icon fa fa-plus icon-on-right bigger-110"></i>
        </button>
          </div>
        </form>
      </div><!-- Modal-content -->
    </div><!-- Modal-Dialog -->
   </div><!-- Modal-Div -->



  
  