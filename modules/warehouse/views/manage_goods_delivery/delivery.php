<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

  
  <div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12" id="small-table">
            <div class="panel_s">
               <div class="panel-body">

                  <div class="row">
                     <div class="col-md-12">
                      <h4 class="no-margin font-bold h4-color"><i class="fa fa-clone menu-icon menu-icon" aria-hidden="true"></i> <?php echo _l($title); ?></h4>
                      <hr class="hr-color">
                    </div>
                  </div>

                  <?php echo form_open_multipart(admin_url('warehouse/goods_delivery'), array('id'=>'add_goods_delivery')); ?>
                <!-- start -->
                <div class="row" >
                  <div class="col-md-12">
                     <div class="panel panel-primary">
                      <div class="panel-heading"><?php echo _l('general_infor') ?></div>
                      <div class="panel-body">

                        <div class="col-md-6">
                          <?php $goods_delivery_code = (isset($goods_code) ? $goods_code : '');?>
                          <?php echo render_input('goods_delivery_code', 'document_number',$goods_delivery_code,'',array('disabled' => 'true')) ?>
                        </div>

                        <div class="col-md-3">
                            <?php echo render_date_input('date_c','accounting_date', $current_day) ?>
                        </div>
                        <div class="col-md-3">
                          <?php echo render_date_input('date_add','day_vouchers', $current_day) ?>
                        </div>

                        <br>
                        <div class="col-md-6">

                          <?php $customer_code = (isset($candidate) ? $candidate->customer_code : '');
                          echo render_input('customer_code','customer_code',$customer_code) ?>

                        </div>

                        <div class="col-md-6">
                          <?php $custumer_name = (isset($candidate) ? $candidate->custumer_name : '');
                          echo render_input('customer_name','customer_name',$custumer_name) ?>
                        </div>

                      <div class=" col-md-6">
                          <?php $to = (isset($candidate) ? $candidate->to : '');
                          echo render_input('to_','receiver',$to) ?>
                      </div>
                      <div class=" col-md-6">
                          <?php $address = (isset($candidate) ? $candidate->address : '');
                          echo render_input('address','address',$address) ?>
                      </div>
                      <div class="col-md-6">
                          <?php echo render_select('warehouse_id',$warehouses,array('warehouse_id',array('warehouse_code','warehouse_name')),'warehouse_out'); ?>
                      </div>
                      <div class=" col-md-6">
                          <label for="staff_id" class="control-label"><?php echo _l('salesman'); ?></label>
                            <select name="staff_id" class="selectpicker" id="staff_id" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>"> 
                              <option value=""></option> 
                              <?php foreach($staff as $s){ ?>
                            <option value="<?php echo html_entity_decode($s['staffid']); ?>"> <?php echo html_entity_decode($s['firstname']).''.html_entity_decode($s['lastname']); ?></option>                  
                            <?php }?>
                            </select>
                      </div>

                      <div class=" col-md-12">
                          <?php $description = (isset($candidate) ? $candidate->description : '');
                          echo render_textarea('description','reason_for_export',$description) ?>
                      </div>


                      </div>
                    </div>
                  </div>

                  
                  </div>
                    
                    <!-- start  -->
                    <div class="col-md-12 ">
                        <h5 class="no-margin font-bold h4-color" ><i class="fa fa-clone menu-icon menu-icon" aria-hidden="true"></i> <?php echo _l('stock_export_detail'); ?></h5>
                        <hr class="hr-color">

                          <div class="panel-body ">
                            <div class="horizontal-scrollable-tabs preview-tabs-top">
                             <div class="scroller arrow-left"><i class="fa fa-angle-left"></i></div>
                             <div class="scroller arrow-right"><i class="fa fa-angle-right"></i></div>
                             <div class="horizontal-tabs">
                             <ul class="nav nav-tabs nav-tabs-horizontal mbot15" role="tablist">
                               <li role="presentation" class="active">
                                   <a href="#commodity" aria-controls="commodity" role="tab" data-toggle="tab" aria-controls="commodity" id="ac_commodity">
                                   <span class="glyphicon glyphicon-align-justify"></span>&nbsp;<?php echo _l('commodity'); ?>
                                   </a>
                                </li>
                              </ul>
                             </div>
                            </div>

                            <div class="tab-content">
                              <div role="tabpanel" class="tab-pane active" id="commodity">
                                <div class="form"> 
                           
                                    <div id="hot_purchase" class="hot handsontable htColumnHeaders">
                                        
                                    </div>
                        
                                  <?php echo form_hidden('hot_purchase'); ?>
                                </div>

                              </div>
                            </div>

                             <div class="col-md-3 pull-right panel-padding">
                                <table class="table border table-striped table-margintop">
                                    <tbody>

                                       <tr class="project-overview">
                                          <td ><?php echo render_input('total_money','total_money','','',array('disabled' => 'true')) ?>
                                            <?php echo form_hidden('total_money'); ?>
                                            
                                          </td>

                                       </tr>
                                        </tbody>
                                </table>
                              </div>


                          </div>

                          </div>

                  <hr>
                 <div class="modal-footer">
                    <a href="#"class="btn btn-info pull-right mright10 display-block add_goods_delivery" ><?php echo _l('submit'); ?></a>
                    
                    <a href="<?php echo admin_url('warehouse/manage_delivery'); ?>"class="btn btn-default pull-right mright10 display-block"><?php echo _l('close'); ?></a>


                </div>

                     
                      </div>

                    </div>
                   

                  </div>
               


                  <?php echo form_close(); ?>

               </div>
            </div>
          </div>
      </div>
    </div>
  </div>


<?php init_tail(); ?>
<?php require 'modules/warehouse/assets/js/goods_delivery_js.php';?>
</body>
</html>



