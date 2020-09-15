<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12" id="small-table">
                <div class="panel_s">
                    <div class="panel-body">
                         <?php echo form_hidden('purchase_id',$purchase_id); ?>
                        <div class="row">
                         <div class="col-md-12">
                          <h4 class="no-margin font-bold"><i class="fa fa-shopping-basket" aria-hidden="true"></i> <?php echo _l($title); ?></h4>
                          <hr />
                         </div>
                        </div>
                        <div class="row">    
                            <div class="_buttons col-md-3">
                                <?php if (has_permission('purchase', '', 'create') || is_admin()) { ?>
                                <a href="<?php echo admin_url('warehouse/manage_goods_receipt'); ?>"class="btn btn-info pull-left mright10 display-block">
                                    <?php echo _l('stock_received_docket'); ?>
                                </a>
                                <?php } ?>
                            </div>
                             <div class="col-md-1 pull-right">
                                <a href="#" class="btn btn-default pull-right btn-with-tooltip toggle-small-view hidden-xs" onclick="toggle_small_view_proposal('.purchase_sm','#purchase_sm_view'); return false;" data-toggle="tooltip" title="<?php echo _l('invoices_toggle_table_tooltip'); ?>"><i class="fa fa-angle-double-left"></i></a>
                            </div>
                        </div>
                    <br><br>
                    <?php render_datatable(array(
                        _l('stock_received_docket_code'),
                        _l('supplier_name'),
                        _l('Buyer'),
                        _l('total_tax_money'),
                        _l('total_goods_money'),
                        _l('value_of_inventory'),
                        _l('total_money'),
                        _l('status'),
                        ),'table_manage_goods_receipt',['purchase_sm' => 'purchase_sm']); ?>
                        
                    </div>
                </div>
            </div>

        <div class="col-md-7 small-table-right-col">
            <div id="purchase_sm_view" class="hide">
            </div>
        </div>

        </div>
    </div>
</div>
<script>var hidden_columns = [3,4,5];</script>
<?php init_tail(); ?>
</body>
</html>

