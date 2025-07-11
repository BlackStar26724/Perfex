<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<script src="https://cdn.jsdelivr.net/npm/handsontable@7.2.2/dist/handsontable.full.min.js"></script>
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable@7.2.2/dist/handsontable.full.min.css">
  
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
                <div class="row row-margin">

            <div class="col-md-9">
              <div class="panel panel-info col-md-12  panel-padding" >
               
                <div class="panel-body">
                  <div class="col-md-10">
                    <?php $company_name = get_option('invoice_company_name'); 
                     $address = get_option('invoice_company_address'); 
                     $day = date('d',strtotime($goods_delivery->date_add));
                     $month = date('m',strtotime($goods_delivery->date_add));
                     $year = date('Y',strtotime($goods_delivery->date_add));?>
                   
                  </div>
                  
                  <div class="col-md-4">
                    
                  </div>
                  <div class="col-md-4">
                    <p><h2 class="bold text-center"><?php echo mb_strtoupper(_l('export_output_slip')); ?></h2></p>
                  </div>
                  <div class="col-md-4">
                  </div>

                  <div class="col-md-3">
                  </div>
                  
                  <div class="col-md-12 pull-right">
                    <br>
                    <div class="row">
                      <div class="col-md-3 pull-right">
                        <p><span class="bold"><?php echo _l('debit'); ?>: </span>.....................</p>
                        <p><span class="bold"><?php echo _l('credit'); ?>: </span>.....................</p>
                      </div>
                      <div class="col-md-4 pull-right">
                      <p><span class="span-font-style"><?php echo _l('days').' '.$day.' '._l('month').' '.$month.' '._l('year') .' '.$year; ?></p>
                      <p><span class="bold"><?php echo _l('voucher_number'); ?>: </span><?php echo html_entity_decode($goods_delivery->goods_delivery_code) ?></p>
                      </div>
                    </div>
                  </div>

                  <table class="table">
                    <tbody>
                      <tr>
                        <td class="bold td-width"><?php echo _l('Buyer'); ?></td>
                        <td><?php echo html_entity_decode($goods_delivery->to_); ?></td>
                      </tr>
                      <tr>
                        <td class="bold"><?php echo _l('customer_name'); ?></td>
                        <td><?php echo html_entity_decode($goods_delivery->customer_name); ?></td>
                      </tr>
                      <tr>
                        <td class="bold"><?php echo _l('address'); ?></td>
                        <td><?php echo html_entity_decode($goods_delivery->address); ?></td>
                      </tr>
                     
                    
                      <tr>
                        <td class="bold"><?php echo _l('pdf'); ?></td>
                        <td>
                          <div class="btn-group">
                           <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file-pdf-o"></i><?php if(is_mobile()){echo ' PDF';} ?> <span class="caret"></span></a>
                           <ul class="dropdown-menu dropdown-menu-right">
                              <li class="hidden-xs"><a href="<?php echo admin_url('warehouse/stock_export_pdf/'.$goods_delivery->id.'?output_type=I'); ?>"><?php echo _l('view_pdf'); ?></a></li>
                              <li class="hidden-xs"><a href="<?php echo admin_url('warehouse/stock_export_pdf/'.$goods_delivery->id.'?output_type=I'); ?>" target="_blank"><?php echo _l('view_pdf_in_new_window'); ?></a></li>
                              <li><a href="<?php echo admin_url('warehouse/stock_export_pdf/'.$goods_delivery->id); ?>"><?php echo _l('download'); ?></a></li>
                           </ul>
                           </div>
                       
                    
                        </td>
                      </tr>
                    </tbody>
                  </table>

                  <table class="table table-bordered">
                    <tbody>
                     <tr>
                       <th colspan="1">STT</th>
                       <th colspan="1"><?php echo _l('description') ?></th>
                       <th colspan="1"><?php echo _l('commodity_code') ?></th>
                       <th colspan="1"><?php echo _l('warehouse_name') ?></th>
                       <th colspan="1"><?php echo _l('unit_name') ?></th>
                       <th colspan="1" class="text-center"><?php echo _l('quantity') ?></th>
                       <th colspan="1" class="text-center"><?php echo _l('unit_price') ?></th>
                      
                      </tr>
                      <tr>
                       <th></th>
                       <th></th>
                       <th></th>
                       <th></th>
                       <th></th>
                       <th></th>
                       <th></th>
                      </tr>
                      
                      <?php foreach (json_decode($goods_delivery_detail) as $receipt_key => $receipt_value) {
                         $commodity_name = (isset($receipt_value) ? $receipt_value->commodity_name : '');
                         $quantities = (isset($receipt_value) ? $receipt_value->quantities : '');
                         $unit_price = (isset($receipt_value) ? $receipt_value->unit_price : '');
                         $unit_price = (isset($receipt_value) ? $receipt_value->unit_price : '');
                         

                         $commodity_code = get_commodity_name($receipt_value->commodity_code) != null ? get_commodity_name($receipt_value->commodity_code)->commodity_code : '';

                         $warehouse_name = get_warehouse_name($receipt_value->warehouse_id) != null ? get_warehouse_name($receipt_value->warehouse_id)->warehouse_name : '';

                         $unit_name = get_unit_type($receipt_value->unit_id) != null ? get_unit_type($receipt_value->unit_id)->unit_name : '';
                      ?>
                      <tr>
                       <td><?php echo html_entity_decode($receipt_key) ?></td>
                        <td><?php echo html_entity_decode($commodity_name) ?></td>
                        <td><?php echo html_entity_decode($commodity_code) ?></td>
                        <td><?php echo html_entity_decode($warehouse_name) ?></td>
                        <td><?php echo html_entity_decode($unit_name) ?></td>
                        <td class="text-right"><?php echo html_entity_decode($quantities) ?></td>
                        <td class="text-right"><?php echo app_format_money((float)$unit_price,'') ?></td>
                        
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>

                 
                  <div class="row">
                    <div class="col-md-4 pull-right">
                        <p><span class="span-font-style"><?php echo _l('days').' ......... '._l('month').' ......... '._l('year') .' .......... '; ?></p>
                    </div>
                  </div>
                <br>
                  <div class="row">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-4">
                        <p><span class="bold"><?php echo _l('receiver') ?></p>
                        <p><span class="span-font-style"><?php echo _l('sign_full_name') ?></p>
                    </div>
                    <div class="col-md-4">
                        <p><span class="bold"><?php echo _l('stocker') ?></p>
                        <p><span class="span-font-style"><?php echo _l('sign_full_name') ?></p>

                    </div>
                    <div class="col-md-3">
                        <p><span class="bold"><?php echo _l('chief_accountant') ?></p>
                        <p><span class="span-font-style"><?php echo _l('sign_full_name') ?></p>

                    </div>
                  </div>

                <br>
                <br>
                <br>
                <br>


    <div class="project-overview-right">
    <?php if(count($list_approve_status) > 0){ ?>
      
     <div class="row">
       <div class="col-md-12 project-overview-expenses-finance">
        <div class="col-md-4 text-sm-center ">
        </div>
        <?php 
          $this->load->model('staff_model');
          $enter_charge_code = 0;
        foreach ($list_approve_status as $value) {
          $value['staffid'] = explode(', ',$value['staffid']);
          if($value['action'] == 'sign'){
         ?>
         <div class="col-md-3 text-sm-center" >
             <p class="text-uppercase text-muted no-mtop bold">
              <?php
              $staff_name = '';
              $st = _l('status_0');
              $color = 'warning';
              foreach ($value['staffid'] as $key => $val) {
                if($staff_name != '')
                {
                  $staff_name .= ' or ';
                }
                $staff_name .= $this->staff_model->get($val)->firstname;
              }
              echo html_entity_decode($staff_name); 
              ?></p>
             <?php if($value['approve'] == 1){ 
              ?>
              <img src="<?php echo site_url('modules/warehouse/uploads/stock_export/'.$goods_delivery->id.'/signature_'.$value['id'].'.png'); ?>" class="img-width-height">
             <?php }
              ?>    
        </div>
        <?php }else{ ?>
        <div class="col-md-3 text-sm-center ">
             <p class="text-uppercase text-muted no-mtop bold">
              <?php
              $staff_name = '';
              foreach ($value['staffid'] as $key => $val) {
                if($staff_name != '')
                {
                  $staff_name .= ' or ';
                }
                $staff_name .= $this->staff_model->get($val)->firstname;
              }
              echo html_entity_decode($staff_name); 
              ?></p>
             <?php if($value['approve'] == 1){ 
              ?>
              <img src="http://greenwork.local/modules/warehouse/uploads/approval/approved.png"class="img-width-height">
             <?php }elseif($value['approve'] == -1){ ?>
                <img src="http://greenwork.local/modules/warehouse/uploads/approval/rejected.png" class="img-width-height">
            <?php }
              ?>    
        </div>
        <?php }
        } ?>
       </div>
       
    </div>
    
    <?php } ?>
    </div>
                  <div class="pull-right">
                    
                  <?php 
                  if($goods_delivery->approval != 1 && ($check_approve_status == false || $check_approve_status == 'reject'))

                    { ?>
            <?php if($check_appr && $check_appr != false){ ?>
              <a data-toggle="tooltip" data-loading-text="<?php echo _l('wait_text'); ?>" class="btn btn-success lead-top-btn lead-view" data-placement="top" href="#" onclick="send_request_approve(<?php echo html_entity_decode($goods_delivery->id); ?>); return false;"><?php echo _l('send_request_approve'); ?></a>
            <?php } ?>

            <?php }
              if(isset($check_approve_status['staffid'])){
                  ?>
                  <?php 
              if(in_array(get_staff_user_id(), $check_approve_status['staffid']) && !in_array(get_staff_user_id(), $get_staff_sign)){ ?>
                  <div class="btn-group" >
                         <a href="#" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo _l('approve'); ?><span class="caret"></span></a>
                         <ul class="dropdown-menu dropdown-menu-right menu-with-heght">
                          <li>
                            <div class="col-md-12">
                              <?php echo render_textarea('reason', 'reason'); ?>
                            </div>
                          </li>
                            <li>
                              <div class="row text-right col-md-12">
                                <a href="#" data-loading-text="<?php echo _l('wait_text'); ?>" onclick="approve_request(<?php echo html_entity_decode($goods_delivery->id); ?>); return false;" class="btn btn-success button-margin" ><?php echo _l('approve'); ?></a>
                               <a href="#" data-loading-text="<?php echo _l('wait_text'); ?>" onclick="deny_request(<?php echo html_entity_decode($goods_delivery->id); ?>); return false;" class="btn btn-warning"><?php echo _l('deny'); ?></a></div>
                            </li>
                         </ul>
                      </div>
                <?php }
                  ?>
                  
                <?php
                 if(in_array(get_staff_user_id(), $check_approve_status['staffid']) && in_array(get_staff_user_id(), $get_staff_sign)){ ?>
                  <button onclick="accept_action();" class="btn btn-success pull-right action-button"><?php echo _l('e_signature_sign'); ?></button>
                <?php }
                  ?>
                  <?php 
                   }
                  ?>
                </div>
                </div>
              </div>
              <?php $value = (isset($payslip->record) ? $payslip->record : []) ?>
                    <?php $record = $value; ?>
                    <?php $value = (isset($payslip->spending) ? $payslip->spending : []) ?>
                    <?php $spending = $value; ?>
              

            </div>
            
           
              <div class="col-md-3">
              <div class="panel panel-info col-md-12 panel-padding">
                <div class="panel-heading "><?php echo _l('approval_information'); ?></div>
                <div class="panel-body">
                  <h5 class="no-margin">
                          <?php echo _l('approver_list'); ?>:
                  </h5>
                  <?php 
                  $stt = 1;
                    foreach ($list_approve_status as $key => $value) {
                       $value['staffid'] = explode(', ',$value['staffid']);
                      $approve = '<span class="label label status-border-color inline-block project-status-' . $goods_delivery->approval . '" >' . _l('status_0') . '</span>';
                      if($value['approve'] == 1){
                        $approve = '<span class="label label inline-block status-border-color1 project-status-' . $goods_delivery->approval . '" >' . _l('status_1') . '</span>';
                      }elseif ($value['approve'] == -1) {
                        $approve = '<span class="label label status-border-color2 inline-block project-status-' . $goods_delivery->approval . '" >' . _l('status_-1') . '</span>';
                      }
                      $staff_name = '';
                        foreach ($value['staffid'] as $key => $val) {
                          if($staff_name != '')
                          {
                            $staff_name .= ' or ';
                          }
                          $staff_name .= get_staff_full_name($val);
                        }
                      echo html_entity_decode($stt.': '.$staff_name.' '.$approve).'<br>';
                      $stt++;
                    }
                   ?>

                  <hr class="hr-panel-heading" />
                  <h5 class="no-margin">
                          <?php echo _l('activity_log'); ?>
                  </h5>
                  <div class="activity-feed">
                      <?php $enter_code = 0;
                      foreach($payslip_log as $log){
                          $approve = '';
                        
                  
                        
                          ?>
                          <div class="feed-item">
                              <div class="row">
                                  <div class="col-md-12">
                                   <div class="date"><span class="text-has-action" data-toggle="tooltip" data-title="<?php echo _dt($log['date']); ?>"><?php echo time_ago($log['date']); ?></span></div>
                                   <div class="text">
                                    <?php

                                    $fullname = get_staff_full_name($log['staffid']);
                                    if($log['staffid'] != 0){ ?>
                                        <a href="<?php echo admin_url('profile/'.$log['staffid']); ?>"><?php echo staff_profile_image($log['staffid'],array('staff-profile-xs-image','pull-left mright10')); ?></a>
                                    <?php }?>
                                  
                                  <p class="mtop10 no-mbot"><?php echo html_entity_decode($fullname) . ' - <b>'.
                                    _l($log['note']).'</b>'; ?></p>
                                  
                              </div>
                          </div>
                          
                          <div class="clearfix"></div>
                          <div class="col-md-12">
                              <hr class="hr-10" />
                          </div>
                      </div>
                  </div>
                  <?php 
                 
                } ?>
                  </div>
                </div>
              </div>
            </div>

          
                  </div>
                    
                   
                    <div class="col-md-12 ">
                      
                        <h5 class="no-margin font-bold h4-color"><i class="fa fa-clone menu-icon menu-icon" aria-hidden="true"></i> <?php echo _l('stock_export_detail'); ?></h5>
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

                          </div>

                          </div>

                      <hr>
                      <div class="modal-footer">
                        <a href="<?php echo admin_url('warehouse/manage_delivery'); ?>"class="btn btn-default pull-right mright10 display-block"><?php echo _l('close'); ?></a>
                      </div>

                       
                      </div>

                    </div>
                   
                  </div>
              
               </div>
            </div>
          </div>

          <div class="modal fade" id="add_action" tabindex="-1" role="dialog">
             <div class="modal-dialog">
                <div class="modal-content">
                   
                  <div class="modal-body">
                   <p class="bold" id="signatureLabel"><?php echo _l('signature'); ?></p>
                      <div class="signature-pad--body">
                        <canvas id="signature" height="130" width="550"></canvas>
                      </div>
                      <input type="text" class="sig-input-style"  tabindex="-1" name="signature" id="signatureInput">
                      <div class="dispay-block">
                        <button type="button" class="btn btn-default btn-xs clear" tabindex="-1" onclick="signature_clear();"><?php echo _l('clear'); ?></button>
                      </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('cancel'); ?></button>
                     <button onclick="sign_request(<?php echo html_entity_decode($goods_delivery->id); ?>);" data-loading-text="<?php echo _l('wait_text'); ?>" autocomplete="off" class="btn btn-success"><?php echo _l('e_signature_sign'); ?></button>
                    </div>
                </div>
             </div>
          </div>

      </div>
    </div>
  </div>


<?php init_tail(); ?>
<?php require 'modules/warehouse/assets/js/edit_delivery_js.php';?>
</body>
</html>



