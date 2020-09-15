<script>
  var hidden_columns = [2,6];
  (function($) {
    "use strict";

    $('input[name="description"]' ).change(function() {
      if($( 'input[name="sku_name"]' ).val() == ''){
        $( 'input[name="sku_name"]' ).val($('input[name="description"]' ).val());
      }

    });


      var gallery = new SimpleLightbox('.gallery a', {});

     if($('#dropzoneDragArea').length > 0){
        expenseDropzone = new Dropzone(".commodity_list-add-edit", appCreateDropzoneOptions({
          autoProcessQueue: false,
          clickable: '#dropzoneDragArea',
          previewsContainer: '.dropzone-previews',
          addRemoveLinks: true,
          maxFiles: 10,
         
            success:function(file,response){
             response = JSON.parse(response);
             if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
               window.location.assign(response.url);
             }else{

                expenseDropzone.processQueue();

             }

           },

       }));
     }

     appValidateForm($("body").find('.commodity_list-add-edit'), {
        'commodity_code': 'required',
        'commodity_barcode': 'required',
        'unit_id': 'required',
        'warehouse_id': 'required',
        'commodity_type': 'required',
        'rate': 'required',
    },expenseSubmitHandler);


    var ProposalServerParams = {
        "warehouse_ft": "[name='warehouse_filter[]']",
        "commodity_ft": "[name='commodity_filter[]']",
        "alert_filter": "[name='alert_filter']",
    };

    var table_commodity_list = $('table.table-table_commodity_list');
    var _table_api = initDataTable(table_commodity_list, admin_url+'warehouse/table_commodity_list', true, '', ProposalServerParams);
    $.each(ProposalServerParams, function(i, obj) {
        $('select' + obj).on('change', function() {  
            table_commodity_list.DataTable().ajax.reload()
                .columns.adjust()
                .responsive.recalc();
        });
    });


})(jQuery); 


 
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

    var units ={};
      <?php foreach ($units as  $unit) { ?>
          units[<?php echo html_entity_decode($unit['unit_type_id']) ; ?>] = '<?php echo html_entity_decode($unit['unit_name']) ;  ?>';
     <?php } ; ?>

    var commodity_types ={};
     <?php foreach ($commodity_types as  $commodity_type) { ?>
          commodity_types[<?php echo html_entity_decode($commodity_type['commodity_type_id']) ; ?>] = '<?php echo html_entity_decode($commodity_type['commondity_name']) ;  ?>';
     <?php } ; ?>

    var commodity_groups ={};
     <?php foreach ($commodity_groups as  $commodity_group) { ?>
          commodity_groups[<?php echo html_entity_decode($commodity_group['id']) ; ?>] = '<?php echo html_entity_decode($commodity_group['name']) ;  ?>';
     <?php } ; ?>

    var warehouses ={};
     <?php foreach ($warehouses as  $warehouse) { ?>
          warehouses[<?php echo html_entity_decode($warehouse['warehouse_id']) ; ?>] = '<?php echo html_entity_decode($warehouse['warehouse_name']) ;  ?>';
     <?php } ; ?>

    var taxes ={};
     <?php foreach ($taxes as  $taxe) { ?>
          taxes[<?php echo html_entity_decode($taxe['id']) ; ?>] = '<?php echo html_entity_decode($taxe['name']) ;  ?>';
     <?php } ; ?>

    var styles ={};
     <?php foreach ($styles as  $style) { ?>
          styles[<?php echo html_entity_decode($style['style_type_id']) ; ?>] = '<?php echo html_entity_decode($style['style_name']) ;  ?>';
     <?php } ; ?>

    var models ={};
     <?php foreach ($models as  $model) { ?>
          models[<?php echo html_entity_decode($model['body_type_id']) ; ?>] = '<?php echo html_entity_decode($model['body_name']) ;  ?>';
     <?php } ; ?>

    var sizes ={};
     <?php foreach ($sizes as  $size) { ?>
          sizes[<?php echo html_entity_decode($size['size_type_id']) ; ?>] = '<?php echo html_entity_decode($size['size_symbol']) ;  ?>';
     <?php } ; ?>

    var type_products ={};
       type_products['1'] ='<?php echo _l('materials') ; ?>';
       type_products['2'] ='<?php echo _l('tools') ; ?>';
       type_products['3'] ='<?php echo _l('service') ; ?>';
       type_products['4'] ='<?php echo _l('foods') ; ?>';
  
  function rendererDropdown(instance, td, row, col, prop, value, cellProperties) {
    "use strict";

    var selectid ='';
    var dataRender ={};
          switch(col) {
          case 3:
            selectid ='units';
            dataRender = units;
            break;
          case 4:
            selectid ='commodity_types';
            dataRender = commodity_types;
            break;
          case 5:
            selectid ='warehouses';
            dataRender = warehouses;
            break;
          case 6:
            selectid ='commodity_groups';
            dataRender = commodity_groups;
            break;
          case 7:
            selectid ='taxes';
            dataRender = taxes;
            break;
          case 9:
            selectid ='styles';
            dataRender = styles;
            break;
          case 10:
            selectid ='models';
            dataRender = models;
            break;
          case 11:
            selectid ='sizes';
            dataRender = sizes;
            break;
          case 17:
            selectid ='type_products';
            dataRender = type_products;
            break;
          
        }
   
           
      if (td.innerHTML === undefined || td.innerHTML === null || td.innerHTML === "") {
      
          if(row%2==1){
          var selectbox = " <select id=" + selectid +row+ col + "  >";
          }else{
            var selectbox = " <select id=" + selectid +row+ col + "  >";
          }
            selectbox +=    "<option value =''></option>";

          for (let elem in dataRender) {  
            selectbox +=  "<option value ="+elem+">"+dataRender[elem]+"</option>";
              };
          selectbox += "</select>";

          var $td = $(td);
          var $text = $(selectbox);
          $text.on('mousedown', function (event) {
                        event.stopPropagation(); 
                      });

              $td.empty().append($text);
              $('#'+selectid +row+ col).change(function () {

                  var value = this[this.selectedIndex].value;
                  instance.setDataAtCell(row, col, value);
              });
          }
  }

  var dataObject = [
    ];
  var hotElement1 = document.querySelector('#hot_warehouse_type');

   var warehouse_type = new Handsontable(hotElement1, {

    contextMenu: true,
    manualRowMove: true,
    manualColumnMove: true,
    stretchH: 'all',
    autoWrapRow: true,
    rowHeights: 30,
    defaultRowHeight: 100,
    minRows: 10,
    maxRows: 22,
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

    colWidths: [120, 100,150, 80,120, 120,120, 120,120, 120,120, 120,120, 120,120, 120,120,],
    rowHeights: 30,
    rowHeaderWidth: [44],

    columns: [
                {
                  type: 'text',
                  data: '<?php echo _l('commodity_code'); ?>',
                },
                 {
                  type: 'text',
                  data: '<?php echo _l('commodity_barcode'); ?>',
                  
                },
                 {
                  type: 'text',
                  data: '<?php echo _l('description'); ?>',
                  
                },
                {
                  type: 'text',
                  data: '<?php echo _l('unit_id'); ?>',
                },
                {
                  type: 'text',
                  data:'<?php echo _l('commodity_type'); ?>',
                 
                },
                {
                  type: 'text',
                  data: '<?php echo _l('warehouse_id') ?>',
                      
                },
                {
                  type: 'text',
                  data: '<?php echo _l('commodity_group'); ?>',
                },
                {
                    type: 'text',
                    data: '<?php echo _l('tax_rate'); ?>',
                },
                {
                    type: 'text',
                    data: '<?php echo _l('origin'); ?>',
                },
                {
                    type: 'text',
                    data: '<?php echo _l('style_id'); ?>',
                },
                {
                    type: 'text',
                    data: '<?php echo _l('model_id'); ?>',
                },
                {
                    type: 'text',
                    data: '<?php echo _l('size_id'); ?>',
                },
                {
                    type: 'text',
                    data: '<?php echo _l('commodity_images'); ?>',  
                },
                {
                    type: 'text',
                    data: '<?php echo _l('date_manufacture'); ?>',
                },
                {
                    type: 'text',
                    data: '<?php echo _l('expiry_date'); ?>',
                },
               {
                    type: 'text',
                    data: '<?php echo _l('rate'); ?>',
                },
               {
                    type: 'text',
                    data: '<?php echo _l('type_product'); ?>',
                },
               
                
              ],

          colHeaders: [
        '<?php echo _l('commodity_code'); ?>',
        '<?php echo _l('commodity_barcode'); ?>',
        '<?php echo _l('description'); ?>',
        '<?php echo _l('unit_id'); ?>',
        '<?php echo _l('commodity_type'); ?>',
        '<?php echo _l('warehouse_id'); ?>',
        '<?php echo _l('commodity_group'); ?>',
        '<?php echo _l('tax_rate'); ?>',
        '<?php echo _l('origin'); ?>',
        '<?php echo _l('style_id'); ?>',
        '<?php echo _l('model_id'); ?>',
        '<?php echo _l('size_id'); ?>',
        '<?php echo _l('commodity_images'); ?>',
        '<?php echo _l('date_manufacture'); ?>',
        '<?php echo _l('expiry_date'); ?>',
        '<?php echo _l('rate'); ?>',
        '<?php echo _l('type_product'); ?>',
        
      ],
   
    data: dataObject,

    cells: function (row, col, prop, value, cellProperties) {
        var cellProperties = {};
        var data = this.instance.getData();
        cellProperties.className = 'htMiddle ';
        if(col == 3 || col == 4|| col == 5|| col == 6|| col == 7|| col == 9|| col == 10|| col == 11|| col == 17){
           cellProperties.renderer = rendererDropdown; // uses function directly
        }
        
        return cellProperties;
      }

  });
   warehouse_type_value = warehouse_type;
  },300);


    }

  //submit data
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


  init_commodity_detail();
  function init_commodity_detail(id) {
    "use strict";
    load_small_table_item_proposal(id, '#proposal_sm_view', 'proposal_id', 'warehouse/get_commodity_data_ajax', '.proposal_sm');
  }

  function load_small_table_item_proposal(pr_id, selector, input_name, url, table) {
    "use strict";
    var _tmpID = $('input[name="' + input_name + '"]').val();
    // Check if id passed from url, hash is prioritized becuase is last
    if (_tmpID !== '' && !window.location.hash) {
        pr_id = _tmpID;
        // Clear the current id value in case user click on the left sidebar credit_note_ids
        $('input[name="' + input_name + '"]').val('');
    } else {
        
        if (window.location.hash && !pr_id) {
            pr_id = window.location.hash.substring(1); 
        }
    }
    if (typeof(pr_id) == 'undefined' || pr_id === '') { return; }
    if (!$("body").hasClass('small-table')) { toggle_small_view_proposal(table, selector); }
    $('input[name="' + input_name + '"]').val(pr_id);
    do_hash_helper(pr_id);
    $(selector).load(admin_url + url + '/' + pr_id);
    if (is_mobile()) {
        $('html, body').animate({
            scrollTop: $(selector).offset().top + 150
        }, 600);
    }
}

