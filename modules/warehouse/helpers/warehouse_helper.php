<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 * Check whether column exists in a table
 * Custom function because Codeigniter is caching the tables and this is causing issues in migrations
 * @param  string $column column name to check
 * @param  string $table table name to check
 * @return boolean
 */


/**
 * get taxes
 * @param  integer $id
 * @return array or row
 */
function get_taxes($id =''){
    $CI           = & get_instance();

     if (is_numeric($id)) {
            $CI->db->where('id',$id);

            return $CI->db->get(db_prefix().'taxes')->row();
        }
        $CI->db->order_by('taxrate', 'ASC');
        return $CI->db->get(db_prefix().'taxes')->result_array();

}

/**
 * get unit type
 * @param  integer $id
 * @return array or row
 */
 function get_unit_type($id = false)
    {
        $CI           = & get_instance();

        if (is_numeric($id)) {
        $CI->db->where('unit_type_id', $id);

            return $CI->db->get(db_prefix() . 'ware_unit_type')->row();
        }
        if ($id == false) {
            return $CI->db->query('select * from tblware_unit_type')->result_array();
        }

    }

/**
 * get tax rate
 * @param  integer $id
 * @return array or row
 */
 function get_tax_rate($id = false)
    {
        $CI           = & get_instance();

        if (is_numeric($id)) {
        $CI->db->where('id', $id);

            return $CI->db->get(db_prefix() . 'taxes')->row();
        }
        if ($id == false) {
            return $CI->db->query('select * from tbltaxes')->result_array();
        }

    }


/**
 * get group name
 * @param  integer $id
 * @return array or row
 */
function get_group_name($id = false)
    {
        $CI           = & get_instance();

        if (is_numeric($id)) {
        $CI->db->where('id', $id);

            return $CI->db->get(db_prefix() . 'items_groups')->row();
        }
        if ($id == false) {
            return $CI->db->query('select * from tblitems_groups')->result_array();
        }

    }


/**
 * get size name
 * @param  integer $id
 * @return array or row
 */
function get_size_name($id = false)
    {
        $CI           = & get_instance();

        if (is_numeric($id)) {
        $CI->db->where('size_type_id', $id);

            return $CI->db->get(db_prefix() . 'ware_size_type')->row();
        }
        if ($id == false) {
            return $CI->db->query('select * from tblware_size_type')->result_array();
        }

    }


/**
 * get style name
 * @param  integer $id
 * @return array or row
 */
function get_style_name($id = false)
{
    $CI           = & get_instance();

    if (is_numeric($id)) {
    $CI->db->where('style_type_id', $id);
        return $CI->db->get(db_prefix() . 'ware_style_type')->row();
    }
    if ($id == false) {
        return $CI->db->query('select * from tblware_style_type')->result_array();
    }

}

/**
 * get model name
 * @param  integer $id
 * @return array or row
 */
function get_model_name($id = false)
    {
        $CI           = & get_instance();

        if (is_numeric($id)) {
        $CI->db->where('body_type_id', $id);

            return $CI->db->get(db_prefix() . 'ware_body_type')->row();
        }
        if ($id == false) {
            return $CI->db->query('select * from tblware_body_type')->result_array();
        }

    }

/**
 * get puchase order aproved on module purchase
 * get purchae order
 * @param  integer $id
 * @return array or row
 */
 function get_pr_order($id = false)
    {
        $CI           = & get_instance();

        if (is_numeric($id)) {
        $CI->db->where('id', $id);
            return $CI->db->get(db_prefix() . 'pur_orders')->row();
        }
        if ($id == false) {
            return $CI->db->query('select * from tblpur_orders where approve_status = 2 AND status_goods = 0')->result_array();
        }

    }


/**
 * reformat currency
 * @param  string  $value
 * @return float
 */
function reformat_currency_j($value)
{

    $f_dot = str_replace(',','', $value);
    return ((float)$f_dot + 0);
}


/**
 * get purchase order request name
 * @param  integer $id
 * @return array or row
 */
function get_pur_request_name($id = false)
    {
        $CI           = & get_instance();

        if (is_numeric($id)) {
        $CI->db->where('id', $id);

            return $CI->db->get(db_prefix() . 'pur_request')->row();
        }
        if ($id == false) {
            return $CI->db->query('select * from tblpur_request')->result_array();
        }

    }


/**
 * get warehouse name
 * @param  integer $id
 * @return array or row
 */
function get_warehouse_name($id = false)
    {
        $CI           = & get_instance();

        if (is_numeric($id)) {
        $CI->db->where('warehouse_id', $id);

            return $CI->db->get(db_prefix() . 'warehouse')->row();
        }
        if ($id == false) {
            return $CI->db->query('select * from tblwarehouse')->result_array();
        }

    }


