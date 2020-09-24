<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="panel_s section-heading section-items">
    <div class="panel-body">
        <h4 class="no-margin section-text"><?php echo $title; ?></h4>
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    </div>
</div>
<div class="panel_s">
 <div class="panel-body">
    <button class="btn btn-info pull-right display-block mr-4 button-margin-r-b" style="margin-bottom: 20px" onclick="func_send_order()">Send</button>
    <table class="table dt-table table-order" data-order-col="1" data-order-type="desc">
        <thead>
            <tr>
                <th class="th-item-code" style="width: 8%">Item Code</th>
                <th class="th-item-photo" style="width: 22%">Photo</th>
                <th class="th-item-description" style="width: 30%">Item Description / Details</th>
                <th class="th-item-stock" style="width: 10%">Stock</th>
                <th class="th-item-cost" style="width: 14%">Cost</th>
                <th class="th-item-qty" style="width: 16%">Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($items as $item){ ?>
                <tr>
                    <td data-order="<?php echo $item['commodity_code']; ?>"><?php echo $item['commodity_code']; ?></td>
                    <?php
                        if($item['image']!='') {
                            $image_url = base_url('/modules/warehouse/uploads/item_img/' . $item['id'] . '/' . $item['image']);
                            echo '<td data-order="' . $item['image'] . '"><img style="height:50px" class="images_w_table" src="' . $image_url . '" alt=""></td>';
                        }
                        else {
                            echo '<td data-order=""><img style="height:50px" class="images_w_table" src="'. base_url('/modules/warehouse/uploads/nul_image.jpg') . '" alt="null_image"></td>';
                        }
                    ?>
                    <td data-order="<?php echo $item['description']; ?>"><?php echo $item['description']; ?></td>
                    <td data-order="<?php echo $item['unit']; ?>"><?php echo $item['unit']; ?></td>
                    <td data-order="<?php echo $item['rate']; ?>"><?php echo $item['rate']; ?></td>
                    <td data-order="<?php echo $item['rate']; ?>"><input type="number" name="order_qty" id="<?php echo $item['id'];?>" value1="<?php echo $item['id']; ?>" style="height: 24px"></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>
