<script> 

var warehouse_type_value = {};
    function new_warehouse_type(){
      "use strict";
        $('#warehouse_type').modal('show');
        $('.edit-title').addClass('hide');
        $('.add-title').removeClass('hide');
        $('#warehouse_type_id').html('');

        var handsontable_html ='<div id="hot_warehouse_type" class="hot handsontable htColumnHeaders"></div>';
        if($('#add_handsontable').html() != null){
          $('#add_handsontable').empty();

          $('#add_handsontable').html(handsontable_html);
        }else{
          $('#add_handsontable').html(handsontable_html);

        }

setTimeout(function(){
  "use strict";
  var hotElement1 = document.querySelector('#hot_warehouse_type');


   var warehouse_type = new Handsontable(hotElement1, {
    contextMenu: true,
    manualRowMove: true,
    manualColumnMove: true,
    stretchH: 'all',
    autoWrapRow: true,
    rowHeights: 30,
    defaultRowHeight: 100,
    maxRows: 22,
    minRows:9,
    width: '100%',
    height: 330,
    rowHeaders: true,
    autoColumnSize: {
      samplingRatio: 23
    },

    licenseKey: 'non-commercial-and-evaluation',
    filters: true,
    manualRowResize: true,
    manualColumnResize: true,
    allowInsertRow: true,
    allowRemoveRow: true,
    columnHeaderHeight: 40,

    colWidths: [20, 50,120,30, 30,120],
    rowHeights: 30,
    rowHeaderWidth: [44],

    columns: [
                {
                  type: 'text',
                  data: 'warehouse_code'
                },
                 {
                  type: 'text',
                  data: 'warehouse_name',
                  // set desired format pattern and
                },
                 {
                  type: 'text',
                  data: 'warehouse_address',
                  // set desired format pattern and
                },
                {
                  type: 'numeric',
                  data: 'order',
                },
                {
                  type: 'checkbox',
                  data: 'display',
                  checkedTemplate: 'yes',
                  uncheckedTemplate: 'no'
                },
                {
                  type: 'text',
                  data: 'note',
                },
              
              ],

    colHeaders: true,
    nestedHeaders: [{"1":"<?php echo _l('warehouse_code') ?>",
                      "2":"<?php echo _l('warehouse_name') ?>",
                      "3":"<?php echo _l('warehouse_address') ?>",
                      "4":"<?php echo _l('order') ?>",
                     "5":"<?php echo _l('display') ?>",
                     "6":"<?php echo _l('note') ?>",
                    }],

    data: [{"warehouse_code":"","warehouse_name":"","warehouse_address":"","order":"","display":"no","note":""}],

  });
   warehouse_type_value = warehouse_type;
  },300);


    }

  function edit_warehouse_type(invoker,id){
      "use strict";

    var warehouse_code = $(invoker).data('warehouse_code');
    var warehouse_name = $(invoker).data('warehouse_name');
    var warehouse_address = $(invoker).data('warehouse_address');

    var order = $(invoker).data('order');
    if($(invoker).data('display') == 0){
      var display = 'no';
    }else{
      var display = 'yes';
    }
    var note = $(invoker).data('note');

        $('#warehouse_type_id').html('');
        $('#warehouse_type_id').append(hidden_input('id',id));

        $('#warehouse_type').modal('show');
        $('.edit-title').addClass('hide');
        $('.add-title').removeClass('hide');

        var handsontable_html ='<div id="hot_warehouse_type" class="hot handsontable htColumnHeaders"></div>';
        if($('#add_handsontable').html() != null){
          $('#add_handsontable').empty();

          $('#add_handsontable').html(handsontable_html);
        }else{
          $('#add_handsontable').html(handsontable_html);

        }

    setTimeout(function(){
      "use strict";
      var hotElement1 = document.querySelector('#hot_warehouse_type');

       var warehouse_type = new Handsontable(hotElement1, {
        contextMenu: true,
        manualRowMove: true,
        manualColumnMove: true,
        stretchH: 'all',
        autoWrapRow: true,
        rowHeights: 30,
        defaultRowHeight: 100,
        maxRows: 1,
        width: '100%',
        height: 130,
        rowHeaders: true,
        autoColumnSize: {
          samplingRatio: 23
        },
        licenseKey: 'non-commercial-and-evaluation',
        filters: true,
        manualRowResize: true,
        manualColumnResize: true,
        columnHeaderHeight: 40,

        colWidths: [40, 100, 30,30, 30, 140],
        rowHeights: 30,
        rowHeaderWidth: [44],

        columns: [
                {
                  type: 'text',
                  data: 'warehouse_code',
                  readOnly:true,
                  
                },
                 {
                  type: 'text',
                  data: 'warehouse_name',
                  // set desired format pattern and
                },
                 {
                  type: 'text',
                  data: 'warehouse_address',
                  // set desired format pattern and
                },
                {
                  type: 'numeric',
                  data: 'order',
                },
                {
                  type: 'checkbox',
                  data: 'display',
                  checkedTemplate: 'yes',
                  uncheckedTemplate: 'no'
                },
                {
                  type: 'text',
                  data: 'note',
                },
              
              ],

        colHeaders: true,
        nestedHeaders: [{"1":"<?php echo _l('warehouse_code') ?>",
                      "2":"<?php echo _l('warehouse_name') ?>",
                      "3":"<?php echo _l('warehouse_address') ?>",
                      "4":"<?php echo _l('order') ?>",
                      "5":"<?php echo _l('display') ?>",
                      "6":"<?php echo _l('note') ?>",
                    }],

        data: [{"warehouse_code":warehouse_code,"warehouse_name":warehouse_name,"warehouse_address":warehouse_address,"order":order,"display":display,"note":note}],

      });
       warehouse_type_value = warehouse_type;
      },300);

    }

    function add_warehouse_type(invoker){
      "use strict";
      var valid_warehouse_type = $('#hot_warehouse_type').find('.htInvalid').html();

      if(valid_warehouse_type){
        alert_float('danger', "<?php echo _l('data_must_number') ; ?>");
      }else{

        $('input[name="hot_warehouse_type"]').val(warehouse_type_value.getData());
        $('#add_warehouse_type').submit(); 

      }
        
    }
</script>