/**
 * get commodity name
 * @param  integer $id
 * @return array or row
 */
function get_commodity_name($id = false)
    {
        $CI           = & get_instance();

        if (is_numeric($id)) {
        $CI->db->where('id', $id);

            return $CI->db->get(db_prefix() . 'items')->row();
        }
        if ($id == false) {
            return $CI->db->query('select * from tblitems')->result_array();
        }

    }


/**
 * get status inventory
 * @param  integer $commodity, integer $inventory
 * @return boolean
 */
function get_status_inventory($commodity, $inventory)
    {
        $CI           = & get_instance();
        $CI->db->where('commodity_id', $commodity);

            $result = $CI->db->get(db_prefix() . 'inventory_commodity_min')->row();
           
            if($result != null){
                return $inventory >= (float)get_object_vars($result)['inventory_number_min'] ? true : false;
            }else{
                return true;
            }

    }

/**
 * get goods receipt code
 * @param  integer $id
 * @return array or row
 */
    function get_goods_receipt_code($id = false)
    {
        $CI           = & get_instance();

        if (is_numeric($id)) {
        $CI->db->where('id', $id);

            return $CI->db->get(db_prefix() . 'goods_receipt')->row();
        }
        if ($id == false) {
            return $CI->db->query('select * from tblgoods_receipt')->result_array();
        }

    }


/**
 * warehouse process digital signature image
 * @param  string $partBase64
 * @param  string $path
 * @param  string $image_name
 * @return boolean
 */
function warehouse_process_digital_signature_image($partBase64, $path, $image_name)
{
    if (empty($partBase64)) {
        return false;
    }

    _maybe_create_upload_path($path);
    $filename = unique_filename($path, $image_name.'.png');

    $decoded_image = base64_decode($partBase64);

    $retval = false;

    $path = rtrim($path, '/') . '/' . $filename;

    $fp = fopen($path, 'w+');

    if (fwrite($fp, $decoded_image)) {
        $retval                                 = true;
        $GLOBALS['processed_digital_signature'] = $filename;
    }

    fclose($fp);

    return $retval;
}


/**
 * numberTowords 
 * @param  string $num 
 * @return string
 */
function numberTowords($num)
{ 
    $ones = array( 
    0 => '',
    1 => "One", 
    2 => "Two", 
    3 => "Three", 
    4 => "Four", 
    5 => "Five", 
    6 => "Six", 
    7 => "Seven", 
    8 => "Eight", 
    9 => "Nine", 
    10 => "Ten", 
    11 => "Eleven", 
    12 => "Twelve", 
    13 => "Thirteen", 
    14 => "Fourteen", 
    15 => "Fifteen", 
    16 => "Sixteen", 
    17 => "Seventeen", 
    18 => "Eighteen", 
    19 => "Nineteen" 
    ); 
    $tens = array( 
    0 => '',
    1 => "Ten",
    2 => "Twenty", 
    3 => "Thirty", 
    4 => "Fourty", 
    5 => "Fifty", 
    6 => "Sixty", 
    7 => "Seventy", 
    8 => "Eighty", 
    9 => "Ninety" 
    ); 
    $hundreds = array( 
    "Hundred", 
    "Thousand", 
    "Million", 
    "Billion", 
    "Thousands of billions", 
    "Million billion" 
    ); //limit t quadrillion 
    $num = number_format($num,2,".",","); 
    $num_arr = explode(".",$num); 
    $wholenum = $num_arr[0]; 
    
    $decnum = $num_arr[1]; 
    $whole_arr = array_reverse(explode(",",$wholenum)); 
    krsort($whole_arr); 
    $rettxt = ""; 
    foreach($whole_arr as $key => $i){ 
           
        if($i == '0' || $i == '000' || $i == '00'){
            $rettxt .= $ones[0];
        }elseif($i < 20){ 
            
            $rettxt .= $ones[$i]; 
        }elseif($i < 100){ 
            $rettxt .= $tens[substr($i,0,1)]; 
            $rettxt .= " ".$ones[substr($i,1,1)]; 
        }else{ 
            $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
            $rettxt .= " ".$tens[substr($i,1,1)]; 
            $rettxt .= " ".$ones[substr($i,2,1)]; 
        }

        if($key > 0){ 
            $rettxt .= " ".$hundreds[$key]." "; 
        } 

    } 
    if($decnum > 0){ 
        $rettxt .= " and "; 
        if($decnum < 20){ 
            $rettxt .= $ones[$decnum]; 
        }elseif($decnum < 100){ 
            $rettxt .= $tens[substr($decnum,0,1)]; 
            $rettxt .= " ".$ones[substr($decnum,1,1)]; 
        } 
    } 

    return $rettxt; 
} 


