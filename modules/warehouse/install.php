<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!$CI->db->table_exists(db_prefix() . 'ware_commodity_type')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "ware_commodity_type` (
      `commodity_type_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `commondity_code` varchar(100) NULL,
      `commondity_name` text NULL,
      `order` int(10) NULL,
      `display` int(1) NULL COMMENT  'display 1: display (yes)  0: not displayed (no)',
      `note` text NULL,
      PRIMARY KEY (`commodity_type_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}
if (!$CI->db->table_exists(db_prefix() . 'ware_unit_type')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "ware_unit_type` (
      `unit_type_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `unit_code` varchar(100) NULL,
      `unit_name` text NULL,
      `unit_symbol` text NULL,
      `order` int(10) NULL,
      `display` int(1) NULL COMMENT  'display 1: display (yes)  0: not displayed (no)',
      `note` text NULL,
      PRIMARY KEY (`unit_type_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}
if (!$CI->db->table_exists(db_prefix() . 'ware_size_type')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "ware_size_type` (
      `size_type_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `size_code` varchar(100) NULL,
      `size_name` text NULL,
      `size_symbol` text NULL,
      `order` int(10) NULL,
      `display` int(1) NULL COMMENT  'display 1: display (yes)  0: not displayed (no)',
      `note` text NULL,
      PRIMARY KEY (`size_type_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}
if (!$CI->db->table_exists(db_prefix() . 'ware_style_type')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "ware_style_type` (
      `style_type_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `style_code` varchar(100) NULL,
      `style_barcode` text NULL,
      `style_name` text NULL,
      `order` int(10) NULL,
      `display` int(1) NULL COMMENT  'display 1: display (yes)  0: not displayed (no)',
      `note` text NULL,
      PRIMARY KEY (`style_type_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}
if (!$CI->db->table_exists(db_prefix() . 'ware_body_type')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "ware_body_type` (
      `body_type_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `body_code` varchar(100) NULL,
      `body_name` text NULL,
      `order` int(10) NULL,
      `display` int(1) NULL COMMENT  'display 1: display (yes)  0: not displayed (no)',
      `note` text NULL,
      PRIMARY KEY (`body_type_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}
 
