<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
	db_prefix() . 'items.id',
	'commodity_code',
	'description',
	'group_id',
	db_prefix() . 'items.warehouse_id',
	db_prefix() . 'inventory_manage.inventory_number',
	'unit_id',
	'rate',
	'purchase_price',
	'tax',
	'origin',
];
$sIndexColumn = 'id';
$sTable = db_prefix() . 'items';

$where = [];

$warehouse_ft = $this->ci->input->post('warehouse_ft');
$commodity_ft = $this->ci->input->post('commodity_ft');
$alert_filter = $this->ci->input->post('alert_filter');

if (!isset($warehouse_ft) && !isset($commodity_ft) && !isset($alert_filter) && ($alert_filter == '')) {
	$join = ['LEFT JOIN ' . db_prefix() . 'inventory_manage ON ' . db_prefix() . 'inventory_manage.commodity_id = ' . db_prefix() . 'items.id'];
} else {

	$join = [

		'LEFT JOIN ' . db_prefix() . 'inventory_manage ON ' . db_prefix() . 'inventory_manage.commodity_id = ' . db_prefix() . 'items.id',

	];
}

if (isset($warehouse_ft)) {

	$where_warehouse_ft = '';
	foreach ($warehouse_ft as $warehouse_id) {
		if ($warehouse_id != '') {
			if ($where_warehouse_ft == '') {
				$where_warehouse_ft .= ' AND (' . db_prefix() . 'inventory_manage.warehouse_id = "' . $warehouse_id . '"';
			} else {
				$where_warehouse_ft .= ' or ' . db_prefix() . 'inventory_manage.warehouse_id = "' . $warehouse_id . '"';
			}
		}
	}
	if ($where_warehouse_ft != '') {
		$where_warehouse_ft .= ')';
		array_push($where, $where_warehouse_ft);
	}
}

if (isset($commodity_ft)) {
	$where_commodity_ft = '';
	foreach ($commodity_ft as $commodity_id) {
		if ($commodity_id != '') {
			if ($where_commodity_ft == '') {
				$where_commodity_ft .= ' AND (tblitems.id = "' . $commodity_id . '"';
			} else {
				$where_commodity_ft .= ' or tblitems.id = "' . $commodity_id . '"';
			}
		}
	}
	if ($where_commodity_ft != '') {
		$where_commodity_ft .= ')';
		array_push($where, $where_commodity_ft);
	}
}

/*alert_filter*/
if (isset($alert_filter)) {
	if ($alert_filter != '') {
		if ($alert_filter == "1") {
			//out of stock
			$where_alert_filter = ' AND ' . db_prefix() . 'inventory_manage.inventory_number = "0"';
			array_push($where, $where_alert_filter);

		} else {
			//exprired
			$current_day = date('Y-m-d');
			$where_alert_filter1 = ' AND ' . db_prefix() . 'inventory_manage.expiry_date > "' . $current_day . '"';
			array_push($where, $where_alert_filter1);

		}
	}
}

if (!isset($warehouse_ft) && !isset($commodity_ft) && ($alert_filter == '')) {
	$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, [db_prefix() . 'items.id', db_prefix() . 'inventory_manage.commodity_id', db_prefix() . 'inventory_manage.warehouse_id as warehouse_ids', db_prefix() . 'inventory_manage.inventory_number', db_prefix() . 'inventory_manage.date_manufacture', db_prefix() . 'inventory_manage.expiry_date', db_prefix() . 'items.description', db_prefix() . 'items.unit_id', db_prefix() . 'items.commodity_code', db_prefix() . 'items.commodity_barcode', db_prefix() . 'items.commodity_type', db_prefix() . 'items.warehouse_id', db_prefix() . 'items.origin', db_prefix() . 'items.color_id', db_prefix() . 'items.style_id', db_prefix() . 'items.model_id', db_prefix() . 'items.size_id', db_prefix() . 'items.rate', db_prefix() . 'items.tax', db_prefix() . 'items.group_id', db_prefix() . 'items.long_description', db_prefix() . 'items.sku_code', db_prefix() . 'items.sku_name', db_prefix() . 'items.sub_group']);
} else {
	$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, [db_prefix() . 'items.id', db_prefix() . 'inventory_manage.commodity_id', db_prefix() . 'inventory_manage.warehouse_id as warehouse_ids', db_prefix() . 'inventory_manage.inventory_number', db_prefix() . 'inventory_manage.date_manufacture', db_prefix() . 'inventory_manage.expiry_date', db_prefix() . 'items.description', db_prefix() . 'items.group_id', db_prefix() . 'items.unit_id', db_prefix() . 'items.rate', db_prefix() . 'items.tax', db_prefix() . 'items.description', db_prefix() . 'items.unit_id', db_prefix() . 'items.commodity_code', db_prefix() . 'items.commodity_barcode', db_prefix() . 'items.commodity_type', db_prefix() . 'items.warehouse_id', db_prefix() . 'items.origin', db_prefix() . 'items.color_id', db_prefix() . 'items.style_id', db_prefix() . 'items.model_id', db_prefix() . 'items.size_id', db_prefix() . 'items.rate', db_prefix() . 'items.tax', db_prefix() . 'items.group_id', db_prefix() . 'items.long_description', db_prefix() . 'items.sku_code', db_prefix() . 'items.sku_name', db_prefix() . 'items.sub_group']);

}

