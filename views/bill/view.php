<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\BillMaster */

$this->title = $model->id;

$subtotal = 0;
$gst = 0;
$cgst = 0; 
$igst = 0;
$total_amount = 0;
?>

<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        Bill Invoice
        <small><?= $model->bill_no; ?></small>
      </h1>      
</section>

<section class="invoice">

      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Accord Engineering
          </h2>
        </div>
        <!-- /.col -->
      </div>

      <!-- info row -->
      <div class="row invoice-info">
        <!-- /.col -->
        <div class="col-sm-6 invoice-col">
          To
          <address>
            <strong><?= $model->customer->company_name; ?></strong><br>
            <?php echo (!empty($model->customer->address_1)) ? $model->customer->address_1.',' : ''; ?>
            <?php echo (!empty($model->customer->address_2)) ? $model->customer->address_2.',' : ''; ?><br>
            <?php echo (!empty($model->customer->city)) ? $model->customer->city.',' : ''; ?> <?php echo (!empty($model->customer->state)) ? $model->customer->state.',' : ''; ?>
            <?php echo (!empty($model->customer->zipcode)) ? '- '.$model->customer->zipcode.',' : ''; ?>
            <br>
            Phone: <?php echo (!empty($model->customer->phone)) ? '- '.$model->customer->phone.',' : ''; ?><br>
            Email: <?php echo (!empty($model->customer->email)) ? '- '.$model->customer->email.',' : ''; ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-6 invoice-col">
          <br/>
          <b>Bill Invoice No: <?= $model->bill_no; ?></b><br>
          <b>PO No: </b><?= $model->purchase_order_no; ?><br>
          <b>Bill Date: </b><?= date('d M Y', strtotime($model->bill_date)); ?><br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Sr. No.</th>
              <th>Drg. No.</th>
              <th>Perticulars</th>
              <th>HSN No.</th>
              <th>Qty.</th>
              <th>Rate</th>
              <th style="text-align:right;">Amount</th>
            </tr>
            </thead>
            <tbody>
              <?php if(!empty($model->billDetails)) { $r = 1; ?>
                <?php foreach( $model->billDetails as $billDetail ) { ?>
                      <tr>
                        <td><?= $r; ?></td>
                        <td><?= $billDetail->sparePart->spare_part_serial_no; ?></td>
                        <td><?= $billDetail->sparePart->spare_part_name; ?></td>
                        <td><?= $billDetail->sparePart->spare_part_hsn_no; ?></td>
                        <td><?= $billDetail->quantity; ?></td>
                        <td><?= $billDetail->rate; ?></td>
                        <?php $amt = $billDetail->quantity * $billDetail->rate; ?>
                        <td style="text-align:right;"><?= number_format( $amt, 2 ); ?></td>
                      </tr>
                      <?php $subtotal += $amt; ?>
              <?php $r++; } } ?>
              
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-4">
          <p class="lead">GST No. : 27AAJPZ6121C1ZN</p>
          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            I/We hereby certify that my/our registration certificate under the GST ACT 2017 is in force
            on the date on which the supply of the goods specified in this tax invoice is made by me/us
            and that the transaction of supplies covered by this tax invoice has been effected by me/us
            and it shall be accounted for in the turnover of supplies while filling of return and the due
            tax if any.
          </p>
        </div>
        <div class="col-xs-4">
          <p class="lead">Company Bank Detail's</p>
          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
               Bank Name: Union Bank of India, Saswad <br>
               A/c No.: 705801010050034 <br>
               IFSC Code : UBIN0570583   
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <div class="table-responsive">
            <table class="table">
              <?php 
                  $cgst = $subtotal*9/100;
                  $sgst = $subtotal*9/100;
                  $igst = $cgst + $sgst;
              ?>
              <tr>
                <th style="width:50%;text-align:right;">Subtotal:</th>
                <td style="text-align:right;"><?= number_format( $subtotal, 2 ); ?></td>
              </tr>
              <tr>
                <th style="text-align:right;">CGST (<?= $model->bill_cgst_rate.'%';?>)</th>
                <td style="text-align:right;"><?= number_format( $cgst, 2 ); ?></td>
              </tr>
              <tr>
                <th style="text-align:right;">SGST (<?= $model->bill_sgst_rate.'%';?>)</th>
                <td style="text-align:right;"><?= number_format( $sgst, 2 ); ?></td>
              </tr>
              <tr>
                <th style="text-align:right;">IGST (18%)</th>
                <td style="text-align:right;"><?= number_format( $igst, 2 ); ?></td>
              </tr>
              <tr>
                <th style="text-align:right;">Total Amount</th>
                <td style="text-align:right;"><?= number_format( $model->bill_total_amount, 2); ?></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">

      </div>

      <div class="row clearfix">
        <br/><br/><br/>
        <div class="col-xs-12">
           <p class="lead pull-left">Recievers Signature</p>       
           <p class="lead pull-right">For Accord Engineering Solutions.</p>
        </div>
      </div>


      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="#" target="_blank" class="btn btn-default printMe"><i class="fa fa-print"></i> Print</a>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>

<?php 

$this->registerJs('
                 
    $(".printMe").click(function(){
      window.print();
    });

',View::POS_READY,'bill-invoice-print');

?>