if (!$CI->db->field_exists('commodity_group_code' ,db_prefix() . 'items_groups')) { 
  $CI->db->query('ALTER TABLE `' . db_prefix() . "items_groups`
	ADD COLUMN `commodity_group_code` varchar(100) NULL AFTER `name`,
	ADD COLUMN `order` int(10) NULL AFTER `commodity_group_code`,
	ADD COLUMN `display` int(1)  NULL AFTER `order` ,
	ADD COLUMN `note` text NULL AFTER `display`
	;");
}
if (!$CI->db->table_exists(db_prefix() . 'warehouse')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "warehouse` (
      `warehouse_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `warehouse_code` varchar(100) NULL,
      `warehouse_name` text NULL,
      `warehouse_address` text NULL,
      `order` int(10) NULL,
      `display` int(1) NULL COMMENT  'display 1: display (yes)  0: not displayed (no)',
      `note` text NULL,
      PRIMARY KEY (`warehouse_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}


if (!$CI->db->field_exists('commodity_code' ,db_prefix() . 'items')) { 
  $CI->db->query('ALTER TABLE `' . db_prefix() . "items`
    ADD COLUMN `commodity_code` varchar(100) NOT NULL;
    ");
}
if (!$CI->db->field_exists('commodity_barcode' ,db_prefix() . 'items')) { 
  $CI->db->query('ALTER TABLE `' . db_prefix() . "items`
    ADD COLUMN `commodity_barcode` text NULL;
    ");
}
if (!$CI->db->field_exists('commodity_type' ,db_prefix() . 'items')) { 
  $CI->db->query('ALTER TABLE `' . db_prefix() . "items`
    ADD COLUMN `commodity_type` int(11) NULL;
    ");
}

if (!$CI->db->field_exists('warehouse_id' ,db_prefix() . 'items')) { 
  $CI->db->query('ALTER TABLE `' . db_prefix() . "items`
    ADD COLUMN `warehouse_id` int(11) NULL;
    ");
}
if (!$CI->db->field_exists('origin' ,db_prefix() . 'items')) { 
  $CI->db->query('ALTER TABLE `' . db_prefix() . "items`
    ADD COLUMN `origin` varchar(100) NULL;
    ");
}
if (!$CI->db->field_exists('color_id' ,db_prefix() . 'items')) { 
  $CI->db->query('ALTER TABLE `' . db_prefix() . "items`
    ADD COLUMN `color_id` int(11) NULL;
    ");
}
if (!$CI->db->field_exists('style_id' ,db_prefix() . 'items')) { 
  $CI->db->query('ALTER TABLE `' . db_prefix() . "items`
    ADD COLUMN `style_id` int(11) NULL;
    ");
}
if (!$CI->db->field_exists('model_id' ,db_prefix() . 'items')) { 
  $CI->db->query('ALTER TABLE `' . db_prefix() . "items`
    ADD COLUMN `model_id` int(11) NULL;
    ");
}
if (!$CI->db->field_exists('size_id' ,db_prefix() . 'items')) { 
  $CI->db->query('ALTER TABLE `' . db_prefix() . "items`
    ADD COLUMN `size_id` int(11) NULL;
    ");
}

if (!$CI->db->field_exists('unit_id' ,db_prefix() . 'items')) { 
  $CI->db->query('ALTER TABLE `' . db_prefix() . "items`
      ADD COLUMN `unit_id` int(11) NULL
  ;");
}

if (!$CI->db->table_exists(db_prefix() . 'goods_receipt')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "goods_receipt` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `supplier_code` varchar(100) NULL,
      `supplier_name` text NULL,
      `deliver_name` text NULL,
      `buyer_id` int(11) NULL,
      `description` text NULL,
      `pr_order_id` int(11) NULL COMMENT 'code puchase request agree',
      `date_c` date NULL ,
      `date_add` date NULL,
      `goods_receipt_code` varchar(100) NULL,
      `total_tax_money` varchar(100) NULL,
      `total_goods_money` varchar(100) NULL,
      `value_of_inventory` varchar(100) NULL,
      `total_money` varchar(100) NULL COMMENT 'total_money = total_tax_money +total_goods_money ',

      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}

if (!$CI->db->field_exists('approval', 'goods_receipt')) {
    $CI->db->query('ALTER TABLE `'.db_prefix() . 'goods_receipt` 
ADD COLUMN `approval` INT(11) NULL DEFAULT 0 AFTER `total_money`;');            
}

if (!$CI->db->field_exists('addedfrom', 'goods_receipt')) {
    $CI->db->query('ALTER TABLE `'.db_prefix() . 'goods_receipt` 
ADD COLUMN `addedfrom` INT(11) NULL AFTER `total_money`;');            
}

if (!$CI->db->table_exists(db_prefix() . 'goods_receipt_detail')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "goods_receipt_detail` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `goods_receipt_id` int(11) NOT NULL,
      `commodity_code` varchar(100) NULL,
      `commodity_name` text NULL,
      `warehouse_id` text NULL,
      `unit_id` text NULL,
      `quantities` text NULL,
      `unit_price` varchar(100) NULL,
      `tax` varchar(100) NULL,
      `tax_money` varchar(100) NULL,
      `goods_money` varchar(100) NULL ,
      `note` text NULL ,

      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}
if (!$CI->db->table_exists(db_prefix() . 'goods_transaction_detail')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "goods_transaction_detail` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `goods_receipt_id` int(11)  NULL COMMENT 'id_goods_receipt_id or goods_delivery_id',
      `goods_id` int(11) NOT NULL COMMENT ' is id commodity',
      `quantity` varchar(100) NULL,
      `date_add` DATETIME NULL,
      `commodity_id` int(11) NOT NULL,
      `warehouse_id` int(11) NOT NULL,
      `note`  text null,
      `status` int(2) NULL COMMENT '1:Goods receipt note 2:Goods delivery note',

      PRIMARY KEY (`id`,`goods_id`, `commodity_id`, `warehouse_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}

if (!$CI->db->table_exists(db_prefix() . 'inventory_manage')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "inventory_manage` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `warehouse_id` int(11) NOT NULL ,
      `commodity_id` int(11) NOT NULL,
      `inventory_number` varchar(100) NULL,

      PRIMARY KEY (`id`, `commodity_id`, `warehouse_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}
if (!$CI->db->table_exists(db_prefix() . 'inventory_commodity_min')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "inventory_commodity_min` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `commodity_id` int(11) NOT NULL,
      `commodity_code` varchar(100) NULL,
      `commodity_name` varchar(100) NULL,
      `inventory_number_min` varchar(100) NULL,

      PRIMARY KEY (`id`, `commodity_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}

if (!$CI->db->table_exists(db_prefix() . 'wh_approval_setting')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() .'wh_approval_setting` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `related` VARCHAR(255) NOT NULL,
    `setting` LONGTEXT NOT NULL,
  PRIMARY KEY (`id`));');
}

if (!$CI->db->table_exists(db_prefix() . 'wh_approval_details')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() .'wh_approval_details` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `rel_id` INT(11) NOT NULL,
  `rel_type` VARCHAR(45) NOT NULL,
  `staffid` VARCHAR(45) NULL,
  `approve` VARCHAR(45) NULL,
  `note` TEXT NULL,
  `date` DATETIME NULL,
  `approve_action` VARCHAR(255) NULL,
  `reject_action` VARCHAR(255) NULL,
  `approve_value` VARCHAR(255) NULL,
  `reject_value` VARCHAR(255) NULL,
  `staff_approve` INT(11) NULL,
  `action` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));');
}

if (!$CI->db->field_exists('sender', 'wh_approval_details')) {
    $CI->db->query('ALTER TABLE `'.db_prefix() . 'wh_approval_details` 
ADD COLUMN `sender` INT(11) NULL AFTER `action`,
ADD COLUMN `date_send` DATETIME NULL AFTER `sender`;');            
}

if (!$CI->db->table_exists(db_prefix() . 'wh_activity_log')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() .'wh_activity_log` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `rel_id` INT(11) NOT NULL,
  `rel_type` VARCHAR(45) NOT NULL,
  `staffid` INT(11) NULL,
  `date` DATETIME NULL,
  `note` TEXT NULL,
  PRIMARY KEY (`id`));');
}

//
if (!$CI->db->table_exists(db_prefix() . 'goods_delivery')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "goods_delivery` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `rel_type` int(11) NULL COMMENT 'type goods delivery',
      `rel_document` int(11) NULL COMMENT 'document id of goods delivery',
      `customer_code` text NULL,
      `customer_name` varchar(100) NULL,
      `to_` varchar(100) NULL,
      `address` varchar(100) NULL,
      `description` text NULL COMMENT 'the reason delivery',
      `staff_id` int(11) NULL COMMENT 'salesman',
      `date_c` date NULL ,
      `date_add` date NULL,
      `goods_delivery_code` varchar(100) NULL COMMENT 'số chứng từ xuất kho',
      `approval` INT(11) NULL DEFAULT 0 COMMENT 'status approval ',
      `addedfrom` INT(11) ,

      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}

if (!$CI->db->table_exists(db_prefix() . 'goods_delivery_detail')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "goods_delivery_detail` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `goods_delivery_id` int(11) NOT NULL,
      `commodity_code` varchar(100) NULL,
      `commodity_name` text NULL,
      `warehouse_id` text NULL,
      `unit_id` text NULL,
      `quantities` text NULL,
      `unit_price` varchar(100) NULL,
      `note` text NULL ,

      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}


if (!$CI->db->table_exists(db_prefix() . 'stock_take')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "stock_take` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `description` text NULL COMMENT 'the reason stock take',
      `warehouse_id` int(11) NULL ,
      `date_stock_take` date NULL ,
      `stock_take_code` varchar(100) NULL COMMENT 'số kiểm kê kho',
      `date_add` date NULL,
      `hour_add` date NULL,
      `staff_id` varchar(100) NULL,
      `approval` INT(11) NULL DEFAULT 0 COMMENT 'status approval ',
      `addedfrom` INT(11) ,

      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}

if (!$CI->db->table_exists(db_prefix() . 'stock_take_detail')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "stock_take_detail` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `stock_take_id` int(11) NOT NULL,
      `commodity_code` varchar(100) NULL,
      `commodity_name` text NULL,
      `unit_id` text NULL,
      `unit_price` varchar(100) NULL,
      `quantity_stock_take` varchar(100) NULL,
      `quantity_accounting_book` varchar(100) NULL,
      `quantity_change` varchar(100) NULL,
      `handling` text NULL ,
      `reason` text NULL ,
      `approval` INT(11) NULL DEFAULT 0 COMMENT 'status approval ',

      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}

/*add column to table tblitem*/
if (!$CI->db->field_exists('sku_code' ,db_prefix() . 'items')) { 
  $CI->db->query('ALTER TABLE `' . db_prefix() . "items`
      ADD COLUMN `sku_code` varchar(200)  NULL
  ;");
}
if (!$CI->db->field_exists('sku_name' ,db_prefix() . 'items')) { 
  $CI->db->query('ALTER TABLE `' . db_prefix() . "items`
      ADD COLUMN `sku_name` varchar(200)  NULL
  ;");
}
if (!$CI->db->field_exists('purchase_price' ,db_prefix() . 'items')) { 
  $CI->db->query('ALTER TABLE `' . db_prefix() . "items`
      ADD COLUMN `purchase_price` decimal(15,2)  NULL
  ;");
}
if (!$CI->db->field_exists('sub_group' ,db_prefix() . 'items')) { 
  $CI->db->query('ALTER TABLE `' . db_prefix() . "items`
      ADD COLUMN `sub_group` varchar(200)  NULL
  ;");
}
if (!$CI->db->table_exists(db_prefix() . 'wh_sub_group')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "wh_sub_group` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `sub_group_code` varchar(100) NULL,
      `sub_group_name` text NULL,
      `order` int(10) NULL,
      `display` int(1) NULL COMMENT  'display 1: display (yes)  0: not displayed (no)',
      `note` text NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}

if (!$CI->db->table_exists(db_prefix() . 'ware_color')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "ware_color` (
      `color_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `color_code` varchar(100) NULL,
      `color_name` varchar(100) NULL,
      `color_hex` text NULL,
      `order` int(10) NULL,
      `display` int(1) NULL COMMENT  'display 1: display (yes)  0: not displayed (no)',
      `note` text NULL,
      PRIMARY KEY (`color_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}

if (!$CI->db->field_exists('commodity_name' ,db_prefix() . 'items')) {
  $CI->db->query('ALTER TABLE `' . db_prefix() . "items`
      ADD COLUMN `commodity_name` varchar(200) NOT NULL
  ;");
}
if (!$CI->db->field_exists('color' ,db_prefix() . 'items')) { 
  $CI->db->query('ALTER TABLE `' . db_prefix() . "items`
      ADD COLUMN `color` text NULL
  ;");
}
if (!$CI->db->field_exists('date_manufacture', 'inventory_manage')) {
    $CI->db->query('ALTER TABLE `'.db_prefix() . 'inventory_manage` 
    ADD COLUMN `date_manufacture` date NULL AFTER `inventory_number`,
    ADD COLUMN `expiry_date` date NULL AFTER `date_manufacture`;');            
}

if (!$CI->db->field_exists('warehouse_id', 'goods_receipt')) {
    $CI->db->query('ALTER TABLE `'.db_prefix() . 'goods_receipt` 
    ADD COLUMN `warehouse_id` int(11) NULL AFTER `goods_receipt_code`
    ;');            
}

if (!$CI->db->field_exists('date_manufacture', 'goods_receipt_detail')) {
    $CI->db->query('ALTER TABLE `'.db_prefix() . 'goods_receipt_detail` 
    ADD COLUMN `date_manufacture` date NULL AFTER `goods_money`,
    ADD COLUMN `expiry_date` date NULL AFTER `date_manufacture`;');            
}


if (!$CI->db->table_exists(db_prefix() . 'wh_loss_adjustment')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "wh_loss_adjustment` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,     
      `type` varchar(15) NULL,     
      `addfrom` int(11) NULL,    
      `reason` LONGTEXT NULL,   
      `time` datetime NULL,
      `date_create` date NOT NULL,
      `status` int NOT NULL,  
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}

if (!$CI->db->field_exists('warehouses' ,db_prefix() . 'wh_loss_adjustment')) { 
  $CI->db->query('ALTER TABLE `' . db_prefix() . "wh_loss_adjustment`
  ADD COLUMN `warehouses` int(11) NOT NULL AFTER `status`
  ;");
}

if (!$CI->db->table_exists(db_prefix() . 'wh_loss_adjustment_detail')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "wh_loss_adjustment_detail` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `items` int(11) NULL, 
      `unit` int(11) NULL,
      `current_number` int(15) NULL,     
      `updates_number` int(15) NULL, 
      `loss_adjustment` INT(11) NULL,       
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}


if (!$CI->db->field_exists('total_money', 'goods_delivery')) {
    $CI->db->query('ALTER TABLE `'.db_prefix() . 'goods_delivery` 
    ADD COLUMN `total_money` varchar(200) NULL AFTER `goods_delivery_code`
    ;');            
}

if (!$CI->db->field_exists('total_money', 'goods_delivery_detail')) {
    $CI->db->query('ALTER TABLE `'.db_prefix() . 'goods_delivery_detail` 
    ADD COLUMN `total_money` varchar(200) NULL AFTER `unit_price`
    ;');            
}

if (!$CI->db->field_exists('warehouse_id', 'goods_delivery')) {
    $CI->db->query('ALTER TABLE `'.db_prefix() . 'goods_delivery` 
    ADD COLUMN `warehouse_id` int(11) NULL AFTER `goods_delivery_code`
    ;');            
}

if ($CI->db->field_exists('goods_id', 'goods_transaction_detail')) {
    $CI->db->query('ALTER TABLE `'.db_prefix() . 'goods_transaction_detail` 
    DROP PRIMARY KEY,
    ADD PRIMARY KEY (`id`, `commodity_id`, `warehouse_id`);');            
}

if (!$CI->db->field_exists('old_quantity', 'goods_transaction_detail')) {
    $CI->db->query('ALTER TABLE `'.db_prefix() . 'goods_transaction_detail` 
    ADD COLUMN `old_quantity` varchar(100) NULL AFTER `goods_id`
    ;');            
}