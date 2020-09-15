<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
     
    'goods_receipt_code',
    'supplier_name',
    'buyer_id',
    'total_tax_money', 
    'total_goods_money',
    'value_of_inventory',
    'total_money',
    'approval',
    ];
$sIndexColumn = 'id';
$sTable       = db_prefix().'goods_receipt';
$join         = [ ];
$where = [];


$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, ['id']);

$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];

   for ($i = 0; $i < count($aColumns); $i++) {

        $_data = $aRow[$aColumns[$i]];
        if($aColumns[$i] == 'supplier_name'){
            $_data = $aRow['supplier_name'];
        }elseif($aColumns[$i] == 'buyer_id'){
            $_data = '<a href="' . admin_url('staff/profile/' . $aRow['buyer_id']) . '">' . staff_profile_image($aRow['buyer_id'], [
                'staff-profile-image-small',
                ]) . '</a>';
            $_data .= ' <a href="' . admin_url('staff/profile/' . $aRow['buyer_id']) . '">' . get_staff_full_name($aRow['buyer_id']) . '</a>';
        }elseif($aColumns[$i] == 'department'){
            $_data = $aRow['name'];
        }elseif ($aColumns[$i] == 'total_tax_money') {
            $_data = app_format_money((float)$aRow['total_tax_money'],'');
        }elseif($aColumns[$i] == 'goods_receipt_code'){
            $name = '<a href="' . admin_url('warehouse/view_purchase/' . $aRow['id'] ).'" onclick="init_goods_receipt('.$aRow['id'].'); return false;">' . $aRow['goods_receipt_code'] . '</a>';

            $name .= '<div class="row-options">';

            $name .= '<a href="' . admin_url('warehouse/edit_purchase/' . $aRow['id'] ).'" >' . _l('view') . '</a>';


            if ((has_permission('warehouse', '', 'delete()') || is_admin()) && ($aRow['approval'] == 0)) {
                $name .= ' | <a href="' . admin_url('warehouse/delete_goods_receipt/' . $aRow['id'] ).'" class="text-danger" >' . _l('delete') . '</a>';
            }
            
            $name .= '</div>';

            $_data = $name;
        }elseif ($aColumns[$i] == 'total_goods_money') {
            $_data = app_format_money((float)$aRow['total_goods_money'],'');
        }elseif ($aColumns[$i] == 'total_money') {
            $_data = app_format_money((float)$aRow['total_money'],'');
        }elseif($aColumns[$i] == 'value_of_inventory') {
            $_data = app_format_money((float)$aRow['value_of_inventory'],'');
        }elseif($aColumns[$i] == 'approval') {
             
             if($aRow['approval'] == 1){
                $_data = '<span class="label label-tag tag-id-1 label-tab1"><span class="tag">'._l('approved').'</span><span class="hide">, </span></span>&nbsp';
             }elseif($aRow['approval'] == 0){
                $_data = '<span class="label label-tag tag-id-1 label-tab2"><span class="tag">'._l('not_yet_approve').'</span><span class="hide">, </span></span>&nbsp';
             }elseif($aRow['approval'] == -1){
                $_data = '<span class="label label-tag tag-id-1 label-tab3"><span class="tag">'._l('reject').'</span><span class="hide">, </span></span>&nbsp';
             }
        }
   


        $row[] = $_data;
    }
    $output['aaData'][] = $row;

}
