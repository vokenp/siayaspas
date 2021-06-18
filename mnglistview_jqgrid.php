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
    //$dCols[] = array("text" => "Action", "dataField" => "link", "width" => 100,"hidden"=>"true");
    //$dFields[] = array( "name" => "link", "type" => "string"); 

    //$dCols[] = array("text" => "S_ROWID", "dataField" => "S_ROWID","hidden"=>"true");
    //$dFields[] = array( "name" => "S_ROWID", "type" => "string");
     
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
      $dFields[] = $val["DisplayName"]; 
      $gdata[] = $val["FieldName"]; 
    $dCols[] = array("name" => $val["FieldName"], "index" => $val["FieldName"],"width" => 100);
     }
     $gridline = array();
    for ($i=0; $i < 34; $i++) { 
      $griddata = array();
        foreach ($gdata as $key => $value) {
          $g = random_int(23, 35);
          $griddata[$value] = $g * $i;
        }
        $gridline[] = $griddata;
    }
  
     
?>
<input type="hidden" name="postvals" id="postvals" value="<?php echo $postvals; ?>">
<input type="hidden" name="IsDelete" id="IsDelete" value="<?php echo $IsDelete; ?>">


<script type="text/javascript">  
  jQuery(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";
         var dfields = <?php echo json_encode($dFields); ?>;
          var dcols = <?php echo json_encode($dCols); ?>;
          var grid_data = <?php echo json_encode($gridline); ?>;
        var parent_column = $(grid_selector).closest('[class*="col-"]');
        //resize to fit page size
        $(window).on('resize.jqGrid', function () {
          $(grid_selector).jqGrid( 'setGridWidth', parent_column.width() );
          });

        //resize on sidebar collapse/expand
        $(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
          if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
            //setTimeout is for webkit only to give time for DOM changes and then redraw!!!
            setTimeout(function() {
              $(grid_selector).jqGrid( 'setGridWidth', parent_column.width() );
            }, 20);
          }
          });

        jQuery(grid_selector).jqGrid({
          data: grid_data,
          datatype: "local",
          height: 270,
          colNames:dfields,
          colModel: dcols,
          viewrecords : true,
          rowNum:20,
          rowList:[20,30,50,100],
          pager : pager_selector,
          altRows: true,
          toppager: false,
          multiselect: true,
         // multikey: "ctrlKey",
          multiboxonly: true,
      
          loadComplete : function() {
            var table = this;
            setTimeout(function(){
              styleCheckbox(table);
              
              updateActionIcons(table);
              updatePagerIcons(table);
              enableTooltips(table);
            }, 0);
          },
      
          editurl: "./dummy.php",//nothing is saved
          caption: "Users List"
          ,autowidth: true,      
        });
        $(window).triggerHandler('resize.jqGrid');//trigger window resize to make the grid get the correct siz
      
        //enable search/filter toolbar
        //jQuery(grid_selector).jqGrid('filterToolbar',{defaultSearch:true,stringResult:true})
        //jQuery(grid_selector).filterToolbar({});
      
      
        //navButtons
        jQuery(grid_selector).jqGrid('navGrid',pager_selector,
          {   //navbar options
            edit: false,
            editicon : 'ace-icon fa fa-pencil blue',
            add: false,
            addicon : 'ace-icon fa fa-plus-circle purple',
            del: true,
            delicon : 'ace-icon fa fa-trash-o red',
            search: true,
            searchicon : 'ace-icon fa fa-search orange',
            refresh: true,
            refreshicon : 'ace-icon fa fa-refresh green',
            view: true,
            viewicon : 'ace-icon fa fa-search-plus grey',
          },
          
          {
            //delete record form
            recreateForm: true,
            beforeShowForm : function(e) {
              var form = $(e[0]);
              if(form.data('styled')) return false;
              
              form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
              style_delete_form(form);
              
              form.data('styled', true);
            },
            onClick : function(e) {
              alert(1);
            }
          },
          {
            //search form
            recreateForm: true,
            afterShowSearch: function(e){
              var form = $(e[0]);
              form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
              style_search_form(form);
            },
            afterRedraw: function(){
              style_search_filters($(this));
            }
            ,
            multipleSearch: true,
            /**
            multipleGroup:true,
            showQuery: true
            */
          },
          {
            //view record form
            recreateForm: true,
            beforeShowForm: function(e){
              var form = $(e[0]);
              form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
            }
          }
        )
      
      
        
      
      
        function style_delete_form(form) {
          var buttons = form.next().find('.EditButton .fm-button');
          buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
          buttons.eq(0).addClass('btn-danger').prepend('<i class="ace-icon fa fa-trash-o"></i>');
          buttons.eq(1).addClass('btn-default').prepend('<i class="ace-icon fa fa-times"></i>')
        }
        
        function style_search_filters(form) {
          form.find('.delete-rule').val('X');
          form.find('.add-rule').addClass('btn btn-xs btn-primary');
          form.find('.add-group').addClass('btn btn-xs btn-success');
          form.find('.delete-group').addClass('btn btn-xs btn-danger');
        }
        function style_search_form(form) {
          var dialog = form.closest('.ui-jqdialog');
          var buttons = dialog.find('.EditTable')
          buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'ace-icon fa fa-retweet');
          buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'ace-icon fa fa-comment-o');
          buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-purple').find('.ui-icon').attr('class', 'ace-icon fa fa-search');
        }
        
        function beforeDeleteCallback(e) {
          var form = $(e[0]);
          if(form.data('styled')) return false;
          
          form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
          style_delete_form(form);
          
          form.data('styled', true);
        }
        
       //replace icons with FontAwesome icons like above
        function updatePagerIcons(table) {
          var replacement = 
          {
            'ui-icon-seek-first' : 'ace-icon fa fa-angle-double-left bigger-140',
            'ui-icon-seek-prev' : 'ace-icon fa fa-angle-left bigger-140',
            'ui-icon-seek-next' : 'ace-icon fa fa-angle-right bigger-140',
            'ui-icon-seek-end' : 'ace-icon fa fa-angle-double-right bigger-140'
          };
          $('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function(){
            var icon = $(this);
            var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
            
            if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
          })
        }

        function enableTooltips(table) {
          $('.navtable .ui-pg-button').tooltip({container:'body'});
          $(table).find('.ui-pg-div').tooltip({container:'body'});
        }
      
        //var selr = jQuery(grid_selector).jqGrid('getGridParam','selrow');
      
        $(document).one('ajaxloadstart.page', function(e) {
          $.jgrid.gridDestroy(grid_selector);
          $('.ui-jqdialog').remove();
        });
      
  });
</script>
  <table id="grid-table"></table>
  <div id="grid-pager"></div>
  