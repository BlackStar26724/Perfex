<?php init_head(); ?>

<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12" id="small-table">
            <div class="panel_s">
               <div class="panel-body">
                <?php echo form_hidden('proposal_id',$proposal_id); ?>
                  <div class="row">
                     <div class="col-md-12">
                      <h4 class="no-margin font-bold"><i class="fa fa-clone menu-icon menu-icon" aria-hidden="true"></i> <?php echo _l($title); ?></h4>
                      <br>

                    </div>
                  </div>
                  <div class="row row-margin-bottom">
                    <div class="col-md-5  ">
                        <?php if (has_permission('warehouse', '', 'create') || is_admin()) { ?>

                          
                        <a href="#" onclick="new_commodity_item(); return false;" class="btn btn-info pull-left display-block mr-4 button-margin-r-b" data-toggle="sidebar-right" data-target=".commodity_list-add-edit-modal">
                            <?php echo _l('add'); ?>
                        </a>

                        <a href="<?php echo admin_url('warehouse/import_xlsx_commodity'); ?>" class="btn btn-success pull-left display-block  mr-4 button-margin-r-b">
                            <?php echo _l('import_excel'); ?>
                        </a>

                        <a href="<?php echo site_url('warehouse/commodity_sync_pos') ?>" class="btn btn-info pull-left display-block mr-4 button-margin-r-b" data-toggle="sidebar-right">
                            <?php echo _l('synchronize'); ?>
                        </a>

                        <?php } ?>
                    </div>
                  
                    <div class=" col-md-2">
                      <select name="alert_filter" id="alert_filter" class="selectpicker"  data-live-search="true" data-width="100%" data-none-selected-text="<?php echo _l('Alert'); ?>">

                            <option value=""></option>
                            <option value="1"><?php echo _l('out_of_stock') ; ?></option>
                            <option value="2"><?php echo _l('expired') ; ?></option>

                        </select>
                    </div>

                    <div class=" col-md-2">
                      <select name="warehouse_filter[]" id="warehouse_filter" class="selectpicker" multiple="true" data-live-search="true" data-width="100%" data-none-selected-text="<?php echo _l('Warehouse'); ?>">

                          <?php foreach($warehouse_filter as $warehouse) { ?>
                            <option value="<?php echo html_entity_decode($warehouse['warehouse_id']); ?>"><?php echo html_entity_decode($warehouse['warehouse_name']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class=" col-md-2">
                      <select name="commodity_filter[]" id="commodity_filter" class="selectpicker" data-live-search="true" multiple="true" data-width="100%" data-none-selected-text="<?php echo _l('Commodity'); ?>">

                          <?php foreach($commodity_filter as $commodity) { ?>
                            <option value="<?php echo html_entity_decode($commodity['id']); ?>"><?php echo html_entity_decode($commodity['description']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                     <div class="col-md-1">
                        <a href="#" class="btn btn-default pull-right btn-with-tooltip toggle-small-view hidden-xs" onclick="toggle_small_view_proposal('.proposal_sm','#proposal_sm_view'); return false;" data-toggle="tooltip" title="<?php echo _l('invoices_toggle_table_tooltip'); ?>"><i class="fa fa-angle-double-left"></i></a>
                    </div>
                    
                   
                   
                    </div>
                      <?php render_datatable(array(
                        _l('_images'),
                        _l('commodity_code'),
                        _l('commodity_name'),
                        _l('group_name'),
                        _l('warehouse_name'),
                        _l('inventory_number'),
                        _l('unit_name'),
                        _l('rate'),
                        _l('purchase_price'),
                        _l('tax'),
                        _l('status'),
                        ),'table_commodity_list',['proposal_sm' => 'proposal_sm']); ?>
               </div>
            </div>
         </div>
         <div class="col-md-7 small-table-right-col">
            <div id="proposal_sm_view" class="hide">
            </div>
         </div>
      </div>
   </div>
   
</div>


    <div class="modal" id="warehouse_type" tabindex="-1" role="dialog">
    <div class="modal-dialog ht-dialog-width">

          <?php echo form_open_multipart(admin_url('warehouse/add_commodity_list'), array('id'=>'add_warehouse_type')); ?>
          <div class="modal-content" >
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                    <h4 class="modal-title">
                        <span class="add-title"><?php echo _l('add'); ?></span>
                    </h4>
                   
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                         <div id="warehouse_type_id">
                         </div>   
                     <div class="form"> 
                        <div class="col-md-12" id="add_handsontable">
                        </div>
                          <?php echo form_hidden('hot_warehouse_type'); ?>
                    </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     <button id="latch_assessor" type="button" class="btn btn-info intext-btn" onclick="add_warehouse_type(this); return false;" ><?php echo _l('submit'); ?></button>
                </div>
                <?php echo form_close(); ?>
              </div>
              </div>
          </div>


  <!-- add one commodity list sibar start-->       

    <div class="modal" id="commodity_list-add-edit" tabindex="-1" role="dialog">
    <div class="modal-dialog ht-dialog-width">

        <?php echo form_open_multipart(admin_url('warehouse/commodity_list_add_edit'),array('class'=>'commodity_list-add-edit','autocomplete'=>'off')); ?>

      <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">
                    <span class="edit-commodity-title"><?php echo _l('edit_item'); ?></span>
                    <span class="add-commodity-title"><?php echo _l('add_item'); ?></span>
                </h4>
            </div>

            <div class="modal-body">
                <div id="commodity_item_id"></div>


                <div class="horizontal-scrollable-tabs preview-tabs-top">
                  <div class="scroller arrow-left"><i class="fa fa-angle-left"></i></div>
                  <div class="scroller arrow-right"><i class="fa fa-angle-right"></i></div>
                  <div class="horizontal-tabs">
                  <ul class="nav nav-tabs nav-tabs-horizontal mbot15" role="tablist">
                   <li role="presentation" class="active">
                       <a href="#interview_infor" aria-controls="interview_infor" role="tab" data-toggle="tab" aria-controls="interview_infor">
                       <span class="glyphicon glyphicon-align-justify"></span>&nbsp;<?php echo _l('general_infor'); ?>
                       </a>
                    </li>
                    <li role="presentation">
                       <a href="#interview_evaluate" aria-controls="interview_evaluate" role="tab" data-toggle="tab" aria-controls="interview_evaluate">
                       <i class="fa fa-group"></i>&nbsp;<?php echo _l('properties'); ?>
                       </a>
                    </li>
                    
                   </ul>
                 </div>
               </div>

               <div class="tab-content">
              
                <!-- interview process start -->
                  <div role="tabpanel" class="tab-pane active" id="interview_infor">

                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo render_input('commodity_code', 'commodity_code'); ?>
                                </div>
                                <div class="col-md-6">
                                  <?php echo render_input('description', 'commodity_name'); ?>
                                </div>
                                
                            </div>

                            <div class="row">
                               <div class="col-md-4">
                                     <?php echo render_input('commodity_barcode', 'commodity_barcode','','text',array('readonly' => 'true')); ?>
                                </div>
                              <div class="col-md-4">
                                <a href="#" class="pull-right display-block input_method"><i class="fa fa-question-circle skucode-tooltip"  data-toggle="tooltip" title="" data-original-title="<?php echo _l('commodity_sku_code_tooltip'); ?>"></i></a>
                                <?php echo render_input('sku_code', 'sku_code','','',array('disabled' => 'true')); ?>
                              </div>
                              <div class="col-md-4">
                                <?php echo render_input('sku_name', 'sku_name'); ?>
                              </div>
                            </div>

                            

                            <div class="row">
                              <div class="col-md-12">
                                    <?php echo render_textarea('long_description', 'description'); ?>
                              </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                     <?php echo render_select('commodity_type',$commodity_types,array('commodity_type_id','commondity_name'),'commodity_type'); ?>

                                </div>
                                 <div class="col-md-6">
                                     <?php echo render_select('unit_id',$units,array('unit_type_id','unit_name'),'units'); ?>
                                </div>
                            </div>


                             <div class="row">
                              
                                <div class="col-md-6">
                                     <?php echo render_select('group_id',$commodity_groups,array('id','name'),'commodity_group'); ?>
                                </div>
                                 <div class="col-md-6">
                                     <?php echo render_select('sub_group',$sub_groups,array('id','sub_group_name'),'sub_group'); ?>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">

                                     <?php $premium_rates = isset($premium_rates) ? $premium_rates : '' ?>
                                    <?php 
                                    $attr = array();
                                    $attr = ['data-type' => 'currency'];
                                     echo render_input('rate', 'rate','', 'text', $attr); ?>


                                </div>
                                <div class="col-md-6">

                                    <?php 
                                    $attr = array();
                                    $attr = ['data-type' => 'currency'];
                                     echo render_input('purchase_price', 'purchase_price','', 'text', $attr); ?>
                                  
                                </div>
                            </div>

                            <div class="row">
                              
                                <div class="col-md-6">
                                     <?php echo render_select('tax',$taxes,array('id','name'),'taxes'); ?>
                                </div>
                            </div>
                            <?php if(!isset($expense) || (isset($expense) && $expense->attachment == '')){ ?>
                            <div id="dropzoneDragArea" class="dz-default dz-message">
                               <span><?php echo _l('expense_add_edit_attach_receipt'); ?></span>
                            </div>
                            <div class="dropzone-previews"></div>
                            <?php } ?>

                            <div id="images_old_preview">
                              
                            </div>

                        
                  </div>
               
                  <div role="tabpanel" class="tab-pane" id="interview_evaluate">
                    <div class="row">
                    <div class="col-md-12">
                     <div id="additional_criteria"></div>   
                     <div class="form">

                        <div class="row">
                            <div class="col-md-6">
                                <?php echo render_input('origin', 'origin'); ?>
                            </div>
                            <div class="col-md-6">
                                 <?php echo render_select('style_id',$styles,array('style_type_id','style_name'),'styles'); ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                 <?php echo render_select('model_id',$models,array('body_type_id','body_name'),'model_id'); ?>
                            </div>
                            <div class="col-md-6">
                                 <?php echo render_select('size_id',$sizes,array('size_type_id','size_name'),'sizes'); ?>
                            </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <?php echo render_select('color',$colors,array('color_id',array('color_hex','color_name')),'_color'); ?>
                          </div>
                        </div>

                        

                        
                        

                    </div>
                    </div>
                    </div>

                  </div>
                 
              </div>

            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
            </div>
          </div>

          </div>
        </div>
            <?php echo form_close(); ?>

<!-- add one commodity list sibar end -->  
<div class="modal fade" id="show_detail" tabindex="-1" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">
                      <span class="add-title"></span>
                  </h4>
              </div>
              <div class="modal-body">
                  <div class="row">
                     <div class="horizontal-scrollable-tabs preview-tabs-top col-md-12">
                  <div class="scroller arrow-left"><i class="fa fa-angle-left"></i></div>
                  <div class="scroller arrow-right"><i class="fa fa-angle-right"></i></div>
                  <div class="horizontal-tabs">
                    <ul class="nav nav-tabs nav-tabs-horizontal mbot15" role="tablist">
                      <li role="presentation" class="active">
                           <a href="#out_of_stock" aria-controls="out_of_stock" role="tab" id="tab_out_of_stock" data-toggle="tab">
                              <?php echo _l('out_of_stock') ?>
                           </a>
                        </li>
                        <li role="presentation">
                           <a href="#expired" aria-controls="expired" role="tab" id="tab_expired" data-toggle="tab">
                              <?php echo _l('expired') ?>
                           </a>
                        </li>                      
                    </ul>
                    </div>
                </div>

                <div class="tab-content col-md-12">
                  <div role="tabpanel" class="tab-pane active row" id="out_of_stock">
                    <div class="col-md-12">
                      <?php render_datatable(array(
                          _l('id'),
                          _l('commodity_name'),
                          _l('exprired'),
                          _l('quantity'),


                          ),'table_out_of_stock'); ?>
                    </div>
                  </div>

                  <div role="tabpanel" class="tab-pane row" id="expired">
                    <div class="col-md-12">
                      <?php render_datatable(array(
                          _l('id'),
                          _l('commodity_name'),
                          _l('exprired'),
                          _l('quantity'),

                          ),'table_expired'); ?>
                    </div>
                  </div>                  
                </div>
                  </div>
              </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                </div>
            </div>
          </div>
      </div>
       <?php echo form_hidden('warehouse_id'); ?>
       <?php echo form_hidden('commodity_id'); ?>
       <?php echo form_hidden('expiry_date'); ?>



<?php init_tail(); ?>
<?php require 'modules/warehouse/assets/js/commodity_list_js.php';?>
</body>
</html>
