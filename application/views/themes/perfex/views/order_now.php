<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
table {
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th {
  cursor: pointer;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2
}
#myInput {
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}
</style>
<div class="panel_s section-heading section-items">
    <div class="panel-body">
        <h4 class="no-margin section-text"><?php echo $title; ?></h4>
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    </div>
</div>
<div class="panel_s">
 <div class="panel-body">
    <button class="btn btn-info pull-right display-block mr-4 button-margin-r-b" style="margin-bottom: 20px" onclick="func_send_order()">Send</button>
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search" title="Type in a name">
    <table id="myTable">
        <tr>
            <th onclick="sortTable(0)" class="th-item-code" style="width: 8%">Item Code</th>
            <th onclick="sortTable(1)" class="th-item-photo" style="width: 22%">Photo</th>
            <th onclick="sortTable(2)" class="th-item-description" style="width: 15%">Item Description / Details</th>
            <th onclick="sortTable(3)" class="th-item-category" style="width: 15%">Category</th>
            <th onclick="sortTable(4)" class="th-item-stock" style="width: 10%">Stock</th>
            <th onclick="sortTable(5)" class="th-item-cost" style="width: 14%">Cost</th>
            <th onclick="sortTable(6)" class="th-item-qty" style="width: 16%">Quantity</th>
        </tr>
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
                <td data-order="<?php echo $item['group_name']; ?>"><?php echo $item['group_name']; ?></td>
                <td data-order="<?php echo $item['unit']; ?>"><?php echo $item['unit']; ?></td>
                <td data-order="<?php echo $item['rate']; ?>"><?php echo $item['rate']; ?></td>
                <td data-order="<?php echo $item['rate']; ?>"><input type="number" name="order_qty" id="<?php echo $item['id'];?>" value1="<?php echo $item['id']; ?>" style="height: 24px"></td>
            </tr>
        <?php } ?>
    </table>
</div>
</div>
