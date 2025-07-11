<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="_buttons">
	<a href="#" class="btn btn-info pull-left" onclick="new_approval_setting(); return false;"><?php echo _l('new_approval_setting'); ?></a>
</div>
<div class="clearfix"></div>
<hr class="hr-panel-heading" />
<div class="clearfix"></div>
<table class="table dt-table">
	<thead>
		<th><?php echo _l('id'); ?></th>
		<th><?php echo _l('name'); ?></th>
		<th><?php echo _l('related'); ?></th>
		<th><?php echo _l('options'); ?></th>
	</thead>
	<tbody>
	<?php foreach($approval_setting as $value){ ?>
		<tr>
		   <td><?php echo html_entity_decode($value['id']); ?></td>
		   <td><?php echo html_entity_decode($value['name']); ?></td>
		   <td><?php echo _l($value['related']); ?></td>
		   <td>
		     <a href="#" onclick="edit_approval_setting(this,<?php echo html_entity_decode($value['id']); ?>); return false" data-name="<?php echo html_entity_decode($value['name']); ?>" data-related="<?php echo html_entity_decode($value['related']); ?>" data-setting='<?php echo html_entity_decode($value['setting']); ?>' class="btn btn-default btn-icon"><i class="fa fa-pencil-square-o"></i></a>
		      <a href="<?php echo admin_url('warehouse/delete_approval_setting/'.$value['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
		   </td>
		</tr>
	<?php } ?>
	</tbody>
</table>

<div class="modal fade" id="approval_setting_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog approval_model" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">
					<span class="edit-title"><?php echo _l('edit_approval_setting'); ?></span>
					<span class="add-title"><?php echo _l('new_approval_setting'); ?></span>
				</h4>
			</div>
			<?php echo form_open('warehouse/approval_setting',array('id'=>'approval-setting-form')); ?>
			<?php echo form_hidden('approval_setting_id'); ?>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<?php echo render_input('name','subject','','text'); ?>
						<?php $related = [ 
								0 => ['id' => '1', 'name' => _l('stock_import')],
								1 => ['id' => '2', 'name' => _l('stock_export')],
								2 => ['id' => '3', 'name' => _l('increase')],
								3 => ['id' => '4', 'name' => _l('reduction')]
							]; ?>

						
						<?php echo render_select('related',$related,array('id','name'),'task_single_related'); ?>
						<div class="list_approve">
							<div id="item_approve">
                                <div class="col-md-11">
                                <div class="col-md-4">
                                	<div class="select-placeholder form-group">
		                                <label for="approver[0]"><?php echo _l('approver'); ?></label>
		                            <select name="approver[0]" id="approver[0]" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>" data-hide-disabled="true" required>
		                                <option value=""></option>
		                                <option value="direct_manager"><?php echo _l('direct_manager'); ?></option>
		                                <option value="department_manager"><?php echo _l('department_manager'); ?></option>
		                                <option value="staff"><?php echo _l('staff'); ?></option>
		                            </select>
		                           </div> 
                          		</div>
                          		<div class="col-md-4">
                                	<div class="select-placeholder form-group">
		                                <label for="staff[0]"><?php echo _l('staff'); ?></label>
		                            <select name="staff[0]" id="staff[0]" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>" data-hide-disabled="true">
		                                <option value=""></option>
		                                <?php foreach($staffs as $val){
		                                 $selected = '';
		                                  ?>
		                              <option value="<?php echo html_entity_decode($val['staffid']); ?>">
		                                 <?php echo get_staff_full_name(html_entity_decode($val['staffid'])); ?>
		                              </option>
		                              <?php } ?>
		                            </select>
		                           </div> 
                          		</div>
                          		<div class="col-md-4">
                                	<div class="select-placeholder form-group">
		                                <label for="action[0]"><?php echo _l('action'); ?></label>
		                            <select name="action[0]" id="action[0]" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>" data-hide-disabled="true">
		                                <option value="sign"><?php echo _l('sign'); ?></option>
		                                <option value="approve"><?php echo _l('approve'); ?></option>
		                            </select>
		                           </div> 
                          		</div>
                          		</div>
                                <div class="col-md-1 new_vendor_requests_button">
                                <span class="pull-bot">
                                    <button name="add" class="btn new_vendor_requests btn-success" data-ticket="true" type="button"><i class="fa fa-plus"></i></button>
                                    </span>
                              </div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
</body>
</html>

