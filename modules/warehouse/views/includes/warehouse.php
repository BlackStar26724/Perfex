<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div>
<div class="_buttons">
    <a href="#" onclick="new_warehouse_type(); return false;" class="btn btn-info pull-left display-block">
        <?php echo _l('add_warehouse_type'); ?>
    </a>
</div>
<div class="clearfix"></div>
<hr class="hr-panel-heading" />
<div class="clearfix"></div>
<table class="table dt-table border table-striped">
 <thead>
    <th><?php echo _l('ID'); ?></th>
    <th><?php echo _l('warehouse_code'); ?></th>
    <th><?php echo _l('warehouse_name'); ?></th>
    <th><?php echo _l('warehouse_address'); ?></th>
    <th><?php echo _l('order'); ?></th>
    <th><?php echo _l('display'); ?></th>
    <th><?php echo _l('note'); ?></th>
    <th><?php echo _l('options'); ?></th>
 </thead>
  <tbody>
    <?php foreach($warehouse_types as $warehouse_type){ ?>

    <tr>
        <td><?php echo _l($warehouse_type['warehouse_id']); ?></td>
        <td><?php echo _l($warehouse_type['warehouse_code']); ?></td>
        <td><?php echo _l($warehouse_type['warehouse_name']); ?></td>
        <td><?php echo _l($warehouse_type['warehouse_address']); ?></td>
        <td><?php echo _l($warehouse_type['order']); ?></td>
        <td><?php if($warehouse_type['display'] == 0){ echo _l('not_display'); }else{echo _l('display');} ?></td>
        <td><?php echo _l($warehouse_type['note']); ?></td>

        <td>
            <?php if (has_permission('warehouse', '', 'edit') || is_admin()) { ?>
              <a href="#" onclick="edit_warehouse_type(this,<?php echo html_entity_decode($warehouse_type['warehouse_id']); ?>); return false;" data-warehouse_code="<?php echo html_entity_decode($warehouse_type['warehouse_code']); ?>" data-warehouse_name="<?php echo html_entity_decode($warehouse_type['warehouse_name']); ?>" data-warehouse_address="<?php echo html_entity_decode($warehouse_type['warehouse_address']); ?>" data-order="<?php echo html_entity_decode($warehouse_type['order']); ?>" data-display="<?php echo html_entity_decode($warehouse_type['display']); ?>" data-note="<?php echo html_entity_decode($warehouse_type['note']); ?>" class="btn btn-default btn-icon"><i class="fa fa-pencil-square-o"></i>
            </a>
            <?php } ?>

            <?php if (has_permission('warehouse', '', 'delete') || is_admin()) { ?> 
            <a href="<?php echo admin_url('warehouse/delete_warehouse/'.$warehouse_type['warehouse_id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
             <?php } ?>
        </td>
    </tr>
    <?php } ?>
 </tbody>
</table>   

<div class="modal1 fade" id="warehouse_type" tabindex="-1" role="dialog">
        <div class="modal-dialog setting-handsome-table">
          <?php echo form_open_multipart(admin_url('warehouse/warehouse_'), array('id'=>'add_warehouse_type')); ?>

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="add-title"><?php echo _l('add_warehouse_type'); ?></span>
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
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                        
                         <button id="latch_assessor" type="button" class="btn btn-info intext-btn" onclick="add_warehouse_type(this); return false;" ><?php echo _l('submit'); ?></button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
</div>

<?php require 'modules/warehouse/assets/js/warehouse_js.php';?>
</body>
</html>
