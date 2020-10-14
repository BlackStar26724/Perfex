<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * warehouse controler
 */
class warehouse extends AdminController {
	public function __construct() {
		parent::__construct();
		$this->load->model('warehouse_model');
		require_once module_dir_path(WAREHOUSE_MODULE_NAME) . '/third_party/excel/PHPExcel.php';
	}

	/**
	 * setting
	 * @return view
	 */
	public function setting() {
		if (!has_permission('warehouse', '', 'edit') && !is_admin()) {
			access_denied('warehouse');
		}
		$data['group'] = $this->input->get('group');

		$data['title'] = _l('setting');
		$data['tab'][] = 'commodity_type';
		$data['tab'][] = 'commodity_group';
		$data['tab'][] = 'sub_group';
		$data['tab'][] = 'units';
		$data['tab'][] = 'colors';
		$data['tab'][] = 'bodys';
		$data['tab'][] = 'sizes';
		$data['tab'][] = 'styles';
		$data['tab'][] = 'warehouse';
		$data['tab'][] = 'inventory';
		$data['tab'][] = 'approval_setting';
		if ($data['group'] == '') {
			$data['group'] = 'commodity_type';
			$data['commodity_types'] = $this->warehouse_model->get_commodity_type();

		} elseif ($data['group'] == 'commodity_group') {
			$data['commodity_group_types'] = $this->warehouse_model->get_commodity_group_type();

		} elseif ($data['group'] == 'units') {
			$data['unit_types'] = $this->warehouse_model->get_unit_type();

		} elseif ($data['group'] == 'bodys') {
			$data['body_types'] = $this->warehouse_model->get_body_type();

		} elseif ($data['group'] == 'sizes') {
			$data['size_types'] = $this->warehouse_model->get_size_type();

		} elseif ($data['group'] == 'styles') {
			$data['style_types'] = $this->warehouse_model->get_style_type();

		} elseif ($data['group'] == 'warehouse') {
			$data['warehouse_types'] = $this->warehouse_model->get_warehouse();

		} elseif ($data['group'] == 'inventory') {
			$data['inventory_min'] = $this->warehouse_model->get_inventory_min();

		} elseif ($data['group'] == 'approval_setting') {
			$data['approval_setting'] = $this->warehouse_model->get_approval_setting();

		} elseif ($data['group'] == 'sub_group') {

			$data['sub_groups'] = $this->warehouse_model->get_sub_group();
		} elseif ($data['group'] == 'colors') {

			$data['colors'] = $this->warehouse_model->get_color();
		}

		if ($data['group'] == 'commodity_type') {
			$data['commodity_types'] = $this->warehouse_model->get_commodity_type();

		}

		$data['tabs']['view'] = 'includes/' . $data['group'];

		$this->load->view('manage_setting', $data);
	}