$output = $result['output'];
$rResult = $result['rResult'];

if (!isset($warehouse_ft) && !isset($commodity_ft) && ($alert_filter == '')) {
	foreach ($rResult as $aRow) {
		$row = [];
		for ($i = 0; $i < count($aColumns); $i++) {
			$_data = $aRow[$aColumns[$i]];
			/*get commodity file*/
			$arr_images = $this->ci->warehouse_model->get_warehourse_attachments($aRow['id']);
			if (count($arr_images) > 0) {

				if (file_exists(WAREHOUSE_ITEM_UPLOAD . $arr_images[0]['rel_id'] . '/' . $arr_images[0]['file_name'])) {
					$_data = '<img class="images_w_table" src="' . site_url('modules/warehouse/uploads/item_img/' . $arr_images[0]['rel_id'] . '/' . $arr_images[0]['file_name']) . '" alt="' . $arr_images[0]['file_name'] . '" >';
				} else {
					$_data = '<img class="images_w_table" src="' . site_url('modules/purchase/uploads/item_img/' . $arr_images[0]['rel_id'] . '/' . $arr_images[0]['file_name']) . '" alt="' . $arr_images[0]['file_name'] . '" >';
				}

			} else {

				$_data = '<img class="images_w_table" src="' . site_url('modules/warehouse/uploads/nul_image.jpg') . '" alt="nul_image.jpg">';
			}

			if ($aColumns[$i] == 'commodity_code') {
				$code = '<a href="' . admin_url('warehouse/view_commodity_detail/' . $aRow['id']) . '">' . $aRow['commodity_code'] . '</a>';
				$code .= '<div class="row-options">';

				$code .= '<a href="' . admin_url('warehouse/view_commodity_detail/' . $aRow['id']) . '" >' . _l('view') . '</a>';

				if (has_permission('warehouse', '', 'edit') || is_admin()) {
					$code .= ' | <a href="#" onclick="edit_commodity_item(this); return false;"  data-commodity_id="' . $aRow['id'] . '" data-description="' . $aRow['description'] . '" data-unit_id="' . $aRow['unit_id'] . '" data-commodity_code="' . $aRow['commodity_code'] . '" data-commodity_barcode="' . $aRow['commodity_barcode'] . '" data-commodity_type="' . $aRow['commodity_type'] . '" data-origin="' . $aRow['origin'] . '" data-color_id="' . $aRow['color_id'] . '" data-style_id="' . $aRow['style_id'] . '" data-model_id="' . $aRow['model_id'] . '" data-size_id="' . $aRow['size_id'] . '" data-date_manufacture="' . _d($aRow['date_manufacture']) . '" data-expiry_date="' . _d($aRow['expiry_date']) . '" data-long_description="' . $aRow['long_description'] . '" data-rate="' . app_format_money($aRow['rate'], '') . '" data-group_id="' . $aRow['group_id'] . '" data-tax="' . $aRow['tax'] . '"  data-warehouse_id="' . $aRow['warehouse_id'] . '" data-sku_code="' . $aRow['sku_code'] . '" data-sku_name="' . $aRow['sku_name'] . '" data-sub_group="' . $aRow['sub_group'] . '" data-purchase_price="' . $aRow['purchase_price'] . '" >' . _l('edit') . '</a>';
				}
				if (has_permission('warehouse', '', 'delete') || is_admin()) {
					$code .= ' | <a href="' . admin_url('warehouse/delete_commodity/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
				}

				$code .= '</div>';

				$_data = $code;

			} elseif ($aColumns[$i] == 'description') {

				if (get_status_inventory($aRow['id'], $aRow['inventory_number'])) {
					$_data = '<a href="#" onclick="show_detail_item(this);return false;" data-name="' . $aRow['description'] . '"  data-warehouse_id="' . $aRow['warehouse_id'] . '" data-commodity_id="' . $aRow['commodity_id'] . '" data-expiry_date="' . $aRow['expiry_date'] . '" >' . $aRow['description'] . '</a>';
				} else {

					$_data = '<a href="#" class="text-danger"  onclick="show_detail_item(this);return false;" data-name="' . $aRow['description'] . '" data-warehouse_id="' . $aRow['warehouse_id'] . '" data-commodity_id="' . $aRow['commodity_id'] . '" data-expiry_date="' . $aRow['expiry_date'] . '" >' . $aRow['description'] . '</a>';
				}

			} elseif ($aColumns[$i] == 'group_id') {
				$_data = get_group_name($aRow['group_id']) != null ? get_group_name($aRow['group_id'])->name : '';
			} elseif ($aColumns[$i] == db_prefix() . 'items.warehouse_id') {

				if ($aRow['warehouse_ids'] != '') {
					$team = get_warehouse_name($aRow['warehouse_ids']);

					$str = '';
					$value = $team != null ? get_object_vars($team)['warehouse_name'] : '';

					$str .= '<span class="label label-tag tag-id-1"><span class="tag">' . $value . '</span><span class="hide">, </span></span>&nbsp';

					$_data = $str;
				} else {
					$_data = '';
				}

			} elseif ($aColumns[$i] == 'unit_id') {
				if ($aRow['unit_id'] != null) {
					$_data = get_unit_type($aRow['unit_id']) != null ? get_unit_type($aRow['unit_id'])->unit_name : '';
				} else {
					$_data = '';
				}
			} elseif ($aColumns[$i] == 'rate') {
				$_data = app_format_money((float) $aRow['rate'], '');
			} elseif ($aColumns[$i] == 'purchase_price') {
				$_data = app_format_money((float) $aRow['purchase_price'], '');

			} elseif ($aColumns[$i] == 'tax') {
				$_data = get_tax_rate($aRow['tax']) != null ? get_tax_rate($aRow['tax'])->name : '';

			} elseif ($aColumns[$i] == db_prefix() . 'inventory_manage.inventory_number') {
				$_data = $aRow['inventory_number'];

			} elseif ($aColumns[$i] == 'origin') {
				$_data = '';
			} elseif ($aColumns[$i] == 'sku_name') {

				$_data = '<a href="' . admin_url('warehouse/view_commodity_detail/' . $aRow['id']) . '" class="btn btn-default btn-icon"><i class="fa fa-eye"></i></a>';
			}

			$row[] = $_data;

		}
		$output['aaData'][] = $row;
	}
} else {
	foreach ($rResult as $aRow) {
		$row = [];
		for ($i = 0; $i < count($aColumns); $i++) {

			$_data = $aRow[$aColumns[$i]];

			/*get commodity file*/
			$arr_images = $this->ci->warehouse_model->get_warehourse_attachments($aRow['id']);
			if (count($arr_images) > 0) {

				if (file_exists(WAREHOUSE_ITEM_UPLOAD . $arr_images[0]['rel_id'] . '/' . $arr_images[0]['file_name'])) {
					$_data = '<img class="images_w_table" src="' . site_url('modules/warehouse/uploads/item_img/' . $arr_images[0]['rel_id'] . '/' . $arr_images[0]['file_name']) . '" alt="' . $arr_images[0]['file_name'] . '" >';
				} else {
					$_data = '<img class="images_w_table" src="' . site_url('modules/purchase/uploads/item_img/' . $arr_images[0]['rel_id'] . '/' . $arr_images[0]['file_name']) . '" alt="' . $arr_images[0]['file_name'] . '" >';
				}

			} else {

				$_data = '<img class="images_w_table" src="' . site_url('modules/warehouse/uploads/nul_image.jpg') . '" alt="nul_image.jpg">';
			}

			if ($aColumns[$i] == 'commodity_code') {
				$code = '<a href="' . admin_url('warehouse/commodity_detail/' . $aRow['id']) . '" onclick="init_commodity_detail(' . $aRow['id'] . '); return false;">' . $aRow['commodity_code'] . '</a>';
				$code .= '<div class="row-options">';

				$code .= '<a href="' . admin_url('warehouse/view_commodity_detail/' . $aRow['id']) . '" >' . _l('view') . '</a>';

				if (has_permission('warehouse', '', 'edit') || is_admin()) {
					$code .= ' | <a href="#" onclick="edit_commodity_item(this); return false;"  data-commodity_id="' . $aRow['id'] . '" data-description="' . $aRow['description'] . '" data-unit_id="' . $aRow['unit_id'] . '" data-commodity_code="' . $aRow['commodity_code'] . '" data-commodity_barcode="' . $aRow['commodity_barcode'] . '" data-commodity_type="' . $aRow['commodity_type'] . '" data-origin="' . $aRow['origin'] . '" data-color_id="' . $aRow['color_id'] . '" data-style_id="' . $aRow['style_id'] . '" data-model_id="' . $aRow['model_id'] . '" data-size_id="' . $aRow['size_id'] . '" data-date_manufacture="' . _d($aRow['date_manufacture']) . '" data-expiry_date="' . _d($aRow['expiry_date']) . '" data-long_description="' . $aRow['long_description'] . '" data-rate="' . app_format_money($aRow['rate'], '') . '" data-group_id="' . $aRow['group_id'] . '" data-tax="' . $aRow['tax'] . '"  data-warehouse_id="' . $aRow['warehouse_id'] . '" data-sku_code="' . $aRow['sku_code'] . '" data-sku_name="' . $aRow['sku_name'] . '" data-sub_group="' . $aRow['sub_group'] . '" data-purchase_price="' . $aRow['purchase_price'] . '" >' . _l('edit') . '</a>';
				}

				if (has_permission('warehouse', '', 'delete') || is_admin()) {
					$code .= ' | <a href="' . admin_url('warehouse/delete_commodity/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
				}

				$code .= '</div>';

				$_data = $code;

			} elseif ($aColumns[$i] == 'description') {

				if (get_status_inventory($aRow['id'], $aRow['inventory_number'])) {
					$_data = '<a href="#" onclick="show_detail_item(this);return false;" data-name="' . $aRow['description'] . '"  data-warehouse_id="' . $aRow['warehouse_id'] . '" data-commodity_id="' . $aRow['commodity_id'] . '" data-expiry_date="' . $aRow['expiry_date'] . '" >' . $aRow['description'] . '</a>';
				} else {

					$_data = '<a href="#" class="text-danger"  onclick="show_detail_item(this);return false;" data-name="' . $aRow['description'] . '" data-warehouse_id="' . $aRow['warehouse_id'] . '" data-commodity_id="' . $aRow['commodity_id'] . '" data-expiry_date="' . $aRow['expiry_date'] . '" >' . $aRow['description'] . '</a>';
				}

			} elseif ($aColumns[$i] == 'group_id') {
				$_data = get_group_name($aRow['group_id']) != null ? get_group_name($aRow['group_id'])->name : '';
			} elseif ($aColumns[$i] == db_prefix() . 'items.warehouse_id') {

				if ($aRow['warehouse_ids'] != '') {
					$team = get_warehouse_name($aRow['warehouse_ids']);

					$str = '';
					$value = $team != null ? get_object_vars($team)['warehouse_name'] : '';

					$str .= '<span class="label label-tag tag-id-1"><span class="tag">' . $value . '</span><span class="hide">, </span></span>&nbsp';

					$_data = $str;
				} else {
					$_data = '';
				}

			} elseif ($aColumns[$i] == 'unit_id') {
				if ($aRow['unit_id'] != null) {
					$_data = get_unit_type($aRow['unit_id']) != null ? get_unit_type($aRow['unit_id'])->unit_name : '';
				} else {
					$_data = '';
				}
			} elseif ($aColumns[$i] == 'rate') {
				$_data = app_format_money((float) $aRow['rate'], '');
			} elseif ($aColumns[$i] == 'purchase_price') {
				$_data = app_format_money((float) $aRow['purchase_price'], '');

			} elseif ($aColumns[$i] == 'tax') {
				$_data = get_tax_rate($aRow['tax']) != null ? get_tax_rate($aRow['tax'])->name : '';

			} elseif ($aColumns[$i] == db_prefix() . 'inventory_manage.inventory_number') {

				$_data = $aRow['inventory_number'];
			} elseif ($aColumns[$i] == 'origin') {
				if (get_status_inventory($aRow['id'], $aRow['inventory_number'])) {
					$_data = '';
				} else {
					$_data = '<span class="label label-tag tag-id-1 label-tab2"><span class="tag">' . _l('unsafe_inventory') . '</span><span class="hide">, </span></span>&nbsp';
				}
			} elseif ($aColumns[$i] == 'sku_name') {
				$_data = '<a href="' . admin_url('warehouse/view_commodity_detail/' . $aRow['id']) . '" class="btn btn-default btn-icon"><i class="fa fa-eye"></i></a>';
			}

			$row[] = $_data;

		}
		$output['aaData'][] = $row;
	}

}