/**
 * get status modules wh
 * @param  string $module_name 
 * @return boolean             
 */
function get_status_modules_wh($module_name){
    $CI             = &get_instance();
   
    $sql = 'select * from '.db_prefix().'modules where module_name = "'.$module_name.'" AND active =1 ';
    $module = $CI->db->query($sql)->row();
    if($module){
        return true;
    }else{
        return false;
    }
}


/**
 * get goods delivery code
 * @param  integer $id
 * @return array or row
 */
function get_goods_delivery_code($id = false)
{
    $CI           = & get_instance();

    if (is_numeric($id)) {
    $CI->db->where('id', $id);

        return $CI->db->get(db_prefix() . 'goods_delivery')->row();
    }
    if ($id == false) {
        return $CI->db->query('select * from tblgoods_delivery')->result_array();
    }

}

/**
 * handle commmodity list add edit file
 * @param  integer $id
 * @return boolean
 */
function handle_commodity_list_add_edit_file($id){

    if (isset($_FILES['cd_avar']['name']) && $_FILES['cd_avar']['name'] != '') {
        
        hooks()->do_action('before_upload_contract_attachment', $id);
        $path = WAREHOUSE_ITEM_UPLOAD. $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['cd_avar']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            _maybe_create_upload_path($path);
            $filename    = unique_filename($path, $_FILES['cd_avar']['name']);
            $newFilePath = $path . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI           = & get_instance();
                $attachment   = [];
                $attachment[] = [
                    'file_name' => $filename,
                    'filetype'  => $_FILES['cd_avar']['type'],
                    ];
                $CI->misc_model->add_attachment_to_database($id, 'commodity_item_file', $attachment);

                return true;
            }
        }
    }

    return false;
}


/**
 * handle commodity attchment
 * @param  integer $id
 * @return array or row
 */
function handle_commodity_attachments($id)
{

    if (isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'])) {
        header('HTTP/1.0 400 Bad error');
        echo _perfex_upload_error($_FILES['file']['error']);
        die;
    }
    $path = WAREHOUSE_ITEM_UPLOAD . $id . '/';
    $CI   = & get_instance();

    if (isset($_FILES['file']['name'])) {

        // 
        // Get the temp file path
        $tmpFilePath = $_FILES['file']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {

            _maybe_create_upload_path($path);
            $filename    = $_FILES['file']['name'];
            $newFilePath = $path . $filename;
            // Upload the file into the temp dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {

                $attachment   = [];
                $attachment[] = [
                    'file_name' => $filename,
                    'filetype'  => $_FILES['file']['type'],
                    ];

                $CI->misc_model->add_attachment_to_database($id, 'commodity_item_file', $attachment);
            }
        }
    }

}


/**
 * handle hrm contract attachemnt array
 * @param  integer $contractid, string $index_name
 * @return boolean
 */
function handle_hrm_contract_attachments_array($contractid, $index_name = 'attachments')
{
    $uploaded_files = [];
    $path           = get_hrm_upload_path_by_type('contract').$contractid .'/';
    $CI             = &get_instance();
    if (isset($_FILES[$index_name]['name'])
        && ($_FILES[$index_name]['name'] != '' || is_array($_FILES[$index_name]['name']) && count($_FILES[$index_name]['name']) > 0)) {
        if (!is_array($_FILES[$index_name]['name'])) {
            $_FILES[$index_name]['name']     = [$_FILES[$index_name]['name']];
            $_FILES[$index_name]['type']     = [$_FILES[$index_name]['type']];
            $_FILES[$index_name]['tmp_name'] = [$_FILES[$index_name]['tmp_name']];
            $_FILES[$index_name]['error']    = [$_FILES[$index_name]['error']];
            $_FILES[$index_name]['size']     = [$_FILES[$index_name]['size']];
        }

        _file_attachments_index_fix($index_name);
        for ($i = 0; $i < count($_FILES[$index_name]['name']); $i++) {
            // Get the temp file path
            $tmpFilePath = $_FILES[$index_name]['tmp_name'][$i];

            // Make sure we have a filepath
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                if (_perfex_upload_error($_FILES[$index_name]['error'][$i])
                    || !_upload_extension_allowed($_FILES[$index_name]['name'][$i])) {
                    continue;
                }

                _maybe_create_upload_path($path);
                $filename    = unique_filename($path, $_FILES[$index_name]['name'][$i]);
                $newFilePath = $path . $filename;

                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    array_push($uploaded_files, [
                    'file_name' => $filename,
                    'filetype'  => $_FILES[$index_name]['type'][$i],
                    ]);
                    if (is_image($newFilePath)) {
                        create_img_thumb($path, $filename);
                    }
                }
            }
        }
    }

    if (count($uploaded_files) > 0) {
        return $uploaded_files;
    }

    return false;
}


