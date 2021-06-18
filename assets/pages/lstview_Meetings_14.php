<?php 
  unset($_GET['sk']);
  $mod = $_GET['mod'];
  $pvals = array();
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
 $AddLink = "<a href='$LinkUrl' class='dt-button btn btn-white btn-primary btn-bold' title='Add New'><i class='fa fa-plus  fa-lg'></i> Add New</a>";

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
    $btnExcel["extend"] = "excelHtml5";
    $btnExcel["title"] = $ModuleName." List";
    $btnExcel["className"] =  "btn btn-white btn-primary btn-bold";
    $btnExcel["text"] = "<i class='fa fa-file-excel-o bigger-110 green'></i>";
    $btnExcel["titleAttr"] = "Generate Excel";
    //$btnExcel["exportOptions"] = $Excol;


      $btnlist = array();
     // $btnlist[] = $btnDelete;
  
      $btnlist[] = $btnPrint;
   
      
?>
  
        <div class="widget-box">
          <div class="widget-header widget-header-flat">
            <h4 class="widget-title smaller">
              <i class="ace-icon fa fa-list smaller-80"></i>
                <?php echo $ModuleName." List";?>
            </h4>
            <div id="listToolBar" class="widget-toolbar no-border">
              
             </div>

          </div>
        <div class="widget-body">
          <div class="dataTables_borderWrap">
          <table id="tblListView" class="table table-bordered table-striped"></table>
         </div><!-- dataTables_borderWrap -->
        </div>
        </div><!-- WidgetBox -->  
<input type="hidden" name="modCode" id="modCode" value="<?php echo $mod;?>">
<input type="hidden" name="enDeleteItems" id="enDeleteItems" value="<?php echo $rst["DeleteItems"];?>">
<input type="hidden" name="EnableCreation" id="EnableCreation" value="<?php echo $rst["EnableCreation"];?>">
<input type="hidden" name="" id="btnAdd" value="<?php echo $AddLink;?>">
  <script type="text/javascript">
    jQuery(function($) {


        //initiate dataTables plugin
         var dcols = <?php echo json_encode($dCols); ?>;
        var btnlist = <?php echo json_encode($btnlist); ?>;
         //var btnAdd = <?php echo $AddLink ;?>;
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
              //alert(JSON.stringify(data));
            },

            error: function(){  // error handling code
              $("#tblListView_processing").css("display","none");
            }
          }
          
    });

         new $.fn.dataTable.Buttons( dtListView, {
          buttons: btnlist
        } );
        dtListView.buttons().container().appendTo( $('#listToolBar') );
        var delBtn = "<a id='btnDelete' class='dt-button btn btn-white btn-primary btn-bold'> <i class='fa fa-trash bigger-110 red' title='Delete Selected Records'></i></a>";

        var reload = "<a id='btnReload' class='dt-button btn btn-white btn-primary btn-bold'> <i class='fa fa-refresh bigger-110 blue' title='Refresh'></i></a>";
          
          if ($("#enDeleteItems").val() == "Y") 
          {
             $(".dt-buttons").append($(delBtn));
          }

          
        
         $(".dt-buttons").prepend($(reload));

         if ($("#EnableCreation").val() == "Y") 
          { 
            var btnAdd = $("#btnAdd").val();
             $(".dt-buttons").prepend($(btnAdd));
          }

         $("#btnReload").click(function(){
          $('#tblListView').DataTable().draw();
         });

        $("#btnDelete").click(function(){
          doRecordDelete();
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
                 
                $.post("assets/bin/ManageRecords.php", {DeleteMultiple: ""+q+"",mod: ""+mod+""}, function(data){
                  $('#tblListView').DataTable().draw();
                  
                  });
              }
            }
            });
            }
      }
       
          });
  </script>



  