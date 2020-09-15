<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Inventory
Description: Inventory module is a tool that allows you to track goods across your business’s supply chain. It optimizes the entire spectrum spanning from order placement with your vendor to order delivery to your customer, mapping the complete journey of a product.
Version: 1.0.0
Requires at least: 2.3.*
Author: Hung Tran
Author URI: https://codecanyon.net/user/hungtran118
*/

define('WAREHOUSE_MODULE_NAME', 'warehouse');
define('WAREHOUSE_MODULE_UPLOAD_FOLDER', module_dir_path(WAREHOUSE_MODULE_NAME, 'uploads'));
define('WAREHOUSE_STOCK_IMPORT_MODULE_UPLOAD_FOLDER', module_dir_path(WAREHOUSE_MODULE_NAME, 'uploads/stock_import/'));
define('WAREHOUSE_STOCK_EXPORT_MODULE_UPLOAD_FOLDER', module_dir_path(WAREHOUSE_MODULE_NAME, 'uploads/stock_export/'));
define('WAREHOUSE_ITEM_UPLOAD', module_dir_path(WAREHOUSE_MODULE_NAME, 'uploads/item_img/'));

hooks()->add_action('admin_init', 'warehouse_permissions');
hooks()->add_action('app_admin_head', 'warehouse_add_head_components');
hooks()->add_action('app_admin_footer', 'warehouse_load_js');
hooks()->add_action('admin_init', 'warehouse_module_init_menu_items');
define('WAREHOUSE_PATH', 'modules/warehouse/uploads/');


/**
* Register activation module hook
*/
register_activation_hook(WAREHOUSE_MODULE_NAME, 'warehouse_module_activation_hook');


/**
 * warehouse module activation hook
 * @return [type] 
 */
function warehouse_module_activation_hook()
{
    $CI = &get_instance();
    require_once(__DIR__ . '/install.php');
}

/**
* Register language files, must be registered if the module is using languages
*/
register_language_files(WAREHOUSE_MODULE_NAME, [WAREHOUSE_MODULE_NAME]);


$CI = & get_instance();
$CI->load->helper(WAREHOUSE_MODULE_NAME . '/warehouse');

/**
 * Init goals module menu items in setup in admin_init hook
 * @return null
 */
function warehouse_module_init_menu_items()
{
    $CI = &get_instance();
    if (has_permission('warehouse', '', 'view')) {

       $CI->app_menu->add_sidebar_menu_item('warehouse', [
            'name'     => _l('warehouse'),
            'icon'     => 'fa fa-snowflake-o',
            'position' => 60,
        ]);
        

        $CI->app_menu->add_sidebar_children_item('warehouse', [
            'slug'     => 'wa_commodity_list',
            'name'     => _l('items'),
            'icon'     => 'fa fa-clone menu-icon',
            'href'     => admin_url('warehouse/commodity_list'),
            'position' => 1,
        ]);

        $CI->app_menu->add_sidebar_children_item('warehouse', [
            'slug'     => 'wa_manage_goods_receipt',
            'name'     => _l('stock_import'),
            'icon'     => 'fa fa-object-group',
            'href'     => admin_url('warehouse/manage_purchase'),
            'position' => 2,
        ]);
        
        $CI->app_menu->add_sidebar_children_item('warehouse', [
            'slug'     => 'wa_manage_goods_delivery',
            'name'     => _l('stock_export'),
            'icon'     => 'fa fa-object-ungroup',
            'href'     => admin_url('warehouse/manage_delivery'),
            'position' => 3,
        ]);

        $CI->app_menu->add_sidebar_children_item('warehouse', [
            'slug'     => 'wa_manage_loss_adjustment',
            'name'     => _l('loss_adjustment'),
            'icon'     => 'fa fa-adjust',
            'href'     => admin_url('warehouse/loss_adjustment'),
            'position' => 4,
        ]);
        
        $CI->app_menu->add_sidebar_children_item('warehouse', [
            'slug'     => 'wa_warehouse_history',
            'name'     => _l('warehouse_history'),
            'icon'     => 'fa fa-calendar menu-icon',
            'href'     => admin_url('warehouse/warehouse_history'),
            'position' => 5,
        ]);

        $CI->app_menu->add_sidebar_children_item('warehouse', [
            'slug'     => 'wa_report',
            'name'     => _l('report'),
            'icon'     => 'fa fa-area-chart menu-icon',
            'href'     => admin_url('warehouse/manage_report'),
            'position' => 6,
        ]);
        

        $CI->app_menu->add_sidebar_children_item('warehouse', [
            'slug'     => 'ware_settings',
            'name'     => _l('setting'),
            'icon'     => 'fa fa-gears',
            'href'     => admin_url('warehouse/setting'),
            'position' => 8,
        ]);
       

    }
}


