  <div class="col-md-12">
     <?php echo form_open_multipart(admin_url('warehouse/stock_summary_report_pdf'), array('id'=>'print_report')); ?>

    <div class="col-md-6 pull-right">
      <div class="col-md-4">
        <?php echo render_date_input('from_date','from_date',date('Y-m-d',strtotime('-7 day',strtotime(date('Y-m-d'))))); ?>
      </div>
      <div class="col-md-4">
        <?php echo render_date_input('to_date','to_date',date('Y-m-d')); ?>
      </div>
      <div class="col-md-2 button-pdf-margin-top">
        <div class="form-group">
          <div class="btn-group">
           <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file-pdf-o"></i><?php if(is_mobile()){echo ' PDF';} ?> <span class="caret"></span></a>
           <ul class="dropdown-menu dropdown-menu-right">
              <li class="hidden-xs"><a href="?output_type=I" target="_blank" onclick="stock_submit(this); return false;"><?php echo _l('download_pdf'); ?></a></li>
             
           </ul>
           </div>
         </div>
      </div>
      <div class="col-md-2" >
        <a href="#" onclick="get_data_stock_summary_report(); return false;" class="btn btn-info display-block button-pdf-margin-top" ><?php echo _l('ok'); ?></a>
      </div>

    </div>

    <?php echo form_close(); ?>
  </div>
<hr class="hr-panel-heading" />
  <div class="col-md-12" id="report">
      <div class="panel panel-info col-md-12 panel-padding">
      
        <div class="panel-body" id="stock_s_report">
            <p><h3 class="bold text-center"><?php echo mb_strtoupper(_l('stock_summary_report')); ?></h3></p>

            <div class="col-md-12">
             <table class="table table-bordered">
              <tbody>
               <tr>
                 <th colspan="1">ID</th>
                 <th colspan="1"><?php echo _l('commodity_code') ?></th>
                 <th colspan="1"><?php echo _l('commodity_name') ?></th>
                 <th colspan="1"><?php echo _l('unit_name') ?></th>
                 <th colspan="2" class="text-center"><?php echo _l('opening_stock') ?></th>
                 <th colspan="2" class="text-center"><?php echo _l('receipt_in_period') ?></th>
                 <th colspan="2" class="text-center"><?php echo _l('issue_in_period') ?></th>
                 <th colspan="2" class="text-center"><?php echo _l('closing_stock') ?></th>
                </tr>
                <tr>
                 <th></th>
                 <th></th>
                 <th></th>
                 <th></th>
                 <th><?php echo _l('quantity') ?></th>
                 <th><?php echo _l('Amount') ?></th>
                 <th><?php echo _l('quantity') ?></th>
                 <th><?php echo _l('Amount') ?></th>
                 <th><?php echo _l('quantity') ?></th>
                 <th><?php echo _l('Amount') ?></th>
                 <th><?php echo _l('quantity') ?></th>
                 <th><?php echo _l('Amount') ?></th>
                </tr>

                <tr>
                  <td>.....</td>
                  <td>.....</td>
                  <td>.....</td>
                  <td>.....</td>
                  <td>.....</td>
                  <td>.....</td>
                  <td>.....</td>
                  <td>.....</td>
                  <td>.....</td>
                  <td>.....</td>
                  <td>.....</td>
                  <td>.....</td>
                </tr>
                <tr>
                 <th colspan="4" class="text-right"><?php echo _l('total') ?> : </th>
                 <th colspan="1"></th>
                 <th colspan="1"></th>
                 <th colspan="1"></th>
                 <th colspan="1"></th>
                 <th colspan="1"></th>
                 <th colspan="1"></th>
                 <th colspan="1"></th>
                 <th colspan="1"></th>
                 
                </tr>
              </tbody>
            </table>
          </div>

           

            <br>
              

            <br>
            <br>
            <br>
            <br>

        </div>
      </div>
  </div>
