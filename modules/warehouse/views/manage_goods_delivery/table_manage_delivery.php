<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [

    'goods_delivery_code',
    'customer_code',
    'customer_name',
    'to_', 
    'address',
    'staff_id',
    'approval',
    ];
$sIndexColumn = 'id';
$sTable       = db_prefix().'goods_delivery';
$join         = [ ];

$where = [];


$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, ['id']);

$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];

   for ($i = 0; $i < count($aColumns); $i++) {

        $_data = $aRow[$aColumns[$i]];
        if($aColumns[$i] == 'customer_code'){
            $_data = $aRow['customer_code'];
        }elseif($aColumns[$i] == 'staff_id'){
            $_data = '<a href="' . admin_url('staff/profile/' . $aRow['staff_id']) . '">' . staff_profile_image($aRow['staff_id'], [
                'staff-profile-image-small',
                ]) . '</a>';
            $_data .= ' <a href="' . admin_url('staff/profile/' . $aRow['staff_id']) . '">' . get_staff_full_name($aRow['staff_id']) . '</a>';
        }elseif($aColumns[$i] == 'department'){
            $_data = $aRow['name'];
        }elseif($aColumns[$i] == 'goods_delivery_code'){
            $name = '<a href="' . admin_url('warehouse/edit_delivery/' . $aRow['id'] ).'" onclick="init_goods_delivery('.$aRow['id'].'); return false;">' . $aRow['goods_delivery_code'] . '</a>';

            $name .= '<div class="row-options">';

            $name .= '<a href="' . admin_url('warehouse/edit_delivery/' . $aRow['id'] ).'" >' . _l('view') . '</a>';
        

            if ((has_permission('warehouse', '', 'delete()') || is_admin()) && ($aRow['approval'] == 0)) {
                $name .= ' | <a href="' . admin_url('warehouse/delete_goods_delivery/' . $aRow['id'] ).'" class="text-danger" >' . _l('delete') . '</a>';
            }

            $name .= '</div>';

            $_data = $name;
        }elseif ($aColumns[$i] == 'custumer_name') {
            $_data =$aRow['custumer_name'];
        }elseif ($aColumns[$i] == 'to_') {
            $_data =    $aRow['to_'];
        }elseif($aColumns[$i] == 'address') {
            $_data = $aRow['address'];
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