/**
 * warehouse load js
 * @return library 
 */
function warehouse_load_js(){
    $CI = &get_instance();

    $viewuri = $_SERVER['REQUEST_URI'];


     if (!(strpos($viewuri, '/admin/warehouse') === false)) {   
         echo '<script src="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/plugins/handsontable/chosen.jquery.js') . '"></script>';
         echo '<script src="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/plugins/handsontable/handsontable-chosen-editor.js') . '"></script>';
         echo '<script src="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/plugins/signature_pad.min.js') . '"></script>';
     }

    if (!(strpos($viewuri, '/admin/warehouse/setting?group=approval_setting') === false)) {
         echo '<script src="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/js/approval_setting.js') . '"></script>';
    }

    if (!(strpos($viewuri, '/admin/warehouse/setting?group=approval_setting') === false)) {
         echo '<script src="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/js/manage_setting.js') . '"></script>';
    }

    if (!(strpos($viewuri, '/admin/warehouse/setting?group=colors') === false)) {
         echo '<script src="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/js/color.js') . '"></script>';
    }


    if (!(strpos($viewuri, '/admin/warehouse/goods_delivery') === false)) {
         echo '<script src="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/plugins/handsontable/chosen.jquery.js') . '"></script>';
         echo '<script src="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/plugins/handsontable/handsontable-chosen-editor.js') . '"></script>';
    }

    if (!(strpos($viewuri, '/admin/warehouse/manage_delivery') === false)) { 
         echo '<script src="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/js/manage_delivery.js') . '"></script>';
    }

    if (!(strpos($viewuri, '/admin/warehouse/manage_purchase') === false)) { 
         echo '<script src="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/js/manage_purchase.js') . '"></script>';
    }

    if (!(strpos($viewuri, '/admin/warehouse/manage_report?group=stock_summary_report') === false)) { 
         echo '<script src="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/js/stock_summary_report.js') . '"></script>';
    }

    if (!(strpos($viewuri, '/admin/warehouse/manage_stock_take') === false)) { 
         echo '<script src="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/js/manage_stock_take.js') . '"></script>';
    }

    if (!(strpos($viewuri, '/admin/warehouse/view_commodity_detail') === false)) { 
         echo '<script src="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/plugins/simplelightbox/simple-lightbox.min.js') . '"></script>';
         echo '<script src="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/plugins/simplelightbox/simple-lightbox.jquery.min.js') . '"></script>';
         echo '<script src="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/plugins/simplelightbox/masonry-layout-vanilla.min.js') . '"></script>';
         
    }

    if (!(strpos($viewuri, '/admin/warehouse/commodity_list') === false)) { 
         echo '<script src="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/plugins/simplelightbox/simple-lightbox.min.js') . '"></script>';
         echo '<script src="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/plugins/simplelightbox/simple-lightbox.jquery.min.js') . '"></script>';
         echo '<script src="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/plugins/simplelightbox/masonry-layout-vanilla.min.js') . '"></script>';
         
    }
    
	if (!(strpos($viewuri, '/admin/warehouse/add_loss_adjustment') === false)) {
         echo '<script src="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/plugins/handsontable/chosen.jquery.js') . '"></script>';
         echo '<script src="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/plugins/handsontable/handsontable-chosen-editor.js') . '"></script>';
    }

    if (!(strpos($viewuri, '/admin/warehouse/loss_adjustment') === false)) { 
        echo '<script src="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/js/loss_adjustment_manage.js') . '"></script>';
    }

    if (!(strpos($viewuri, '/admin/warehouse/manage_report?group=inventory_valuation_report') === false)) { 
        echo '<script src="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/js/inventory_valuation_report.js') . '"></script>';
    }

    if (!(strpos($viewuri, '/admin/warehouse/setting') === false)) { 
        echo '<script src="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/js/manage_setting.js') . '"></script>';
    }
    
    
        
        
}


