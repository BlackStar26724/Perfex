<?php

defined('BASEPATH') or exit('No direct script access allowed');


$aColumns = [
    
    'warehouse_id',
    'commodity_id',
    'inventory_number',
    'expiry_date',
    
    ];
$sIndexColumn = 'id';
$sTable       = db_prefix().'inventory_manage';



$join =[];
$where = [];


$warehouse_id = $this->ci->input->post('warehouse_id1');
$commodity_id = $this->ci->input->post('commodity_id1'); 
$expiry_date = $this->ci->input->post('expiry_date1'); 


if(isset($warehouse_id)){

        $where_status_ft = ' AND warehouse_id = "'.$warehouse_id.'"';
        array_push($where, $where_status_ft);
}

if(isset($commodity_id)){

        $where_commodity = ' AND commodity_id = "'.$commodity_id.'"';
        array_push($where, $where_commodity);
}


$where_inventory = ' AND DATE_FORMAT(expiry_date, "%Y-%m-%d")  < "'.date('Y-m-d').'"';
array_push($where, $where_inventory);



$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, ['id','date_manufacture',
    'expiry_date',]);


$output  = $result['output'];
$rResult = $result['rResult'];



    foreach ($rResult as $aRow) {
        $row = [];
        $row[] = $aRow['id'];
        $row[] = get_commodity_name($aRow['commodity_id'])->description;
        $row[] = _d($aRow['expiry_date']);
        $row[] = $aRow['inventory_number'];
     
    $output['aaData'][] = $row;

    }