function toggle_small_view_proposal(table, main_data) {
  "use strict";

    $("body").toggleClass('small-table');
    var tablewrap = $('#small-table');
    if (tablewrap.length === 0) { return; }
    var _visible = false;
    if (tablewrap.hasClass('col-md-5')) {
        tablewrap.removeClass('col-md-5').addClass('col-md-12');
        _visible = true;
        $('.toggle-small-view').find('i').removeClass('fa fa-angle-double-right').addClass('fa fa-angle-double-left');
    } else {
        tablewrap.addClass('col-md-5').removeClass('col-md-12');
        $('.toggle-small-view').find('i').removeClass('fa fa-angle-double-left').addClass('fa fa-angle-double-right');
    }
    var _table = $(table).DataTable();
    // Show hide hidden columns
    _table.columns(hidden_columns).visible(_visible, false);
    _table.columns.adjust();
    $(main_data).toggleClass('hide');
    $(window).trigger('resize');
}
 




function close_modal_preview(){
  "use strict";
 $('._project_file').modal('hide');
}

  

$(document).ready(function(){
  "use strict";
    $("#wizard-picture").change(function(){
        readURL(this);
    });
});

  
$('#hot-display-license-info').empty();
   Dropzone.options.expenseForm = false;
   var expenseDropzone;



   function expenseSubmitHandler(form){
    "use strict";

      $.post(form.action, $(form).serialize()).done(function(response) {

        response = JSON.parse(response);

        if (response.commodityid) {
         if(typeof(expenseDropzone) !== 'undefined'){
          if (expenseDropzone.getQueuedFiles().length > 0) {
            expenseDropzone.options.url = admin_url + 'warehouse/add_commodity_attachment/' + response.commodityid;
            expenseDropzone.processQueue();
          } else {
            window.location.assign(response.url);
          }
        } else {
          window.location.assign(response.url);
        }
      } else {
        window.location.assign(response.url);
      }
    });
      return false;
  }

      //function delete contract attachment file 
  function delete_contract_attachment(wrapper, id) {
    "use strict";
    
    if (confirm_delete()) {
       $.get(admin_url + 'warehouse/delete_commodity_file/' + id, function (response) {
          if (response.success == true) {
             $(wrapper).parents('.dz-preview').remove();

             var totalAttachmentsIndicator = $('.dz-preview'+id);
             var totalAttachments = totalAttachmentsIndicator.text().trim();

             if(totalAttachments == 1) {
               totalAttachmentsIndicator.remove();
             } else {
               totalAttachmentsIndicator.text(totalAttachments-1);
             }
             alert_float('success', "<?php echo _l('delete_commodity_file_success') ?>");

          } else {
             alert_float('danger', "<?php echo _l('delete_commodity_file_false') ?>");
          }
       }, 'json');
    }
    return false;
  }

  function readURL(input) {
      "use strict";
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
          }
          reader.readAsDataURL(input.files[0]);
      }
  }

