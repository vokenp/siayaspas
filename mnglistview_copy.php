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
$TableName = $modInfo["TableName"];
$IsDelete = $modInfo["DeleteItems"];
$MetaColumns = $db->MetaColumns($TableName);
$MetaType = array();
   foreach ($MetaColumns as $key => $vals) {
     $ColDef = (array)$vals;
     $MetaType[$ColDef["name"]] = $ColDef["type"];
   }

$getCols = $db->GetArray("select FieldName,DisplayName from dh_listview where ModuleCode='$ModuleCode' and ListType='Main' order by DisplayOrder asc");
    //$colst = $rs->getCols("dh_listview");
    $dFields = array();
  $dCols = array(); 
    $dCols[] = array("text" => "Action", "dataField" => "link", "width" => 100,"hidden"=>"true");
    $dFields[] = array( "name" => "link", "type" => "string"); 

    $dCols[] = array("text" => "S_ROWID", "dataField" => "S_ROWID","hidden"=>"true");
    $dFields[] = array( "name" => "S_ROWID", "type" => "string");
     foreach ($getCols as $val) {
      $type = $MetaType[$val["FieldName"]];
      switch ($type) {
        case 'varchar':
          $dtype = "string";
          $cellsalign = "left";
          $cellsformat = '';
          $filtertype = "input";
          break;
      case 'int':
          $dtype = "number";
          $cellsalign = 'right';
          $cellsformat = '';
          $filtertype = "number";
          break;
      case in_array($type, $dateTypes):
          $dtype = "date";
          $cellsformat = 'dd-MM-yyyy';
          $filtertype = "range";
          $cellsalign = 'center';
          break;
        default:
          $dtype = "string";
          $cellsalign = 'left';
          $cellsformat = '';
          $filtertype = "input";
          break;
      }
      $dFields[] = array( "name" => $val["FieldName"], "type" => $dtype); 
    $dCols[] = array("text" => $val["DisplayName"], "dataField" => $val["FieldName"], "minwidth" => 150, "cellsalign" => $cellsalign,"filtertype" => $filtertype,"cellsformat" => $cellsformat);
     }
