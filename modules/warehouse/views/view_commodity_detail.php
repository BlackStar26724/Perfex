<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">               
                        <div class="clearfix"></div>
                           <h4>
                              <?php echo html_entity_decode($commodity_item->description); ?>
                           </h4>


                        <hr class="hr-panel-heading" /> 
                        <div class="clearfix"></div> 
                        <div class="col-md-12">

                         <div class="row col-md-12">

                            <h4 class="h4-color"><?php echo _l('general_infor'); ?></h4>
                            <hr class="hr-color">

                            
                            
                            <div class="col-md-7 panel-padding">
                              <table class="table border table-striped table-margintop">
                                  <tbody>

                                      <tr class="project-overview">
                                        <td class="bold" width="30%"><?php echo _l('commodity_code'); ?></td>
                                        <td><?php echo html_entity_decode($commodity_item->commodity_code) ; ?></td>
                                     </tr>
                                     <tr class="project-overview">
                                        <td class="bold"><?php echo _l('commodity_name'); ?></td>
                                        <td><?php echo html_entity_decode($commodity_item->description) ; ?></td>
                                     </tr>
                                     <tr class="project-overview">
                                        <td class="bold"><?php echo _l('commodity_group'); ?></td>
                                        <td><?php echo get_group_name(html_entity_decode($commodity_item->group_id)) != null ? get_group_name(html_entity_decode($commodity_item->group_id))->name : '' ; ?></td>
                                     </tr>
                                     <tr class="project-overview">
                                        <td class="bold"><?php echo _l('commodity_barcode'); ?></td>
                                        <td><?php echo html_entity_decode($commodity_item->commodity_barcode) ; ?></td>
                                     </tr>
                                     <tr class="project-overview">
                                        <td class="bold"><?php echo _l('sku_code'); ?></td>
                                        <td><?php echo html_entity_decode($commodity_item->sku_code) ; ?></td>
                                     </tr>
                                     <tr class="project-overview">
                                        <td class="bold"><?php echo _l('sku_name'); ?></td>
                                        <td><?php echo html_entity_decode($commodity_item->sku_name) ; ?></td>
                                     </tr>
                                     
                                    

                                    </tbody>
                              </table>
                          </div>

                            <div class="gallery">
                                <div class="wrapper-masonry">
                                  <div id="masonry" class="masonry-layout columns-3">
                                <?php if(isset($commodity_file) && count($commodity_file) > 0){ ?>
                                  <?php foreach ($commodity_file as $key => $value) { ?>

                                      <?php if(file_exists(WAREHOUSE_ITEM_UPLOAD .$value["rel_id"].'/'.$value["file_name"])){ ?>
                                          <a  class="images_w_table" href="<?php echo site_url('modules/warehouse/uploads/item_img/'.$value["rel_id"].'/'.$value["file_name"]); ?>"><img class="images_w_table" src="<?php echo site_url('modules/warehouse/uploads/item_img/'.$value["rel_id"].'/'.$value["file_name"]); ?>" alt="<?php echo html_entity_decode($value['file_name']) ?>"/></a>
                                           
                                        <?php }else{ ?>
                                          <a  class="images_w_table" href="<?php echo site_url('modules/purchase/uploads/item_img/'.$value["rel_id"].'/'.$value["file_name"]); ?>"><img class="images_w_table" src="<?php echo site_url('modules/purchase/uploads/item_img/'.$value["rel_id"].'/'.$value["file_name"]); ?>" alt="<?php echo html_entity_decode($value['file_name']) ?>"/></a>
                                            
                                           
                                        <?php } ?>


                                <?php } ?>
                              <?php }else{ ?>

                                    <a  href="<?php echo site_url('modules/warehouse/uploads/nul_image.jpg'); ?>"><img class="images_w_table" src="<?php echo site_url('modules/warehouse/uploads/nul_image.jpg'); ?>" alt="nul_image.jpg"/></a>

                              <?php } ?>
                                <div class="clear"></div>
                              </div>
                            </div>
                            </div>
                            <br>
                        </div>


                         <h4 class="h4-color"><?php echo _l('infor_detail'); ?></h4>
                          <hr class="hr-color">
                          <div class="col-md-6 panel-padding" >
                            <table class="table border table-striped table-margintop" >
                                <tbody>
                                   <tr class="project-overview">
                                      <td class="bold td-width"><?php echo _l('origin'); ?></td>
                                        <td><?php echo html_entity_decode($commodity_item->origin) ; ?></td>
                                   </tr>
                                   <tr class="project-overview">
                                      <td class="bold"><?php echo _l('colors'); ?></td>
                                        <td><?php echo html_entity_decode($commodity_item->color_id) ; ?></td>
                                   </tr>
                                   <tr class="project-overview">
                                      <td class="bold"><?php echo _l('style_id'); ?></td>
                                    <td><?php  if($commodity_item->style_id != null){ echo get_style_name(html_entity_decode($commodity_item->style_id)) != null ? get_style_name(html_entity_decode($commodity_item->style_id))->style_name : '';}else{echo '';} ?></td>
                                   </tr>

                                    <tr class="project-overview">
                                      <td class="bold"><?php echo _l('rate'); ?></td>
                                      <td><?php echo app_format_money((float)$commodity_item->rate,'') ; ?></td>
                                   </tr>

                                </tbody>
                            </table>
                          </div>
                           
                          <div class="col-md-6 panel-padding" >
                            <table class="table table-striped table-margintop">
                                <tbody>
                                   <tr class="project-overview">
                                      <td class="bold" width="40%"><?php echo _l('model_id'); ?></td>
                                       <td><?php if($commodity_item->style_id != null){ echo get_model_name(html_entity_decode($commodity_item->model_id)) != null ? get_model_name(html_entity_decode($commodity_item->model_id))->body_name : ''; }else{echo '';}?></td>
                                   </tr>
                                   <tr class="project-overview">
                                      <td class="bold"><?php echo _l('size_id'); ?></td>

                                      <td><?php if($commodity_item->style_id != null){ echo get_size_name(html_entity_decode($commodity_item->size_id)) != null ? get_size_name(html_entity_decode($commodity_item->size_id))->size_name : ''; }else{ echo '';}?></td>
                                   </tr>
                                   
                                     <tr class="project-overview">
                                        <td class="bold"><?php echo _l('unit_id'); ?></td>
                                        <td><?php echo  $commodity_item->unit_id != '' && get_unit_type($commodity_item->unit_id) != null ? get_unit_type($commodity_item->unit_id)->unit_name : ''; ?></td>
                                     </tr> 

                                     <tr class="project-overview">
                                        <td class="bold"><?php echo _l('purchase_price'); ?></td>
                                        <td><?php echo app_format_money((float)$commodity_item->purchase_price,'') ; ?></td>
                                     </tr>
                                     
                                  
                                  
                                  </tbody>
                                </table>
                          </div>

                           <h4 class="h4-color"><?php echo _l('description'); ?></h4>
                          <hr class="hr-color">
                          <h5><?php echo html_entity_decode($commodity_item->long_description) ; ?></h5>

                                   
                            <table class="table border table-striped ">
                               <tbody>  
                                   <tr class="project-overview">
                                     <td colspan="2">
                                        <div class="horizontal-scrollable-tabs preview-tabs-top">
                                          <div class="scroller arrow-left"><i class="fa fa-angle-left"></i></div>
                                            <div class="scroller arrow-right"><i class="fa fa-angle-right"></i></div>
                                            <div class="horizontal-tabs">
                                              <ul class="nav nav-tabs nav-tabs-horizontal mbot15" role="tablist">

                                                  <li role="presentation" class="active">
                                                     <a href="#out_of_stock" aria-controls="out_of_stock" role="tab" id="tab_out_of_stock" data-toggle="tab">
                                                        <?php echo _l('inventory_stock') ?>
                                                     </a>
                                                  </li>

                                                  <li role="presentation" >
                                                     <a href="#expiry_date" aria-controls="expiry_date" role="tab" id="tab_expiry_date" data-toggle="tab">
                                                        <?php echo _l('expiry_date') ?>
                                                     </a>
                                                  </li>

                                                  <li role="presentation">
                                                     <a href="#history" aria-controls="history" role="tab" id="tab_history" data-toggle="tab">
                                                        <?php echo _l('history') ?>
                                                     </a>
                                                  </li>                      
                                              </ul>
                                              </div>
                                          </div>

                                          <div class="tab-content col-md-12">

                                            <div role="tabpanel" class="tab-pane active row" id="out_of_stock">
                                                <?php render_datatable(array(
                                                  _l('commodity_name'),
                                                  _l('expiry_date'),
                                                  _l('warehouse_name'),
                                              
                                                  _l('inventory_number'),
                                                  _l('unit_name'),
                                                  _l('rate'),
                                                  _l('purchase_price'),
                                                  _l('tax'),
                                                  _l('status'),
                                                 
                                                  ),'table_inventory_stock'); ?>
                                            </div>

                                            <div role="tabpanel" class="tab-pane  row" id="expiry_date">
                                                    <?php render_datatable(array(
                                                  _l('commodity_name'),
                                                  _l('expiry_date'),
                                                  _l('warehouse_name'),
                                              
                                                  _l('inventory_number'),
                                                  _l('unit_name'),
                                                  _l('rate'),
                                                  _l('purchase_price'),
                                                  _l('tax'),
                                                  _l('status'),
                                                 
                                                  ),'table_view_commodity_detail',['proposal_sm' => 'proposal_sm']); ?>
                                            </div>

                                            <div role="tabpanel" class="tab-pane row" id="history">
                                                <?php render_datatable(array(
                                              _l('form_code'),
                                              _l('commodity_code'),
                                              _l('description'),
                                              _l('warehouse_code'),
                                              _l('warehouse_name'),
                                              _l('date_add'),
                                              _l('old_quantity'),
                                              _l('new_quantity'),
                                              _l('note'),
                                              _l('status'),
                                              ),'table_warehouse_history'); ?>
                                            </div>                  
                                          </div>                                    
                                     </td>
                                   </tr>
                                   
  
                            
                                </tbody>
                            </table>                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo form_hidden('commodity_id'); ?>

<?php init_tail(); ?>
<?php require 'modules/warehouse/assets/js/view_commodity_detail_js.php';?>
<?php require 'modules/warehouse/assets/js/commodity_detail_js.php';?>
</body>
</html>