function edit_commodity_item(invoker){
  "use strict";
  $('#commodity_list-add-edit').modal('show');
      
      $('#commodity_item_id').empty();
      $('#commodity_item_id').append(hidden_input('id',$(invoker).data('commodity_id')));

      $('.edit-commodity-title').removeClass('hide');
      $('.add-commodity-title').addClass('hide');


      $('#commodity_list-add-edit input[name="commodity_code"]').val($(invoker).data('commodity_code'));
      $('#commodity_list-add-edit input[name="commodity_barcode"]').val($(invoker).data('commodity_barcode'));
      $('#commodity_list-add-edit input[name="description"]').val($(invoker).data('description'));

      $('#commodity_list-add-edit input[name="sku_code"]').val($(invoker).data('sku_code'));
      $('#commodity_list-add-edit input[name="sku_name"]').val($(invoker).data('sku_name'));
      $('#commodity_list-add-edit input[name="purchase_price"]').val($(invoker).data('purchase_price'));

      $('#commodity_list-add-edit select[name="unit_id"]').val($(invoker).data('unit_id')).change();
      $('#commodity_list-add-edit select[name="commodity_type"]').val($(invoker).data('commodity_type')).change();
      $('#commodity_list-add-edit select[name="group_id"]').val($(invoker).data('group_id')).change();
      $('#commodity_list-add-edit select[name="warehouse_id"]').val($(invoker).data('warehouse_id')).change();
      $('#commodity_list-add-edit select[name="tax"]').val($(invoker).data('tax')).change();

      $('#commodity_list-add-edit input[name="origin"]').val($(invoker).data('origin'));
      $('#commodity_list-add-edit input[name="rate"]').val($(invoker).data('rate'));
      $('#commodity_list-add-edit input[name="type_product"]').val($(invoker).data('type_product'));

      $('#commodity_list-add-edit select[name="style_id"]').val($(invoker).data('style_id')).change();
      $('#commodity_list-add-edit select[name="model_id"]').val($(invoker).data('model_id')).change();
      $('#commodity_list-add-edit select[name="size_id"]').val($(invoker).data('size_id')).change();
      $('#commodity_list-add-edit select[name="sub_group"]').val($(invoker).data('sub_group')).change();

     
      $('#commodity_list-add-edit input[name="date_manufacture"]').val($(invoker).data('date_manufacture')).change();
      $('#commodity_list-add-edit input[name="expiry_date"]').val($(invoker).data('expiry_date')).change();
     
        $.post(admin_url + 'warehouse/get_commodity_file_url/'+$(invoker).data('commodity_id')).done(function(response) {
            response = JSON.parse(response);

            $('#images_old_preview').empty();

            if(response !=''){
              $('#images_old_preview').prepend(response.arr_images);

            }


        });
  }


  function new_commodity_item(){
    "use strict";

      $.post(admin_url + 'warehouse/get_commodity_barcode').done(function(response) {
        response = JSON.parse(response);
        $('#commodity_list-add-edit input[name="commodity_barcode"]').val(response);
      });
      $('#commodity_list-add-edit').modal('show');

          $('#commodity_item_id').empty();

          $('.edit-commodity-title').addClass('hide');
          $('.add-commodity-title').removeClass('hide');

          $('.dropzone-previews').empty();
          $('#images_old_preview').empty();

        
        $('#commodity_list-add-edit input[name="commodity_code"]').val('');
        
        $('#commodity_list-add-edit input[name="description"]').val('');
        $('#commodity_list-add-edit input[name="sku_code"]').val('');
        $('#commodity_list-add-edit input[name="sku_name"]').val('');
        $('#commodity_list-add-edit input[name="purchase_price"]').val('');

        $('#commodity_list-add-edit select[name="unit_id"]').val('').change();
        $('#commodity_list-add-edit select[name="commodity_type"]').val('').change();
        $('#commodity_list-add-edit select[name="group_id"]').val('').change();
        $('#commodity_list-add-edit select[name="warehouse_id"]').val('').change();
        $('#commodity_list-add-edit select[name="tax"]').val('').change();
        $('#commodity_list-add-edit select[name="sub_group"]').val('').change();

        $('#commodity_list-add-edit input[name="origin"]').val('');
        $('#commodity_list-add-edit input[name="rate"]').val('');
        $('#commodity_list-add-edit input[name="type_product"]').val('');

        $('#commodity_list-add-edit select[name="style_id"]').val('').change();
        $('#commodity_list-add-edit select[name="model_id"]').val('').change();
        $('#commodity_list-add-edit select[name="size_id"]').val('').change();

       
        $('#commodity_list-add-edit input[name="date_manufacture"]').val('').change();
        $('#commodity_list-add-edit input[name="expiry_date"]').val('').change();
        $('#commodity_list-add-edit img[id="wizardPicturePreview"]').attr('src', '<?php echo site_url(WAREHOUSE_PATH.'nul_image.jpg'); ?>');


    }

  function view_commodity_images(){
    "use strict";
    $('#commodity_list_carosel').modal('show');
  }

  function show_detail_item(el){
  "use strict";

  $('.add-title').text($(el).data('name'));
  $('#show_detail').modal('show');
  
  $('input[name="warehouse_id"]').val($(el).data('warehouse_id'));
  $('input[name="commodity_id"]').val($(el).data('commodity_id'));
  $('input[name="expiry_date"]').val($(el).data('expiry_date'));

  
    var ProposalServerParams1 = {
        "expiry_date1": "[name='expiry_date']",
        "commodity_id1": "[name='commodity_id']",
        "warehouse_id1": "[name='warehouse_id']",
    };

  $('.table-table_out_of_stock').DataTable().destroy();
  $('.table-table_expired').DataTable().destroy();

    var table_out_of_stock = $('table.table-table_out_of_stock');
    var _table_api = initDataTable(table_out_of_stock, admin_url+'warehouse/table_out_of_stock', true, '', ProposalServerParams1);
    
    var table_expired = $('table.table-table_expired');
    var _table_api = initDataTable(table_expired, admin_url+'warehouse/table_expired', true, '', ProposalServerParams1);


}





</script>