?>
<input type="hidden" name="postvals" id="postvals" value="<?php echo $postvals; ?>">
<input type="hidden" name="IsDelete" id="IsDelete" value="<?php echo $IsDelete; ?>">
<script type="text/javascript">
  
        $(document).ready(function () {
            // prepare the data
            
            var theme = 'fresh';
            var dfields = <?php echo json_encode($dFields); ?>;
            var dcols = <?php echo json_encode($dCols); ?>;
            var mod = <?php echo $mod;?>
            //var postvals = <?php echo $postvals; ?>;
            //$("#jqxgrid").appendPostData({TableName:'DH_SaleOrder'});
            
            var source =
            {
                 datatype: "json",
                 datafields:dfields,
          url: 'get_dataList.php',
          pagesize:20,
          sortcolumn: 'S_ROWID',
          sortdirection: 'desc',
          data: {
            postvals: $("#postvals").val()
            },
        cache: false,
        filter: function()
        {
          // update the grid and send a request to the server.
          $("#jqxgrid").jqxGrid('updatebounddata', 'filter');
        },
        sort: function()
        {
          // update the grid and send a request to the server.
          $("#jqxgrid").jqxGrid('updatebounddata', 'sort');
        },
        root: 'Rows',
        beforeprocessing: function(data)
        {   
          source.totalrecords = data[0].TotalRows;          
        }
            };  
           
            
        var dataadapter = new $.jqx.dataAdapter(source, {
          loadError: function(xhr, status, error)
          {
            alert(error);
          }
  
          
        }
      );
  
            // initialize jqxGrid
            
            $("#jqxgrid").jqxGrid(
            {   
                source: dataadapter,
                theme: theme,
                width: '99%',
                filterable: true,
                sortable: true,
                pageable: true,
                virtualmode: true,
                showfilterrow: true,
                selectionmode: 'checkbox',
                showtoolbar: true,
                 columnsresize: true,
                 altrows: true,
                 pagesizeoptions: ['20', '30', '50','100'],
                rendergridrows: function(obj)
                {
                    return obj.data;     
                },
                        rendertoolbar: function (toolbar) {
                    var me = this;
                    var IsDelete = $("#IsDelete").val();
                    var container = $("<div style='margin: 5px; padding-buttom:5px;'></div>");
                    var btnOpen = $("<button id='btnOpen' type='button' class='btn btn-primary btn-sm' style='margin-button:50px;' title='Open Selected'><i class='fa fa-file-text'> Open  </i></>");
                    var btnDelete = $("<button id='btnDelete' type='button' class='btn btn-danger btn-sm' style='margin-left:5px;' ><i class='fa fa-trash' >  </i> Delete</button>");
                    var btnClearFilter = $("<button id='btnClearFilter' type='button' class='btn btn-warning btn-sm' style='margin-left:5px;' title='Refresh'><i class='fa fa-refresh'></i></button>");
                    toolbar.append(container);
                    container.append(btnOpen);
                    container.append(btnClearFilter);

                     if (IsDelete == "Y") 
                      {
                        container.append(btnDelete);
                      }
 
                    

                    $("#btnClearFilter").click(function(){
                       $("#jqxgrid").jqxGrid('clearfilters');
                    });

                       $("#btnOpen").click(function(){
                     var rowindexes = $('#jqxgrid').jqxGrid('getselectedrowindexes');
                     var boundrows = $('#jqxgrid').jqxGrid('getboundrows');
                     var selectedrows = new Array();
                     var linkarray = new Array();
                     var sPath= document.location.href;
                     var pos = sPath.lastIndexOf("/")+1;
                     var str2 = sPath.substring(0,pos);
                     
                     var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
                     
                     for(var i =0; i < rowindexes.length; i++)
                     {
                    var datarow = $.parseJSON(JSON.stringify(boundrows[rowindexes[i]]));
                       if ( i == 0) 
                       {
                         $(window.location).attr('href', datarow.link);
                       }
                       else
                       {
                        
                        if(isChrome){
                         linkarray.push(str2+datarow.link);
                         window.open(str2+datarow.link,"_blank");
                        } 
                        else 
                        {
                          window.open(str2+datarow.link,"_blank");
                        }
                        
                       }
                     }
                     
                     
                    });

                    $("#btnDelete").click(function(){
                     var rowindexes = $('#jqxgrid').jqxGrid('getselectedrowindexes');
                     var boundrows = $('#jqxgrid').jqxGrid('getboundrows');
                     var selectedrows = new Array();
                     for(var i =0; i < rowindexes.length; i++)
                     {
                    var datarow = jQuery.parseJSON(JSON.stringify(boundrows[rowindexes[i]]));
                        selectedrows.push(datarow.S_ROWID);
                     }
                       if (selectedrows.length != 0) 
                       {
                          jConfirm('Are you sure Delete the Selected Records?', 'Delete Records', function(r) {
                        if(r){
                          var q = JSON.stringify(selectedrows);
                        $.post("assets/bin/ManageRecords.php", {DeleteMultiple: ""+q+"",mod: ""+mod+""}, function(data){
                               $("#jqxgrid").jqxGrid('applyfilters');
                            });
                          }
                        });
                       }
                    });
                  },

          columns: dcols
            });
   var height = $(window).height();
   var gridHeight = eval(height-160);   
   $("#jqxgrid").jqxGrid({ height: gridHeight});

   $("#jqxgrid").bind('celldoubleclick', function (event) {
    var column = event.args.column;
    var rowindex = event.args.rowindex;
      var datafield = event.args.datafield;
      var datarow = $("#jqxgrid").jqxGrid('getrowdata', rowindex);
      var obj = $.parseJSON(JSON.stringify(datarow));
      $(window.location).attr('href', obj.link);
});



    
        });
    </script>
    <div id='jqxWidget'>
        <div id="jqxgrid" style="font-size: 13px; font-family: Verdana; float: left;></div>
    </div>
    <div id="selectrowindex"></div>