<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * warehouse model
 */
class Warehouse_model extends App_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * add commodity type
	 * @param array  $data
	 * @param boolean $id
	 * return boolean
	 */
	public function add_commodity_type($data, $id = false) {
		$commodity_type = str_replace(', ', '|/\|', $data['hot_commodity_type']);

		$data_commodity_type = explode(',', $commodity_type);
		$results = 0;
		$results_update = '';
		$flag_empty = 0;

		foreach ($data_commodity_type as $commodity_type_key => $commodity_type_value) {
			if ($commodity_type_value == '') {
				$commodity_type_value = 0;
			}
			if (($commodity_type_key + 1) % 5 == 0) {
				$arr_temp['note'] = str_replace('|/\|', ', ', $commodity_type_value);

				if ($id == false && $flag_empty == 1) {
					$this->db->insert(db_prefix() . 'ware_commodity_type', $arr_temp);
					$insert_id = $this->db->insert_id();
					if ($insert_id) {
						$results++;
					}
				}
				if (is_numeric($id) && $flag_empty == 1) {
					$this->db->where('commodity_type_id', $id);
					$this->db->update(db_prefix() . 'ware_commodity_type', $arr_temp);
					if ($this->db->affected_rows() > 0) {
						$results_update = true;
					} else {
						$results_update = false;
					}
				}
				$flag_empty = 0;
				$arr_temp = [];
			} else {

				switch (($commodity_type_key + 1) % 5) {
				case 1:
					$arr_temp['commondity_code'] = str_replace('|/\|', ', ', $commodity_type_value);
					if ($commodity_type_value != '0') {
						$flag_empty = 1;
					}
					break;
				case 2:
					$arr_temp['commondity_name'] = str_replace('|/\|', ', ', $commodity_type_value);
					break;
				case 3:
					$arr_temp['order'] = $commodity_type_value;
					break;
				case 4:
					//display 1: display (yes) , 0: not displayed (no)
					if ($commodity_type_value == 'yes') {
						$display_value = 1;
					} else {
						$display_value = 0;
					}
					$arr_temp['display'] = $display_value;
					break;
				}
			}

		}

		if ($id == false) {
			return $results > 0 ? true : false;
		} else {
			return $results_update;
		}

	}

	/**
	 *  get commodity type
	 * @param  boolean $id
	 * @return array or object
	 */
	public function get_commodity_type($id = false) {

		if (is_numeric($id)) {
			$this->db->where('commodity_type_id', $id);

			return $this->db->get(db_prefix() . 'ware_commodity_type')->row();
		}
		if ($id == false) {
			return $this->db->query('select * from ' . db_prefix() . 'ware_commodity_type')->result_array();
		}

	}

	/**
	 * get commodity type add commodity
	 * @return array
	 */
	public function get_commodity_type_add_commodity() {

		return $this->db->query('select * from tblware_commodity_type where display = 1 order by tblware_commodity_type.order asc ')->result_array();

	}

	/**
	 * delete commodity type
	 * @param  integer $id
	 * @return boolean
	 */
	public function delete_commodity_type($id) {
		$this->db->where('commodity_type_id', $id);
		$this->db->delete(db_prefix() . 'ware_commodity_type');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * add unit type
	 * @param array  $data
	 * @param boolean $id
	 * return boolean
	 */
	public function add_unit_type($data, $id = false) {

		$unit_type = str_replace(', ', '|/\|', $data['hot_unit_type']);
		$data_unit_type = explode(',', $unit_type);
		$results = 0;
		$results_update = '';
		$flag_empty = 0;

		foreach ($data_unit_type as $unit_type_key => $unit_type_value) {
			if ($unit_type_value == '') {
				$unit_type_value = 0;
			}
			if (($unit_type_key + 1) % 6 == 0) {
				$arr_temp['note'] = str_replace('|/\|', ', ', $unit_type_value);

				if ($id == false && $flag_empty == 1) {
					$this->db->insert(db_prefix() . 'ware_unit_type', $arr_temp);
					$insert_id = $this->db->insert_id();
					if ($insert_id) {
						$results++;
					}
				}
				if (is_numeric($id) && $flag_empty == 1) {
					$this->db->where('unit_type_id', $id);
					$this->db->update(db_prefix() . 'ware_unit_type', $arr_temp);
					if ($this->db->affected_rows() > 0) {
						$results_update = true;
					} else {
						$results_update = false;
					}
				}
				$flag_empty = 0;
				$arr_temp = [];
			} else {

				switch (($unit_type_key + 1) % 6) {
				case 1:
					$arr_temp['unit_code'] = str_replace('|/\|', ', ', $unit_type_value);

					if ($unit_type_value != '0') {
						$flag_empty = 1;
					}
					break;
				case 2:
					$arr_temp['unit_name'] = str_replace('|/\|', ', ', $unit_type_value);
					break;
				case 3:
					$arr_temp['unit_symbol'] = $unit_type_value;
					break;
				case 4:
					$arr_temp['order'] = $unit_type_value;
					break;
				case 5:
					//display 1: display (yes) , 0: not displayed (no)
					if ($unit_type_value == 'yes') {
						$display_value = 1;
					} else {
						$display_value = 0;
					}
					$arr_temp['display'] = $display_value;
					break;
				}
			}

		}

		if ($id == false) {
			return $results > 0 ? true : false;
		} else {
			return $results_update;
		}

	}

	/**
	 * get unit type
	 * @param  boolean $id
	 * @return array or object
	 */
	public function get_unit_type($id = false) {

		if (is_numeric($id)) {
			$this->db->where('unit_type_id', $id);

			return $this->db->get(db_prefix() . 'ware_unit_type')->row();
		}
		if ($id == false) {
			return $this->db->query('select * from tblware_unit_type')->result_array();
		}

	}

	/**
	 * get unit add commodity
	 * @return array
	 */
	public function get_unit_add_commodity() {
		return $this->db->query('select * from tblware_unit_type where display = 1 order by tblware_unit_type.order asc ')->result_array();
	}

	/**
	 * get unit code name
	 * @return array
	 */
	public function get_units_code_name() {
		return $this->db->query('select unit_type_id as id, unit_name as label from ' . db_prefix() . 'ware_unit_type')->result_array();
	}

	/**
	 * get warehouse code name
	 * @return array
	 */
	public function get_warehouse_code_name() {
		return $this->db->query('select warehouse_id as id, warehouse_name as label from ' . db_prefix() . 'warehouse')->result_array();
	}

	/**
	 * delete unit type
	 * @param  integer $id
	 * @return boolean
	 */
	public function delete_unit_type($id) {
		$this->db->where('unit_type_id', $id);
		$this->db->delete(db_prefix() . 'ware_unit_type');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * add size type
	 * @param array  $data
	 * @param boolean $id
	 * return boolean
	 */
	public function add_size_type($data, $id = false) {
		$size_type = str_replace(', ', '|/\|', $data['hot_size_type']);

		$data_size_type = explode(',', ($size_type));
		$results = 0;
		$results_update = '';
		$flag_empty = 0;

		foreach ($data_size_type as $size_type_key => $size_type_value) {
			if ($size_type_value == '') {
				$size_type_value = 0;
			}
			if (($size_type_key + 1) % 6 == 0) {
				$arr_temp['note'] = str_replace('|/\|', ', ', $size_type_value);

				if ($id == false && $flag_empty == 1) {
					$this->db->insert(db_prefix() . 'ware_size_type', $arr_temp);
					$insert_id = $this->db->insert_id();
					if ($insert_id) {
						$results++;
					}
				}
				if (is_numeric($id) && $flag_empty == 1) {
					$this->db->where('size_type_id', $id);
					$this->db->update(db_prefix() . 'ware_size_type', $arr_temp);
					if ($this->db->affected_rows() > 0) {
						$results_update = true;
					} else {
						$results_update = false;
					}
				}
				$flag_empty = 0;
				$arr_temp = [];
			} else {

				switch (($size_type_key + 1) % 6) {
				case 1:
					$arr_temp['size_code'] = str_replace('|/\|', ', ', $size_type_value);
					if ($size_type_value != '0') {
						$flag_empty = 1;
					}
					break;
				case 2:
					$arr_temp['size_name'] = str_replace('|/\|', ', ', $size_type_value);
					break;
				case 3:
					$arr_temp['size_symbol'] = $size_type_value;
					break;
				case 4:
					$arr_temp['order'] = $size_type_value;
					break;
				case 5:
					//display 1: display (yes) , 0: not displayed (no)
					if ($size_type_value == 'yes') {
						$display_value = 1;
					} else {
						$display_value = 0;
					}
					$arr_temp['display'] = $display_value;
					break;
				}
			}

		}

		if ($id == false) {
			return $results > 0 ? true : false;
		} else {
			return $results_update;
		}

	}

	/**
	 * get size type
	 * @param  boolean $id
	 * @return array or object
	 */
	public function get_size_type($id = false) {

		if (is_numeric($id)) {
			$this->db->where('size_type_id', $id);

			return $this->db->get(db_prefix() . 'ware_size_type')->row();
		}
		if ($id == false) {
			return $this->db->query('select * from tblware_size_type')->result_array();
		}

	}

	/**
	 * get size add commodity
	 * @return array
	 */
	public function get_size_add_commodity() {

		return $this->db->query('select * from tblware_size_type where display = 1 order by tblware_size_type.order asc')->result_array();

	}

	/**
	 * delete size type
	 * @param  integer $id
	 * @return boolean
	 */
	public function delete_size_type($id) {
		$this->db->where('size_type_id', $id);
		$this->db->delete(db_prefix() . 'ware_size_type');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * add style type
	 * @param array  $data
	 * @param boolean $id
	 * return boolean
	 */
	public function add_style_type($data, $id = false) {
		$style_type = str_replace(', ', '|/\|', $data['hot_style_type']);

		$data_style_type = explode(',', ($style_type));
		$results = 0;
		$results_update = '';
		$flag_empty = 0;

		foreach ($data_style_type as $style_type_key => $style_type_value) {
			if ($style_type_value == '') {
				$style_type_value = 0;
			}
			if (($style_type_key + 1) % 6 == 0) {
				$arr_temp['note'] = str_replace('|/\|', ', ', $style_type_value);

				if ($id == false && $flag_empty == 1) {
					$this->db->insert(db_prefix() . 'ware_style_type', $arr_temp);
					$insert_id = $this->db->insert_id();
					if ($insert_id) {
						$results++;
					}
				}
				if (is_numeric($id) && $flag_empty == 1) {
					$this->db->where('style_type_id', $id);
					$this->db->update(db_prefix() . 'ware_style_type', $arr_temp);
					if ($this->db->affected_rows() > 0) {
						$results_update = true;
					} else {
						$results_update = false;
					}
				}
				$flag_empty = 0;
				$arr_temp = [];
			} else {

				switch (($style_type_key + 1) % 6) {
				case 1:
					$arr_temp['style_code'] = str_replace('|/\|', ', ', $style_type_value);
					if ($style_type_value != '0') {
						$flag_empty = 1;
					}
					break;
				case 2:
					$arr_temp['style_barcode'] = str_replace('|/\|', ', ', $style_type_value);
					break;
				case 3:
					$arr_temp['style_name'] = str_replace('|/\|', ', ', $style_type_value);
					break;
				case 4:
					$arr_temp['order'] = $style_type_value;
					break;
				case 5:
					//display 1: display (yes) , 0: not displayed (no)
					if ($style_type_value == 'yes') {
						$display_value = 1;
					} else {
						$display_value = 0;
					}
					$arr_temp['display'] = $display_value;
					break;
				}
			}

		}

		if ($id == false) {
			return $results > 0 ? true : false;
		} else {
			return $results_update;
		}

	}

	/**
	 * get style type
	 * @param  boolean $id
	 * @return array or object
	 */
	public function get_style_type($id = false) {

		if (is_numeric($id)) {
			$this->db->where('style_type_id', $id);

			return $this->db->get(db_prefix() . 'ware_style_type')->row();
		}
		if ($id == false) {
			return $this->db->query('select * from tblware_style_type')->result_array();
		}

	}

	/**
	 * get style add commodity
	 * @return array
	 */
	public function get_style_add_commodity() {

		return $this->db->query('select * from tblware_style_type where display = 1 order by tblware_style_type.order asc')->result_array();

	}

	/**
	 * delete style type
	 * @param  integer $id
	 * @return boolean
	 */
	public function delete_style_type($id) {
		$this->db->where('style_type_id', $id);
		$this->db->delete(db_prefix() . 'ware_style_type');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * add body type
	 * @param array  $data
	 * @param boolean $id
	 * return boolean
	 */
	public function add_body_type($data, $id = false) {
		$body_type = str_replace(', ', '|/\|', $data['hot_body_type']);

		$data_body_type = explode(',', ($body_type));
		$results = 0;
		$results_update = '';
		$flag_empty = 0;

		foreach ($data_body_type as $body_type_key => $body_type_value) {
			if ($body_type_value == '') {
				$body_type_value = 0;
			}
			if (($body_type_key + 1) % 5 == 0) {
				$arr_temp['note'] = str_replace('|/\|', ', ', $body_type_value);

				if ($id == false && $flag_empty == 1) {
					$this->db->insert(db_prefix() . 'ware_body_type', $arr_temp);
					$insert_id = $this->db->insert_id();
					if ($insert_id) {
						$results++;
					}
				}
				if (is_numeric($id) && $flag_empty == 1) {
					$this->db->where('body_type_id', $id);
					$this->db->update(db_prefix() . 'ware_body_type', $arr_temp);
					if ($this->db->affected_rows() > 0) {
						$results_update = true;
					} else {
						$results_update = false;
					}
				}
				$flag_empty = 0;
				$arr_temp = [];
			} else {

				switch (($body_type_key + 1) % 5) {
				case 1:
					$arr_temp['body_code'] = str_replace('|/\|', ', ', $body_type_value);
					if ($body_type_value != '0') {
						$flag_empty = 1;
					}
					break;
				case 2:
					$arr_temp['body_name'] = str_replace('|/\|', ', ', $body_type_value);
					break;
				case 3:
					$arr_temp['order'] = $body_type_value;
					break;
				case 4:
					//display 1: display (yes) , 0: not displayed (no)
					if ($body_type_value == 'yes') {
						$display_value = 1;
					} else {
						$display_value = 0;
					}
					$arr_temp['display'] = $display_value;
					break;
				}
			}

		}

		if ($id == false) {
			return $results > 0 ? true : false;
		} else {
			return $results_update;
		}

	}

	/**
	 * get body type
	 * @param  boolean $id
	 * @return row or array
	 */
	public function get_body_type($id = false) {

		if (is_numeric($id)) {
			$this->db->where('body_type_id', $id);

			return $this->db->get(db_prefix() . 'ware_body_type')->row();
		}
		if ($id == false) {
			return $this->db->query('select * from tblware_body_type')->result_array();
		}

	}

	/**
	 * get body add commodity
	 * @return array
	 */
	public function get_body_add_commodity() {

		return $this->db->query('select * from tblware_body_type where display = 1 order by tblware_body_type.order asc')->result_array();
	}

	/**
	 * delete body type
	 * @param  integer $id
	 * @return boolean
	 */
	public function delete_body_type($id) {
		$this->db->where('body_type_id', $id);
		$this->db->delete(db_prefix() . 'ware_body_type');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * add commodity group type
	 * @param array  $data
	 * @param boolean $id
	 * return boolean
	 */
	public function add_commodity_group_type($data, $id = false) {
		$data['commodity_group'] = str_replace(', ', '|/\|', $data['hot_commodity_group_type']);

		$data_commodity_group_type = explode(',', $data['commodity_group']);
		$results = 0;
		$results_update = '';
		$flag_empty = 0;

		foreach ($data_commodity_group_type as $commodity_group_type_key => $commodity_group_type_value) {
			if ($commodity_group_type_value == '') {
				$commodity_group_type_value = 0;
			}
			if (($commodity_group_type_key + 1) % 5 == 0) {

				$arr_temp['note'] = str_replace('|/\|', ', ', $commodity_group_type_value);

				if ($id == false && $flag_empty == 1) {
					$this->db->insert(db_prefix() . 'items_groups', $arr_temp);
					$insert_id = $this->db->insert_id();
					if ($insert_id) {
						$results++;
					}
				}
				if (is_numeric($id) && $flag_empty == 1) {
					$this->db->where('id', $id);
					$this->db->update(db_prefix() . 'items_groups', $arr_temp);
					if ($this->db->affected_rows() > 0) {
						$results_update = true;
					} else {
						$results_update = false;
					}
				}

				$flag_empty = 0;
				$arr_temp = [];
			} else {

				switch (($commodity_group_type_key + 1) % 5) {
				case 1:
					$arr_temp['commodity_group_code'] = str_replace('|/\|', ', ', $commodity_group_type_value);

					if ($commodity_group_type_value != '0') {
						$flag_empty = 1;
					}
					break;
				case 2:
					$arr_temp['name'] = str_replace('|/\|', ', ', $commodity_group_type_value);
					break;
				case 3:
					$arr_temp['order'] = $commodity_group_type_value;
					break;
				case 4:
					//display 1: display (yes) , 0: not displayed (no)
					if ($commodity_group_type_value == 'yes') {
						$display_value = 1;
					} else {
						$display_value = 0;
					}
					$arr_temp['display'] = $display_value;
					break;
				}
			}

		}

		if ($id == false) {
			return $results > 0 ? true : false;
		} else {
			return $results_update;
		}

	}

	/**
	 * get commodity group type
	 * @param  boolean $id
	 * @return array or object
	 */
	public function get_commodity_group_type($id = false) {

		if (is_numeric($id)) {
			$this->db->where('id', $id);

			return $this->db->get(db_prefix() . 'items_groups')->row();
		}
		if ($id == false) {
			return $this->db->query('select * from tblitems_groups')->result_array();
		}

	}

	/**
	 * get commodity group add commodity
	 * @return array
	 */
	public function get_commodity_group_add_commodity() {

		return $this->db->query('select * from tblitems_groups where display = 1 order by tblitems_groups.order asc ')->result_array();
	}

	/**
	 * delete commodity group type
	 * @param  integer $id
	 * @return boolean
	 */
	public function delete_commodity_group_type($id) {
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'items_groups');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * add warehouse
	 * @param array  $data
	 * @param boolean $id
	 * return boolean
	 */
	public function add_warehouse($data, $id = false) {

		$data['warehouse_type'] = str_replace(', ', '|/\|', $data['hot_warehouse_type']);

		$data_warehouse_type = explode(',', $data['warehouse_type']);

		$results = 0;
		$results_update = '';
		$flag_empty = 0;

		foreach ($data_warehouse_type as $warehouse_key => $warehouse_value) {
			if ($warehouse_value == '') {
				$warehouse_value = 0;
			}
			if (($warehouse_key + 1) % 6 == 0) {
				$arr_temp['note'] = str_replace('|/\|', ', ', $warehouse_value);

				if ($id == false && $flag_empty == 1) {
					$this->db->insert(db_prefix() . 'warehouse', $arr_temp);
					$insert_id = $this->db->insert_id();
					if ($insert_id) {
						$results++;
					}
				}
				if (is_numeric($id) && $flag_empty == 1) {
					$this->db->where('warehouse_id', $id);
					$this->db->update(db_prefix() . 'warehouse', $arr_temp);
					if ($this->db->affected_rows() > 0) {
						$results_update = true;
					} else {
						$results_update = false;
					}
				}
				$flag_empty = 0;
				$arr_temp = [];
			} else {

				switch (($warehouse_key + 1) % 6) {
				case 1:
					$arr_temp['warehouse_code'] = str_replace('|/\|', ', ', $warehouse_value);
					if ($warehouse_value != '0') {
						$flag_empty = 1;
					}
					break;
				case 2:
					$arr_temp['warehouse_name'] = str_replace('|/\|', ', ', $warehouse_value);
					break;
				case 3:
					$arr_temp['warehouse_address'] = str_replace('|/\|', ', ', $warehouse_value);
					break;
				case 4:
					$arr_temp['order'] = $warehouse_value;
					break;
				case 5:
					//display 1: display (yes) , 0: not displayed (no)
					if ($warehouse_value == 'yes') {
						$display_value = 1;
					} else {
						$display_value = 0;
					}
					$arr_temp['display'] = $display_value;
					break;
				}
			}

		}

		if ($id == false) {
			return $results > 0 ? true : false;
		} else {
			return $results_update;
		}

	}

	/**
	 * get warehouse
	 * @param  boolean $id
	 * @return array or object
	 */
	public function get_warehouse($id = false) {

		if (is_numeric($id)) {
			$this->db->where('warehouse_id', $id);

			return $this->db->get(db_prefix() . 'warehouse')->row();
		}
		if ($id == false) {
			return $this->db->query('select * from tblwarehouse')->result_array();
		}

	}

	/**
	 * get warehouse add commodity
	 * @return array
	 */
	public function get_warehouse_add_commodity() {

		return $this->db->query('select * from tblwarehouse where display = 1 order by tblwarehouse.order asc')->result_array();
	}

	/**
	 * delete warehouse
	 * @param  integer $id
	 * @return boolean
	 */
	public function delete_warehouse($id) {
		$this->db->where('warehouse_id', $id);
		$this->db->delete(db_prefix() . 'warehouse');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * add commodity
	 * @param array $data
	 * @param boolean $id
	 * return boolean
	 */
	public function add_commodity($data, $id = false) {
		$data['warehouse_type'] = str_replace(', ', '|/\|', $data['hot_warehouse_type']);
		$data_warehouse_type = explode(',', $data['warehouse_type']);

		$results = 0;
		$results_update = '';
		$flag_empty = 0;

		foreach ($data_warehouse_type as $warehouse_key => $warehouse_value) {
			$data_inventory_min = [];
			if ($warehouse_value == '') {
				$warehouse_value = 0;
			}
			if (($warehouse_key + 1) % 17 == 0) {
				$arr_temp['type_product'] = str_replace('|/\|', ', ', $warehouse_value);

				if ($id == false && $flag_empty == 1) {
					$this->db->insert(db_prefix() . 'items', $arr_temp);
					$insert_id = $this->db->insert_id();
					if ($insert_id) {
						$data_inventory_min['commodity_id'] = $insert_id;
						$data_inventory_min['commodity_code'] = $arr_temp['commodity_code'];
						$data_inventory_min['commodity_name'] = $arr_temp['description'];
						$this->add_inventory_min($data_inventory_min);
						$results++;
					}
				}
				if (is_numeric($id)) {
					$this->db->where('id', $id);
					$this->db->update(db_prefix() . 'items', $arr_temp);
					if ($this->db->affected_rows() > 0) {
						$results_update = true;
					} else {
						$results_update = false;
					}
				}
				$flag_empty = 0;
				$arr_temp = [];
			} else {

				switch (($warehouse_key + 1) % 17) {
				case 1:
					$arr_temp['commodity_code'] = str_replace('|/\|', ', ', $warehouse_value);
					break;
				case 2:
					$arr_temp['commodity_barcode'] = str_replace('|/\|', ', ', $warehouse_value);
					break;
				case 3:
					$arr_temp['description'] = str_replace('|/\|', ', ', $warehouse_value);
					break;
				case 4:
					$arr_temp['unit_id'] = $warehouse_value;
					if ($warehouse_value != '0') {
						$flag_empty = 1;
					}
					break;
				case 5:
					$arr_temp['commodity_type'] = $warehouse_value;
					break;
				case 6:
					$arr_temp['warehouse_id'] = $warehouse_value;
					break;
				case 7:
					$arr_temp['group_id'] = $warehouse_value;
					break;
				case 8:
					$arr_temp['tax'] = $warehouse_value;
					break;
				case 9:
					$arr_temp['origin'] = str_replace('|/\|', ', ', $warehouse_value);
					break;
				case 10:
					$arr_temp['style_id'] = $warehouse_value;
					break;
				case 11:
					$arr_temp['model_id'] = $warehouse_value;
					break;
				case 12:
					$arr_temp['size_id'] = $warehouse_value;
					break;
				case 13:
					$arr_temp['images'] = $warehouse_value;
					break;
				case 14:
					$arr_temp['date_manufacture'] = $warehouse_value;
					break;
				case 15:
					$arr_temp['expiry_date'] = $warehouse_value;
					break;
				case 16:
					$arr_temp['rate'] = $warehouse_value;
					break;

				}
			}

		}

		if ($id == false) {
			return $results > 0 ? true : false;
		} else {
			return $results_update;
		}

	}

	/**
	 * get commodity
	 * @param  boolean $id
	 * @return array or object
	 */
	public function get_commodity($id = false) {

		if (is_numeric($id)) {
			$this->db->where('id', $id);

			return $this->db->get(db_prefix() . 'items')->row();
		}
		if ($id == false) {
			return $this->db->query('select * from tblitems')->result_array();
		}

	}

	/**
	 * get commodity code name
	 * @return array
	 */
	public function get_commodity_code_name() {
		return $this->db->query('select id as id, CONCAT(commodity_code,"_",description) as label from ' . db_prefix() . 'items')->result_array();

	}

	/**
	 * get items code name
	 * @return array
	 */
	public function get_items_code_name() {
		return $this->db->query('select id as id, CONCAT(commodity_code," - " ,description) as label from ' . db_prefix() . 'items')->result_array();

	}

	/**
	 * delete commodity
	 * @param  integer $id
	 * @return boolean
	 */
	public function delete_commodity($id) {
		/*delete commodity min*/
		$this->db->where('commodity_id', $id);
		$this->db->delete(db_prefix() . 'inventory_commodity_min');

		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'items');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * get commodity hansometable
	 * @param  boolean $id
	 * @return object
	 */
	public function get_commodity_hansometable($id = false) {

		if (is_numeric($id)) {
			return $this->db->query('select description, rate, unit_id, taxrate, purchase_price,' . db_prefix() . 'taxes.name from ' . db_prefix() . 'items left join ' . db_prefix() . 'ware_unit_type on  ' . db_prefix() . 'items.unit_id = ' . db_prefix() . 'ware_unit_type.unit_type_id
					left join ' . db_prefix() . 'taxes on ' . db_prefix() . 'items.tax = ' . db_prefix() . 'taxes.id where ' . db_prefix() . 'items.id = ' . $id)->row();
		}
	}

	/**
	 * create goods code
	 * @return	string
	 */
	public function create_goods_code() {
		$id = $this->db->query('SELECT id FROM ' . db_prefix() . 'goods_receipt order by id desc limit 1')->row();

		if ($id == null) {
			$goods_code = 'NK01';
		} else {
			$goods_code = 'NK0' . (get_object_vars($id)['id'] + 1);
		}
		return $goods_code;
	}

	/**
	 * add goods
	 * @param array $data
	 * @param boolean $id
	 * return boolean
	 */
	public function add_goods_receipt($data, $id = false) {

		$check_appr = $this->get_approve_setting('1');
		$data['approval'] = 0;
		if ($check_appr && $check_appr != false) {
			$data['approval'] = 0;
		} else {
			$data['approval'] = 1;
		}

		if (isset($data['hot_purchase'])) {
			$hot_purchase = $data['hot_purchase'];
			unset($data['hot_purchase']);
		}
		$data['goods_receipt_code'] = $this->create_goods_code();
		$data['date_c'] = to_sql_date($data['date_c']);
		$data['date_add'] = to_sql_date($data['date_add']);
		$data['addedfrom'] = get_staff_user_id();

		$data['total_tax_money'] = reformat_currency_j($data['total_tax_money']);

		$data['total_goods_money'] = reformat_currency_j($data['total_goods_money']);
		$data['value_of_inventory'] = reformat_currency_j($data['value_of_inventory']);

		$data['total_money'] = reformat_currency_j($data['total_money']);

		if ($data['pr_order_id'] != '') {
			$this->update_status_goods($data['pr_order_id']);
		}

		$this->db->insert(db_prefix() . 'goods_receipt', $data);
		$insert_id = $this->db->insert_id();
		if (isset($insert_id)) {

			$data['purchase'] = str_replace(', ', '|/\|', $hot_purchase);

			$purchases = explode(',', $data['purchase']);
			$results = 0;
			$results_update = '';
			$flag_empty = 0;
			foreach ($purchases as $purchase_key => $purchase_value) {
				if ($purchase_value == '') {
					$purchase_value = 0;
				}
				if (($purchase_key + 1) % 10 == 0) {
					$arr_temp['note'] = str_replace('|/\|', ', ', $purchase_value);
					$arr_temp['goods_receipt_id'] = $insert_id;

					if ($id == false && $flag_empty == 1) {
						$this->db->insert(db_prefix() . 'goods_receipt_detail', $arr_temp);
						$insert_detail = $this->db->insert_id();

						$results++;
					}
					$flag_empty = 0;
					$arr_temp = [];
				} else {

					switch (($purchase_key + 1) % 10) {
					case 1:
						$arr_temp['commodity_code'] = str_replace('|/\|', ', ', $purchase_value);
						if ($purchase_value != '0') {
							$flag_empty = 1;
						}
						break;
					case 2:
						$arr_temp['unit_id'] = $purchase_value;
						break;
					case 3:
						$arr_temp['quantities'] = $purchase_value;
						break;
					case 4:
						$arr_temp['unit_price'] = $purchase_value;
						break;
					case 5:
						$arr_temp['tax'] = $purchase_value;
						break;
					case 6:
						$arr_temp['goods_money'] = $purchase_value;
						break;
					case 7:
						$arr_temp['tax_money'] = $purchase_value;
						break;
					case 8:

						$arr_temp['date_manufacture'] = to_sql_date($purchase_value);
						break;
					case 9:
						$arr_temp['expiry_date'] = to_sql_date($purchase_value);
						break;

					}
				}
				$arr_temp['warehouse_id'] = $data['warehouse_id'];

			}

			$data_log = [];
			$data_log['rel_id'] = $insert_id;
			$data_log['rel_type'] = 'stock_import';
			$data_log['staffid'] = get_staff_user_id();
			$data_log['date'] = date('Y-m-d H:i:s');
			$data_log['note'] = "stock_import";

			$this->add_activity_log($data_log);

		}

		//approval if not approval setting
		if (isset($insert_id)) {
			if ($data['approval'] == 1) {
				$this->update_approve_request($insert_id, 1, 1);
			}
		}

		return $results > 0 ? true : false;

	}

	/**
	 * get goods receipt
	 * @param  integer $id
	 * @return array or object
	 */
	public function get_goods_receipt($id) {
		if (is_numeric($id)) {
			$this->db->where('id', $id);

			return $this->db->get(db_prefix() . 'goods_receipt')->row();
		}
		if ($id == false) {
			return $this->db->query('select * from tblgoods_receipt')->result_array();
		}
	}

	/**
	 * get goods receipt detail
	 * @param  integer $id
	 * @return array
	 */
	public function get_goods_receipt_detail($id) {
		if (is_numeric($id)) {
			$this->db->where('goods_receipt_id', $id);

			return $this->db->get(db_prefix() . 'goods_receipt_detail')->result_array();
		}
		if ($id == false) {
			return $this->db->query('select * from tblgoods_receipt_detail')->result_array();
		}
	}

	/**
	 * get purchase request
	 * @param  integer $pur_order
	 * @return array
	 */
	public function get_pur_request($pur_order) {

		$arr_pur_resquest = [];
		$total_goods_money = 0;
		$total_money = 0;
		$total_tax_money = 0;
		$value_of_inventory = 0;

		$sql = 'select item_code as commodity_code, description, ' . db_prefix() . 'items.unit_id, unit_price, quantity, taxrate as tax_rate, into_money, ((into_money*taxrate)/100) as tax_money from ' . db_prefix() . 'pur_order_detail
			left join ' . db_prefix() . 'items on ' . db_prefix() . 'pur_order_detail.item_code =  ' . db_prefix() . 'items.id
			left join ' . db_prefix() . 'taxes on ' . db_prefix() . 'taxes.id = ' . db_prefix() . 'pur_order_detail.tax where ' . db_prefix() . 'pur_order_detail.pur_order = ' . $pur_order;
		$results = $this->db->query($sql)->result_array();
		foreach ($results as $key => $value) {
			$total_goods_money += $value['into_money'];
			$total_tax_money += $value['tax_money'];

		}
		$total_money = $total_goods_money + $total_tax_money;
		$value_of_inventory = $total_goods_money;

		$arr_pur_resquest[] = $results;
		$arr_pur_resquest[] = $total_tax_money;
		$arr_pur_resquest[] = $total_goods_money;
		$arr_pur_resquest[] = $value_of_inventory;
		$arr_pur_resquest[] = $total_money;
		$arr_pur_resquest[] = count($results);

		return $arr_pur_resquest;
	}

	/**
	 * get staff
	 * @param  string $id
	 * @param  array  $where
	 * @return array or object
	 */
	public function get_staff($id = '', $where = []) {
		$select_str = '*,CONCAT(firstname," ",lastname) as full_name';

		// Used to prevent multiple queries on logged in staff to check the total unread notifications in core/AdminController.php
		if (is_staff_logged_in() && $id != '' && $id == get_staff_user_id()) {
			$select_str .= ',(SELECT COUNT(*) FROM ' . db_prefix() . 'notifications WHERE touserid=' . get_staff_user_id() . ' and isread=0) as total_unread_notifications, (SELECT COUNT(*) FROM ' . db_prefix() . 'todos WHERE finished=0 AND staffid=' . get_staff_user_id() . ') as total_unfinished_todos';
		}

		$this->db->select($select_str);
		$this->db->where($where);

		if (is_numeric($id)) {
			$this->db->where('staffid', $id);
			$staff = $this->db->get(db_prefix() . 'staff')->row();

			if ($staff) {
				$staff->permissions = $this->get_staff_permissions($id);
			}

			return $staff;
		}
		$this->db->order_by('firstname', 'desc');

		return $this->db->get(db_prefix() . 'staff')->result_array();
	}

	/**
	 * update status goods
	 * @param  integer $pur_orders_id
	 * @return boolean
	 */
	public function update_status_goods($pur_orders_id) {
		$arr_temp['status_goods'] = 1;
		$this->db->where('id', $pur_orders_id);
		$this->db->update(db_prefix() . 'pur_orders', $arr_temp);
	}

	/**
	 * add goods transaction detail
	 * @param array $data
	 * @param string $status
	 */
	public function add_goods_transaction_detail($data, $status) {
		if ($status == '1') {
			$data_insert['goods_receipt_id'] = $data['goods_receipt_id'];
		} elseif ($status == '2') {
			$data_insert['goods_receipt_id'] = $data['goods_delivery_id'];

		}
		$data_insert['goods_id'] = $data['id'];

		$data_insert['commodity_id'] = $data['commodity_code'];
		$data_insert['quantity'] = $data['quantities'];
		$data_insert['date_add'] = date('Y-m-d H:i:s');
		$data_insert['warehouse_id'] = $data['warehouse_id'];
		$data_insert['note'] = $data['note'];
		$data_insert['status'] = $status;
		// status '1:Goods receipt note 2:Goods delivery note',
		$this->db->insert(db_prefix() . 'goods_transaction_detail', $data_insert);
	}

	/**
	 * add inventory manage
	 * @param array $data
	 * @param string $status
	 */
	public function add_inventory_manage($data, $status) {
		// status '1:Goods receipt note 2:Goods delivery note',
		

		if ($status == 1) {
			$this->db->where('warehouse_id', $data['warehouse_id']);
			$this->db->where('commodity_id', $data['commodity_code']);
			$this->db->where('expiry_date', $data['expiry_date']);
			$total_rows = $this->db->count_all_results('tblinventory_manage');

			if ($total_rows > 0) {
				$status_insert_update = false;
			} else {
				$status_insert_update = true;
			}

			if (!$status_insert_update) {
				//update
				$this->db->where('warehouse_id', $data['warehouse_id']);
				$this->db->where('commodity_id', $data['commodity_code']);
				$this->db->where('expiry_date', $data['expiry_date']);

				$result = $this->db->get('tblinventory_manage')->row();
				$inventory_number = $result->inventory_number;
				$update_id = $result->id;

				if ($status == 1) {
					//Goods receipt
					$data_update['inventory_number'] = (int) $inventory_number + (int) $data['quantities'];
				} elseif ($status == 2) {
					// 2:Goods delivery note
					$data_update['inventory_number'] = (int) $inventory_number - (int) $data['quantities'];
				}

				//update
				$this->db->where('id', $update_id);
				$this->db->update(db_prefix() . 'inventory_manage', $data_update);
				return;

			} else {
				//insert
				$data_insert['warehouse_id'] = $data['warehouse_id'];
				$data_insert['commodity_id'] = $data['commodity_code'];
				$data_insert['inventory_number'] = $data['quantities'];
				$data_insert['date_manufacture'] = $data['date_manufacture'];
				$data_insert['expiry_date'] = $data['expiry_date'];

				$this->db->insert(db_prefix() . 'inventory_manage', $data_insert);

				return;

			}
		} else {
			//status == 2 export
			//update
			$this->db->where('warehouse_id', $data['warehouse_id']);
			$this->db->where('commodity_id', $data['commodity_code']);
			$this->db->order_by('id', 'ASC');
			$result = $this->db->get('tblinventory_manage')->result_array();

			$temp_quantities = $data['quantities'];
			foreach ($result as $result_value) {
				if (($result_value['inventory_number'] != 0) && ($temp_quantities != 0)) {

					if ($temp_quantities >= $result_value['inventory_number']) {
						$temp_quantities = (float) $temp_quantities - (float) $result_value['inventory_number'];
						//update inventory
						$this->db->where('id', $result_value['id']);
						$this->db->update(db_prefix() . 'inventory_manage', [
							'inventory_number' => 0,
						]);

					} else {
						//update inventory
						$this->db->where('id', $result_value['id']);
						$this->db->update(db_prefix() . 'inventory_manage', [
							'inventory_number' => (float) $result_value['inventory_number'] - (float) $temp_quantities,
						]);

						$temp_quantities = 0;

					}

				}

			}

		}

	}

	/**
	 * check commodity exist inventory
	 * @param  integer $warehouse_id
	 * @param  integer $commodity_id
	 * @return boolean
	 */
	public function check_commodity_exist_inventory($warehouse_id, $commodity_id) {
		$this->db->where('warehouse_id', $warehouse_id);
		$this->db->where('commodity_id', $commodity_id);
		$total_rows = $this->db->count_all_results('tblinventory_manage');
		//if > 0 update, else insert
		return $total_rows > 0 ? false : true;

	}

	/**
	 * get inventory commodity
	 * @param  integer $commodity_id
	 * @return array
	 */
	public function get_inventory_commodity($commodity_id) {
		$sql = 'SELECT ' . db_prefix() . 'warehouse.warehouse_code, sum(inventory_number) as inventory_number, unit_name FROM ' . db_prefix() . 'inventory_manage
			LEFT JOIN ' . db_prefix() . 'items on ' . db_prefix() . 'inventory_manage.commodity_id = ' . db_prefix() . 'items.id
			LEFT JOIN ' . db_prefix() . 'ware_unit_type on ' . db_prefix() . 'items.unit_id = ' . db_prefix() . 'ware_unit_type.unit_type_id
			LEFT JOIN ' . db_prefix() . 'warehouse on ' . db_prefix() . 'inventory_manage.warehouse_id = ' . db_prefix() . 'warehouse.warehouse_id
			 where commodity_id = ' . $commodity_id . ' group by ' . db_prefix() . 'inventory_manage.warehouse_id';
		return $this->db->query($sql)->result_array();

	}

	/**
	 * add inventory min
	 * @param array $data
	 * return boolean
	 */
	public function add_inventory_min($data) {
		$data['inventory_number_min'] = 0;
		$this->db->insert(db_prefix() . 'inventory_commodity_min', $data);
		return;
	}

	/**
	 * get inventory min
	 * @param  boolean $id
	 * @return array or object
	 */
	public function get_inventory_min($id = false) {
		if (is_numeric($id)) {
			$this->db->where('id', $id);

			return $this->db->get(db_prefix() . 'inventory_commodity_min')->row();
		}
		if ($id == false) {
			return $this->db->query('select * from tblinventory_commodity_min')->result_array();
		}
	}

	/**
	 * update inventory min
	 * @param  array $data
	 * @return boolean
	 */
	public function update_inventory_min($data) {
		$inventory_min = str_replace(', ', '|/\|', $data['inventory_min']);
		$data_inventory = explode(',', $inventory_min);

		$results = 0;
		$results_update = '';
		foreach ($data_inventory as $inventory_key => $inventory_value) {
			$data_inventory_min = [];

			if (($inventory_key + 1) % 5 == 0) {
				$arr_temp['inventory_number_min'] = $inventory_value != '' ? $inventory_value : 0;
				if (is_numeric($arr_temp['id'])) {

					$this->db->where('id', (int) $arr_temp['id']);
					unset($arr_temp['id']);
					$this->db->update(db_prefix() . 'inventory_commodity_min', $arr_temp);
				}

				$arr_temp = [];
			} else {
				switch (($inventory_key + 1) % 5) {
				case 1:
					$arr_temp['id'] = $inventory_value;
					break;
				}
			}

		}

		return true;

	}

	/**
	 * get commodity warehouse
	 * @param  boolean $id
	 * @return array
	 */
	public function get_commodity_warehouse($commodity_id = false) {
		if ($commodity_id != false) {

			$sql = 'SELECT ' . db_prefix() . 'warehouse.warehouse_name FROM ' . db_prefix() . 'inventory_manage
					LEFT JOIN ' . db_prefix() . 'warehouse on ' . db_prefix() . 'inventory_manage.warehouse_id = ' . db_prefix() . 'warehouse.warehouse_id
					where ' . db_prefix() . 'inventory_manage.commodity_id = ' . $commodity_id;

			return $this->db->query($sql)->result_array();
		}

	}

	/**
	 * get total inventory commodity
	 * @param  boolean $id
	 * @return object
	 */
	public function get_total_inventory_commodity($commodity_id = false) {
		if ($commodity_id != false) {

			$sql = 'SELECT sum(inventory_number) as inventory_number FROM ' . db_prefix() . 'inventory_manage
			where ' . db_prefix() . 'inventory_manage.commodity_id = ' . $commodity_id . ' order by ' . db_prefix() . 'inventory_manage.warehouse_id';

			return $this->db->query($sql)->row();
		}

	}

	/**
	 * add approval setting
	 * @param  array $data
	 * @return boolean
	 */
	public function add_approval_setting($data) {
		unset($data['approval_setting_id']);

		if (isset($data['approver'])) {
			$setting = [];
			foreach ($data['approver'] as $key => $value) {
				$node = [];
				$node['approver'] = $data['approver'][$key];
				$node['staff'] = $data['staff'][$key];
				$node['action'] = $data['action'][$key];

				$setting[] = $node;
			}
			unset($data['approver']);
			unset($data['staff']);
			unset($data['action']);
		}
		$data['setting'] = json_encode($setting);

		$this->db->insert(db_prefix() . 'wh_approval_setting', $data);
		$insert_id = $this->db->insert_id();
		if ($insert_id) {
			return true;
		}
		return false;
	}

	/**
	 * edit approval setting
	 * @param  integer $id
	 * @param   array $data
	 * @return    boolean
	 */
	public function edit_approval_setting($id, $data) {
		unset($data['approval_setting_id']);

		if (isset($data['approver'])) {
			$setting = [];
			foreach ($data['approver'] as $key => $value) {
				$node = [];
				$node['approver'] = $data['approver'][$key];
				$node['staff'] = $data['staff'][$key];
				$node['action'] = $data['action'][$key];

				$setting[] = $node;
			}
			unset($data['approver']);
			unset($data['staff']);
			unset($data['action']);
		}
		$data['setting'] = json_encode($setting);

		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'wh_approval_setting', $data);

		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * delete approval setting
	 * @param  integer $id
	 * @return boolean
	 */
	public function delete_approval_setting($id) {
		if (is_numeric($id)) {
			$this->db->where('id', $id);
			$this->db->delete(db_prefix() . 'wh_approval_setting');

			if ($this->db->affected_rows() > 0) {
				return true;
			}
		}
		return false;
	}

	/**
	 * get approval setting
	 * @param  boolean $id
	 * @return array or object
	 */
	public function get_approval_setting($id = '') {
		if (is_numeric($id)) {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'wh_approval_setting')->row();
		}
		return $this->db->get(db_prefix() . 'wh_approval_setting')->result_array();
	}

	/**
	 * get staff sign
	 * @param   integer $rel_id
	 * @param   string $rel_type
	 * @return  array
	 */
	public function get_staff_sign($rel_id, $rel_type) {
		$this->db->select('*');

		$this->db->where('rel_id', $rel_id);
		$this->db->where('rel_type', $rel_type);
		$this->db->where('action', 'sign');
		$approve_status = $this->db->get(db_prefix() . 'wh_approval_details')->result_array();
		if (isset($approve_status)) {
			$array_return = [];
			foreach ($approve_status as $key => $value) {
				array_push($array_return, $value['staffid']);
			}
			return $array_return;
		}
		return [];
	}

	/**
	 * check approval detail
	 * @param   integer $rel_id
	 * @param   string $rel_type
	 * @return  boolean
	 */
	public function check_approval_details($rel_id, $rel_type) {
		$this->db->where('rel_id', $rel_id);
		$this->db->where('rel_type', $rel_type);
		$approve_status = $this->db->get(db_prefix() . 'wh_approval_details')->result_array();

		if (count($approve_status) > 0) {
			foreach ($approve_status as $value) {
				if ($value['approve'] == -1) {
					return 'reject';
				}
				if ($value['approve'] == 0) {
					$value['staffid'] = explode(', ', $value['staffid']);
					return $value;
				}
			}
			return true;
		}
		return false;
	}

	/**
	 * get list approval detail
	 * @param   integer $rel_id
	 * @param   string $rel_type
	 * @return  array
	 */
	public function get_list_approval_details($rel_id, $rel_type) {
		$this->db->select('*');
		$this->db->where('rel_id', $rel_id);
		$this->db->where('rel_type', $rel_type);
		return $this->db->get(db_prefix() . 'wh_approval_details')->result_array();
	}

	/**
	 * add activity log
	 * @param array $data
	 * return boolean
	 */
	public function add_activity_log($data) {
		$this->db->insert(db_prefix() . 'wh_activity_log', $data);
		return true;
	}

	/**
	 * get activity log
	 * @param   integer $rel_id
	 * @param   string $rel_type
	 * @return  array
	 */
	public function get_activity_log($rel_id, $rel_type) {
		$this->db->where('rel_id', $rel_id);
		$this->db->where('rel_type', $rel_type);
		return $this->db->get(db_prefix() . 'wh_activity_log')->result_array();
	}

	/**
	 * 	delete activiti log
	 * @param   integer $rel_id
	 * @param   string $rel_type
	 * @return  boolean
	 */
	public function delete_activity_log($rel_id, $rel_type) {
		$this->db->where('rel_id', $rel_id);
		$this->db->where('rel_type', $rel_type);
		$this->db->delete(db_prefix() . 'wh_activity_log');
		return true;
	}

	/**
	 *  send request approve
	 * @param  array $data
	 * @return boolean
	 */
	public function send_request_approve($data) {
		if (!isset($data['status'])) {
			$data['status'] = '';
		}
		$date_send = date('Y-m-d H:i:s');
		$data_new = $this->get_approve_setting($data['rel_type'], $data['status']);
		$this->delete_approval_details($data['rel_id'], $data['rel_type']);
		$list_staff = $this->staff_model->get();
		$list = [];
		$staff_addedfrom = $data['addedfrom'];
		$sender = get_staff_user_id();

		foreach ($data_new as $value) {
			$row = [];

			if ($value->approver !== 'staff') {
				$value->staff_addedfrom = $staff_addedfrom;
				$value->rel_type = $data['rel_type'];
				$value->rel_id = $data['rel_id'];

				$approve_value = $this->get_staff_id_by_approve_value($value, $value->approver);
				if (is_numeric($approve_value)) {
					$approve_value = $this->staff_model->get($approve_value)->email;
				} else {

					$this->db->where('rel_id', $data['rel_id']);
					$this->db->where('rel_type', $data['rel_type']);
					$this->db->delete('tblwh_approval_details');

					return $value->approver;
				}
				$row['approve_value'] = $approve_value;

				$staffid = $this->get_staff_id_by_approve_value($value, $value->approver);

				if (empty($staffid)) {
					$this->db->where('rel_id', $data['rel_id']);
					$this->db->where('rel_type', $data['rel_type']);
					$this->db->delete('tblwh_approval_details');

					return $value->approver;
				}

				$row['action'] = $value->action;
				$row['staffid'] = $staffid;
				$row['date_send'] = $date_send;
				$row['rel_id'] = $data['rel_id'];
				$row['rel_type'] = $data['rel_type'];
				$row['sender'] = $sender;
				$this->db->insert('tblwh_approval_details', $row);

			} else if ($value->approver == 'staff') {
				$row['action'] = $value->action;
				$row['staffid'] = $value->staff;
				$row['date_send'] = $date_send;
				$row['rel_id'] = $data['rel_id'];
				$row['rel_type'] = $data['rel_type'];
				$row['sender'] = $sender;

				$this->db->insert('tblwh_approval_details', $row);
			}
		}
		return true;
	}

	/**
	 * get approve setting
	 * @param  integer] $type
	 * @param  string $status
	 * @return object
	 */
	public function get_approve_setting($type, $status = '') {

		$this->db->select('*');
		$this->db->where('related', $type);
		$approval_setting = $this->db->get('tblwh_approval_setting')->row();
		if ($approval_setting) {
			return json_decode($approval_setting->setting);
		} else {
			return false;
		}

	}

	/**
	 * delete approval details
	 * @param  integer $rel_id
	 * @param  string $rel_type
	 * @return  boolean
	 */
	public function delete_approval_details($rel_id, $rel_type) {
		$this->db->where('rel_id', $rel_id);
		$this->db->where('rel_type', $rel_type);
		$this->db->delete(db_prefix() . 'wh_approval_details');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * get staff id by approve value
	 * @param  array $data
	 * @param  integer $approve_value
	 * @return boolean
	 */
	public function get_staff_id_by_approve_value($data, $approve_value) {
		$list_staff = $this->staff_model->get();
		$list = [];
		$staffid = [];

		if ($approve_value == 'department_manager') {
			$staffid = $this->departments_model->get_staff_departments($data->staff_addedfrom)[0]['manager_id'];
		} elseif ($approve_value == 'direct_manager') {
			$staffid = $this->staff_model->get($data->staff_addedfrom)->team_manage;
		}

		return $staffid;
	}

	/**
	 *  update approval details
	 * @param  integer $id
	 * @param  array $data
	 * @return boolean
	 */
	public function update_approval_details($id, $data) {
		$data['date'] = date('Y-m-d H:i:s');
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'wh_approval_details', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * update approve request
	 * @param  integer $rel_id
	 * @param  string $rel_type
	 * @param  integer $status
	 * @return boolean
	 */
	public function update_approve_request($rel_id, $rel_type, $status) {
		$data_update = [];

		switch ($rel_type) {
		//case 1: stock_import
		case '1':
			$data_update['approval'] = $status;
			$this->db->where('id', $rel_id);
			$this->db->update(db_prefix() . 'goods_receipt', $data_update);
			//update history stock, inventoty manage after staff approved
			$goods_receipt_detail = $this->get_goods_receipt_detail($rel_id);
			foreach ($goods_receipt_detail as $goods_receipt_detail_value) {
				$this->add_goods_transaction_detail($goods_receipt_detail_value, 1);
				$this->add_inventory_manage($goods_receipt_detail_value, 1);
			}

			return true;
			break;
		case '2':
			$data_update['approval'] = $status;
			$this->db->where('id', $rel_id);
			$this->db->update(db_prefix() . 'goods_delivery', $data_update);
			//update history stock, inventoty manage after staff approved

			$goods_delivery_detail = $this->get_goods_delivery_detail($rel_id);
			foreach ($goods_delivery_detail as $goods_delivery_detail_value) {
				$this->add_goods_transaction_detail($goods_delivery_detail_value, 2);
				$this->add_inventory_manage($goods_delivery_detail_value, 2);
			}

			return true;
			break;

		default:
			return false;
			break;
		}
	}

	/**
	 * stock import pdf
	 * @param  integer $purchase
	 * @return  pdf view
	 */
	function stock_import_pdf($purchase) {
		return app_pdf('purchase', module_dir_path(WAREHOUSE_MODULE_NAME, 'libraries/pdf/Purchase_pdf'), $purchase);
	}

	/**
	 * get stock import pdf_html
	 * @param  integer $goods_receipt_id
	 * @return html
	 */
	public function get_stock_import_pdf_html($goods_receipt_id) {
		// get_goods_receipt
		$goods_receipt = $this->get_goods_receipt($goods_receipt_id);
		// get_goods_receipt_detail
		$goods_receipt_detail = $this->get_goods_receipt_detail($goods_receipt_id);
		$company_name = get_option('invoice_company_name');
		$address = get_option('invoice_company_address');

		$day = date('d', strtotime($goods_receipt->date_add));
		$month = date('m', strtotime($goods_receipt->date_add));
		$year = date('Y', strtotime($goods_receipt->date_add));

		$html = '';
		$html .= '<table class="table">';
		$html .= '<tbody>';
		$html .= '</tbody>
      </table>';
		$html .= '<table class="table">
        <tbody>
          <tr>
            <td class="font_td_cpn"></td>
            <td class="td_ali_font"><h2 class="h2_style">' . mb_strtoupper(_l('store_input_slip')) . '</h2></td>
            <td class="align_cen"></td>
          </tr>
          <tr>
            <td class="font_500"></td>
            <td class="align_cen">' . _l('days') . ' ' . $day . ' ' . _l('month') . ' ' . $month . ' ' . _l('year') . ' ' . $year . '</td>
            <td class="align_cen"></td>
          </tr>
          <tr>
            <td class="font_500"></td>
            <td></td>
            <td><span class="font_500">' . _l('debit') . ': </span>.....................</td>
          </tr>
          <tr>
            <td class="font_500"></td>
            <td></td>
            <td><span class="font_500">' . _l('credit') . ':</span>.....................</td>
          </tr>
          <tr>
            <td class="font_500"></td>
            <td></td>
            <td><span class="font_500">' . _l('document_number') . ':</span> ' . $goods_receipt->goods_receipt_code . '</td>
          </tr>
        </tbody>
      </table> <br>';
		$html .= '<table class="table">
        <tbody>
          <tr>
            <td class="font_td_cpn"><h4>' . _l('deliver_name') . ':</h4></td>
            <td class="font_500">' . $goods_receipt->deliver_name . '</td>
          </tr>
          <tr>
            <td class="font_500"><h4>' . _l('Theo số') . ':</h4></td>
            <td>' . $goods_receipt->goods_receipt_code . '</td>
          </tr>
        </tbody>
      </table>';

		$html .= '<table class="table table-bordered">
        <tbody>

         <tr>
           <th colspan="1" class="th_width_7">ID</th>
           <th colspan="1" class="th_style">' . _l('commodity_code') . '</th>
           <th colspan="1" class="th_width_25">' . _l('commodity_name') . '</th>
           <th colspan="1" class="th_width_10">' . _l('unit_name') . '</th>
           <th colspan="2" class="th_spe">' . _l('quantity') . '</th>
           <th colspan="1" class="th_style">' . _l('unit_price') . '</th>
           <th colspan="1" class="th_width_15">' . _l('total_money') . '</th>
          </tr>
          <tr>
           <th class="th_style"></th>
           <th class="th_style"></th>
           <th class="th_style"></th>
           <th class="th_style"></th>
           <th class="th_style">' . _l('document_number') . '</th>
           <th class="th_style">' . _l('actually_imported') . '</th>
           <th class="th_style"></th>
           <th class="th_style"></th>
          </tr>';
		foreach ($goods_receipt_detail as $receipt_key => $receipt_value) {

			$commodity_name = (isset($receipt_value) ? $receipt_value['commodity_name'] : '');
			$quantities = (isset($receipt_value) ? $receipt_value['quantities'] : '');
			$unit_price = (isset($receipt_value) ? $receipt_value['unit_price'] : '');
			$unit_price = (isset($receipt_value) ? $receipt_value['unit_price'] : '');
			$goods_money = (isset($receipt_value) ? $receipt_value['goods_money'] : '');

			$commodity_code = get_commodity_name($receipt_value['commodity_code']) != null ? get_commodity_name($receipt_value['commodity_code'])->commodity_code : '';

			$unit_name = get_unit_type($receipt_value['unit_id']) != null ? get_unit_type($receipt_value['unit_id'])->unit_name : '';

			$html .= '<tr>';
			$html .= '<td class="th_style">' . $receipt_key . '</td>
            <td class="th_style">' . $commodity_code . '</td>
            <td class="th_style">' . $commodity_name . '</td>
            <td class="th_style">' . $unit_name . '</td>
            <td class="th_style"></td>
            <td class="td_style_r">' . $quantities . '</td>
            <td class="td_style_r">' . app_format_money((float) $unit_price, '') . '</td>
            <td class="td_style_r">' . app_format_money((float) $goods_money, '') . '</td>
          </tr>';
		}

		$html .= '</tbody>';
		$html .= '</table>
		<br>
		<br>
      <table class="table">
        <tbody>
          <tr>
            <td class="bold width_27" >' . _l('amount_of') . ' :</td>

              <td>' . app_format_money((float) $goods_receipt->total_money, '') . '</td>
          </tr>
          <tr>
            	<td class="bold width_27">' . _l('amount_of_in_word') . ' :</td>

              <td>' . numberTowords((float) $goods_receipt->total_money) . '</td>
          </tr>
          <tr>
            <td class="bold">' . _l('origin_voucher_following') . ' :</td>
              <td>' . 'CTG_001' . '</td>
          </tr>
          <tr></tr>
          <tr>
          	<td class="fw_width35"></td>
          	<td class="fw_width30"></td>
        	<td class="ali_r_width30">' . _l('days') . ' .... ' . _l('month') . ' .... ' . _l('year') . ' ....</td>
        	</tr>
        </tbody>
      </table> <br>';

		$html .= '<table class="table">
        <tbody>
          <tr>
           <td class="fw_width35"><h4>' . _l('deliver_name') . '</h4></td>
           <td class="fw_width30"><h4>' . _l('stocker') . '</h4></td>
           <td class="fw_width30"><h4>' . _l('chief_accountant') . '</h4></td>

          </tr>
          <tr>


           <td class="fw_width35 fstyle">' . _l('sign_full_name') . '</td>
            <td class="fw_width30 fstyle ">' . _l('sign_full_name') . '</td>
            <td class="fw_width30 fstyle">' . _l('sign_full_name') . '</td>
          </tr>

        </tbody>
      </table>

      <br>
      <br>
      <br>
      <br>
      <table class="table">
        <tbody>
          <tr>';
		$html .= '<link href="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/css/pdf_style.css') . '"  rel="stylesheet" type="text/css" />';

		return $html;
	}

	/**
	 * send mail
	 * @param  array $data
	 * @return
	 */
	public function send_mail($data) {
		$this->load->model('emails_model');
		if (!isset($data['status'])) {
			$data['status'] = '';
		}
		$get_staff_enter_charge_code = '';
		$mes = 'notify_send_request_approve_project';
		$staff_addedfrom = 0;
		$additional_data = $data['rel_type'];
		$object_type = $data['rel_type'];
		switch ($data['rel_type']) {
		// case '1 : stock_import':
		case '1':
			$staff_addedfrom = $this->get_goods_receipt($data['rel_id'])->addedfrom;
			$additional_data = $this->get_goods_receipt($data['rel_id'])->reason_for_spending;
			$list_approve_status = $this->get_list_approval_details($data['rel_id'], $data['rel_type']);
			$mes = 'notify_send_request_approve_stock_import';
			$mes_approve = 'notify_send_approve_stock_import';
			$mes_reject = 'notify_send_rejected_stock_import';
			$link = 'warehouse/edit_purchase/' . $data['rel_id'];
			break;
		case '2':
			$staff_addedfrom = $this->get_goods_delivery($data['rel_id'])->addedfrom;
			$additional_data = $this->get_goods_delivery($data['rel_id'])->reason_for_spending;
			$list_approve_status = $this->get_list_approval_details($data['rel_id'], $data['rel_type']);
			$mes = 'notify_send_request_approve_stock_export';
			$mes_approve = 'notify_send_approve_stock_export';
			$mes_reject = 'notify_send_rejected_stock_export';
			$link = 'warehouse/edit_delivery/' . $data['rel_id'];
			break;

		default:

			break;
		}

		$check_approve_status = $this->check_approval_details($data['rel_id'], $data['rel_type'], $data['status']);
		if (isset($check_approve_status['staffid'])) {

			$mail_template = 'send-request-approve';

			if (!in_array(get_staff_user_id(), $check_approve_status['staffid'])) {
				foreach ($check_approve_status['staffid'] as $value) {
					$staff = $this->staff_model->get($value);
					$notified = add_notification([
						'description' => $mes,
						'touserid' => $staff->staffid,
						'link' => $link,
						'additional_data' => serialize([
							$additional_data,
						]),
					]);
					if ($notified) {
						pusher_trigger_notification([$staff->staffid]);
					}

					//send mail

				}
			}
		}

		if (isset($data['approve'])) {
			if ($data['approve'] == 1) {
				$mes = $mes_approve;
				$mail_template = 'send_approve';
			} else {
				$mes = $mes_reject;
				$mail_template = 'send_rejected';
			}

			$staff = $this->staff_model->get($staff_addedfrom);
			$notified = add_notification([
				'description' => $mes,
				'touserid' => $staff->staffid,
				'link' => $link,
				'additional_data' => serialize([
					$additional_data,
				]),
			]);
			if ($notified) {
				pusher_trigger_notification([$staff->staffid]);
			}

			//send mail

			foreach ($follower as $key => $value) {
				if (get_staff_user_id() != $value['staffid']) {
					$staff = $this->staff_model->get($value['staffid']);
					$notified = add_notification([
						'description' => $mes,
						'touserid' => $staff->staffid,
						'link' => $link,
						'additional_data' => serialize([
							$additional_data,
						]),
					]);
					if ($notified) {
						pusher_trigger_notification([$staff->staffid]);
					}

					//send mail
				}
			}

			foreach ($list_approve_status as $key => $value) {
				$value['staffid'] = explode(', ', $value['staffid']);
				if ($value['approve'] == 1 && !in_array(get_staff_user_id(), $value['staffid'])) {
					foreach ($value['staffid'] as $staffid) {

						$staff = $this->staff_model->get($staffid);
						$notified = add_notification([
							'description' => $mes,
							'touserid' => $staff->staffid,
							'link' => $link,
							'additional_data' => serialize([
								$additional_data,
							]),
						]);
						if ($notified) {
							pusher_trigger_notification([$staff->staffid]);
						}

						//send mail

					}
				}
			}
		}
	}

	/**
	 * create goods delivery code
	 * @return string
	 */
	public function create_goods_delivery_code() {
		$id = $this->db->query('SELECT id FROM ' . db_prefix() . 'goods_delivery order by id desc limit 1')->row();
		if ($id == null) {
			$goods_code = 'XK01';
		} else {
			$goods_code = 'XK0' . (get_object_vars($id)['id'] + 1);
		}
		return $goods_code;
	}

	/**
	 * add goods delivery
	 * @param array  $data
	 * @param boolean $id
	 * return boolean
	 */
	public function add_goods_delivery($data, $id = false) {

		$check_appr = $this->get_approve_setting('2');
		$data['approval'] = 0;
		if ($check_appr && $check_appr != false) {
			$data['approval'] = 0;
		} else {
			$data['approval'] = 1;
		}

		if (isset($data['hot_purchase'])) {
			$hot_purchase = $data['hot_purchase'];
			unset($data['hot_purchase']);
		}
		$data['goods_delivery_code'] = $this->create_goods_delivery_code();
		$data['date_c'] = to_sql_date($data['date_c']);
		$data['date_add'] = to_sql_date($data['date_add']);
		$data['addedfrom'] = get_staff_user_id();

		$this->db->insert(db_prefix() . 'goods_delivery', $data);
		$insert_id = $this->db->insert_id();
		if (isset($insert_id)) {

			$data['purchase'] = str_replace(', ', '|/\|', $hot_purchase);

			$purchases = explode(',', $data['purchase']);
			$results = 0;
			$results_update = '';
			$flag_empty = 0;

			foreach ($purchases as $purchase_key => $purchase_value) {
				if ($purchase_value == '') {
					$purchase_value = 0;
				}
				if (($purchase_key + 1) % 6 == 0) {
					$arr_temp['note'] = str_replace('|/\|', ', ', $purchase_value);
					$arr_temp['goods_delivery_id'] = $insert_id;

					if ($id == false && $flag_empty == 1) {
						$this->db->insert(db_prefix() . 'goods_delivery_detail', $arr_temp);
						$insert_detail = $this->db->insert_id();

						$results++;
					}
					$flag_empty = 0;
					$arr_temp = [];
				} else {

					switch (($purchase_key + 1) % 6) {
					case 1:
						$arr_temp['commodity_code'] = str_replace('|/\|', ', ', $purchase_value);
						if ($purchase_value != '0') {
							$flag_empty = 1;
						}
						break;
					case 2:
						$arr_temp['unit_id'] = $purchase_value;
						break;
					case 3:
						$arr_temp['quantities'] = $purchase_value;
						break;
					case 4:
						$arr_temp['unit_price'] = $purchase_value;
						break;
					case 5:
						$arr_temp['total_money'] = $purchase_value;
						break;
					}
				}
				$arr_temp['warehouse_id'] = $data['warehouse_id'];

			}

			$data_log = [];
			$data_log['rel_id'] = $insert_id;
			$data_log['rel_type'] = 'stock_export';
			$data_log['staffid'] = get_staff_user_id();
			$data_log['date'] = date('Y-m-d H:i:s');
			$data_log['note'] = "stock_export";

			$this->add_activity_log($data_log);

		}

		//approval if not approval setting
		if (isset($insert_id)) {
			if ($data['approval'] == 1) {
				$this->update_approve_request($insert_id, 2, 1);
			}
		}

		return $results > 0 ? true : false;

	}

	/**
	 * commodity goods delivery change
	 * @param  boolean $id
	 * @return  array
	 */
	public function commodity_goods_delivery_change($id = false) {

		if (is_numeric($id)) {
			$commodity_value = $this->db->query('select description, rate, unit_id, taxrate, purchase_price, ' . db_prefix() . 'taxes.name from ' . db_prefix() . 'items left join ' . db_prefix() . 'ware_unit_type on  ' . db_prefix() . 'items.unit_id = ' . db_prefix() . 'ware_unit_type.unit_type_id
				left join ' . db_prefix() . 'taxes on ' . db_prefix() . 'items.tax = ' . db_prefix() . 'taxes.id where ' . db_prefix() . 'items.id = ' . $id)->row();

			$warehouse_inventory = $this->db->query('SELECT ' . db_prefix() . 'warehouse.warehouse_id as id, CONCAT(' . db_prefix() . 'warehouse.warehouse_code," - ", ' . db_prefix() . 'warehouse.warehouse_name) as label FROM ' . db_prefix() . 'inventory_manage
				LEFT JOIN ' . db_prefix() . 'warehouse on ' . db_prefix() . 'inventory_manage.warehouse_id = ' . db_prefix() . 'warehouse.warehouse_id
				where ' . db_prefix() . 'inventory_manage.commodity_id = ' . $id)->result_array();

		}
		$data['commodity_value'] = $commodity_value;
		$data['warehouse_inventory'] = $warehouse_inventory;
		return $data;
	}

	/**
	 * get goods delivery
	 * @param  integer $id
	 * @return array or object
	 */
	public function get_goods_delivery($id) {
		if (is_numeric($id)) {
			$this->db->where('id', $id);

			return $this->db->get(db_prefix() . 'goods_delivery')->row();
		}
		if ($id == false) {
			return $this->db->query('select * from tblgoods_delivery')->result_array();
		}
	}

	/**
	 * get goods delivery detail
	 * @param  integer $id
	 * @return array
	 */
	public function get_goods_delivery_detail($id) {
		if (is_numeric($id)) {
			$this->db->where('goods_delivery_id', $id);

			return $this->db->get(db_prefix() . 'goods_delivery_detail')->result_array();
		}
		if ($id == false) {
			return $this->db->query('select * from tblgoods_delivery_detail')->result_array();
		}
	}

	/**
	 * get vendor
	 * @param  string $id
	 * @param  array  $where
	 * @return array or object
	 */
	public function get_vendor($id = '', $where = []) {
		$this->db->select(implode(',', prefixed_table_fields_array(db_prefix() . 'pur_vendor')) . ',' . get_sql_select_vendor_company());

		$this->db->join(db_prefix() . 'countries', '' . db_prefix() . 'countries.country_id = ' . db_prefix() . 'pur_vendor.country', 'left');
		$this->db->join(db_prefix() . 'pur_contacts', '' . db_prefix() . 'pur_contacts.userid = ' . db_prefix() . 'pur_vendor.userid AND is_primary = 1', 'left');

		if ((is_array($where) && count($where) > 0) || (is_string($where) && $where != '')) {
			$this->db->where($where);
		}

		if (is_numeric($id)) {

			$this->db->where(db_prefix() . 'pur_vendor.userid', $id);
			$vendor = $this->db->get(db_prefix() . 'pur_vendor')->row();

			if ($vendor && get_option('company_requires_vat_number_field') == 0) {
				$vendor->vat = null;
			}

			return $vendor;

		}

		$this->db->order_by('company', 'asc');

		return $this->db->get(db_prefix() . 'pur_vendor')->result_array();
	}

	/**
	 * get vendor ajax
	 * @param  integer $pur_orders_id
	 * @return object
	 */
	public function get_vendor_ajax($pur_orders_id) {
		$data = [];
		$sql = 'SELECT * FROM ' . db_prefix() . 'pur_vendor
			left join ' . db_prefix() . 'pur_orders on ' . db_prefix() . 'pur_vendor.userid = ' . db_prefix() . 'pur_orders.vendor
 			where ' . db_prefix() . 'pur_orders.id = ' . $pur_orders_id;
		$result_array = $this->db->query($sql)->row();

		$data['id'] = $result_array->userid;
		$data['buyer'] = $result_array->buyer;
		return $data;

	}

	/**
	 * stock export pdf
	 * @param  integer $delivery
	 * @return pdf view
	 */
	function stock_export_pdf($delivery) {
		return app_pdf('delivery', module_dir_path(WAREHOUSE_MODULE_NAME, 'libraries/pdf/Delivery_pdf.php'), $delivery);
	}

	/**
	 * get stock export pdf_html
	 * @param  integer $goods_delivery_id
	 * @return string
	 */
	public function get_stock_export_pdf_html($goods_delivery_id) {
		// get_goods_receipt
		$goods_delivery = $this->get_goods_delivery($goods_delivery_id);
		// get_goods_receipt_detail
		$goods_delivery_detail = $this->get_goods_delivery_detail($goods_delivery_id);
		$company_name = get_option('invoice_company_name');
		$address = get_option('invoice_company_address');

		$day = date('d', strtotime($goods_delivery->date_add));
		$month = date('m', strtotime($goods_delivery->date_add));
		$year = date('Y', strtotime($goods_delivery->date_add));

		$html = '';
		$html .= '<table class="table">
        <tbody>
          <tr>
            <td class="font_td_cpn"></td>
            <td class="td_ali_font"><h2 class="h2_style">' . mb_strtoupper(_l('store_input_slip')) . '</h2></td>
            <td class="align_cen"></td>
          </tr>
          <tr>
            <td class="font_500"></td>
            <td class="align_cen">' . _l('days') . ' ' . $day . ' ' . _l('month') . ' ' . $month . ' ' . _l('year') . ' ' . $year . '</td>
            <td class="align_cen"></td>
          </tr>
          <tr>
            <td class="font_500"></td>
            <td></td>
            <td><span class="font_500">' . _l('debit') . ': </span>.....................</td>
          </tr>
          <tr>
            <td class="font_500"></td>
            <td></td>
            <td><span class="font_500">' . _l('credit') . ':</span>.....................</td>
          </tr>
          <tr>
            <td class="font_500"></td>
            <td></td>
            <td><span class="font_500">' . _l('Số chứng từ') . ':</span> ' . $goods_delivery->goods_delivery_code . '</td>
          </tr>
        </tbody>
      </table> <br>';
		$html .= '<table class="table">
        <tbody>
          <tr>
            <td class="font_td_cpn"><h4>' . _l('Buyer') . ':</h4></td>
            <td class="font_500">' . $goods_delivery->to_ . '</td>
          </tr>
          <tr>
            <td class="font_500"><h4>' . _l('customer_name') . ':</h4></td>
            <td>' . $goods_delivery->customer_name . '</td>
          </tr>
          <tr>
            <td class="font_500"><h4>' . _l('address') . ':</h4></td>
            <td>' . $goods_delivery->address . '</td>
          </tr>
        </tbody>
      </table>';

		$html .= '<table class="table table-bordered">
        <tbody>

         <tr>
           <th colspan="1" class="th_width_7">STT</th>
           <th colspan="1" class="th_width_10">' . _l('commodity_code') . '</th>
           <th colspan="1" class="th_width_25">' . _l('commodity_name') . '</th>
           <th colspan="1" class="th_width_20">' . _l('warehouse_name') . '</th>
           <th colspan="1" class="th_width_10">' . _l('unit_name') . '</th>
           <th colspan="1" class="th_width_10">' . _l('quantity') . '</th>
           <th colspan="1" class="th_width_17">' . _l('unit_price') . '</th>

          </tr>';
		foreach ($goods_delivery_detail as $delivery_key => $delivery_value) {

			$commodity_name = (isset($delivery_value) ? $delivery_value['commodity_name'] : '');
			$quantities = (isset($delivery_value) ? $delivery_value['quantities'] : '');
			$unit_price = (isset($delivery_value) ? $delivery_value['unit_price'] : '');

			$commodity_code = get_commodity_name($delivery_value['commodity_code']) != null ? get_commodity_name($delivery_value['commodity_code'])->commodity_code : '';

			$warehouse_name = get_warehouse_name($delivery_value['warehouse_id']) != null ? get_warehouse_name($delivery_value['warehouse_id'])->warehouse_name : '';

			$unit_name = get_unit_type($delivery_value['unit_id']) != null ? get_unit_type($delivery_value['unit_id'])->unit_name : '';

			$html .= '<tr>';
			$html .= '<td class="th_style">' . $delivery_key . '</td>
            <td class="th_style">' . $commodity_code . '</td>
            <td class="th_style">' . $commodity_name . '</td>
            <td class="th_style">' . $warehouse_name . '</td>
            <td class="th_style">' . $unit_name . '</td>
            <td class="td_style_r">' . $quantities . '</td>
            <td class="td_style_r">' . app_format_money((float) $unit_price, '') . '</td>
          </tr>';
		}

		$html .= '</tbody>';
		$html .= '</table>
		<br>
		<br>';

		$html .= '<table class="table">
        <tbody>
          <tr>
           <td class="fw_width35"><h4>' . _l('receiver') . '</h4></td>
           <td class="font_td_cpn"><h4>' . _l('stocker') . '</h4></td>
           <td class="font_td_cpn"><h4>' . _l('chief_accountant') . '</h4></td>

          </tr>
          <tr>


           <td class="fw_width35 fstyle">' . _l('sign_full_name') . '</td>
            <td class="fw_width30 fstyle">' . _l('sign_full_name') . '</td>
            <td class="fw_width30 fstyle">' . _l('sign_full_name') . '</td>
          </tr>

        </tbody>
      </table>

      <br>
      <br>
      <br>
      <br>
      <table class="table">
        <tbody>
          <tr>';
		$html .= '<link href="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/css/pdf_style.css') . '"  rel="stylesheet" type="text/css" />';
		return $html;
	}

	//stock summary report for pdf
	/**
	 * get stock summary report
	 * @param  array $data
	 * @return string
	 */
	public function get_stock_summary_report($data) {
		$from_date = to_sql_date($data['from_date']);
		$to_date = to_sql_date($data['to_date']);

		//get_commodity_list in warehouse
		$commodity_lists = $this->db->query('SELECT commodity_id, ' . db_prefix() . 'items.commodity_code, ' . db_prefix() . 'items.rate, ' . db_prefix() . 'items.description as commodity_name, ' . db_prefix() . 'ware_unit_type.unit_name FROM ' . db_prefix() . 'goods_transaction_detail
			LEFT JOIN ' . db_prefix() . 'items ON ' . db_prefix() . 'goods_transaction_detail.commodity_id = ' . db_prefix() . 'items.id
			LEFT JOIN ' . db_prefix() . 'ware_unit_type ON ' . db_prefix() . 'items.unit_id = ' . db_prefix() . 'ware_unit_type.unit_type_id group by commodity_id')->result_array();

		//import opening
		$import_openings = $this->db->query('SELECT commodity_id, sum(quantity) as quantity FROM ' . db_prefix() . 'goods_transaction_detail
		where status = 1 AND date_format(date_add,"%Y-%m-%d") < "' . $from_date . '"
		group by commodity_id')->result_array();

		$arr_import_openings = [];
		foreach ($import_openings as $import_opening_key => $import_opening_value) {
			$arr_import_openings[$import_opening_value['commodity_id']] = $import_opening_value['quantity'];
		}

		//export opening
		$export_openings = $this->db->query('SELECT commodity_id, sum(quantity) as quantity FROM ' . db_prefix() . 'goods_transaction_detail
		where status = 2 AND date_format(date_add,"%Y-%m-%d") < "' . $from_date . '"
		group by commodity_id')->result_array();

		$arr_export_openings = [];
		foreach ($export_openings as $export_opening_key => $export_opening_value) {
			$arr_export_openings[$export_opening_value['commodity_id']] = $export_opening_value['quantity'];
		}

		//import_periods
		$import_periods = $this->db->query('SELECT commodity_id, sum(quantity) as quantity FROM ' . db_prefix() . 'goods_transaction_detail
		where status = 1 AND "' . $from_date . '" <= date_format(date_add,"%Y-%m-%d") AND date_format(date_add,"%Y-%m-%d") <= "' . $to_date . '"
		group by commodity_id')->result_array();

		$arr_import_periods = [];
		foreach ($import_periods as $import_period_key => $import_period_value) {
			$arr_import_periods[$import_period_value['commodity_id']] = $import_period_value['quantity'];
		}

		//export_periods
		$export_periods = $this->db->query('SELECT commodity_id, sum(quantity) as quantity FROM ' . db_prefix() . 'goods_transaction_detail
		where status = 2 AND "' . $from_date . '" <= date_format(date_add,"%Y-%m-%d") AND date_format(date_add,"%Y-%m-%d") <= "' . $to_date . '"
		group by commodity_id')->result_array();

		$arr_export_periods = [];
		foreach ($export_periods as $export_period_key => $export_period_value) {
			$arr_export_periods[$export_period_value['commodity_id']] = $export_period_value['quantity'];
		}

		//html for page
		$html = '';
		$html .= ' <p><h3 class="bold align_cen">' . mb_strtoupper(_l('stock_summary_report')) . '</h3></p>
			<br>
            <div class="col-md-12 pull-right">
              <div class="row">
                <div class="col-md-12 align_cen">
                <p>' . _l('from_date') . ' :  <span class="fstyle">' . _l('days') . '  ' . date('d', strtotime($from_date)) . '  ' . _l('month') . '  ' . date('m', strtotime($from_date)) . '  ' . _l('year') . '  ' . date('Y', strtotime($from_date)) . '  ' . '</p>
                <p>' . _l('to_date') . ' :  <span class="fstyle">' . _l('days') . '  ' . date('d', strtotime($to_date)) . '  ' . _l('month') . '  ' . date('m', strtotime($to_date)) . '  ' . _l('year') . '  ' . date('Y', strtotime($to_date)) . '  ' . '</p>
                </div>
              </div>
            </div>

            <table class="table">';
		$company_name = get_option('invoice_company_name');
		$address = get_option('invoice_company_address');
		$total_opening_quatity = 0;
		$total_opening_amount = 0;
		$total_import_period_quatity = 0;
		$total_import_period_amount = 0;
		$total_export_period_quatity = 0;
		$total_export_period_amount = 0;
		$total_closing_quatity = 0;
		$total_closing_amount = 0;

		$html .= '<tbody>
                <tr>
                  <td class="bold width21">' . _l('company_name') . '</td>
                  <td>' . $company_name . '</td>
                </tr>
                <tr>
                  <td class="bold">' . _l('address') . '</td>
                  <td>' . $address . '</td>
                </tr>
              </tbody>
            </table>
            <div class="col-md-12">
             <table class="table table-bordered">
              <tbody>
               <tr>
                 <th colspan="1" class="th_style_stk">ID</th>
                 <th  colspan="1" class="th_stk10">' . _l('commodity_code') . '</th>
                 <th  colspan="1" class="th_stk10">' . _l('commodity_name') . '</th>
                 <th  colspan="1" class="th_stk7">' . _l('unit_name') . '</th>
                 <th  colspan="2" class="th_stk17">' . _l('opening_stock') . '</th>
                 <th  colspan="2" class="th_stk17">' . _l('receipt_in_period') . '</th>
                 <th  colspan="2" class="th_stk17">' . _l('issue_in_period') . '</th>
                 <th  colspan="2" class="th_r_stk17">' . _l('closing_stock') . '</th>
                </tr>
                <tr>
                 <th class="td_w5"></th>
                 <th class="td_w10"></th>
                 <th class="td_w10"></th>
                 <th class="td_stk_w7"></th>
                 <th  class="td_stkw5">' . _l('quantity') . '</th>
                 <th  class="td_stkw12">' . _l('Amount_') . '</th>
                 <th  class="td_stkw5">' . _l('quantity') . '</th>
                 <th  class="td_stkw12">' . _l('Amount_') . '</th>
                 <th  class="td_stkw5">' . _l('quantity') . '</th>
                 <th class="td_stkw12">' . _l('Amount_') . '</th>
                 <th  class="td_stkw5">' . _l('quantity') . '</th>
                 <th class="td_stkw12s">' . _l('Amount_') . '</th>
                </tr>';
		foreach ($commodity_lists as $commodity_list_key => $commodity_list) {
			$html .= '<tr>
                  <td class="border_td">' . $commodity_list_key . '</td>
                  <td class="border_td">' . $commodity_list['commodity_code'] . '</td>
                  <td class="border_td">' . $commodity_list['commodity_name'] . '</td>
                  <td class="border_td">' . $commodity_list['unit_name'] . '</td>';
			//import opening
			$stock_opening_quatity = 0;
			$stock_opening_amount = 0;

			$import_opening_quantity = isset($arr_import_openings[$commodity_list['commodity_id']]) ? $arr_import_openings[$commodity_list['commodity_id']] : 0;

			$export_opening_quantity = isset($arr_export_openings[$commodity_list['commodity_id']]) ? $arr_export_openings[$commodity_list['commodity_id']] : 0;

			$stock_opening_quatity = $import_opening_quantity - $export_opening_quantity;
			$stock_opening_amount = $stock_opening_quatity * $commodity_list['rate'];

			$total_opening_quatity += $stock_opening_quatity;
			$total_opening_amount += $stock_opening_amount;

			//import period
			$import_period_quatity = 0;
			$import_period_amount = 0;

			$import_period_quantity = isset($arr_import_periods[$commodity_list['commodity_id']]) ? $arr_import_periods[$commodity_list['commodity_id']] : 0;

			$import_period_quatity = $import_period_quantity;
			$import_period_amount = $import_period_quatity * $commodity_list['rate'];

			$total_import_period_quatity += $import_period_quatity;
			$total_import_period_amount += $import_period_amount;

			//export period
			$export_period_quatity = 0;
			$export_period_amount = 0;

			$export_period_quantity = isset($arr_export_periods[$commodity_list['commodity_id']]) ? $arr_export_periods[$commodity_list['commodity_id']] : 0;

			$export_period_quatity = $export_period_quantity;
			$export_period_amount = $export_period_quatity * $commodity_list['rate'];

			$total_export_period_quatity += $export_period_quatity;
			$total_export_period_amount += $export_period_amount;

			//closing
			$closing_quatity = 0;
			$closing_amount = 0;
			$closing_quatity = $stock_opening_quatity + $import_period_quatity - $export_period_quatity;
			$closing_amount = $stock_opening_amount + $import_period_amount - $export_period_amount;

			$total_closing_quatity += $closing_quatity;
			$total_closing_amount += $closing_amount;

			$html .= '<td class="bor_alir">' . $stock_opening_quatity . '</td>
                  <td class="bor_alir">' . app_format_money((float) $stock_opening_amount, '') . '</td>
                  <td class="bor_alir">' . $import_period_quatity . '</td>
                  <td class="bor_alir">' . app_format_money((float) $import_period_amount, '') . '</td>
                  <td class="bor_alir">' . $export_period_quatity . '</td>
                  <td class="bor_alir">' . app_format_money((float) $export_period_amount, '') . '</td>
                  <td class="bor_alir">' . $closing_quatity . '</td>
                  <td class="bor_r">' . app_format_money((float) $closing_amount, '') . '</td>
                </tr>';
		}
		$html .= '<tr>
                 <th  colspan="4" class="th_stk_style">' . _l('total') . ' : </th>
                <th  colspan="1" class="th_stk_style">' . $total_opening_quatity . '</th>
				<th  colspan="1" class="th_stk_style">' . app_format_money((float) $total_opening_amount, '') . '</th>
				<th  colspan="1" class="th_stk_style">' . $total_import_period_quatity . '</th>
				<th  colspan="1" class="th_stk_style">' . app_format_money((float) $total_import_period_amount, '') . '</th>
				<th  colspan="1" class="th_stk_style">' . $total_export_period_quatity . '</th>
				<th  colspan="1" class="th_stk_style">' . app_format_money((float) $total_export_period_amount, '') . '</th>
				<th  colspan="1" class="th_stk_style">' . $total_closing_quatity . '</th>
				<th  colspan="1" class="th_st_spe">' . app_format_money((float) $total_closing_amount, '') . '</th>
                </tr>
              </tbody>
            </table>
          </div>';

		$html .= ' <table class="table">
       		<tbody>
                <tr>
                  <td class="bold wf60" ></td>
                  <td>' . _l('days') . ' ......... ' . _l('month') . ' ......... ' . _l('year') . ' .......... ' . '</td>
                </tr>
              </tbody>
            </table>
            <br>
            <br>';

		$html .= '<table class="table">
        <tbody>
          <tr>
           <td class="font_500 width60 fstyle"><h4>' . _l('scheduler') . '</h4></td>
           <td class="font_500 width40 fstyle"><h4>' . _l('chief_accountant') . '</h4></td>
          </tr>
          <tr>
           	<td class="font_500 width60 fstyle">' . _l('sign_full_name') . '</td>
            <td class="font_500 width40 fstyle">' . _l('sign_full_name') . '</td>
          </tr>
        </tbody>
      </table>
            <br>
            <br>
            <br>
            <br>';

		$html .= '<link href="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/css/pdf_style.css') . '"  rel="stylesheet" type="text/css" />';
		return $html;

	}

	/**
	 * stock summary report pdf
	 * @param  string $stock_report
	 * @return pdf view
	 */
	function stock_summary_report_pdf($stock_report) {
		return app_pdf('stock_summary_report', module_dir_path(WAREHOUSE_MODULE_NAME, 'libraries/pdf/Stock_summary_report_pdf.php'), $stock_report);
	}

	//get stock summary report for view
	/**
	 * get stock summary report view
	 * @param  array $data
	 * @return string
	 */
	public function get_stock_summary_report_view($data) {
		$from_date = $data['from_date'];
		$to_date = $data['to_date'];

		if(!$this->check_format_date($from_date)){
			$from_date = to_sql_date($from_date);
		}
		if(!$this->check_format_date($to_date)){
			$to_date = to_sql_date($to_date);
		}


		//get_commodity_list in warehouse
		$commodity_lists = $this->db->query('SELECT commodity_id, ' . db_prefix() . 'items.commodity_code, ' . db_prefix() . 'items.rate, ' . db_prefix() . 'items.description as commodity_name, ' . db_prefix() . 'ware_unit_type.unit_name FROM ' . db_prefix() . 'goods_transaction_detail
			LEFT JOIN ' . db_prefix() . 'items ON ' . db_prefix() . 'goods_transaction_detail.commodity_id = ' . db_prefix() . 'items.id
			LEFT JOIN ' . db_prefix() . 'ware_unit_type ON ' . db_prefix() . 'items.unit_id = ' . db_prefix() . 'ware_unit_type.unit_type_id group by commodity_id')->result_array();

		//import_openings
		$import_openings = $this->db->query('SELECT commodity_id, sum(quantity) as quantity FROM ' . db_prefix() . 'goods_transaction_detail
		where status = 1 AND date_format(date_add,"%Y-%m-%d") < "' . $from_date . '"
		group by commodity_id')->result_array();

		$arr_import_openings = [];
		foreach ($import_openings as $import_opening_key => $import_opening_value) {
			$arr_import_openings[$import_opening_value['commodity_id']] = $import_opening_value['quantity'];
		}

		//export_openings
		$export_openings = $this->db->query('SELECT commodity_id, sum(quantity) as quantity FROM ' . db_prefix() . 'goods_transaction_detail
		where status = 2 AND date_format(date_add,"%Y-%m-%d") < "' . $from_date . '"
		group by commodity_id')->result_array();

		$arr_export_openings = [];
		foreach ($export_openings as $export_opening_key => $export_opening_value) {
			$arr_export_openings[$export_opening_value['commodity_id']] = $export_opening_value['quantity'];
		}

		//import_periods
		$import_periods = $this->db->query('SELECT commodity_id, sum(quantity) as quantity FROM ' . db_prefix() . 'goods_transaction_detail
		where status = 1 AND "' . $from_date . '" <= date_format(date_add,"%Y-%m-%d") AND date_format(date_add,"%Y-%m-%d") <= "' . $to_date . '"
		group by commodity_id')->result_array();

		$arr_import_periods = [];
		foreach ($import_periods as $import_period_key => $import_period_value) {
			$arr_import_periods[$import_period_value['commodity_id']] = $import_period_value['quantity'];
		}

		//export_periods
		$export_periods = $this->db->query('SELECT commodity_id, sum(quantity) as quantity FROM ' . db_prefix() . 'goods_transaction_detail
		where status = 2 AND "' . $from_date . '" <= date_format(date_add,"%Y-%m-%d") AND date_format(date_add,"%Y-%m-%d") <= "' . $to_date . '"
		group by commodity_id')->result_array();

		$arr_export_periods = [];
		foreach ($export_periods as $export_period_key => $export_period_value) {
			$arr_export_periods[$export_period_value['commodity_id']] = $export_period_value['quantity'];
		}

		//html for page
		$html = '';
		$html .= ' <p><h3 class="bold align_cen">' . mb_strtoupper(_l('stock_summary_report')) . '</h3></p>
            <br>
            <div class="col-md-12 pull-right">
              <div class="row">
                <div class="col-md-12 align_cen">
                <p>' . _l('from_date') . ' :  <span class="fstyle">' . _l('days') . '  ' . date('d', strtotime($from_date)) . '  ' . _l('month') . '  ' . date('m', strtotime($from_date)) . '  ' . _l('year') . '  ' . date('Y', strtotime($from_date)) . '  ' . '</p>
                <p>' . _l('to_date') . ' :  <span class="fstyle">' . _l('days') . '  ' . date('d', strtotime($to_date)) . '  ' . _l('month') . '  ' . date('m', strtotime($to_date)) . '  ' . _l('year') . '  ' . date('Y', strtotime($to_date)) . '  ' . '</p>
                </div>
              </div>
            </div>

            <table class="table">';
		$company_name = get_option('invoice_company_name');
		$address = get_option('invoice_company_address');
		$total_opening_quatity = 0;
		$total_opening_amount = 0;
		$total_import_period_quatity = 0;
		$total_import_period_amount = 0;
		$total_export_period_quatity = 0;
		$total_export_period_amount = 0;
		$total_closing_quatity = 0;
		$total_closing_amount = 0;

		$html .= '<tbody>
                <tr>
                  <td class="bold width21">' . _l('company_name') . '</td>
                  <td>' . $company_name . '</td>
                </tr>
                <tr>
                  <td class="bold">' . _l('address') . '</td>
                  <td>' . $address . '</td>
                </tr>
              </tbody>
            </table>
            <div class="col-md-12">
             <table class="table table-bordered">
              <tbody>
               <tr>
                 <th colspan="1" class="th_style_stk">ID</th>
                 <th  colspan="1" class="th_stk10">' . _l('commodity_code') . '</th>
                 <th  colspan="1" class="th_stk10">' . _l('commodity_name') . '</th>
                 <th  colspan="1" class="th_stk7">' . _l('unit_name') . '</th>
                 <th  colspan="2" class="th_stk17">' . _l('opening_stock') . '</th>
                 <th  colspan="2" class="th_stk17">' . _l('receipt_in_period') . '</th>
                 <th  colspan="2" class="th_stk17">' . _l('issue_in_period') . '</th>
                 <th  colspan="2" class="th_r_stk17">' . _l('closing_stock') . '</th>
                </tr>
                <tr>
                 <th class="td_w5"></th>
                 <th class="td_w10"></th>
                 <th class="td_w10"></th>
                 <th class="td_stk_w7"></th>
                 <th  class="td_stkw5">' . _l('quantity') . '</th>
                 <th  class="td_stkw12">' . _l('Amount_') . '</th>
                 <th  class="td_stkw5">' . _l('quantity') . '</th>
                 <th  class="td_stkw12">' . _l('Amount_') . '</th>
                 <th  class="td_stkw5">' . _l('quantity') . '</th>
                 <th class="td_stkw12">' . _l('Amount_') . '</th>
                 <th  class="td_stkw5">' . _l('quantity') . '</th>
                 <th class="td_stkw12s">' . _l('Amount_') . '</th>
                </tr>';
		foreach ($commodity_lists as $commodity_list_key => $commodity_list) {
			$html .= '<tr>
                  <td class="border_td">' . $commodity_list_key . '</td>
                  <td class="border_td">' . $commodity_list['commodity_code'] . '</td>
                  <td class="border_td">' . $commodity_list['commodity_name'] . '</td>
                  <td class="border_td">' . $commodity_list['unit_name'] . '</td>';
			//import opening
			$stock_opening_quatity = 0;
			$stock_opening_amount = 0;

			$import_opening_quantity = isset($arr_import_openings[$commodity_list['commodity_id']]) ? $arr_import_openings[$commodity_list['commodity_id']] : 0;

			$export_opening_quantity = isset($arr_export_openings[$commodity_list['commodity_id']]) ? $arr_export_openings[$commodity_list['commodity_id']] : 0;

			$stock_opening_quatity = $import_opening_quantity - $export_opening_quantity;
			$stock_opening_amount = $stock_opening_quatity * $commodity_list['rate'];

			$total_opening_quatity += $stock_opening_quatity;
			$total_opening_amount += $stock_opening_amount;

			//import period
			$import_period_quatity = 0;
			$import_period_amount = 0;

			$import_period_quantity = isset($arr_import_periods[$commodity_list['commodity_id']]) ? $arr_import_periods[$commodity_list['commodity_id']] : 0;

			$import_period_quatity = $import_period_quantity;
			$import_period_amount = $import_period_quatity * $commodity_list['rate'];

			$total_import_period_quatity += $import_period_quatity;
			$total_import_period_amount += $import_period_amount;

			//export period
			$export_period_quatity = 0;
			$export_period_amount = 0;

			$export_period_quantity = isset($arr_export_periods[$commodity_list['commodity_id']]) ? $arr_export_periods[$commodity_list['commodity_id']] : 0;

			$export_period_quatity = $export_period_quantity;
			$export_period_amount = $export_period_quatity * $commodity_list['rate'];

			$total_export_period_quatity += $export_period_quatity;
			$total_export_period_amount += $export_period_amount;

			//closing
			$closing_quatity = 0;
			$closing_amount = 0;
			$closing_quatity = $stock_opening_quatity + $import_period_quatity - $export_period_quatity;
			$closing_amount = $stock_opening_amount + $import_period_amount - $export_period_amount;

			$total_closing_quatity += $closing_quatity;
			$total_closing_amount += $closing_amount;

			$html .= '<td class="bor_alir">' . $stock_opening_quatity . '</td>
                  <td class="bor_alir">' . app_format_money((float) $stock_opening_amount, '') . '</td>
                  <td class="bor_alir">' . $import_period_quatity . '</td>
                  <td class="bor_alir">' . app_format_money((float) $import_period_amount, '') . '</td>
                  <td class="bor_alir">' . $export_period_quatity . '</td>
                  <td class="bor_alir">' . app_format_money((float) $export_period_amount, '') . '</td>
                  <td class="bor_alir">' . $closing_quatity . '</td>
                  <td class="bor_r">' . app_format_money((float) $closing_amount, '') . '</td>
                </tr>';
		}
		$html .= '<tr>
                 <th  colspan="4" class="th_stk_style">' . _l('total') . ' : </th>
                <th  colspan="1" class="th_stk_style">' . $total_opening_quatity . '</th>
                <th  colspan="1" class="th_stk_style">' . app_format_money((float) $total_opening_amount, '') . '</th>
                <th  colspan="1" class="th_stk_style">' . $total_import_period_quatity . '</th>
                <th  colspan="1" class="th_stk_style">' . app_format_money((float) $total_import_period_amount, '') . '</th>
                <th  colspan="1" class="th_stk_style">' . $total_export_period_quatity . '</th>
                <th  colspan="1" class="th_stk_style">' . app_format_money((float) $total_export_period_amount, '') . '</th>
                <th  colspan="1" class="th_stk_style">' . $total_closing_quatity . '</th>
                <th  colspan="1" class="th_st_spe">' . app_format_money((float) $total_closing_amount, '') . '</th>
                </tr>
              </tbody>
            </table>
          </div>';

		$html .= ' <table class="table">
            <tbody>
                <tr>
                  <td class="bold wf60" ></td>
                  <td>' . _l('days') . ' ......... ' . _l('month') . ' ......... ' . _l('year') . ' .......... ' . '</td>
                </tr>
              </tbody>
            </table>
            <br>
            <br>';

		$html .= '<table class="table">
        <tbody>
          <tr>
           <td class="font_500 width60 fstyle"><h4>' . _l('scheduler') . '</h4></td>
           <td class="font_500 width40 fstyle"><h4>' . _l('chief_accountant') . '</h4></td>
          </tr>
          <tr>
            <td class="font_500 width60 fstyle">' . _l('sign_full_name') . '</td>
            <td class="font_500 width40 fstyle">' . _l('sign_full_name') . '</td>
          </tr>
        </tbody>
      </table>
            <br>
            <br>
            <br>
            <br>';

		$html .= '<link href="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/css/pdf_style.css') . '"  rel="stylesheet" type="text/css" />';

		return $html;

	}

	/**
	 * get quantity inventory
	 * @param  integer $warehouse_id
	 * @param  integer $commodity_id
	 * @return object
	 */
	public function get_quantity_inventory($warehouse_id, $commodity_id) {

		$sql = 'SELECT * from ' . db_prefix() . 'inventory_manage where warehouse_id = ' . $warehouse_id . ' AND commodity_id = ' . $commodity_id;
		$result = $this->db->query($sql)->row();
		//if > 0 update, else insert
		return $result;

	}

	/**
	 * get warehourse attachments
	 * @param  integer $commodity_id
	 * @return array
	 */
	public function get_warehourse_attachments($commodity_id) {

		$this->db->order_by('dateadded', 'desc');
		$this->db->where('rel_id', $commodity_id);
		$this->db->where('rel_type', 'commodity_item_file');

		return $this->db->get(db_prefix() . 'files')->result_array();

	}

	/**
	 * add commodity one item
	 * @param array $data
	 * @return integer
	 */
	public function add_commodity_one_item($data) {
		/*add data tblitem*/
		$data['rate'] = reformat_currency_j($data['rate']);
		$data['purchase_price'] = reformat_currency_j($data['purchase_price']);

		/*create sku code*/

		//data sku_code = group_character.sub_code.commodity_str_betwen.next_commodity_id; // X_X_000.id auto increment
		$data['sku_code'] = $this->create_sku_code($data['group_id'], $data['sub_group']);
		/*create sku code*/

		$this->db->insert(db_prefix() . 'items', $data);
		$insert_id = $this->db->insert_id();

		/*add data tblinventory*/
		if ($insert_id) {
			$data_inventory_min['commodity_id'] = $insert_id;
			$data_inventory_min['commodity_code'] = $data['commodity_code'];
			$data_inventory_min['commodity_name'] = $data['description'];
			$this->add_inventory_min($data_inventory_min);
		}
		return $insert_id;

	}

	/**
	 * update commodity one item
	 * @param  array $data
	 * @param  integer $id
	 * @return boolean
	 */
	public function update_commodity_one_item($data, $id) {
		/*add data tblitem*/
		
		$data['rate'] = reformat_currency_j($data['rate']);
		$data['purchase_price'] = reformat_currency_j($data['purchase_price']);

		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'items', $data);

		return true;
	}

	/**
	 * get sub group
	 * @param  boolean $id
	 * @return array  or object
	 */
	public function get_sub_group($id = false) {

		if (is_numeric($id)) {
			$this->db->where('id', $id);

			return $this->db->get(db_prefix() . 'wh_sub_group')->row();
		}
		if ($id == false) {
			return $this->db->query('select * from tblwh_sub_group')->result_array();
		}

	}

	/**
	 * add sub group
	 * @param array  $data
	 * @param boolean $id
	 * @return boolean
	 */
	public function add_sub_group($data, $id = false) {
		$commodity_type = str_replace(', ', '|/\|', $data['hot_sub_group']);

		$data_commodity_type = explode(',', $commodity_type);
		$results = 0;
		$results_update = '';
		$flag_empty = 0;

		foreach ($data_commodity_type as $commodity_type_key => $commodity_type_value) {
			if ($commodity_type_value == '') {
				$commodity_type_value = 0;
			}
			if (($commodity_type_key + 1) % 5 == 0) {
				$arr_temp['note'] = str_replace('|/\|', ', ', $commodity_type_value);

				if ($id == false && $flag_empty == 1) {
					$this->db->insert(db_prefix() . 'wh_sub_group', $arr_temp);
					$insert_id = $this->db->insert_id();
					if ($insert_id) {
						$results++;
					}
				}
				if (is_numeric($id) && $flag_empty == 1) {
					$this->db->where('id', $id);
					$this->db->update(db_prefix() . 'wh_sub_group', $arr_temp);
					if ($this->db->affected_rows() > 0) {
						$results_update = true;
					} else {
						$results_update = false;
					}
				}
				$flag_empty = 0;
				$arr_temp = [];
			} else {

				switch (($commodity_type_key + 1) % 5) {
				case 1:
					$arr_temp['sub_group_code'] = str_replace('|/\|', ', ', $commodity_type_value);
					if ($commodity_type_value != '0') {
						$flag_empty = 1;
					}
					break;
				case 2:
					$arr_temp['sub_group_name'] = str_replace('|/\|', ', ', $commodity_type_value);
					break;
				case 3:
					$arr_temp['order'] = $commodity_type_value;
					break;
				case 4:
					//display 1: display (yes) , 0: not displayed (no)
					if ($commodity_type_value == 'yes') {
						$display_value = 1;
					} else {
						$display_value = 0;
					}
					$arr_temp['display'] = $display_value;
					break;
				}
			}

		}

		if ($id == false) {
			return $results > 0 ? true : false;
		} else {
			return $results_update;
		}

	}

	/**
	 * delete_sub_group
	 * @param  integer $id
	 * @return boolean
	 */
	public function delete_sub_group($id) {
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'wh_sub_group');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * import xlsx commodity
	 * @param  array $data
	 * @return integer
	 */
	public function import_xlsx_commodity($data) {

		$this->db->insert(db_prefix() . 'items', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * get commodity attachments delete
	 * @param  integer $id
	 * @return object
	 */
	public function get_commodity_attachments_delete($id) {

		if (is_numeric($id)) {
			$this->db->where('id', $id);

			return $this->db->get(db_prefix() . 'files')->row();
		}
	}

	//delete _commodity_file file for any
	/**
	 * delete commodity file
	 * @param  integer $attachment_id
	 * @return boolean
	 */
	public function delete_commodity_file($attachment_id) {
		$deleted = false;
		$attachment = $this->get_commodity_attachments_delete($attachment_id);

		if ($attachment) {
			if (empty($attachment->external)) {
				if (file_exists(WAREHOUSE_ITEM_UPLOAD . $attachment->rel_id . '/' . $attachment->file_name)) {
					unlink(WAREHOUSE_ITEM_UPLOAD . $attachment->rel_id . '/' . $attachment->file_name);
				} else {
					unlink('modules/purchase/uploads/item_img/' . $attachment->rel_id . '/' . $attachment->file_name);
				}
			}
			$this->db->where('id', $attachment->id);
			$this->db->delete(db_prefix() . 'files');
			if ($this->db->affected_rows() > 0) {
				$deleted = true;
				log_activity('commodity Attachment Deleted [commodityID: ' . $attachment->rel_id . ']');
			}
			if (file_exists(WAREHOUSE_ITEM_UPLOAD . $attachment->rel_id . '/' . $attachment->file_name)) {
				if (is_dir(WAREHOUSE_ITEM_UPLOAD . $attachment->rel_id)) {

					// Check if no attachments left, so we can delete the folder also
					$other_attachments = list_files(WAREHOUSE_ITEM_UPLOAD . $attachment->rel_id);
					if (count($other_attachments) == 0) {
						// okey only index.html so we can delete the folder also
						delete_dir(WAREHOUSE_ITEM_UPLOAD . $attachment->rel_id);
					}
				}
			} else {
				if (is_dir('modules/purchase/uploads/item_img/' . $attachment->rel_id)) {

					// Check if no attachments left, so we can delete the folder also
					$other_attachments = list_files('modules/purchase/uploads/item_img/' . $attachment->rel_id);
					if (count($other_attachments) == 0) {
						// okey only index.html so we can delete the folder also
						delete_dir('modules/purchase/uploads/item_img/' . $attachment->rel_id);
					}
				}
			}

		}

		return $deleted;
	}

	/**
	 * get color
	 * @param  boolean $id
	 * @return array or object
	 */
	public function get_color($id = false) {

		if (is_numeric($id)) {
			$this->db->where('color_id', $id);

			return $this->db->get(db_prefix() . 'ware_color')->row();
		}
		if ($id == false) {
			return $this->db->query('select * from tblware_color')->result_array();
		}

	}

	/**
	 * create sku code
	 * @param  int commodity_group
	 * @param  int sub_group
	 * @return string
	 */
	public function create_sku_code($commodity_group, $sub_group) {
		// input  commodity group, sub group
		//get commodity group from id
		$group_character = '';
		if (isset($commodity_group)) {

			$sql_group_where = 'SELECT * FROM ' . db_prefix() . 'items_groups where id = "' . $commodity_group . '"';
			$group_value = $this->db->query($sql_group_where)->row();
			if ($group_value) {

				if ($group_value->commodity_group_code != '') {
					$group_character = mb_substr($group_value->commodity_group_code, 0, 1, "UTF-8") . '-';

				}
			}

		}

		//get sku code from sku id
		$sub_code = '';
		if (isset($sub_group)) {

			$sql_sub_group_where = 'SELECT * FROM ' . db_prefix() . 'wh_sub_group where id = "' . $sub_group . '"';
			$sub_group_value = $this->db->query($sql_sub_group_where)->row();
			if ($sub_group_value) {
				$sub_code = $sub_group_value->sub_group_code . '-';
			}

		}

		$sql_where = 'SELECT * FROM ' . db_prefix() . 'items order by id desc limit 1';
		$res = $this->db->query($sql_where)->row();
		$last_commodity_id = 0;
		if (isset($res)) {
			$last_commodity_id = $this->db->query($sql_where)->row()->id;
		}
		$next_commodity_id = (int) $last_commodity_id + 1;

		$commodity_id_length = strlen((string) $next_commodity_id);

		$commodity_str_betwen = '';

		$create_candidate_code = '';

		switch ($commodity_id_length) {
		case 1:
			$commodity_str_betwen = '000';
			break;
		case 2:
			$commodity_str_betwen = '00';
			break;
		case 3:
			$commodity_str_betwen = '0';
			break;

		default:
			$commodity_str_betwen = '0';
			break;
		}

		// data_sku_code = group_character.sub_code.commodity_str_betwen.next_commodity_id; // X_X_000.id auto increment
		return $group_character . $sub_code . $commodity_str_betwen . $next_commodity_id; // X_X_000.id auto increment

	}

	/**
	 * add color
	 * @param array $data
	 * @return integer
	 */
	public function add_color($data) {

		$option = 'off';
		if (isset($data['display'])) {
			$option = $data['display'];
			unset($data['display']);
		}

		if ($option == 'on') {
			$data['display'] = 1;
		} else {
			$data['display'] = 0;
		}

		$this->db->insert(db_prefix() . 'ware_color', $data);
		$insert_id = $this->db->insert_id();

		return $insert_id;
	}

	/**
	 * update color
	 * @param  array $data
	 * @param  integer $id
	 * @return boolean
	 */
	public function update_color($data, $id) {
		$this->db->where('color_id', $id);
		$this->db->update(db_prefix() . 'ware_color', $data);

		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return true;
	}

	/**
	 * delete color
	 * @param  integer $id
	 * @return boolean
	 */
	public function delete_color($id) {

		//delete job_p
		$this->db->where('color_id', $id);
		$this->db->delete(db_prefix() . 'ware_color');

		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	/**
	 * get color add commodity
	 * @return array
	 */
	public function get_color_add_commodity() {
		return $this->db->query('select * from tblware_color where display = 1 order by tblware_color.order asc ')->result_array();
	}

	/**
	 * Adds a loss adjustment.
	 *
	 * @param      <type>  $data   The data
	 *
	 * @return     <type>  (id loss addjustment) )
	 */
	public function add_loss_adjustment($data) {
		$data_add['time'] = to_sql_date($data['time'], true);
		$data_add['type'] = $data['type'];
		$data_add['reason'] = (isset($data['reason']) ? $data['reason'] : '');
		$data_add['addfrom'] = $data['addfrom'];
		$data_add['date_create'] = $data['date_create'];
		$data_add['warehouses'] = $data['warehouses'];
		$data_add['status'] = 0;
		$this->db->insert(db_prefix() . 'wh_loss_adjustment', $data_add);
		$insert_id = $this->db->insert_id();
		if ($insert_id) {
			if (isset($data['pur_order_detail'])) {
				$pur_order_detail = explode(',', $data['pur_order_detail']);
				unset($data['pur_order_detail']);
				$es_detail = [];
				$row = [];
				$rq_val = [];
				$header = [];

				$header[] = 'items';
				$header[] = 'unit';
				$header[] = 'current_number';
				$header[] = 'updates_number';
				$header[] = 'loss_adjustment';

				for ($i = 0; $i < count($pur_order_detail); $i++) {
					$row[] = $pur_order_detail[$i];
					if ((($i + 1) % 4) == 0) {
						$row[] = $insert_id;
						$rq_val[] = array_combine($header, $row);
						$row = [];
					}
				}
				foreach ($rq_val as $key => $rq) {
					if ($rq['items'] != '') {
						array_push($es_detail, $rq_val[$key]);
					}
				}

				$this->db->insert_batch(db_prefix() . 'wh_loss_adjustment_detail', $es_detail);
			}
			return $insert_id;
		}
		return false;

	}

	/**
	 * { update loss adjustment }
	 *
	 * @param      <type>   $data   The data
	 *
	 * @return     boolean
	 */
	public function update_loss_adjustment($data) {
		$affected_rows = 0;
		$data_add['time'] = to_sql_date($data['time'], true);
		$data_add['type'] = $data['type'];
		$data_add['reason'] = (isset($data['reason']) ? $data['reason'] : '');
		$data_add['addfrom'] = $data['addfrom'];
		$data_add['date_create'] = $data['date_create'];
		$data_add['warehouses'] = $data['warehouses'];
		$this->db->where('id', $data['id']);
		$this->db->update(db_prefix() . 'wh_loss_adjustment', $data_add);

		if (isset($data['pur_order_detail'])) {
			$pur_order_detail = explode(',', $data['pur_order_detail']);
			unset($data['pur_order_detail']);
			$es_detail = [];
			$row = [];
			$rq_val = [];
			$header = [];

			$header[] = 'items';
			$header[] = 'unit';
			$header[] = 'current_number';
			$header[] = 'updates_number';
			$header[] = 'loss_adjustment';

			for ($i = 0; $i < count($pur_order_detail); $i++) {
				$row[] = $pur_order_detail[$i];
				if ((($i + 1) % 5) == 0) {
					$rq_val[] = array_combine($header, $row);
					$row = [];
				}
			}
			foreach ($rq_val as $key => $rq) {
				if ($rq['items'] != '') {
					array_push($es_detail, $rq_val[$key]);
				}
			}
			$this->db->where('loss_adjustment', $data['id']);
			$this->db->delete(db_prefix() . 'wh_loss_adjustment_detail');

			foreach ($es_detail as $key => $val) {
				$this->db->insert(db_prefix() . 'wh_loss_adjustment_detail', [
					'items' => $val['items'],
					'unit' => $val['unit'],
					'current_number' => $val['current_number'],
					'updates_number' => $val['updates_number'],
					'loss_adjustment' => $data['id'],
				]);
			}

		}

		return true;

	}

	/**
	 * { delete loss adjustment }
	 *
	 * @param      <type>   $id     The identifier
	 *
	 * @return     boolean
	 */
	public function delete_loss_adjustment($id) {
		$affected_rows = 0;
		$this->db->where('loss_adjustment', $id);
		$this->db->delete(db_prefix() . 'wh_loss_adjustment_detail');
		if ($this->db->affected_rows() > 0) {

			$affected_rows++;
		}

		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'wh_loss_adjustment');
		if ($this->db->affected_rows() > 0) {

			$affected_rows++;
		}

		if ($affected_rows > 0) {
			return true;
		}
		return false;
	}

	/**
	 * Gets the loss adjustment.
	 *
	 * @param      string  $id     The identifier
	 *
	 * @return     <type>  The loss adjustment.
	 */
	public function get_loss_adjustment($id = '') {
		if ($id == '') {
			return $this->db->get(db_prefix() . 'wh_loss_adjustment')->result_array();
		} else {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'wh_loss_adjustment')->row();
		}
	}

	/**
	 * Gets the loss adjustment detailt by masterid.
	 *
	 * @param      string  $id     The identifier
	 *
	 * @return     <type>  The loss adjustment detailt by masterid.
	 */
	public function get_loss_adjustment_detailt_by_masterid($id = '') {
		if ($id == '') {
			return $this->db->get(db_prefix() . 'wh_loss_adjustment_detail')->result_array();
		} else {
			$this->db->where('loss_adjustment', $id);
			return $this->db->get(db_prefix() . 'wh_loss_adjustment_detail')->result_array();
		}
	}

	/**
	 * { change adjust }
	 *
	 * @param      <type>  $id     The identifier
	 */
	public function change_adjust($id) {
		$loss_adjustment = $this->get_loss_adjustment($id);
		$detail = $this->get_loss_adjustment_detailt_by_masterid($id);
		$affected_rows = 0;
		foreach ($detail as $d) {
			$check = $this->check_commodity_exist_inventory($loss_adjustment->warehouses, $d['items']);
			if ($check == false) {
				$this->db->where('warehouse_id', $loss_adjustment->warehouses);
				$this->db->where('commodity_id', $d['items']);
				$this->db->update(db_prefix() . 'inventory_manage', [
					'inventory_number' => $d['updates_number'],
				]);
				if ($this->db->affected_rows() > 0) {
					$affected_rows++;
				}

				$this->db->insert(db_prefix() . 'goods_transaction_detail', [
					'old_quantity' => $d['current_number'],
					'quantity' => $d['updates_number'],
					'date_add' => date('Y-m-d H:i:s'),
					'commodity_id' => $d['items'],
					'warehouse_id' => $loss_adjustment->warehouses,
					'status' => 3,
				]);

			} else {
				return false;
			}
		}

		if ($affected_rows > 0) {
			$this->db->where('id', $id);
			$this->db->update(db_prefix() . 'wh_loss_adjustment', [
				'status' => 1,
			]);

			return true;
		}
		return false;
	}

	/**
	 *@param array data
	 */
	public function get_inventory_valuation_report_view($data) {
		$from_date = $data['from_date'];
		$to_date = $data['to_date'];

		if(!$this->check_format_date($from_date)){
			$from_date = to_sql_date($from_date);
		}
		if(!$this->check_format_date($to_date)){
			$to_date = to_sql_date($to_date);
		}
		//get_commodity_list in warehouse
		$commodity_lists = $this->db->query('SELECT commodity_id, ' . db_prefix() . 'items.commodity_code, ' . db_prefix() . 'items.rate, ' . db_prefix() . 'items.purchase_price, ' . db_prefix() . 'items.description as commodity_name, ' . db_prefix() . 'ware_unit_type.unit_name FROM ' . db_prefix() . 'goods_transaction_detail
            LEFT JOIN ' . db_prefix() . 'items ON ' . db_prefix() . 'goods_transaction_detail.commodity_id = ' . db_prefix() . 'items.id
            LEFT JOIN ' . db_prefix() . 'ware_unit_type ON ' . db_prefix() . 'items.unit_id = ' . db_prefix() . 'ware_unit_type.unit_type_id group by commodity_id')->result_array();

		//import_openings
		$import_openings = $this->db->query('SELECT commodity_id, sum(quantity) as quantity FROM ' . db_prefix() . 'goods_transaction_detail
        where status = 1 AND date_format(date_add,"%Y-%m-%d") < "' . $from_date . '"
        group by commodity_id')->result_array();

		$arr_import_openings = [];
		foreach ($import_openings as $import_opening_key => $import_opening_value) {
			$arr_import_openings[$import_opening_value['commodity_id']] = $import_opening_value['quantity'];
		}

		//export_openings
		$export_openings = $this->db->query('SELECT commodity_id, sum(quantity) as quantity FROM ' . db_prefix() . 'goods_transaction_detail
        where status = 2 AND date_format(date_add,"%Y-%m-%d") < "' . $from_date . '"
        group by commodity_id')->result_array();

		$arr_export_openings = [];
		foreach ($export_openings as $export_opening_key => $export_opening_value) {
			$arr_export_openings[$export_opening_value['commodity_id']] = $export_opening_value['quantity'];
		}

		//import_periods
		$import_periods = $this->db->query('SELECT commodity_id, sum(quantity) as quantity FROM ' . db_prefix() . 'goods_transaction_detail
        where status = 1 AND "' . $from_date . '" <= date_format(date_add,"%Y-%m-%d") AND date_format(date_add,"%Y-%m-%d") <= "' . $to_date . '"
        group by commodity_id')->result_array();

		$arr_import_periods = [];
		foreach ($import_periods as $import_period_key => $import_period_value) {
			$arr_import_periods[$import_period_value['commodity_id']] = $import_period_value['quantity'];
		}

		//export_periods
		$export_periods = $this->db->query('SELECT commodity_id, sum(quantity) as quantity FROM ' . db_prefix() . 'goods_transaction_detail
        where status = 2 AND "' . $from_date . '" <= date_format(date_add,"%Y-%m-%d") AND date_format(date_add,"%Y-%m-%d") <= "' . $to_date . '"
        group by commodity_id')->result_array();

		$arr_export_periods = [];
		foreach ($export_periods as $export_period_key => $export_period_value) {
			$arr_export_periods[$export_period_value['commodity_id']] = $export_period_value['quantity'];
		}

		//html for page
		$html = '';
		$html .= ' <p><h3 class="bold align_cen">' . mb_strtoupper(_l('inventory_valuation_report')) . '</h3></p>

            <div class="col-md-12 pull-right">
              <div class="row">
                <div class="col-md-12 align_cen">
                <p>' . _l('from_date') . ' :  <span class="fstyle" >' . _l('days') . '  ' . date('d', strtotime($from_date)) . '  ' . _l('month') . '  ' . date('m', strtotime($from_date)) . '  ' . _l('year') . '  ' . date('Y', strtotime($from_date)) . '  ' . '</p>
                <p>' . _l('to_date') . ' :  <span class="fstyle">' . _l('days') . '  ' . date('d', strtotime($to_date)) . '  ' . _l('month') . '  ' . date('m', strtotime($to_date)) . '  ' . _l('year') . '  ' . date('Y', strtotime($to_date)) . '  ' . '</p>
                </div>
              </div>
            </div>

            <table class="table">';
		$company_name = get_option('invoice_company_name');
		$address = get_option('invoice_company_address');
		$total_opening_quatity = 0;
		$total_opening_amount = 0;
		$total_import_period_quatity = 0;
		$total_import_period_amount = 0;
		$total_export_period_quatity = 0;
		$total_export_period_amount = 0;
		$total_closing_quatity = 0;
		$total_closing_amount = 0;

		//rate
		$total_amount_sold = 0;
		$total_amount_purchased = 0;
		$total_expected_profit = 0;
		$total_sales_number = 0;
		//purchase

		$html .= '<tbody>
                <tr>
                  <td class="bold width">' . _l('company_name') . '</td>
                  <td>' . $company_name . '</td>
                </tr>
                <tr>
                  <td class="bold">' . _l('address') . '</td>
                  <td>' . $address . '</td>
                </tr>
              </tbody>
            </table>
            <div class="col-md-12">
             <table class="table table-bordered">
              <tbody>
               <tr>
                 <th colspan="1" class="td_text">STT</th>
                 <th colspan="1" class="td_text">' . _l('commodity_code') . '</th>
                 <th colspan="1" class="td_text">' . _l('commodity_name') . '</th>
                 <th colspan="1" class="td_text">' . _l('unit_name') . '</th>

                 <th colspan="1" class="td_text">' . _l('inventory_number') . '</th>
                 <th colspan="1" class="td_text">' . _l('Price') . '</th>
                 <th colspan="1" class="td_text">' . _l('purchase_price') . '</th>
                 <th colspan="1" class="td_text">' . _l('amount_sold') . '</th>
                 <th colspan="1" class="td_text">' . _l('amount_purchased') . '</th>
                 <th colspan="1" class="td_text">' . _l('expected_profit') . '</th>

                </tr>';

		foreach ($commodity_lists as $commodity_list_key => $commodity_list) {

			$html .= '<tr>
                  <td class="border_1">' . $commodity_list_key . '</td>
                  <td class="border_1">' . $commodity_list['commodity_code'] . '</td>
                  <td class="border_1">' . $commodity_list['commodity_name'] . '</td>
                  <td class="border_1">' . $commodity_list['unit_name'] . '</td>';

			//sales
			$sales_number = 0;
			$export_period_quantity = isset($arr_export_periods[$commodity_list['commodity_id']]) ? $arr_export_periods[$commodity_list['commodity_id']] : 0;
			$sales_number = $export_period_quantity;
			$total_sales_number += (float) $export_period_quantity;

			//opening
			$stock_opening_quatity = 0;
			$stock_opening_amount = 0;

			$import_opening_quantity = isset($arr_import_openings[$commodity_list['commodity_id']]) ? $arr_import_openings[$commodity_list['commodity_id']] : 0;

			$export_opening_quantity = isset($arr_export_openings[$commodity_list['commodity_id']]) ? $arr_export_openings[$commodity_list['commodity_id']] : 0;

			$stock_opening_quatity = $import_opening_quantity - $export_opening_quantity;

			//import_period
			$import_period_quatity = 0;
			$import_period_amount = 0;

			$import_period_quantity = isset($arr_import_periods[$commodity_list['commodity_id']]) ? $arr_import_periods[$commodity_list['commodity_id']] : 0;

			$import_period_quatity = $import_period_quantity;

			//export_period
			$export_period_quatity = 0;
			$export_period_amount = 0;

			$export_period_quantity = isset($arr_export_periods[$commodity_list['commodity_id']]) ? $arr_export_periods[$commodity_list['commodity_id']] : 0;

			$export_period_quatity = $export_period_quantity;

			//closing
			$closing_quatity = 0;
			$expected_profit = 0;
			//eventory number
			$closing_quatity = (float) $stock_opening_quatity + (float) $import_period_quatity - (float) $export_period_quatity;
			//sale
			//
			$total_amount_sold += (float) $total_closing_quatity * $commodity_list['rate'];
			$total_amount_purchased += (float) $total_closing_quatity * $commodity_list['purchase_price'];
			$total_expected_profit += (float) $total_closing_quatity * $commodity_list['rate'] - (float) $total_closing_quatity * $commodity_list['purchase_price'];

			$total_closing_quatity += $closing_quatity;

			// Sell number

			$html .= '<td class="td_style_r">' . $closing_quatity . '</td>
                

                  <td class="td_style_r">' . app_format_money((float)$commodity_list['rate'] , ''). '</td>
                  <td class="td_style_r">' . app_format_money((float)$commodity_list['purchase_price'] , ''). '</td>
                  <td class="td_style_r">' . app_format_money((float) ($total_closing_quatity * $commodity_list['rate']), '') . '</td>
                  <td class="td_style_r">' . app_format_money((float) ($total_closing_quatity * $commodity_list['purchase_price']), '') . '</td>
                  <td class="td_style_r">' . app_format_money((float) ((float) $total_closing_quatity * $commodity_list['rate'] - (float) $total_closing_quatity * $commodity_list['purchase_price']), '') . '</td>
                </tr>';
		}

		$html .= '<tr>
                 <th colspan="4" class="td_text_r">' . _l('total') . ' : </th>
                <th colspan="1" class="td_text_r">' . $total_closing_quatity . '</th>
               

                <th colspan="1" class="td_text_r"></th>
                <th colspan="1" class="td_text_r"></th>

                <th colspan="1" class="td_text_r">' . app_format_money((float) ($total_amount_sold), '') . '</th>
                <th colspan="1" class="td_text_r">' . app_format_money((float) ($total_amount_purchased), '') . '</th>
                <th colspan="1" class="td_text_r">' . app_format_money((float) ($total_expected_profit), '') . '</th>
                </tr>
              </tbody>
            </table>
          </div>



            <br>
            <br>
            <br>
            <br>';

		$html .= '<link href="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/css/pdf_style.css') . '"  rel="stylesheet" type="text/css" />';

		return $html;

	}

	/**
	 * generate commodity barcode
	 *
	 * @return     string
	 */
	public function generate_commodity_barcode() {
		$item = false;
		do {
			$length = 11;
			$chars = '0123456789';
			$count = mb_strlen($chars);
			$password = '';
			for ($i = 0; $i < $length; $i++) {
				$index = rand(0, $count - 1);
				$password .= mb_substr($chars, $index, 1);
			}
			$this->db->where('commodity_barcode', $password);
			$item = $this->db->get(db_prefix() . 'items')->row();
		} while ($item);

		return $password;
	}

/**
 * delete goods receipt
 * @param  [integer] $id
 * @return [redirect]
 */
	public function delete_goods_receipt($id) {
		$affected_rows = 0;

		$this->db->where('goods_receipt_id', $id);
		$this->db->delete(db_prefix() . 'goods_receipt_detail');
		if ($this->db->affected_rows() > 0) {

			$affected_rows++;
		}

		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'goods_receipt');
		if ($this->db->affected_rows() > 0) {

			$affected_rows++;
		}

		if ($affected_rows > 0) {
			return true;
		}
		return false;
	}

	/**
	 * delete goods delivery
	 * @param  [integer] $id
	 * @return [redirect]
	 */
	public function delete_goods_delivery($id) {
		$affected_rows = 0;

		$this->db->where('goods_delivery_id', $id);
		$this->db->delete(db_prefix() . 'goods_delivery_detail');
		if ($this->db->affected_rows() > 0) {

			$affected_rows++;
		}

		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'goods_delivery');
		if ($this->db->affected_rows() > 0) {

			$affected_rows++;
		}

		if ($affected_rows > 0) {
			return true;
		}
		return false;
	}

	/**
	 * check format date Y-m-d
	 *
	 * @param      String   $date   The date
	 *
	 * @return     boolean 
	 */
	public function check_format_date($date){
		if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
		    return true;
		} else {
		    return false;
		}
	}
	//////////////////////////////////////////////////////////////////
	public function commodity_sync_model() {
		$pospospos_db = $this->load->database('pospospos', TRUE);
		$pospospos_db->empty_table('products');
		$pospospos_db->empty_table('product_store_qty');
		$q = $this->db->get('items');

        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data = array(
	                'type' => $row->commodity_type,
	                'code' => $row->commodity_code,
	                'name' => $row->description,
	                'category_id' => '1',
	                'price' => $row->purchase_price,
	                'cost' => $row->purchase_price,
	                'tax' => $row->tax,
	                'tax_method' => '1',
	                'alert_quantity' => $row->unit,
	                'quantity' => $row->unit,
	                'details' => $row->long_description,
	                'barcode_symbology' => $row->commodity_type,
                );
                $pospospos_db->insert('products', $data);

                $product_id = $pospospos_db->insert_id();
                
                $unit = $row->unit;
                if(!$row->unit)
                	$unit = 0;
                $store_quantity = array(
                    'store_id' => '1',
                    'quantity' => $unit,
                    'price' => $row->purchase_price,
                    'product_id' => $product_id,
                );
                $pospospos_db->insert('product_store_qty', $store_quantity);
            }
        }
	}
}