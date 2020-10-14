<!DOCTYPE html>
<html>
<head>
    <title>Convert Table to PDF using JavaScript</title>
    <style>
        @font-face{
            font-family: Angsa;
            src:url(<?php echo base_url('/assets/angsa.ttf');?>);
        }
        table
        {
            width: 760px;
            font: 21px Angsa;
        }
        table, th, td 
        {
            border: solid 1px #DDD;
            border-collapse: collapse;
            padding: 2px 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="tab">
        <table> 
            <tr style="height: 100px">
                <td colspan="6">M.C.<br><br>asdfasfasdfasdfasdf</td>
            </tr>
            <tr style="height: 100px">
                <td colspan="2" style="width: 33%;text-align: left">Bill to:<?php echo $billing_street?><br>Ship to:<?php echo $shipping_street?></td>
                <td colspan="2" style="width: 33%">55577854</td>
                <td colspan="2" style="width: 33%;text-align: left">Inv.no:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $number;?><br>Date:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $date;?><br>Time:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $time;?></td>
            </tr>
            <tr style="height: 100px">
                <td colspan="4" style="width: 66%;text-align: left">Client Name:<?php echo $name;?><br>Client ID&nbsp&nbsp&nbsp:<?php echo $id?></td>
                <td colspan="2" style="width: 33%;text-align: left">Term of payment<br>Reference No<br>Due Date<br>Salesman Code</td>
            </tr>
        </table>
        <table style="margin-top: 5px"> 
            <tr>
                <th>No</th>
                <th>Description</th>
                <th>Qty</th>
                <th>Unit</th>
                <th>Price/Unit</th>
                <th>Discount</th>
                <th>Amount</th>
            </tr>
            <?php
                $i = 0;
                foreach($item as $row) {
                    echo '<tr>';
                    echo '<td>'. ++$i .'</td>';
                    echo '<td>'. $row->description .'</td>';
                    echo '<td>'. $row->qty .'</td>';
                    echo '<td>'. $row->unit .'</td>';
                    echo '<td>'. $row->rate .'</td>';
                    echo '<td>'. $row->vip .'%</td>';
                    echo '<td>'. app_format_number($row->rate * $row->qty * (100 - $row->vip) / 100).'</td>';
                    echo '</tr>';
                }
            ?>
        </table>
        <table style="margin-top: 100px">
            <tr>
                <td rowspan="3" style="width: 50%">dfasdfasdfadsf<br>asdfasdfa<br>adsfasdf<br>asdfasfasf</td>
                <td style="width: 35%;text-align: right;">Subtotal</td>
                <td style="width: 15%"><?php echo $subtotal;?></td>
            </tr>
            <tr>
                <td style="text-align: right;">Total Tax</td>
                <td><?php echo $total_tax;?></td>
            </tr>
            <tr>
                <td style="text-align: right;">Discount</td>
                <td><?php echo $discount;?></td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: right;">Total</td>
                <td><?php echo $total;?></td>
            </tr>
        </table>
        <table>
            <tr style="height: 130px">
                <td colspan="2" style="width: 35%"></td>
                <td style="width: 30%"></td>
                <td colspan="2" style="width: 35%"></td>
            </tr>
            <tr style="height: 40px">
                <td style="width: 20%">Receiver</td>
                <td style="width: 15%">Received Date</td>
                <td style="width: 30%">Deliverer</td>
                <td style="width: 17%">Collerctor</td>
                <td style="width: 17%">Authroized</td>
            </tr>
        </table>
    </div>
    <p>
        <input type="button" value="Create PDF" id="btPrint" onclick="createPDF()" />
    </p>
</body>
<script>
    function createPDF() {
        var sTable = document.getElementById('tab').innerHTML;

        var style = "<style>";
        style = style + "table {width: 100%;font: 17px Calibri;}";
        style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
        style = style + "padding: 2px 3px;text-align: center;}";
        style = style + "</style>";

        // CREATE A WINDOW OBJECT.
        var win = window.open('', '', 'height=700,width=700');

        win.document.write('<html><head>');
        win.document.write('<title>Invoice</title>');   // <title> FOR PDF HEADER.
        win.document.write(style);          // ADD STYLE INSIDE THE HEAD TAG.
        win.document.write('</head>');
        win.document.write('<body>');
        win.document.write(sTable);         // THE TABLE CONTENTS INSIDE THE BODY TAG.
        win.document.write('</body></html>');

        win.document.close(); 	// CLOSE THE CURRENT WINDOW.

        win.print();    // PRINT THE CONTENTS.
    }
</script>
</html>