	/**
	 * commodity type
	 * @param  integer $id
	 * @return redirect
	 */
	public function commodity_type($id = '') {
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();

			if (!$this->input->post('id')) {

				$mess = $this->warehouse_model->add_commodity_type($data);
				if ($mess) {
					set_alert('success', _l('added_successfully') . _l('commodity_type'));

				} else {
					set_alert('warning', _l('Add_commodity_type_false'));
				}
				redirect(admin_url('warehouse/setting?group=commodity_type'));

			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->warehouse_model->add_commodity_type($data, $id);
				if ($success) {
					set_alert('success', _l('updated_successfully') . _l('commodity_type'));
				} else {
					set_alert('warning', _l('updated_commodity_type_false'));
				}

				redirect(admin_url('warehouse/setting?group=commodity_type'));
			}
		}
	}

	/**
	 * delete commodity type
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_commodity_type($id) {
		if (!$id) {
			redirect(admin_url('warehouse/setting?group=commodity_type'));
		}
		$response = $this->warehouse_model->delete_commodity_type($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced', _l('commodity_type')));
		} elseif ($response == true) {
			set_alert('success', _l('deleted', _l('commodity_type')));
		} else {
			set_alert('warning', _l('problem_deleting', _l('commodity_type')));
		}
		redirect(admin_url('warehouse/setting?group=commodity_type'));
	}

	/**
	 * unit type
	 * @param  integer $id
	 * @return redirect
	 */
	public function unit_type($id = '') {
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();

			if (!$this->input->post('id')) {

				$mess = $this->warehouse_model->add_unit_type($data);
				if ($mess) {
					set_alert('success', _l('added_successfully') . _l('unit_type'));

				} else {
					set_alert('warning', _l('Add_unit_type_false'));
				}
				redirect(admin_url('warehouse/setting?group=units'));

			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->warehouse_model->add_unit_type($data, $id);
				if ($success) {
					set_alert('success', _l('updated_successfully') . _l('unit_type'));
				} else {
					set_alert('warning', _l('updated_unit_type_false'));
				}

				redirect(admin_url('warehouse/setting?group=units'));
			}
		}
	}

	/**
	 * delete unit type
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_unit_type($id) {
		if (!$id) {
			redirect(admin_url('warehouse/setting?group=units'));
		}
		$response = $this->warehouse_model->delete_unit_type($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced', _l('unit_type')));
		} elseif ($response == true) {
			set_alert('success', _l('deleted', _l('unit_type')));
		} else {
			set_alert('warning', _l('problem_deleting', _l('unit_type')));
		}
		redirect(admin_url('warehouse/setting?group=units'));
	}

	/**
	 * size type
	 * @param  integer $id
	 * @return redirect
	 */
	public function size_type($id = '') {
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();

			if (!$this->input->post('id')) {

				$mess = $this->warehouse_model->add_size_type($data);
				if ($mess) {
					set_alert('success', _l('added_successfully') . _l('size_type'));

				} else {
					set_alert('warning', _l('Add_size_type_false'));
				}
				redirect(admin_url('warehouse/setting?group=sizes'));

			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->warehouse_model->add_size_type($data, $id);
				if ($success) {
					set_alert('success', _l('updated_successfully') . _l('size_type'));
				} else {
					set_alert('warning', _l('updated_size_type_false'));
				}

				redirect(admin_url('warehouse/setting?group=sizes'));
			}
		}
	}

	/**
	 * delete size type
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_size_type($id) {
		if (!$id) {
			redirect(admin_url('warehouse/setting?group=sizes'));
		}
		$response = $this->warehouse_model->delete_size_type($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced', _l('size_type')));
		} elseif ($response == true) {
			set_alert('success', _l('deleted', _l('size_type')));
		} else {
			set_alert('warning', _l('problem_deleting', _l('size_type')));
		}
		redirect(admin_url('warehouse/setting?group=sizes'));
	}

	/**
	 * style type
	 * @param  integer $id
	 * @return redirect
	 */
	public function style_type($id = '') {
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();

			if (!$this->input->post('id')) {
				$mess = $this->warehouse_model->add_style_type($data);
				if ($mess) {
					set_alert('success', _l('added_successfully') . _l('style_type'));

				} else {
					set_alert('warning', _l('Add_style_type_false'));
				}
				redirect(admin_url('warehouse/setting?group=styles'));

			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->warehouse_model->add_style_type($data, $id);
				if ($success) {
					set_alert('success', _l('updated_successfully') . _l('style_type'));
				} else {
					set_alert('warning', _l('updated_style_type_false'));
				}

				redirect(admin_url('warehouse/setting?group=styles'));
			}
		}
	}
	/**
	 * delete style type
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_style_type($id) {
		if (!$id) {
			redirect(admin_url('warehouse/setting?group=styles'));
		}
		$response = $this->warehouse_model->delete_style_type($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced', _l('style_type')));
		} elseif ($response == true) {
			set_alert('success', _l('deleted', _l('style_type')));
		} else {
			set_alert('warning', _l('problem_deleting', _l('style_type')));
		}
		redirect(admin_url('warehouse/setting?group=styles'));
	}

	/**
	 * body type
	 * @param  integer $id
	 * @return redirect
	 */
	public function body_type($id = '') {
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();

			if (!$this->input->post('id')) {

				$mess = $this->warehouse_model->add_body_type($data);
				if ($mess) {
					set_alert('success', _l('added_successfully') . _l('body_type'));

				} else {
					set_alert('warning', _l('Add_body_type_false'));
				}
				redirect(admin_url('warehouse/setting?group=bodys'));

			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->warehouse_model->add_body_type($data, $id);
				if ($success) {
					set_alert('success', _l('updated_successfully') . _l('body_type'));
				} else {
					set_alert('warning', _l('updated_body_type_false'));
				}

				redirect(admin_url('warehouse/setting?group=bodys'));
			}
		}
	}

	/**
	 * delete body type
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_body_type($id) {
		if (!$id) {
			redirect(admin_url('warehouse/setting?group=bodys'));
		}
		$response = $this->warehouse_model->delete_body_type($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced', _l('body_type')));
		} elseif ($response == true) {
			set_alert('success', _l('deleted', _l('body_type')));
		} else {
			set_alert('warning', _l('problem_deleting', _l('body_type')));
		}
		redirect(admin_url('warehouse/setting?group=bodys'));
	}

	/**
	 * commodty group type
	 * @param  integer $id
	 * @return redirect
	 */
	public function commodity_group_type($id = '') {
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();

			if (!$this->input->post('id')) {

				$mess = $this->warehouse_model->add_commodity_group_type($data);
				if ($mess) {
					set_alert('success', _l('added_successfully') . _l('commodity_group_type'));

				} else {
					set_alert('warning', _l('Add_commodity_group_type_false'));
				}
				redirect(admin_url('warehouse/setting?group=commodity_group'));

			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->warehouse_model->add_commodity_group_type($data, $id);
				if ($success) {
					set_alert('success', _l('updated_successfully') . _l('commodity_group_type'));
				} else {
					set_alert('warning', _l('updated_commodity_group_type_false'));
				}

				redirect(admin_url('warehouse/setting?group=commodity_group'));
			}
		}
	}

	/**
	 * delete commodity group type
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_commodity_group_type($id) {
		if (!$id) {
			redirect(admin_url('warehouse/setting?group=commodity_group'));
		}
		$response = $this->warehouse_model->delete_commodity_group_type($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced', _l('commodity_group_type')));
		} elseif ($response == true) {
			set_alert('success', _l('deleted', _l('commodity_group_type')));
		} else {
			set_alert('warning', _l('problem_deleting', _l('commodity_group_type')));
		}
		redirect(admin_url('warehouse/setting?group=commodity_group'));
	}

	/**
	 * warehouse_
	 * @param  integer $id
	 * @return redirect
	 */

	public function warehouse_($id = '') {
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();

			if (!$this->input->post('id')) {

				$mess = $this->warehouse_model->add_warehouse($data);
				if ($mess) {
					set_alert('success', _l('added_successfully') . _l('warehouse'));

				} else {
					set_alert('warning', _l('Add_warehouse_false'));
				}
				redirect(admin_url('warehouse/setting?group=warehouse'));

			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->warehouse_model->add_warehouse($data, $id);
				if ($success) {
					set_alert('success', _l('updated_successfully') . _l('warehouse'));
				} else {
					set_alert('warning', _l('updated_warehouse_false'));
				}

				redirect(admin_url('warehouse/setting?group=warehouse'));
			}
		}
	}

	/**
	 * delete warehouse
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_warehouse($id) {
		if (!$id) {
			redirect(admin_url('warehouse/setting?group=warehouse'));
		}
		$response = $this->warehouse_model->delete_warehouse($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced', _l('warehouse')));
		} elseif ($response == true) {
			set_alert('success', _l('deleted', _l('warehouse')));
		} else {
			set_alert('warning', _l('problem_deleting', _l('warehouse')));
		}
		redirect(admin_url('warehouse/setting?group=warehouse'));
	}

	/**
	 * table commodity list
	 *
	 * @return array
	 */
	public function table_commodity_list() {
		$this->app->get_table_data(module_views_path('warehouse', 'table_commodity_list'));
	}

	/**
	 * commodity list
	 * @param  integer $id
	 * @return load view
	 */
	public function commodity_list($id = '') {
		$this->load->model('departments_model');
		$this->load->model('staff_model');

		$data['units'] = $this->warehouse_model->get_unit_add_commodity();
		$data['commodity_types'] = $this->warehouse_model->get_commodity_type_add_commodity();
		$data['commodity_groups'] = $this->warehouse_model->get_commodity_group_add_commodity();
		$data['warehouses'] = $this->warehouse_model->get_warehouse_add_commodity();
		$data['taxes'] = get_taxes();
		$data['styles'] = $this->warehouse_model->get_style_add_commodity();
		$data['models'] = $this->warehouse_model->get_body_add_commodity();
		$data['sizes'] = $this->warehouse_model->get_size_add_commodity();
		//filter
		$data['warehouse_filter'] = $this->warehouse_model->get_warehouse();
		$data['commodity_filter'] = $this->warehouse_model->get_commodity();
		$data['sub_groups'] = $this->warehouse_model->get_sub_group();
		$data['colors'] = $this->warehouse_model->get_color_add_commodity();

		$data['title'] = _l('commodity_list');

		$data['proposal_id'] = $id;

		$this->load->view('commodity_list', $data);
	}

	/**
	 * get commodity data ajax
	 * @param  integer $id
	 * @return view
	 */
	public function get_commodity_data_ajax($id) {

		$data['id'] = $id;
		$data['commodites'] = $this->warehouse_model->get_commodity($id);
		$data['inventory_commodity'] = $this->warehouse_model->get_inventory_commodity($id);
		$data['commodity_file'] = $this->warehouse_model->get_warehourse_attachments($id);
		$this->load->view('commodity_detail', $data);
	}

	/**
	 * add commodity list
	 * @param  integer $id
	 * @return redirect
	 */
	public function add_commodity_list($id = '') {
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();

			if (!$this->input->post('id')) {

				$mess = $this->warehouse_model->add_commodity($data);
				if ($mess) {
					set_alert('success', _l('added_successfully') . _l('commodity_list'));

				} else {
					set_alert('warning', _l('Add_commodity_list_false'));
				}
				redirect(admin_url('warehouse/commodity_list'));

			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->warehouse_model->add_warehouse($data, $id);
				if ($success) {
					set_alert('success', _l('updated_successfully') . _l('commodity_list'));
				} else {
					set_alert('warning', _l('updated_commodity_list_false'));
				}

				redirect(admin_url('warehouse/commodity_list'));
			}
		}
	}

	/**
	 * delete commodity
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_commodity($id) {
		if (!$id) {
			redirect(admin_url('warehouse/commodity_list'));
		}
		$response = $this->warehouse_model->delete_commodity($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced', _l('commodity_list')));
		} elseif ($response == true) {
			set_alert('success', _l('deleted', _l('commodity_list')));
		} else {
			set_alert('warning', _l('problem_deleting', _l('commodity_list')));
		}
		redirect(admin_url('warehouse/commodity_list'));
	}

	/**
	 * table manage goods receipt
	 * @param  integer $id
	 * @return array
	 */
	public function table_manage_goods_receipt() {
		$this->app->get_table_data(module_views_path('warehouse', 'manage_goods_receipt/table_manage_goods_receipt'));
	}

	/**
	 * manage purchase
	 * @param  integer $id
	 * @return view
	 */
	public function manage_purchase($id = '') {
		$data['title'] = _l('stock_received_manage');
		$data['purchase_id'] = $id;
		$this->load->view('manage_goods_receipt/manage_purchase', $data);
	}

	/**
	 * manage goods receipt
	 * @param  integer $id
	 * @return view
	 */
	public function manage_goods_receipt() {
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();

			if (!$this->input->post('id')) {

				$mess = $this->warehouse_model->add_goods_receipt($data);
				if ($mess) {
					set_alert('success', _l('added_successfully') . _l('stock_received_docket'));

				} else {
					set_alert('warning', _l('Add_stock_received_docket_false'));
				}
				redirect(admin_url('warehouse/manage_purchase'));

			}
		}
		//get vaule render dropdown select
		$data['commodity_code_name'] = $this->warehouse_model->get_commodity_code_name();
		$data['units_code_name'] = $this->warehouse_model->get_units_code_name();
		$data['units_warehouse_name'] = $this->warehouse_model->get_warehouse_code_name();

		$data['title'] = _l('goods_receipt');

		$data['commodity_codes'] = $this->warehouse_model->get_commodity();

		$data['warehouses'] = $this->warehouse_model->get_warehouse();
		if (get_status_modules_wh('purchase')) {
			$data['pr_orders'] = get_pr_order();
			$data['pr_orders_status'] = true;
		} else {
			$data['pr_orders'] = [];
			$data['pr_orders_status'] = false;
		}

		if (get_status_modules_wh('purchase')) {
			$data['vendors'] = $this->warehouse_model->get_vendor();
		} else {
			$data['vendors'] = [];

		}

		$data['goods_code'] = $this->warehouse_model->create_goods_code();
		$data['staff'] = $this->warehouse_model->get_staff();
		$data['current_day'] = date('Y-m-d');
		//check status module purchase

		$this->load->view('manage_goods_receipt/purchase', $data);

	}

	/**
	 * copy pur request
	 * @param  integer $pur request
	 * @return json encode
	 */
	public function coppy_pur_request($pur_request) {

		$pur_request_detail = $this->warehouse_model->get_pur_request($pur_request);

		echo json_encode([

			'result' => $pur_request_detail[0] ? $pur_request_detail[0] : '',
			'total_tax_money' => $pur_request_detail[1] ? $pur_request_detail[1] : '',
			'total_goods_money' => $pur_request_detail[2] ? $pur_request_detail[2] : '',
			'value_of_inventory' => $pur_request_detail[3] ? $pur_request_detail[3] : '',
			'total_money' => $pur_request_detail[4] ? $pur_request_detail[4] : '',
			'total_row' => $pur_request_detail[5] ? $pur_request_detail[5] : '',
		]);
	}

	/**
	 * copy pur vender
	 * @param  integer $pủ request
	 * @return json encode
	 */
	public function copy_pur_vender($pur_request) {

		$pur_vendor = $this->warehouse_model->get_vendor_ajax($pur_request);

		echo json_encode([

			'userid' => $pur_vendor['id'] ? $pur_vendor['id'] : '',
			'buyer' => $pur_vendor['buyer'] ? $pur_vendor['buyer'] : '',

		]);
	}

	/**
	 * view purchase
	 * @param  integer $id
	 * @return view
	 */
	public function view_purchase($id) {
		//approval
		$send_mail_approve = $this->session->userdata("send_mail_approve");
		if ((isset($send_mail_approve)) && $send_mail_approve != '') {
			$data['send_mail_approve'] = $send_mail_approve;
			$this->session->unset_userdata("send_mail_approve");
		}

		$data['get_staff_sign'] = $this->warehouse_model->get_staff_sign($id, 1);

		$data['check_approve_status'] = $this->warehouse_model->check_approval_details($id, 1);
		$data['list_approve_status'] = $this->warehouse_model->get_list_approval_details($id, 1);
		$data['payslip_log'] = $this->warehouse_model->get_activity_log($id, 1);

		//get vaule render dropdown select
		$data['commodity_code_name'] = $this->warehouse_model->get_commodity_code_name();
		$data['units_code_name'] = $this->warehouse_model->get_units_code_name();
		$data['units_warehouse_name'] = $this->warehouse_model->get_warehouse_code_name();

		$data['goods_receipt_detail'] = $this->warehouse_model->get_goods_receipt_detail($id);

		$data['goods_receipt'] = $this->warehouse_model->get_goods_receipt($id);

		$data['title'] = _l('stock_received_info');
		$check_appr = $this->warehouse_model->get_approve_setting('1');
		$data['check_appr'] = $check_appr;

		$this->load->view('manage_goods_receipt/view_purchase', $data);

	}

	/**
	 * edit purchase
	 * @param  integer $id
	 * @return view
	 */
	public function edit_purchase($id) {

		//check exist
		$goods_receipt = $this->warehouse_model->get_goods_receipt($id);
		 if (!$goods_receipt) {
                blank_page('Stock received Not Found', 'danger');
            }

		//approval
		$send_mail_approve = $this->session->userdata("send_mail_approve");
		if ((isset($send_mail_approve)) && $send_mail_approve != '') {
			$data['send_mail_approve'] = $send_mail_approve;
			$this->session->unset_userdata("send_mail_approve");
		}

		$data['get_staff_sign'] = $this->warehouse_model->get_staff_sign($id, 1);

		$data['check_approve_status'] = $this->warehouse_model->check_approval_details($id, 1);
		$data['list_approve_status'] = $this->warehouse_model->get_list_approval_details($id, 1);
		$data['payslip_log'] = $this->warehouse_model->get_activity_log($id, 1);

		//get vaule render dropdown select
		$data['commodity_code_name'] = $this->warehouse_model->get_commodity_code_name();
		$data['units_code_name'] = $this->warehouse_model->get_units_code_name();
		$data['units_warehouse_name'] = $this->warehouse_model->get_warehouse_code_name();

		$data['goods_receipt_detail'] = json_encode($this->warehouse_model->get_goods_receipt_detail($id));

		$data['goods_receipt'] = $goods_receipt;

		$data['title'] = _l('stock_received_info');

		$check_appr = $this->warehouse_model->get_approve_setting('1');
		$data['check_appr'] = $check_appr;

		$this->load->view('manage_goods_receipt/edit_purchase', $data);

	}

	public function add_goods_receipt() {

	}

	/**
	 * commodity code change
	 * @param  integer $val
	 * @return json encode
	 */
	public function commodity_code_change($val) {

		$value = $this->warehouse_model->get_commodity_hansometable($val);
		echo json_encode([
			'value' => get_object_vars($value),
		]);
		die;
	}

	/**
	 * update inventory min
	 * @param  integer $id
	 * @return redirect
	 */
	public function update_inventory_min($id = '') {
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();

			$success = $this->warehouse_model->update_inventory_min($data, $id);
			if ($success) {
				set_alert('success', _l('updated_successfully') . ' ' . _l('inventory'));
			} else {
				set_alert('warning', _l('updated_inventory_false'));
			}

			redirect(admin_url('warehouse/setting?group=inventory'));
		}
	}

	/**
	 * table warehouse history
	 *
	 * @return array
	 */
	public function table_warehouse_history() {
		$this->app->get_table_data(module_views_path('warehouse', 'table_warehouse_history'));
	}

	/**
	 * warehouse history
	 *
	 * @return view
	 */
	public function warehouse_history() {
		$data['title'] = _l('warehouse_history');

		$data['warehouse_filter'] = $this->warehouse_model->get_warehouse();
		$data['commodity_filter'] = $this->warehouse_model->get_commodity();
		$this->load->view('warehouse/warehouse_history', $data);
	}

	/**
	 * approval setting
	 * @return redirect
	 */
	public function approval_setting() {
		if ($this->input->post()) {
			$data = $this->input->post();
			if ($data['approval_setting_id'] == '') {
				$message = '';
				$success = $this->warehouse_model->add_approval_setting($data);
				if ($success) {
					$message = _l('added_successfully', _l('approval_setting'));
				}
				set_alert('success', $message);
				redirect(admin_url('warehouse/setting?group=approval_setting'));
			} else {
				$message = '';
				$id = $data['approval_setting_id'];
				$success = $this->warehouse_model->edit_approval_setting($id, $data);
				if ($success) {
					$message = _l('updated_successfully', _l('approval_setting'));
				}
				set_alert('success', $message);
				redirect(admin_url('warehouse/setting?group=approval_setting'));
			}
		}
	}

	/**
	 * delete approval setting
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_approval_setting($id) {
		if (!$id) {
			redirect(admin_url('warehouse/setting?group=approval_setting'));
		}
		$response = $this->warehouse_model->delete_approval_setting($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced', _l('approval_setting')));
		} elseif ($response == true) {
			set_alert('success', _l('deleted', _l('payment_mode')));
		} else {
			set_alert('warning', _l('problem_deleting', _l('approval_setting')));
		}
		redirect(admin_url('warehouse/setting?group=approval_setting'));
	}

	/**
	 * get html approval setting
	 * @param  integer $id
	 * @return html
	 */
	public function get_html_approval_setting($id = '') {
		$html = '';
		$staffs = $this->staff_model->get();
		$approver = [
			0 => ['id' => 'direct_manager', 'name' => _l('direct_manager')],
			1 => ['id' => 'department_manager', 'name' => _l('department_manager')],
			2 => ['id' => 'staff', 'name' => _l('staff')]];
		$action = [
			0 => ['id' => 'sign', 'name' => _l('sign')],
			1 => ['id' => 'approve', 'name' => _l('approve')],
		];
		if (is_numeric($id)) {
			$approval_setting = $this->warehouse_model->get_approval_setting($id);

			$setting = json_decode($approval_setting->setting);

			foreach ($setting as $key => $value) {
				if ($key == 0) {
					$html .= '<div id="item_approve">
                                    <div class="col-md-11">
                                    <div class="col-md-4"> ' .
					render_select('approver[' . $key . ']', $approver, array('id', 'name'), 'task_single_related', $value->approver) . '
                                    </div>
                                    <div class="col-md-4">
                                    ' . render_select('staff[' . $key . ']', $staffs, array('staffid', 'full_name'), 'staff', $value->staff) . '
                                    </div>
                                    <div class="col-md-4">
                                        ' . render_select('action[' . $key . ']', $action, array('id', 'name'), 'action', $value->action) . '
                                    </div>
                                    </div>
                                    <div class="col-md-1 button_class" >
                                    <span class="pull-bot">
                                        <button name="add" class="btn new_vendor_requests btn-success" data-ticket="true" type="button"><i class="fa fa-plus"></i></button>
                                        </span>
                                  </div>
                                </div>';
				} else {
					$html .= '<div id="item_approve">
                                    <div class="col-md-11">
                                    <div class="col-md-4">
                                        ' .
					render_select('approver[' . $key . ']', $approver, array('id', 'name'), 'task_single_related', $value->approver) . '
                                    </div>
                                    <div class="col-md-4">
                                        ' . render_select('staff[' . $key . ']', $staffs, array('staffid', 'full_name'), 'staff', $value->staff) . '
                                    </div>
                                    <div class="col-md-4">
                                        ' . render_select('action[' . $key . ']', $action, array('id', 'name'), 'action', $value->action) . '
                                    </div>
                                    </div>
                                    <div class="col-md-1 button_class" >
                                    <span class="pull-bot">
                                        <button name="add" class="btn remove_vendor_requests btn-danger" data-ticket="true" type="button"><i class="fa fa-minus"></i></button>
                                        </span>
                                  </div>
                                </div>';
				}
			}
		} else {
			$html .= '<div id="item_approve">
                        <div class="col-md-11">
                        <div class="col-md-4"> ' .
			render_select('approver[0]', $approver, array('id', 'name'), 'task_single_related') . '
                        </div>
                        <div class="col-md-4">
                        ' . render_select('staff[0]', $staffs, array('staffid', 'full_name'), 'staff') . '
                        </div>
                        <div class="col-md-4">
                            ' . render_select('action[0]', $action, array('id', 'name'), 'action') . '
                        </div>
                        </div>
                        <div class="col-md-1 button_class">
                        <span class="pull-bot">
                            <button name="add" class="btn new_vendor_requests btn-success" data-ticket="true" type="button"><i class="fa fa-plus"></i></button>
                            </span>
                      </div>
                    </div>';
		}

		echo json_encode([
			$html,
		]);
	}

	/**
	 * send request approve
	 * @return json
	 */
	public function send_request_approve() {
		$data = $this->input->post();
		$message = 'Send request approval fail';
		$success = $this->warehouse_model->send_request_approve($data);
		if ($success === true) {
			$message = 'Send request approval success';
			$data_new = [];
			$data_new['send_mail_approve'] = $data;
			$this->session->set_userdata($data_new);
		} else {
			$message = _l('could_not_find_approver_with', _l($success));
			$success = false;
		}
		echo json_encode([
			'success' => $success,
			'message' => $message,
		]);
		die;
	}

	/**
	 * approve request
	 * @param  integer $id
	 * @return json
	 */
	public function approve_request() {
		$data = $this->input->post();

		$data['staff_approve'] = get_staff_user_id();
		$success = false;
		$code = '';
		$signature = '';

		if (isset($data['signature'])) {
			$signature = $data['signature'];
			unset($data['signature']);
		}
		$status_string = 'status_' . $data['approve'];
		$check_approve_status = $this->warehouse_model->check_approval_details($data['rel_id'], $data['rel_type']);

		if (isset($data['approve']) && in_array(get_staff_user_id(), $check_approve_status['staffid'])) {

			$success = $this->warehouse_model->update_approval_details($check_approve_status['id'], $data);

			$message = _l('approved_successfully');

			if ($success) {
				if ($data['approve'] == 1) {
					$message = _l('approved_successfully');
					$data_log = [];

					if ($signature != '') {
						$data_log['note'] = "signed_request";
					} else {
						$data_log['note'] = "approve_request";
					}
					if ($signature != '') {
						switch ($data['rel_type']) {
						// case 'stock_import 1':
						case 1:
							$path = WAREHOUSE_STOCK_IMPORT_MODULE_UPLOAD_FOLDER . $data['rel_id'];
							break;
						// case 'stock_export 2':
						case 2:
							$path = WAREHOUSE_STOCK_EXPORT_MODULE_UPLOAD_FOLDER . $data['rel_id'];
							break;

						default:
							$path = WAREHOUSE_STOCK_IMPORT_MODULE_UPLOAD_FOLDER;
							break;
						}
						warehouse_process_digital_signature_image($signature, $path, 'signature_' . $check_approve_status['id']);
						$message = _l('sign_successfully');
					}
					$data_log['rel_id'] = $data['rel_id'];
					$data_log['rel_type'] = $data['rel_type'];
					$data_log['staffid'] = get_staff_user_id();
					$data_log['date'] = date('Y-m-d H:i:s');

					$this->warehouse_model->add_activity_log($data_log);

					$check_approve_status = $this->warehouse_model->check_approval_details($data['rel_id'], $data['rel_type']);

					if ($check_approve_status === true) {
						$this->warehouse_model->update_approve_request($data['rel_id'], $data['rel_type'], 1);
					}
				} else {
					$message = _l('rejected_successfully');
					$data_log = [];
					$data_log['rel_id'] = $data['rel_id'];
					$data_log['rel_type'] = $data['rel_type'];
					$data_log['staffid'] = get_staff_user_id();
					$data_log['date'] = date('Y-m-d H:i:s');
					$data_log['note'] = "rejected_request";
					$this->warehouse_model->add_activity_log($data_log);
					$this->warehouse_model->update_approve_request($data['rel_id'], $data['rel_type'], '-1');
				}
			}
		}

		$data_new = [];
		$data_new['send_mail_approve'] = $data;
		$this->session->set_userdata($data_new);
		echo json_encode([
			'success' => $success,
			'message' => $message,
		]);
		die();
	}

	/**
	 * stock import pdf
	 * @param  integer $id
	 * @return pdf file view
	 */
	public function stock_import_pdf($id) {
		if (!$id) {
			redirect(admin_url('warehouse/manage_goods_receipt/manage_purchase'));
		}

		$stock_import = $this->warehouse_model->get_stock_import_pdf_html($id);

		try {
			$pdf = $this->warehouse_model->stock_import_pdf($stock_import);
		} catch (Exception $e) {
			echo html_entity_decode($e->getMessage());
			die;
		}

		$type = 'D';

		if ($this->input->get('output_type')) {
			$type = $this->input->get('output_type');
		}

		if ($this->input->get('print')) {
			$type = 'I';
		}

		$pdf->Output('stock_import.pdf', $type);
	}

	/**
	 * send mail
	 * @param  integer $id
	 * @return json
	 */
	public function send_mail() {
		if ($this->input->is_ajax_request()) {
			$data = $this->input->post();
			if ((isset($data)) && $data != '') {
				$this->warehouse_model->send_mail($data);

				$success = 'success';
				echo json_encode([
					'success' => $success,
				]);
			}
		}
	}

	/**
	 * manage delivery
	 * @param  integer $id
	 * @return view
	 */
	public function manage_delivery($id = '') {
		$data['delivery_id'] = $id;
		$data['title'] = _l('stock_delivery_manage');
		$this->load->view('manage_goods_delivery/manage_delivery', $data);
	}

	/**
	 * goods delivery
	 * @return view
	 */
	public function goods_delivery() {
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();

			if (!$this->input->post('id')) {

				$mess = $this->warehouse_model->add_goods_delivery($data);
				if ($mess) {
					set_alert('success', _l('added_successfully') . _l('stock_delivery_docket'));

				} else {
					set_alert('warning', _l('Add_stock_delivery_docket_false'));
				}
				redirect(admin_url('warehouse/manage_delivery'));

			}
		}
		//get vaule render dropdown select
		$data['commodity_code_name'] = $this->warehouse_model->get_commodity_code_name();
		$data['units_code_name'] = $this->warehouse_model->get_units_code_name();
		$data['units_warehouse_name'] = $this->warehouse_model->get_warehouse_code_name();

		$data['title'] = _l('goods_delivery');

		$data['commodity_codes'] = $this->warehouse_model->get_commodity();

		$data['warehouses'] = $this->warehouse_model->get_warehouse();
		if (get_status_modules_wh('purchase')) {
			$data['pr_orders'] = get_pr_order();
		} else {
			$data['pr_orders'] = [];
		}

		$data['goods_code'] = $this->warehouse_model->create_goods_delivery_code();
		$data['staff'] = $this->warehouse_model->get_staff();
		$data['current_day'] = date('Y-m-d');

		$this->load->view('manage_goods_delivery/delivery', $data);

	}

	/**
	 * commodity goods delivery change
	 * @param  integer $val
	 * @return json
	 */
	public function commodity_goods_delivery_change($val) {

		if ($val != 'null') {
			$value = $this->warehouse_model->commodity_goods_delivery_change($val);

			echo json_encode([
				'value' => $value['commodity_value'],
				'warehouse_inventory' => $value['warehouse_inventory'],
			]);
			die;
		}
	}

	/**
	 * table manage delivery
	 * @return array
	 */
	public function table_manage_delivery() {
		$this->app->get_table_data(module_views_path('warehouse', 'manage_goods_delivery/table_manage_delivery'));
	}

	/**
	 * edit delivery
	 * @param  integer $id
	 * @return view
	 */
	public function edit_delivery($id) {
		//check exist
		$goods_delivery = $this->warehouse_model->get_goods_delivery($id);
		 if (!$goods_delivery) {
                blank_page('Stock export Not Found', 'danger');
            }

		//approval
		$send_mail_approve = $this->session->userdata("send_mail_approve");
		if ((isset($send_mail_approve)) && $send_mail_approve != '') {
			$data['send_mail_approve'] = $send_mail_approve;
			$this->session->unset_userdata("send_mail_approve");
		}

		$data['get_staff_sign'] = $this->warehouse_model->get_staff_sign($id, 2);

		$data['check_approve_status'] = $this->warehouse_model->check_approval_details($id, 2);
		$data['list_approve_status'] = $this->warehouse_model->get_list_approval_details($id, 2);
		$data['payslip_log'] = $this->warehouse_model->get_activity_log($id, 2);

		//get vaule render dropdown select
		$data['commodity_code_name'] = $this->warehouse_model->get_commodity_code_name();
		$data['units_code_name'] = $this->warehouse_model->get_units_code_name();
		$data['units_warehouse_name'] = $this->warehouse_model->get_warehouse_code_name();

		$data['goods_delivery_detail'] = json_encode($this->warehouse_model->get_goods_delivery_detail($id));

		$data['goods_delivery'] = $goods_delivery;

		$data['title'] = _l('stock_export_info');
		$check_appr = $this->warehouse_model->get_approve_setting('2');
		$data['check_appr'] = $check_appr;

		$this->load->view('manage_goods_delivery/edit_delivery', $data);

	}

	/**
	 * stock export pdf
	 * @param  integer $id
	 * @return pdf file view
	 */
	public function stock_export_pdf($id) {
		if (!$id) {
			redirect(admin_url('warehouse/manage_goods_delivery/manage_delivery'));
		}

		$stock_export = $this->warehouse_model->get_stock_export_pdf_html($id);

		try {
			$pdf = $this->warehouse_model->stock_export_pdf($stock_export);

		} catch (Exception $e) {
			echo html_entity_decode($e->getMessage());
			die;
		}

		$type = 'D';

		if ($this->input->get('output_type')) {
			$type = $this->input->get('output_type');
		}

		if ($this->input->get('print')) {
			$type = 'I';
		}

		$pdf->Output('stock_export.pdf', $type);
	}

	/**
	 * manage report
	 * @return view
	 */
	public function manage_report() {
		$data['group'] = $this->input->get('group');

		$data['title'] = _l('als_report');
		$data['tab'][] = 'stock_summary_report';
		$data['tab'][] = 'inventory_valuation_report';

		switch ($data['group']) {
		case 'stock_summary_report':
			$data['title'] = _l('stock_summary_report');

			break;
		case 'inventory_valuation_report':
			$data['title'] = _l('inventory_valuation_report');

			break;

		default:
			$data['title'] = _l('stock_summary_report');
			$data['group'] = 'stock_summary_report';
			break;
		}

		$data['tabs']['view'] = 'report/' . $data['group'];

		$this->load->view('report/manage_report', $data);
	}

	/**
	 * get data stock summary report
	 * @return json
	 */
	public function get_data_stock_summary_report() {
		if ($this->input->post()) {
			$data = $this->input->post();

			$stock_summary_report = $this->warehouse_model->get_stock_summary_report_view($data);
		}

		echo json_encode([
			'value' => $stock_summary_report,
		]);
		die();
	}

	/**
	 * stock summary report pdf
	 * @return pdf view file
	 */
	public function stock_summary_report_pdf() {
		$data = $this->input->post();
		if (!$data) {
			redirect(admin_url('warehouse/report/manage_report'));
		}

		$stock_summary_report = $this->warehouse_model->get_stock_summary_report($data);

		try {
			$pdf = $this->warehouse_model->stock_summary_report_pdf($stock_summary_report);

		} catch (Exception $e) {
			echo html_entity_decode($e->getMessage());
			die;
		}

		$type = 'D';

		if ($this->input->get('output_type')) {
			$type = $this->input->get('output_type');
		}

		if ($this->input->get('print')) {
			$type = 'I';
		}

		$pdf->Output('stock_summary_report.pdf', $type);
	}

	/**
	 * view delivery
	 * @param  integer $id
	 * @return view
	 */
	public function view_delivery($id) {
		//approval
		$send_mail_approve = $this->session->userdata("send_mail_approve");
		if ((isset($send_mail_approve)) && $send_mail_approve != '') {
			$data['send_mail_approve'] = $send_mail_approve;
			$this->session->unset_userdata("send_mail_approve");
		}

		$data['get_staff_sign'] = $this->warehouse_model->get_staff_sign($id, 2);

		$data['check_approve_status'] = $this->warehouse_model->check_approval_details($id, 2);
		$data['list_approve_status'] = $this->warehouse_model->get_list_approval_details($id, 2);
		$data['payslip_log'] = $this->warehouse_model->get_activity_log($id, 2);

		//get vaule render dropdown select
		$data['commodity_code_name'] = $this->warehouse_model->get_commodity_code_name();
		$data['units_code_name'] = $this->warehouse_model->get_units_code_name();
		$data['units_warehouse_name'] = $this->warehouse_model->get_warehouse_code_name();

		$data['goods_delivery_detail'] = $this->warehouse_model->get_goods_delivery_detail($id);

		$data['goods_delivery'] = $this->warehouse_model->get_goods_delivery($id);

		$data['title'] = _l('stock_export_info');
		$check_appr = $this->warehouse_model->get_approve_setting('2');
		$data['check_appr'] = $check_appr;

		$this->load->view('manage_goods_delivery/view_delivery', $data);

	}

	/**
	 * check quantity inventory
	 * @return json
	 */
	public function check_quantity_inventory() {
		$data = $this->input->post();
		if ($data != 'null') {
			$value = $this->warehouse_model->get_quantity_inventory($data['warehouse_id'], $data['commodity_id']);

			$quantity = 0;
			if ($value != null) {
				if ((float) get_object_vars($value)['inventory_number'] < (float) $data['quantity']) {
					$message = _l('in_stock');
					$quantity = get_object_vars($value)['inventory_number'];
				} else {
					$message = true;
				}

			} else {
				$message = _l('Product_does_not_exist_in_stock');
			}

			echo json_encode([
				'message' => $message,
				'value' => $quantity,
			]);
			die;
		}
	}

	/**
	 *  quantity inventory
	 * @return json
	 */
	public function quantity_inventory() {
		$data = $this->input->post();
		if ($data != 'null') {
			$value = $this->warehouse_model->get_quantity_inventory($data['warehouse_id'], $data['commodity_id']);
			$unit = $this->warehouse_model->get_commodity_hansometable($data['commodity_id']);
			$quantity = 0;
			if ($value != null) {

				$message = _l('in_stock');
				$quantity = get_object_vars($value)['inventory_number'];

			} else {
				$message = _l('Product_does_not_exist_in_stock');
			}

			echo json_encode([
				'message' => $message,
				'value' => $quantity,
				'unit' => $unit->unit_id,
			]);
			die;
		}
	}

	/**
	 * check quantity inventory onsubmit
	 * @return json
	 */
	public function check_quantity_inventory_onsubmit() {
		$data = $this->input->post();
		$flag = 0;
		$message = true;

		if ($data['hot_delivery'] != 'null') {
			foreach ($data['hot_delivery'] as $delivery_value) {
				if ($delivery_value[0] != '') {
					$value = $this->warehouse_model->get_quantity_inventory($data['warehouse_id'], $delivery_value[0]);
					if ($value != null) {
						if ((float) get_object_vars($value)['inventory_number'] < (float) $delivery_value[2]) {
							$flag = 1;
						}
					} else {
						$flag = 1;
					}
				}

				if ($flag == 1) {
					$message = false;

				} else {
					$message = true;
				}
			}
			echo json_encode([
				'message' => $message,

			]);
			die;
		}
	}

	/**
	 * manage stock take
	 * @param  integer $id
	 * @return view
	 */
	public function manage_stock_take($id = '') {
		$data['stock_take_id'] = $id;
		$data['title'] = _l('stock_take');
		$this->load->view('manage_stock_take/manage', $data);
	}

	/**
	 * table manage stock table
	 * @return array
	 */
	public function table_manage_stock_take() {
		$this->app->get_table_data(module_views_path('warehouse', 'manage_stock_take/table_manage_stock_take'));
	}

	/**
	 * stock take
	 * @param  integer $id
	 * @return view
	 */
	public function stock_take() {
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();

			if (!$this->input->post('id')) {

				$mess = $this->warehouse_model->add_goods_receipt($data);
				if ($mess) {
					set_alert('success', _l('added_successfully') . _l('stock_take'));

				} else {
					set_alert('warning', _l('Add_stock_take_false'));
				}
				redirect(admin_url('warehouse/manage_stock_take'));

			}
		}
		//get vaule render dropdown select
		$data['commodity_code_name'] = $this->warehouse_model->get_commodity_code_name();
		$data['units_code_name'] = $this->warehouse_model->get_units_code_name();
		$data['units_warehouse_name'] = $this->warehouse_model->get_warehouse_code_name();

		$data['title'] = _l('inventory_goods_materials');

		$data['commodity_codes'] = $this->warehouse_model->get_commodity();

		$data['warehouses'] = $this->warehouse_model->get_warehouse();
		if (get_status_modules_wh('purchase')) {
			$data['pr_orders'] = get_pr_order();
		} else {
			$data['pr_orders'] = [];
		}

		$data['vendors'] = $this->warehouse_model->get_vendor();

		$data['goods_code'] = $this->warehouse_model->create_goods_code();
		$data['staff'] = $this->warehouse_model->get_staff();

		$this->load->view('manage_stock_take/stock_take', $data);

	}

	/**
	 * commodity list add edit
	 * @param  integer $id
	 * @return json
	 */
	public function commodity_list_add_edit($id = '') {
		$data = $this->input->post();
		if ($data) {
			if (!isset($data['id'])) {
				$ids = $this->warehouse_model->add_commodity_one_item($data);
				if ($ids) {

					// handle commodity list add edit file
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
					/*upload multifile*/
					echo json_encode([
						'url' => admin_url('warehouse/view_commodity_detail/' . $ids),
						'commodityid' => $ids,
					]);
					die;

				}
				echo json_encode([
					'url' => admin_url('warehouse/commodity_list'),
				]);
				die;

			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->warehouse_model->update_commodity_one_item($data, $id);

				/*update file*/

				if ($success == true) {

					$message = _l('updated_successfully');
					set_alert('success', $message);
				}

				echo json_encode([
					'url' => admin_url('warehouse/view_commodity_detail/' . $id),
					'commodityid' => $id,
				]);
				die;

			}
		}

	}

	/**
	 * get commodity file url
	 * @param  integer $commodity_id
	 * @return json
	 */
	public function get_commodity_file_url($commodity_id) {
		$arr_commodity_file = $this->warehouse_model->get_warehourse_attachments($commodity_id);
		/*get images old*/
		$images_old_value = '';

		if (count($arr_commodity_file) > 0) {
			foreach ($arr_commodity_file as $key => $value) {
				$images_old_value .= '<div class="dz-preview dz-image-preview image_old' . $value["id"] . '">';

				$images_old_value .= '<div class="dz-image">';
				if (file_exists(WAREHOUSE_ITEM_UPLOAD . $value["rel_id"] . '/' . $value["file_name"])) {
					$images_old_value .= '<img class="image-w-h" data-dz-thumbnail alt="' . $value["file_name"] . '" src="' . site_url('modules/warehouse/uploads/item_img/' . $value["rel_id"] . '/' . $value["file_name"]) . '">';
				} else {
					$images_old_value .= '<img class="image-w-h" data-dz-thumbnail alt="' . $value["file_name"] . '" src="' . site_url('modules/purchase/uploads/item_img/' . $value["rel_id"] . '/' . $value["file_name"]) . '">';
				}

				$images_old_value .= '</div>';

				$images_old_value .= '<div class="dz-error-mark">';
				$images_old_value .= '<a class="dz-remove" data-dz-remove>Remove file';
				$images_old_value .= '</a>';
				$images_old_value .= '</div>';

				$images_old_value .= '<div class="remove_file">';
				$images_old_value .= '<a href="#" class="text-danger" onclick="delete_contract_attachment(this,' . $value["id"] . '); return false;"><i class="fa fa fa-times"></i></a>';
				$images_old_value .= '</div>';

				$images_old_value .= '</div>';
			}
		}

		echo json_encode([
			'arr_images' => $images_old_value,
		]);
		die();

	}

	/**
	 * sub group
	 * @param  integer $id
	 * @return redirect
	 */
	public function sub_group($id = '') {
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();

			if (!$this->input->post('id')) {

				$mess = $this->warehouse_model->add_sub_group($data);
				if ($mess) {
					set_alert('success', _l('added_successfully') . ' ' . _l('sub_group'));

				} else {
					set_alert('warning', _l('Add_sub_group_false'));
				}
				redirect(admin_url('warehouse/setting?group=sub_group'));

			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->warehouse_model->add_sub_group($data, $id);
				if ($success) {
					set_alert('success', _l('updated_successfully') . ' ' . _l('sub_group'));
				} else {
					set_alert('warning', _l('updated_sub_group_false'));
				}

				redirect(admin_url('warehouse/setting?group=sub_group'));
			}
		}
	}

	/**
	 * delete sub group
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_sub_group($id) {
		if (!$id) {
			redirect(admin_url('warehouse/setting?group=sub_group'));
		}
		$response = $this->warehouse_model->delete_sub_group($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced', _l('sub_group')));
		} elseif ($response == true) {
			set_alert('success', _l('deleted', _l('sub_group')));
		} else {
			set_alert('warning', _l('problem_deleting', _l('sub_group')));
		}
		redirect(admin_url('warehouse/setting?group=sub_group'));
	}

	/**
	 * add commodity attachment
	 * @param  integer $id
	 * @return json
	 */
	public function add_commodity_attachment($id) {

		handle_commodity_attachments($id);
		echo json_encode([

			'url' => admin_url('warehouse/commodity_list'),
		]);
	}

	/**
	 * import xlsx commodity
	 * @param  integer $id
	 * @return view
	 */
	public function import_xlsx_commodity() {
		if (!is_admin() && !has_permission('warehouse', '', 'create')) {
			access_denied('warehouse');
		}
		$this->load->model('staff_model');
		$data_staff = $this->staff_model->get(get_staff_user_id());

		/*get language active*/
		if ($data_staff) {
			if ($data_staff->default_language != '') {
				$data['active_language'] = $data_staff->default_language;

			} else {

				$data['active_language'] = get_option('active_language');
			}

		} else {
			$data['active_language'] = get_option('active_language');
		}

		$this->load->view('warehouse/import_excel', $data);
	}

	/**
	 * import file xlsx commodity
	 * @return json
	 */
	public function import_file_xlsx_commodity() {
		if (!is_admin() && !has_permission('warehouse', '', 'create')) {
			access_denied(_l('warehouse'));
		}

		$total_row_false = 0;
		$total_rows = 0;
		$dataerror = 0;
		$total_row_success = 0;

		if ($this->input->post()) {

			if (isset($_FILES['file_csv']['name']) && $_FILES['file_csv']['name'] != '') {
				//do_action('before_import_leads');

				// Get the temp file path
				$tmpFilePath = $_FILES['file_csv']['tmp_name'];
				// Make sure we have a filepath
				if (!empty($tmpFilePath) && $tmpFilePath != '') {
					$tmpDir = TEMP_FOLDER . '/' . time() . uniqid() . '/';

					if (!file_exists(TEMP_FOLDER)) {
						mkdir(TEMP_FOLDER, 0755);
					}

					if (!file_exists($tmpDir)) {
						mkdir($tmpDir, 0755);
					}

					// Setup our new file path
					$newFilePath = $tmpDir . $_FILES['file_csv']['name'];

					if (move_uploaded_file($tmpFilePath, $newFilePath)) {
						$import_result = true;
						$rows = [];

						$objReader = new PHPExcel_Reader_Excel2007();
						$objReader->setReadDataOnly(true);
						$objPHPExcel = $objReader->load($newFilePath);
						$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
						$sheet = $objPHPExcel->getActiveSheet();

						//innit  file exel error start

						$dataError = new PHPExcel();
						$dataError->setActiveSheetIndex(0);
						//create header file

						// add style to the header
						$styleArray = array(
							'font' => array(
								'bold' => true,

							),

							'borders' => array(
								'top' => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN,
								),
							),
							'fill' => array(

								'rotation' => 90,
								'startcolor' => array(
									'argb' => 'FFA0A0A0',
								),
								'endcolor' => array(
									'argb' => 'FFFFFFFF',
								),
							),
						);

						// set the names of header cells
						$dataError->setActiveSheetIndex(0)
							->setCellValue("A1", "(*)" . _l('commodity_code'))
							->setCellValue("B1", _l('commodity_barcode'))
							->setCellValue("C1", _l('sku_code'))
							->setCellValue("D1", _l('sku_name'))
							->setCellValue("E1", _l('description'))
							->setCellValue("F1", _l('commodity_type'))
							->setCellValue("G1", _l('unit_id'))
							->setCellValue("H1", "(*)" . _l('commodity_group'))
							->setCellValue("I1", _l('sub_group'))
							->setCellValue("J1", _l('warehouse_id'))
							->setCellValue("K1", _l('tax'))
							->setCellValue("L1", _l('origin'))
							->setCellValue("M1", _l('style_id'))
							->setCellValue("N1", _l('model_id'))
							->setCellValue("O1", _l('size_id'))
							->setCellValue("P1", _l('date_manufacture') . " ( dd/mm/yy ) ")
							->setCellValue("Q1", _l('expiry_date') . " ( dd/mm/yy ) ")
							->setCellValue("R1", "(*)" . _l('rate'))
							->setCellValue("S1", _l('purchase_price'))
							->setCellValue("T1", _l('error'));

						/*set style for header*/
						$dataError->getActiveSheet()->getStyle('A1:T1')->applyFromArray($styleArray);

						// auto fit column to content

						foreach (range('A', 'T') as $columnID) {
							$dataError->getActiveSheet()->getColumnDimension($columnID)
								->setAutoSize(true);

						}

						$dataError->getActiveSheet()->getStyle('A1:T1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
						$dataError->getActiveSheet()->getStyle('A1:T1')->getFill()->getStartColor()->setARGB('29bb04');
						// Add some data
						$dataError->getActiveSheet()->getStyle('A1:T1')->getFont()->setBold(true);
						$dataError->getActiveSheet()->getStyle('A1:T1')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

						/*set header middle alignment*/
						$dataError->getActiveSheet()->getStyle('A1:T1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

						$dataError->getActiveSheet()->getStyle('A1:T1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						/*set row1 height*/
						$dataError->getActiveSheet()->getRowDimension('1')->setRowHeight(40);

						//init file error end

						// start row write 2
						$numRow = 2;
						$total_rows = 0;

						$total_rows_actualy = 0;
						//get data for compare

						foreach ($rowIterator as $row) {
							$rowIndex = $row->getRowIndex();
							if ($rowIndex > 1) {
								$rd = array();
								$flag = 0;
								$flag2 = 0;
								$flag_mail = 0;
								$string_error = '';
								$flag_contract_form = 0;

								$flag_id_commodity_type;
								$flag_id_unit_id;
								$flag_id_commodity_group;
								$flag_id_sub_group;
								$flag_id_warehouse_id;
								$flag_id_tax;
								$flag_id_style_id;
								$flag_id_model_id;
								$flag_id_size_id;

								$value_cell_commodity_code = $sheet->getCell('A' . $rowIndex)->getValue();
								$value_cell_description = $sheet->getCell('E' . $rowIndex)->getValue();

								$value_cell_commodity_group = $sheet->getCell('H' . $rowIndex)->getValue();
								$value_cell_rate = $sheet->getCell('R' . $rowIndex)->getValue();

								$value_cell_commodity_type = $sheet->getCell('F' . $rowIndex)->getValue();
								$value_cell_unit_id = $sheet->getCell('G' . $rowIndex)->getValue();
								$value_cell_commodity_group = $sheet->getCell('H' . $rowIndex)->getValue();
								$value_cell_sub_group = $sheet->getCell('I' . $rowIndex)->getValue();
								$value_cell_warehouse_id = $sheet->getCell('J' . $rowIndex)->getValue();
								$value_cell_tax = $sheet->getCell('K' . $rowIndex)->getValue();
								$value_cell_style_id = $sheet->getCell('M' . $rowIndex)->getValue();
								$value_cell_model_id = $sheet->getCell('N' . $rowIndex)->getValue();
								$value_cell_size_id = $sheet->getCell('O' . $rowIndex)->getValue();

								$value_cell_date_manufacture = $sheet->getCell('P' . $rowIndex)->getValue();
								$value_cell_expiry_date = $sheet->getCell('Q' . $rowIndex)->getValue();

								$value_cell_rate = $sheet->getCell('R' . $rowIndex)->getValue();
								$value_cell_purchase_price = $sheet->getCell('S' . $rowIndex)->getValue();

								$pattern = '#^[a-z][a-z0-9\._]{2,31}@[a-z0-9\-]{3,}(\.[a-z]{2,4}){1,2}$#';

								$reg_day = '#^(((1)[0-2]))(\/)\d{4}-(3)[0-1])(\/)(((0)[0-9])-[0-2][0-9]$#'; /*yyyy-mm-dd*/

								/*check null*/
								if (is_null($value_cell_commodity_code) == true) {
									$string_error .= _l('commodity_code') . _l('not_yet_entered');
									$flag = 1;
								}

								if (is_null($value_cell_commodity_group) == true) {
									$string_error .= _l('commodity_group') . _l('not_yet_entered');
									$flag = 1;
								}

								if (is_null($value_cell_rate) == true) {
									$string_error .= _l('rate') . _l('not_yet_entered');
									$flag = 1;
								}

								if (is_null($value_cell_description) == true) {
									$string_error .= _l('description') . _l('not_yet_entered');
									$flag = 1;
								}

								//check commodity_type exist  (input: id or name contract)
								if (is_null($value_cell_commodity_type) != true) {
									/*case input  id*/
									if (is_numeric($value_cell_commodity_type)) {

										$this->db->where('commodity_type_id', $value_cell_commodity_type);
										$commodity_type_value = $this->db->count_all_results(db_prefix() . 'ware_commodity_type');

										if ($commodity_type_value == 0) {
											$string_error .= _l('commodity_type') . _l('does_not_exist');
											$flag2 = 1;
										} else {
											/*get id commodity_type*/
											$flag_id_commodity_type = $value_cell_commodity_type;
										}

									} else {
										/*case input name*/
										$this->db->like(db_prefix() . 'ware_commodity_type.commondity_code', $value_cell_commodity_type);

										$commodity_type_value = $this->db->get(db_prefix() . 'ware_commodity_type')->result_array();
										if (count($commodity_type_value) == 0) {
											$string_error .= _l('commodity_type') . _l('does_not_exist');
											$flag2 = 1;
										} else {
											/*get id commodity_type*/

											$flag_id_commodity_type = $commodity_type_value[0]['commodity_type_id'];
										}
									}

								}

								//check unit_code exist  (input: id or name contract)
								if (is_null($value_cell_unit_id) != true) {
									/*case input id*/
									if (is_numeric($value_cell_unit_id)) {

										$this->db->where('unit_type_id', $value_cell_unit_id);
										$unit_id_value = $this->db->count_all_results(db_prefix() . 'ware_unit_type');

										if ($unit_id_value == 0) {
											$string_error .= _l('unit_id') . _l('does_not_exist');
											$flag2 = 1;
										} else {
											/*get id unit_id*/
											$flag_id_unit_id = $value_cell_unit_id;
										}

									} else {
										/*case input name*/
										$this->db->like(db_prefix() . 'ware_unit_type.unit_code', $value_cell_unit_id);

										$unit_id_value = $this->db->get(db_prefix() . 'ware_unit_type')->result_array();
										if (count($unit_id_value) == 0) {
											$string_error .= _l('unit_id') . _l('does_not_exist');
											$flag2 = 1;
										} else {
											/*get unit_id*/
											$flag_id_unit_id = $unit_id_value[0]['unit_id_id'];
										}
									}

								}

								//check commodity_group exist  (input: id or name contract)
								if (is_null($value_cell_commodity_group) != true) {
									/*case input id*/
									if (is_numeric($value_cell_commodity_group)) {

										$this->db->where('id', $value_cell_commodity_group);
										$commodity_group_value = $this->db->count_all_results(db_prefix() . 'items_groups');

										if ($commodity_group_value == 0) {
											$string_error .= _l('commodity_group') . _l('does_not_exist');
											$flag2 = 1;
										} else {
											/*get id commodity_group*/
											$flag_id_commodity_group = $value_cell_commodity_group;
										}

									} else {
										/*case input name*/
										$this->db->like(db_prefix() . 'items_groups.commodity_group_code', $value_cell_commodity_group);

										$commodity_group_value = $this->db->get(db_prefix() . 'items_groups')->result_array();
										if (count($commodity_group_value) == 0) {
											$string_error .= _l('commodity_group') . _l('does_not_exist');
											$flag2 = 1;
										} else {
											/*get id commodity_group*/

											$flag_id_commodity_group = $commodity_group_value[0]['id'];
										}
									}

								}

								//check commodity_group exist  (input: id or name contract)
								if (is_null($value_cell_warehouse_id) != true) {
									/*case input id*/
									if (is_numeric($value_cell_warehouse_id)) {

										$this->db->where('warehouse_id', $value_cell_warehouse_id);
										$warehouse_id_value = $this->db->count_all_results(db_prefix() . 'warehouse');

										if ($warehouse_id_value == 0) {
											$string_error .= _l('warehouse_id') . _l('does_not_exist');
											$flag2 = 1;
										} else {
											/*get id warehouse_id*/
											$flag_id_warehouse_id = $value_cell_warehouse_id;
										}

									} else {
										/*case input name*/
										$this->db->like(db_prefix() . 'warehouse.warehouse_code', $value_cell_warehouse_id);

										$warehouse_id_value = $this->db->get(db_prefix() . 'warehouse')->result_array();
										if (count($warehouse_id_value) == 0) {
											$string_error .= _l('warehouse_id') . _l('does_not_exist');
											$flag2 = 1;
										} else {
											/*get id warehouse_id*/

											$flag_id_warehouse_id = $warehouse_id_value[0]['warehouse_id'];
										}
									}

								}

								//check taxes exist  (input: id or name contract)
								if (is_null($value_cell_tax) != true) {
									/*case input id*/
									if (is_numeric($value_cell_tax)) {

										$this->db->where('id', $value_cell_tax);
										$cell_tax_value = $this->db->count_all_results(db_prefix() . 'taxes');

										if ($cell_tax_value == 0) {
											$string_error .= _l('tax') . _l('does_not_exist');
											$flag2 = 1;
										} else {
											/*get id cell_tax*/
											$flag_id_tax = $value_cell_tax;
										}

									} else {
										/*case input name*/
										$this->db->like(db_prefix() . 'taxes.name', $value_cell_tax);

										$cell_tax_value = $this->db->get(db_prefix() . 'taxes')->result_array();
										if (count($warehouse_id_value) == 0) {
											$string_error .= _l('tax') . _l('does_not_exist');
											$flag2 = 1;
										} else {
											/*get id warehouse_id*/

											$flag_id_tax = $cell_tax_value[0]['id'];
										}
									}

								}

								//check commodity_group exist  (input: id or name contract)
								if (is_null($value_cell_sub_group) != true) {
									/*case input id*/
									if (is_numeric($value_cell_sub_group)) {

										$this->db->where('id', $value_cell_sub_group);
										$sub_group_value = $this->db->count_all_results(db_prefix() . 'wh_sub_group');

										if ($sub_group_value == 0) {
											$string_error .= _l('sub_group') . _l('does_not_exist');
											$flag2 = 1;
										} else {
											/*get id sub_group*/
											$flag_id_sub_group = $value_cell_sub_group;
										}

									} else {
										/*case input  name*/
										$this->db->like(db_prefix() . 'wh_sub_group.sub_group_code', $value_cell_sub_group);

										$sub_group_value = $this->db->get(db_prefix() . 'wh_sub_group')->result_array();
										if (count($sub_group_value) == 0) {
											$string_error .= _l('sub_group') . _l('does_not_exist');
											$flag2 = 1;
										} else {
											/*get id sub_group*/

											$flag_id_sub_group = $sub_group_value[0]['id'];
										}
									}

								}

								//check commodity_group exist  (input: id or name contract)
								if (is_null($value_cell_style_id) != true) {
									/*case input id*/
									if (is_numeric($value_cell_style_id)) {

										$this->db->where('style_type_id', $value_cell_style_id);
										$style_id_value = $this->db->count_all_results(db_prefix() . 'ware_style_type');

										if ($style_id_value == 0) {
											$string_error .= _l('style_id') . _l('does_not_exist');
											$flag2 = 1;
										} else {
											/*get id style_id*/
											$flag_id_style_id = $value_cell_style_id;
										}

									} else {
										/*case input  name*/
										$this->db->like(db_prefix() . 'ware_style_type.style_code', $value_cell_style_id);

										$style_id_value = $this->db->get(db_prefix() . 'ware_style_type')->result_array();
										if (count($style_id_value) == 0) {
											$string_error .= _l('style_id') . _l('does_not_exist');
											$flag2 = 1;
										} else {
											/*get id style_id*/

											$flag_id_style_id = $style_id_value[0]['style_type_id'];
										}
									}

								}

								//check body_code exist  (input: id or name contract)
								if (is_null($value_cell_model_id) != true) {
									/*case input id*/
									if (is_numeric($value_cell_model_id)) {

										$this->db->where('body_type_id', $value_cell_model_id);
										$model_id_value = $this->db->count_all_results(db_prefix() . 'ware_body_type');

										if ($model_id_value == 0) {
											$string_error .= _l('model_id') . _l('does_not_exist');
											$flag2 = 1;
										} else {
											/*get id model_id*/
											$flag_id_model_id = $value_cell_model_id;
										}

									} else {
										/*case input name*/
										$this->db->like(db_prefix() . 'ware_body_type.body_code', $value_cell_model_id);

										$model_id_value = $this->db->get(db_prefix() . 'ware_body_type')->result_array();
										if (count($model_id_value) == 0) {
											$string_error .= _l('model_id') . _l('does_not_exist');
											$flag2 = 1;
										} else {
											/*get id model_id*/

											$flag_id_model_id = $model_id_value[0]['body_type_id'];
										}
									}

								}

								//check size_code exist  (input: id or name contract)
								if (is_null($value_cell_size_id) != true) {
									/*case input id*/
									if (is_numeric($value_cell_size_id)) {

										$this->db->where('size_type_id', $value_cell_size_id);
										$size_id_value = $this->db->count_all_results(db_prefix() . 'ware_size_type');

										if ($size_id_value == 0) {
											$string_error .= _l('size_id') . _l('does_not_exist');
											$flag2 = 1;
										} else {
											/*get id size_id*/
											$flag_id_size_id = $value_cell_size_id;
										}

									} else {
										/*case input name*/
										$this->db->like(db_prefix() . 'ware_size_type.size_code', $value_cell_size_id);

										$size_id_value = $this->db->get(db_prefix() . 'ware_size_type')->result_array();
										if (count($size_id_value) == 0) {
											$string_error .= _l('size_id') . _l('does_not_exist');
											$flag2 = 1;
										} else {
											/*get id size_id*/

											$flag_id_size_id = $size_id_value[0]['size_type_id'];
										}
									}

								}

								//check value_cell_rate input
								if (is_null($value_cell_rate) != true) {
									if (!is_numeric($value_cell_rate)) {
										$string_error .= _l('cell_rate') . _l('_check_invalid');
										$flag = 1;

									}

								}

								//check value_cell_rate input
								if (is_null($value_cell_purchase_price) != true) {
									if (!is_numeric($value_cell_purchase_price)) {
										$string_error .= _l('purchase_price') . _l('_check_invalid');
										$flag = 1;

									}

								}

								//check value_cell_date_manufacture
								if (is_null($value_cell_date_manufacture) != true) {
									if (preg_match($reg_day, $value_cell_date_manufacture, $match) != 1) {
										$string_error .= _l('date_manufacture') . _l('_check_invalid');
										$flag = 1;
									}

								}

								//check value_cell_expiry_date
								if (is_null($value_cell_expiry_date) != true) {
									if (preg_match($reg_day, $value_cell_expiry_date, $match) != 1) {
										$string_error .= _l('expiry_date') . _l('_check_invalid');
										$flag = 1;
									}

								}

								if (($flag == 1) || ($flag2 == 1)) {
									$dataError->getActiveSheet()->setCellValue('A' . $numRow, $sheet->getCell('A' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('B' . $numRow, $sheet->getCell('B' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('C' . $numRow, $sheet->getCell('C' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('D' . $numRow, $sheet->getCell('D' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('E' . $numRow, $sheet->getCell('E' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('F' . $numRow, $sheet->getCell('F' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('G' . $numRow, $sheet->getCell('G' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('H' . $numRow, $sheet->getCell('H' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('I' . $numRow, $sheet->getCell('I' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('J' . $numRow, $sheet->getCell('J' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('K' . $numRow, $sheet->getCell('K' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('M' . $numRow, $sheet->getCell('M' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('N' . $numRow, $sheet->getCell('N' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('O' . $numRow, $sheet->getCell('O' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('P' . $numRow, $sheet->getCell('P' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('Q' . $numRow, $sheet->getCell('Q' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('R' . $numRow, $sheet->getCell('R' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('S' . $numRow, $sheet->getCell('S' . $rowIndex)->getValue());

									$dataError->getActiveSheet()->setCellValue('T' . $numRow, $string_error)->getStyle('T' . $numRow)->applyFromArray($styleArray);

									$numRow++;
								}

								if (($flag == 0) && ($flag2 == 0)) {

									/*staff id is HR_code, input is HR_CODE, insert => staffid*/
									$rd['commodity_code'] = $sheet->getCell('A' . $rowIndex)->getValue();
									$rd['commodity_barcode'] = $sheet->getCell('B' . $rowIndex)->getValue();
									$rd['sku_code'] = $sheet->getCell('C' . $rowIndex)->getValue();
									$rd['sku_code'] = $sheet->getCell('D' . $rowIndex)->getValue();
									$rd['description'] = $sheet->getCell('E' . $rowIndex)->getValue();

									$rd['commodity_type'] = isset($flag_id_commodity_type) ? $flag_id_commodity_type : '';
									$rd['unit_id'] = isset($flag_id_unit_id) ? $flag_id_unit_id : '';
									$rd['group_id'] = isset($flag_id_commodity_group) ? $flag_id_commodity_group : '';
									$rd['sub_group'] = isset($flag_id_sub_group) ? $flag_id_sub_group : '';
									$rd['warehouse_id'] = isset($flag_id_warehouse_id) ? $flag_id_warehouse_id : '';
									$rd['tax'] = isset($flag_id_tax) ? $flag_id_tax : '';

									$rd['origin'] = $sheet->getCell('L' . $rowIndex)->getValue();

									$rd['style_id'] = isset($flag_id_style_id) ? $flag_id_style_id : '';
									$rd['model_id'] = isset($flag_id_model_id) ? $flag_id_model_id : '';
									$rd['size_id'] = isset($flag_id_size_id) ? $flag_id_size_id : '';

									$rd['date_manufacture'] = to_sql_date($sheet->getCell('P' . $rowIndex)->getValue());
									$rd['expiry_date'] = to_sql_date($sheet->getCell('Q' . $rowIndex)->getValue());

									$rd['rate'] = $sheet->getCell('R' . $rowIndex)->getValue();
									$rd['purchase_price'] = $sheet->getCell('S' . $rowIndex)->getValue();

								}

								if (get_staff_user_id() != '' && $flag == 0 && $flag2 == 0) {
									$rows[] = $rd;
									$result_value = $this->warehouse_model->import_xlsx_commodity($rd);
									if ($result_value) {
										$total_rows_actualy++;
									}
								}

								$total_rows++;
							}

						}

						if ($total_rows_actualy != $total_rows) {
							$total_rows = $total_rows_actualy;
						}

						$total_rows = $total_rows;
						$data['total_rows_post'] = count($rows);
						$total_row_success = count($rows);
						$total_row_false = $total_rows - (int) count($rows);
						$dataerror = $dataError;
						$message = 'Not enought rows for importing';

						if ($total_row_false != 0) {

							$objWriter = new PHPExcel_Writer_Excel2007($dataError);
							$filename = 'FILE_ERROR_COMMODITY' . get_staff_user_id() . '.xlsx';
							$objWriter->save($filename);

						}
						$import_result = true;
						@delete_dir($tmpDir);

					}
				} else {
					set_alert('warning', _l('import_upload_failed'));
				}
			}

		}
		echo json_encode([
			'message' => $message,
			'total_row_success' => $total_row_success,
			'total_row_false' => $total_row_false,
			'total_rows' => $total_rows,
			'site_url' => site_url(),
			'staff_id' => get_staff_user_id(),
		]);

	}

	/**
	 * delete commodity file
	 * @param  integer $attachment_id
	 * @return json
	 */
	public function delete_commodity_file($attachment_id) {
		if (!has_permission('warehouse', '', 'delete') && !is_admin()) {
			access_denied('warehouse');
		}

		$file = $this->misc_model->get_file($attachment_id);
		echo json_encode([
			'success' => $this->warehouse_model->delete_commodity_file($attachment_id),
		]);
	}

	/**
	 * [colors_setting description]
	 * @param  string $id [description]
	 * @return [type]     [description]
	 */
	public function colors_setting($id = '') {
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();

			if (!$this->input->post('id')) {

				$mess = $this->warehouse_model->add_color($data);
				if ($mess) {
					set_alert('success', _l('added_successfully'));

				} else {
					set_alert('warning', _l('Add_commodity_type_false'));
				}
				redirect(admin_url('warehouse/setting?group=colors'));

			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->warehouse_model->update_color($data, $id);
				if ($success) {
					set_alert('success', _l('updated_successfully'));
				} else {
					set_alert('warning', _l('updated_commodity_type_false'));
				}

				redirect(admin_url('warehouse/setting?group=colors'));
			}
		}
	}

	/**
	 * [delete_color description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function delete_color($id) {
		if (!$id) {
			redirect(admin_url('warehouse/setting?group=colors'));
		}

		$response = $this->warehouse_model->delete_color($id);
		if ($response) {
			set_alert('success', _l('deleted'));
			redirect(admin_url('warehouse/setting?group=colors'));
		} else {
			set_alert('warning', _l('problem_deleting'));
			redirect(admin_url('warehouse/setting?group=colors'));
		}

	}

	/**
	 * { loss adjustment }
	 */
	public function loss_adjustment() {
		$data['title'] = _l('loss_adjustment');
		$this->load->view('loss_adjustment/manage', $data);
	}

	/**
	 * { loss adjustment table }
	 */
	public function loss_adjustment_table() {
		if ($this->input->is_ajax_request()) {
			if ($this->input->post()) {

				$time_filter = $this->input->post('time_filter');
				$date_create = $this->input->post('date_create');
				$type_filter = $this->input->post('type_filter');
				$status_filter = $this->input->post('status_filter');

				$query = '';
				if ($time_filter != '') {
					$query .= 'month(time) = month(\'' . $time_filter . '\') and day(time) = day(\'' . $time_filter . '\') and year(time) = year(\'' . $time_filter . '\') and ';
				}
				if ($date_create != '') {
					$query .= 'month(date_create) = month(\'' . $date_create . '\') and day(date_create) = day(\'' . $date_create . '\') and year(date_create) = year(\'' . $date_create . '\') and ';
				}
				if ($status_filter != '') {
					$query .= 'status = \'' . $status_filter . '\' and ';
				}
				$select = [

					'id',
					'id',
					'id',
					'id',
					'id',
					'id',
					'id',

				];
				$where = [(($query != '') ? ' where ' . rtrim($query, ' and ') : '')];

				$aColumns = $select;
				$sIndexColumn = 'id';
				$sTable = db_prefix() . 'wh_loss_adjustment';
				$join = [];

				$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, [

					'time',
					'type',
					'reason',
					'addfrom',
					'status',
					'date_create',
				]);

				$output = $result['output'];
				$rResult = $result['rResult'];
				foreach ($rResult as $aRow) {
					$row = [];
					$allow_add = 0;
					if ($type_filter != '') {
						if ($type_filter == 'loss') {
							if ($aRow['type'] == 'loss') {
								$allow_add = 1;
							}
						}
						if ($type_filter == 'adjustment') {
							if ($aRow['type'] == 'adjustment') {
								$allow_add = 1;
							}
						}
						if ($type_filter == 'return') {
							if ($aRow['type'] == 'return') {
								$allow_add = 1;
							}
						}
					} else {
						$allow_add = 1;
					}

					$row[] = _l($aRow['type']);
					$row[] = _dt($aRow['time']);
					$row[] = _d($aRow['date_create']);

					$status = '';
					if ((int) $aRow['status'] == 0) {
						$status = '<div class="btn btn-warning" >' . _l('draft') . '</div>';
					} elseif ((int) $aRow['status'] == 1) {
						$status = '<div class="btn btn-success" >' . _l('Adjusted') . '</div>';
					}
					$row[] = $status;

					$row[] = $aRow['reason'];
					$row[] = get_staff_full_name($aRow['addfrom']);

					$option = '';
					$option .= '<a href="' . admin_url('warehouse/add_loss_adjustment/' . $aRow['id']) . '" class="btn btn-default btn-icon" >';
					$option .= '<i class="fa fa-eye"></i>';
					$option .= '</a>';
					if ((int) $aRow['status'] == 0) {
						$option .= '<a href="' . admin_url('warehouse/add_loss_adjustment/' . $aRow['id']) . '" class="btn btn-default btn-icon" >';
						$option .= '<i class="fa fa-pencil-square-o"></i>';
						$option .= '</a>';
					}
					$option .= '<a href="' . admin_url('warehouse/delete_loss_adjustment/' . $aRow['id']) . '" class="btn btn-danger btn-icon _delete">';
					$option .= '<i class="fa fa-remove"></i>';
					$option .= '</a>';
					$row[] = $option;
					if ($allow_add == 1) {
						$output['aaData'][] = $row;
					}
				}

				echo json_encode($output);
				die();
			}
		}
	}

	public function add_loss_adjustment($id = '') {
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			$data['date_create'] = date('Y-m-d');
			$data['addfrom'] = get_staff_user_id();
			if ($data['id'] == '') {
				unset($data['id']);
				$id = $this->warehouse_model->add_loss_adjustment($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}

				redirect(admin_url('warehouse/add_loss_adjustment/' . $id));
			} else {
				$success = $this->warehouse_model->update_loss_adjustment($data);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('warehouse/add_loss_adjustment/' . $id));
			}
			die;
		}

		$data['items'] = $this->warehouse_model->get_items_code_name();
		$data['unit'] = $this->warehouse_model->get_units_code_name();
		$data['warehouses'] = $this->warehouse_model->get_warehouse_code_name();
		$data['title'] = _l('loss_adjustment');
		if ($id != '') {
			$data['loss_adjustment'] = $this->warehouse_model->get_loss_adjustment($id);
			$data_lost = $this->warehouse_model->get_loss_adjustment_detailt_by_masterid($id);
			$data_row = [];
			foreach ($data_lost as $item) {
				array_push($data_row, array('items' => $item['items'], 'unit' => $item['unit'], 'current_number' => $item['current_number'], 'updates_number' => $item['updates_number'], 'loss_adjustment' => $item['loss_adjustment']));
			}
			$data['loss_adjustment_detailt'] = json_encode($data_row);
			$data['title'] = _l('update_loss_adjustment');
		}
		$this->load->view('loss_adjustment/add_loss_adjustment', $data);
	}

	public function adjust($id) {
		$success = $this->warehouse_model->change_adjust($id);
		echo json_encode([
			'success' => $success,
		]);
		die;
	}

	/**
	 * { delete loss adjustment }
	 *
	 * @param      <type>  $id     The identifier
	 */
	public function delete_loss_adjustment($id) {
		$response = $this->warehouse_model->delete_loss_adjustment($id);
		if ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('warehouse/loss_adjustment'));
	}

	/**
	 * { get data inventory valuation report }
	 *
	 * @return json
	 */
	public function get_data_inventory_valuation_report() {
		if ($this->input->post()) {
			$data = $this->input->post();

			$inventory_valuation_report = $this->warehouse_model->get_inventory_valuation_report_view($data);
		}

		echo json_encode([
			'value' => $inventory_valuation_report,
		]);
		die();
	}

	/**
	 * table out of stock
	 * @return [type]
	 */
	public function table_out_of_stock() {

		$this->app->get_table_data(module_views_path('warehouse', 'table_out_of_stock'));
	}

	/**
	 * table expired
	 * @return [type]
	 */
	public function table_expired() {

		$this->app->get_table_data(module_views_path('warehouse', 'table_expired'));
	}

	/**
	 * view commodity detail
	 * @param  [integer] $commodity_id
	 * @return [type]
	 */
	public function view_commodity_detail($commodity_id) {
		$commodity_item = get_commodity_name($commodity_id);

            if (!$commodity_item) {
                blank_page('commodity item Not Found', 'danger');
            }

		$data['commodity_item'] = $commodity_item;
		$data['commodity_file'] = $this->warehouse_model->get_warehourse_attachments($commodity_id);

		$this->load->view('view_commodity_detail', $data);

	}

	/**
	 * table view commodity detail
	 * @return [type]
	 */
	public function table_view_commodity_detail() {

		$this->app->get_table_data(module_views_path('warehouse', 'table_view_commodity_detail'));
	}

	/**
	 * delete goods receipt
	 * @param  [integer] $id
	 * @return redirect
	 */
	public function delete_goods_receipt($id) {
		$response = $this->warehouse_model->delete_goods_receipt($id);
		if ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('warehouse/manage_purchase'));
	}

	/**
	 * delete_goods_delivery
	 * @param  [integer] $id
	 * @return [redirect]
	 */
	public function delete_goods_delivery($id) {
		$response = $this->warehouse_model->delete_goods_delivery($id);
		if ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('warehouse/manage_delivery'));
	}

	/**
	 * Gets the commodity barcode.
	 */
	public function get_commodity_barcode() {
		$commodity_barcode = $this->warehouse_model->generate_commodity_barcode();

		echo json_encode([
			$commodity_barcode,
		]);
		die();
	}

	/**
	 * table inventory stock
	 * @return [type]
	 */
	public function table_inventory_stock() {

		$this->app->get_table_data(module_views_path('warehouse', 'table_inventory_stock'));
	}
	/////////////////////////////////////////////////////////////////////////////////////////////

	public function commodity_sync_pos() {
		$data = $this->warehouse_model->commodity_sync_model();
		redirect(admin_url('warehouse/commodity_list'));
	}

}