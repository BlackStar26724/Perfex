
<script>
  var purchase;
(function($) {
  "use strict";

  appValidateForm($('#add_goods_receipt'), {
     date_c: 'required',
     date_add: 'required',
     warehouse_id: 'required',
    
   }); 



  var dataObject_pu = [];
  var hotElement1 = document.querySelector('#hot_purchase');
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
    height: 330,

    rowHeaders: true,
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
                  data: 'unit_price',
                  numericFormat: {
                    pattern: '0,00',
                  },
                  readOnly: true

                      
                },
                {
                  type: 'numeric',
                  data:'tax_rate',
                  numericFormat: {
                    pattern: '0,00',
                  },
                readOnly: true

                },
                {
                  type: 'numeric',
                  data: 'into_money',
                  numericFormat: {
                    pattern: '0,00',
                  },
                readOnly: true

                      
                },
                {
                  type: 'numeric',
                  data: 'tax_money',
                  numericFormat: {
                    pattern: '0,00',
                  },
                readOnly: true

                      
                },
                {
                  type: 'date',
                  dateFormat: 'YYYY-MM-DD',
                  correctFormat: true,
                  defaultDate: "<?php echo _d(date('Y-m-d')) ?>"
                },
                {
                  type: 'date',
                  dateFormat: 'YYYY-MM-DD',
                  correctFormat: true,
                  defaultDate: "<?php echo _d(date('Y-m-d')) ?>"
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
        '<?php echo _l('unit_price'); ?>',
        '<?php echo _l('tax_rate')._l(' %'); ?>',
        '<?php echo _l('goods_money'); ?>',
        '<?php echo _l('tax_money'); ?>',
        '<?php echo _l('date_manufacture'); ?>',
        '<?php echo _l('expiry_date'); ?>',
        '<?php echo _l('note'); ?>',
        
      ],
   
    data: dataObject_pu,

    cells: function (row, col, prop, value, cellProperties) {
        var cellProperties = {};
        var data = this.instance.getData();
        cellProperties.className = 'htMiddle ';
        
        return cellProperties;
      }


  });

})(jQuery);

  (function($) {
  "use strict";
      
      var purchase_value = purchase;

    purchase.addHook('afterChange', function(changes, src) {
      "use strict";

        if(changes !== null){
        changes.forEach(([row, col, prop, oldValue, newValue]) => {
          if($('select[name="warehouse_id"]').val() == ''){
            alert_float('warning', "<?php echo _l('please_select_a_warehouse'); ?>");

          }else{

            if(col == 'commodity_code' && oldValue != ''&& oldValue != ''){
              console.log('oldValue', oldValue);
              $.post(admin_url + 'warehouse/commodity_code_change/'+oldValue ).done(function(response){
                response = JSON.parse(response);
                  purchase.setDataAtCell(row,1, response.value.unit_id);
                  purchase.setDataAtCell(row,2, '');
                  purchase.setDataAtCell(row,3, response.value.purchase_price);
                  purchase.setDataAtCell(row,4, response.value.taxrate);
                  purchase.setDataAtCell(row,7, '');
                  purchase.setDataAtCell(row,8, '');

              });
            }
            if(col == 'commodity_code' && oldValue == null){
                purchase.setDataAtCell(row,1,'');
                purchase.setDataAtCell(row,2,'');
                purchase.setDataAtCell(row,3,'');
                purchase.setDataAtCell(row,4,'');
                purchase.setDataAtCell(row,5,'');
                purchase.setDataAtCell(row,6,'');
                purchase.setDataAtCell(row,7,'');
                purchase.setDataAtCell(row,8,'');
            }
            if(col == 'quantity' && oldValue != ''){
                  var total_tax_money =0;
                  var total_goods_money =0;
                  var value_of_inventory =0;
                  var total_money =0;

                purchase.setDataAtCell(row,5,oldValue*purchase.getDataAtCell(row,3));
                purchase.setDataAtCell(row,6,oldValue*purchase.getDataAtCell(row,3)*(purchase.getDataAtCell(row,4)/100));
                

                for (var row_index = 0; row_index <= 20; row_index++) {

                  total_tax_money += (purchase.getDataAtCell(row_index, 2)*purchase.getDataAtCell(row_index, 3))*purchase.getDataAtCell(row_index, 4)/100;
                  total_goods_money += purchase.getDataAtCell(row_index, 2)*purchase.getDataAtCell(row_index, 3);
                  value_of_inventory += purchase.getDataAtCell(row_index, 2)*purchase.getDataAtCell(row_index, 3);

                }

                  total_money = total_tax_money + total_goods_money;

                  $('input[name="total_tax_money"]').val((total_tax_money).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                  $('input[name="total_goods_money"]').val((total_goods_money).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                  $('input[name="value_of_inventory"]').val((value_of_inventory).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                  $('input[name="total_money"]').val((total_money).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
            }else if(col == 'quantity' && oldValue == ''){
                purchase.setDataAtCell(row,5,0);
                purchase.setDataAtCell(row,6,0);
                $('input[name="total_goods_money"]').val(0);
                $('input[name="value_of_inventory"]').val(0);
                $('input[name="total_money"]').val(0);
            }
          }

        });
      }
    });

   
      $('.add_goods_receipt').on('click', function() {
        var valid_warehouse_type = $('#hot_purchase').find('.htInvalid').html();

        if(valid_warehouse_type){
          alert_float('danger', "<?php echo _l('data_must_number') ; ?>");

        }else{
          $('input[name="hot_purchase"]').val(purchase_value.getData());
          $('#add_goods_receipt').submit(); 

        }
      });
        

   })(jQuery);

  function pr_order_change(){
    "use strict";

    var pr_order_id = $('select[name="pr_order_id"]').val();

    if(pr_order_id != ''){
      alert_float('warning', '<?php echo _l('stock_received_docket_from_purchase_request'); ?>')
      $.post(admin_url + 'warehouse/coppy_pur_request/'+pr_order_id).done(function(response){
            response = JSON.parse(response);
            console.log(response);
            purchase.updateSettings({
            data: response.result,
            maxRows: response.total_row,
          });
            $('input[name="total_tax_money"]').val((response.total_tax_money));
            $('input[name="total_goods_money"]').val((response.total_goods_money));
            $('input[name="value_of_inventory"]').val((response.value_of_inventory));
            $('input[name="total_money"]').val((response.total_money));



          });
      $.post(admin_url + 'warehouse/copy_pur_vender/'+pr_order_id).done(function(response){
       var response_vendor = JSON.parse(response);

        $('select[name="supplier_code"]').val(response_vendor.userid).change();
        $('select[name="buyer_id"]').val(response_vendor.buyer).change();

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
