<?php

defined('BASEPATH') or exit('No direct script access allowed');


$aColumns = [
    'id',
    'goods_receipt_id',
    'commodity_id',
    'warehouse_id',
    'date_add',
    'old_quantity',
    'quantity',
    'note',
    'status',
    ];
$sIndexColumn = 'id';
$sTable       = db_prefix().'goods_transaction_detail';



$where = [];


$warehouse_ft = $this->ci->input->post('warehouse_ft');
$commodity_ft = $this->ci->input->post('commodity_ft'); 
$status_ft = $this->ci->input->post('status_ft'); 

$join =[];



if(isset($warehouse_ft)){

    $where_warehouse_ft = '';
    foreach ($warehouse_ft as $warehouse_id) {
        if($warehouse_id != '')
        {
            if($where_warehouse_ft == ''){
                $where_warehouse_ft .= ' AND ('.db_prefix().'goods_transaction_detail.warehouse_id = "'.$warehouse_id.'"';
            }else{
                $where_warehouse_ft .= ' or '.db_prefix().'goods_transaction_detail.warehouse_id = "'.$warehouse_id.'"';
            }
        }
    }
    if($where_warehouse_ft != '')
    {
        $where_warehouse_ft .= ')';

        array_push($where, $where_warehouse_ft);
    }
}


    if(isset($commodity_ft)){
        if(!is_array($commodity_ft)){
            $where_commodity_ft = ' AND tblgoods_transaction_detail.commodity_id = "'.$commodity_ft.'"';
            array_push($where, $where_commodity_ft);
            
        }else{

            $where_commodity_ft = '';
            foreach ($commodity_ft as $commodity_id) {
                if($commodity_id != '')
                {
                    if($where_commodity_ft == ''){
                        $where_commodity_ft .= ' AND (tblgoods_transaction_detail.commodity_id = "'.$commodity_id.'"';
                    }else{
                        $where_commodity_ft .= ' or tblgoods_transaction_detail.commodity_id = "'.$commodity_id.'"';
                    }
                }
            }
            if($where_commodity_ft != '')
            {
                $where_commodity_ft .= ')';

                array_push($where, $where_commodity_ft);
            }
        }

    }

if(isset($status_ft)){

    $where_status_ft = '';
    foreach ($status_ft as $status_id) {
        if($status_id != '')
        {
            if($where_status_ft == ''){
                $where_status_ft .= ' AND (tblgoods_transaction_detail.status = "'.$status_id.'"';
            }else{
                $where_status_ft .= ' or tblgoods_transaction_detail.status = "'.$status_id.'"';
            }
        }
    }
    if($where_status_ft != '')
    {
        $where_status_ft .= ')';

        array_push($where, $where_status_ft);
    }
}

if($this->ci->input->post('validity_start_date')){
        $start_date = to_sql_date($this->ci->input->post('validity_start_date'));
    }

    if($this->ci->input->post('validity_end_date')){
        $end_date = to_sql_date($this->ci->input->post('validity_end_date'));
    }

    if(isset($start_date) && isset($end_date)){
            array_push($where, 'AND ((date_add >= "' . $start_date . '" and date_add <= "' . $end_date . '") or if(date_add > 0, (date_add <= "' . $start_date . '" and date_add >= "' . $end_date . '"), (date_add <= "' . $start_date . '")))');
    }elseif(isset($start_date) && !isset($end_date)){
        array_push($where, 'AND if(date_add > 0, (date_add <= "' . $start_date . '" and date_add >= "' . $start_date . '"), (date_add <= "' . $start_date . '"))');
    }elseif(!isset($start_date) && isset($end_date)){
        array_push($where, 'AND if(date_add > 0, (date_add <= "' . $end_date . '" and date_add >= "' . $end_date . '"), (date_add <= "' . $end_date . '"))');
    }



$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, ['id','old_quantity']);


$output  = $result['output'];
$rResult = $result['rResult'];



    foreach ($rResult as $aRow) {
        $row = [];


    if($aRow['status'] == 1){

         $row[] = get_goods_receipt_code($aRow['goods_receipt_id']) != null ? get_goods_receipt_code($aRow['goods_receipt_id'])->goods_receipt_code : '';
    }elseif($aRow['status'] == 2){
         $row[] = get_goods_delivery_code($aRow['goods_receipt_id']) != null ? get_goods_delivery_code($aRow['goods_receipt_id'])->goods_delivery_code : '';

    }else{
        $row[] = '';
    }    

     $row[] = get_commodity_name($aRow['commodity_id']) != null ? get_commodity_name($aRow['commodity_id'])->commodity_code : '';
     $row[] = get_commodity_name($aRow['commodity_id']) != null ? get_commodity_name($aRow['commodity_id'])->description : '';

     $row[] = get_warehouse_name($aRow['warehouse_id']) != null ? get_warehouse_name($aRow['warehouse_id'])->warehouse_code : '';
     $row[] = get_warehouse_name($aRow['warehouse_id']) != null ? get_warehouse_name($aRow['warehouse_id'])->warehouse_name : '';
     $row[] = _dt($aRow['date_add']); 


    $row[] = $aRow['old_quantity']; 
    
    $row[] = $aRow['quantity']; 

     $row[] = $aRow['note'];
     switch ($aRow['status']) {
           case 1:
               $row[] = _l('stock_import');
               break;
           case 2:
               $row[] = _l('stock_export');
               break;
           case 3:
               $row[] = _l('lost, adjustment');
               break;
           case 4:
               $row[] = _l('reduction');
               break;
       }  
     
     
    $output['aaData'][] = $row;

    }