/**
 * warehouse add head components
 * @return library 
 */
function warehouse_add_head_components(){
    $CI = &get_instance();
    $viewuri = $_SERVER['REQUEST_URI'];


    if (!(strpos($viewuri, '/admin/warehouse') === false)) {  
        echo '<link href="' . base_url('modules/warehouse/assets/css/styles.css') .'?v=' . $CI->app_scripts->core_version(). '"  rel="stylesheet" type="text/css" />';
        echo '<link href="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/plugins/handsontable/handsontable.full.min.css') . '"  rel="stylesheet" type="text/css" />';
        echo '<link href="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/plugins/handsontable/chosen.css') . '"  rel="stylesheet" type="text/css" />';
        echo '<script src="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/plugins/handsontable/handsontable.full.min.js') . '"></script>';
        echo '<link href="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/css/edit_delivery.css') . '"  rel="stylesheet" type="text/css" />';
        echo '<link href="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/css/commodity_list.css') . '"  rel="stylesheet" type="text/css" />';
    }


    if (!(strpos($viewuri, '/admin/warehouse/setting?group=bodys') === false)) { 

        echo '<link href="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/css/body.css') . '"  rel="stylesheet" type="text/css" />';
    }

    if (!(strpos($viewuri, '/admin/warehouse/setting?group=colors') === false)) { 

        echo '<link href="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/css/body.css') . '"  rel="stylesheet" type="text/css" />';
    }

    if (!(strpos($viewuri, '/admin/warehouse/setting?group=commodity_group') === false)) {     
        echo '<link href="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/css/body.css') . '"  rel="stylesheet" type="text/css" />';
    }
    if (!(strpos($viewuri, '/admin/warehouse/setting?group=commodity_type') === false)) {
        echo '<link href="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/css/body.css') . '"  rel="stylesheet" type="text/css" />';
    }


    if (!(strpos($viewuri, '/admin/warehouse/goods_delivery') === false)) {
        echo '<link href="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/css/goods_delivery.css') . '"  rel="stylesheet" type="text/css" />';
    }

    if (!(strpos($viewuri, '/admin/warehouse/manage_report?group=stock_summary_report') === false)) {
        echo '<link href="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/css/report.css') . '"  rel="stylesheet" type="text/css" />';
    }

    if (!(strpos($viewuri, '/admin/warehouse/manage_report?group=inventory_valuation_report') === false)) {
        echo '<link href="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/css/report.css') . '"  rel="stylesheet" type="text/css" />';
    }

    
    if (!(strpos($viewuri, '/admin/warehouse/view_commodity_detail') === false)) {
        echo '<link href="' . base_url('modules/warehouse/assets/css/styles.css') .'?v=' . $CI->app_scripts->core_version(). '"  rel="stylesheet" type="text/css" />';
        echo '<link href="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/plugins/simplelightbox/simple-lightbox.min.css') . '"  rel="stylesheet" type="text/css" />';
        echo '<link href="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/plugins/simplelightbox/masonry-layout-vanilla.min.css') . '"  rel="stylesheet" type="text/css" />';
    }   

    if (!(strpos($viewuri, '/admin/warehouse/setting?group=approval_setting') === false)) {
        echo '<link href="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/css/approval_setting.css') . '"  rel="stylesheet" type="text/css" />';
       
    }   
    
     if (!(strpos($viewuri, '/admin/warehouse/setting') === false)) {
       echo '<link href="' . module_dir_url(WAREHOUSE_MODULE_NAME, 'assets/css/body.css') . '"  rel="stylesheet" type="text/css" />';
       
    }   

}



/**
 * warehouse permissions
 * @return capabilities 
 */
function warehouse_permissions()
{
    $capabilities = [];

    $capabilities['capabilities'] = [
            'view'   => _l('permission_view') . '(' . _l('permission_global') . ')',
            'create' => _l('permission_create'),
            'edit'   => _l('permission_edit'),
            'delete' => _l('permission_delete'),
    ];

    register_staff_capabilities('warehouse', $capabilities, _l('warehouse'));
}




