<script>
  var purchase;
  var warehouses;

(function($) {
"use strict";  
 
  appValidateForm($('#add_goods_delivery'), {
     date_c: 'required',
     date_add: 'required',
     warehouse_id: 'required',
    
   }); 
  var warehouses ={};

  //hansometable for purchase
  var row_global;
  var dataObject_pu = [];
  var
    hotElement1 = document.getElementById('hot_purchase');

  purchase = new Handsontable(hotElement1, {
    licenseKey: 'non-commercial-and-evaluation',

    contextMenu: true,
    manualRowMove: true,
    manualColumnMove: true,
    stretchH: 'all',
    autoWrapRow: true,
    rowHeights: 30,
    defaultRowHeight: 100,
    minRows: 9,
    maxRows: 22,
    width: '100%',
    

    rowHeaders: true,
    colHeaders: true,
    autoColumnSize: {
      samplingRatio: 23
    },
   
    filters: true,
    manualRowResize: true,
    manualColumnResize: true,
    allowInsertRow: true,
    allowRemoveRow: true,
    columnHeaderHeight: 40,

    colWidths: [110, 100,80, 80,80, 100,120,120,120,120,],
    rowHeights: 30,
    rowHeaderWidth: [44],

    columns: [
                {
                  type: 'text',
                  data: 'commodity_code',
                  renderer: customDropdownRenderer,
                  editor: "chosen",
                  width: 150,
                  chosenOptions: {
                      data: <?php echo json_encode($commodity_code_name); ?>
                  }
                },
                {
                  
                  type: 'text',
                  data: 'unit_id',
                  renderer: customDropdownRenderer,
                  editor: "chosen",
                  width: 150,
                  chosenOptions: {
                      data: <?php echo json_encode($units_code_name); ?>
                  },
                  readOnly: true

                },
                {
                  type: 'numeric',
                  data:'quantity',
                  numericFormat: {
                    pattern: '0,00',
                  }
                },
                {
                  type: 'numeric',
                  data: 'rate',
                  numericFormat: {
                    pattern: '0,00',
                  },
                  readOnly: true

                      
                },
                {
                  type: 'numeric',
                  data: 'total_money',
                  numericFormat: {
                    pattern: '0,00',
                  },
                  readOnly: true

                      
                },
               
                {
                  type: 'text',
                  data: 'note',
                },
             
                
              ],

          colHeaders: [
        '<?php echo _l('commodity_code'); ?>',
        '<?php echo _l('unit_id'); ?>',
        '<?php echo _l('quantity'); ?>',
        '<?php echo _l('rate'); ?>',
        '<?php echo _l('total_money'); ?>',
        '<?php echo _l('note'); ?>',
        
      ],
   
    data: dataObject_pu,
  });

 })(jQuery);


var purchase_value = purchase;
(function($) {
"use strict";  
 
  purchase.addHook('afterChange', function(changes, src) {
    if(changes !== null){
      changes.forEach(([row, col, prop, oldValue, newValue]) => {
        if($('select[name="warehouse_id"]').val() == ''){
          alert_float('warning', "<?php echo _l('please_select_a_warehouse'); ?>");
        }else
        {
          var row_global = row;
          if(col == 'commodity_code' && oldValue != '')
          {
            $.post(admin_url + 'warehouse/commodity_goods_delivery_change/'+oldValue ).done(function(response){
              response = JSON.parse(response);
                    
              purchase.setDataAtCell(row,1, response.value.unit_id);
              purchase.setDataAtCell(row,2, '');
              purchase.setDataAtCell(row,3, response.value.rate);
              purchase.setDataAtCell(row,4, '');
              purchase.setDataAtCell(row,5, '');

              warehouses = response.warehouse_inventory;
            });
          }

          if(col == 'commodity_code' && oldValue == '')
          {
            purchase.setDataAtCell(row,1,'');
            purchase.setDataAtCell(row,2,'');
            purchase.setDataAtCell(row,3,'');
            purchase.setDataAtCell(row,4,'');
            purchase.setDataAtCell(row,5,'');
          }

          if(col == 'quantity' && oldValue != '' && $.isNumeric(oldValue) && purchase.getDataAtCell(row_global,0) != null )
          {
            row_global = row;
            var data={};
            data.warehouse_id = $('select[name="warehouse_id"]').val();
            data.commodity_id = purchase.getDataAtCell(row, 0);
            data.quantity = purchase.getDataAtCell(row, 2);

            $.post(admin_url + 'warehouse/check_quantity_inventory', data).done(function(response){
              response = JSON.parse(response);
              if(response.message != true){
                if(response.value != 0){
                  alert_float('danger', response.message+response.value+' <?php echo _l('product') ?>');
                  
                  purchase.setCellMeta(row_global, 2, 'className', 'border');
                  purchase.render()

                }else{
                  alert_float('danger', response.message);

                  purchase.setCellMeta(row_global, 2, 'className', 'border');
                  purchase.render()
                }
              }else{
                  purchase.setCellMeta(row_global, 2, 'className', 'border-none');
                  purchase.render()
                  //set value
                  var total_money =0;
                  purchase.setDataAtCell(row,4,oldValue*purchase.getDataAtCell(row,3));

                  for (var row_index = 0; row_index <= 20; row_index++) {
                    total_money += purchase.getDataAtCell(row_index, 2)*purchase.getDataAtCell(row_index, 3);
                  }

                  $('input[name="total_money"]').val((total_money).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
              }
            });
          }else  if(col == 'quantity' && oldValue != '' && !$.isNumeric(oldValue))
          {
            alert_float('danger', "<?php echo _l('data_invalid') ; ?>");
            purchase.setCellMeta(row_global, 2, 'className', 'border');
            purchase.render()
          }else if(col == 'quantity' && oldValue != '' && $.isNumeric(oldValue))
          {
            purchase.setCellMeta(row_global, 2, 'className', 'border-none');
            purchase.render()
          }
          if(col == 'warehouse_id' && oldValue != '' && purchase.getDataAtCell(row_global,2) != '' && purchase.getDataAtCell(row_global,0) != null)
          {
            row_global = row;

            var data={};
            data.warehouse_id = $('select[name="warehouse_id"]').val();
            data.commodity_id = purchase.getDataAtCell(row, 0);
            data.quantity = purchase.getDataAtCell(row, 2);
           
            $.post(admin_url + 'warehouse/check_quantity_inventory', data).done(function(response){
              response = JSON.parse(response);
              if(response.message != true){
                if(response.value != 0){
                  alert_float('danger', response.message+response.value+' <?php echo _l('product') ?>');
                  purchase.setCellMeta(row_global, 2, 'className', 'border');
                  purchase.render();
                }else{
                  alert_float('danger', response.message);
                  purchase.setCellMeta(row_global, 2, 'className', 'border');
                  purchase.render();
                }
              }else{
                purchase.setCellMeta(row_global, 2, 'className', 'border-none');
                purchase.render();
              }
            });
          }

          if(col == 'quantity' && oldValue == '')
          {
            $('input[name="total_goods_money"]').val(0);
            $('input[name="value_of_inventory"]').val(0);
            $('input[name="total_money"]').val(0);
          }
        }
      });
    }
  })
})(jQuery);


(function($) {
"use strict";  


   $('.add_goods_delivery').on('click', function() {
      "use strict";
      var valid_warehouse_type = $('#hot_purchase').find('.border').html();

      if(valid_warehouse_type){
        alert_float('danger', "<?php echo _l('data_invalid') ; ?>");
      }else{
        var datasubmit = {};

        datasubmit.hot_delivery = purchase_value.getData();
         datasubmit.warehouse_id = $('select[name="warehouse_id"]').val();

         $.post(admin_url + 'warehouse/check_quantity_inventory_onsubmit', datasubmit).done(function(responsec){
          responsec = JSON.parse(responsec);
            console.log('response', responsec);
          if(responsec.message){
            $('input[name="hot_purchase"]').val(purchase_value.getData());
            $('#add_goods_delivery').submit(); 
          }else{
            alert_float('danger', "<?php echo _l('data_invalid') ; ?>");
          }

        });
      }
        
    });


  })(jQuery);

  function pr_order_change(){
     "use strict";

      pr_order_id = $('select[name="pr_order_id"]').val();

      if(pr_order_id != ''){
        alert_float('warning', '<?php echo _l('stock_received_docket_from_purchase_request'); ?>')
        $.post(admin_url + 'warehouse/coppy_pur_request/'+pr_order_id).done(function(response){
              response = JSON.parse(response);
              purchase.updateSettings({
              data: response.result,
              maxRows: response.total_row,
            });

              $('input[name="total_tax_money"]').val((response.total_tax_money).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
              $('input[name="total_goods_money"]').val((response.total_goods_money).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
              $('input[name="value_of_inventory"]').val((response.value_of_inventory).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
              $('input[name="total_money"]').val((response.total_money).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));


            });
        
      }else{

        purchase.updateSettings({
              data: [],
              maxRows: 22,

            });

      }
  }

function customDropdownRenderer(instance, td, row, col, prop, value, cellProperties) {
   "use strict";
    var selectedId;
    var optionsList = cellProperties.chosenOptions.data;
    
    if(typeof optionsList === "undefined" || typeof optionsList.length === "undefined" || !optionsList.length) {
        Handsontable.cellTypes.text.renderer(instance, td, row, col, prop, value, cellProperties);
        return td;
    }

    var values = (value + "").split("|");
    value = [];
    for (var index = 0; index < optionsList.length; index++) {

        if (values.indexOf(optionsList[index].id + "") > -1) {
            selectedId = optionsList[index].id;
            value.push(optionsList[index].label);
        }
    }
    value = value.join(", ");

    Handsontable.cellTypes.text.renderer(instance, td, row, col, prop, value, cellProperties);
    return td;
}

  
</script>