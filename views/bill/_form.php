<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\BillMaster */
/* @var $form yii\widgets\ActiveForm */

$this->registerCssFile("@web/css/select2.min.css", [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()],
], 'css-select2');

?>

<?php $form = ActiveForm::begin(); ?>


<?= $form->field($model, 'bill_subtotal_amount')->hiddenInput()->label(false); ?>
<?= $form->field($model, 'bill_total_amount')->hiddenInput()->label(false); ?>
<?= $form->field($model, 'bill_paid_amount')->hiddenInput()->label(false); ?>
<?= $form->field($model, 'bill_cgst_rate')->hiddenInput(['value' => 9])->label(false); ?>
<?= $form->field($model, 'bill_sgst_rate')->hiddenInput(['value' => 9])->label(false); ?>
<?= $form->field($model, 'bill_igst_rate')->hiddenInput(['value' => 9])->label(false); ?>
<?= $form->field($model, 'bill_no')->hiddenInput(['value' => $unique_invoice_no])->label(false); ?>

<div class="row">

<div class="col-md-9">

<div class="box">

    <div class="box-header with-border">
        <h2 class="box-title">Bill Information</h2>

        <div class="box-tools pull-right">
       
        </div>
    </div>

    <div class="box-body">

        <div class="row">

            <div class="col-md-6">

                <?= $form->field($model, 'customer_id')->dropDownList($customers,['prompt'=>'Select company name','class' => 'form-control select2']); ?>

                <?= $form->field($model, 'purchase_order_no')->textInput(['maxlength' => true]) ?>

            </div>


            <div class="col-md-6">

                <?= $form->field($model, 'bill_date')->widget(DatePicker::classname(), [
                        'options' => [
                            'placeholder' => 'Bill Date',
                            'value' => ( $model->isNewRecord ) ? date('j M Y') : Yii::$app->formatter->asDate($model->bill_date) 
                        ],
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'format' => 'd M yyyy'
                        ]
                    ]); 
                ?>

                <?= $form->field($model, 'purchase_order_date')->widget(DatePicker::classname(), [
                        'options' => [
                            'placeholder' => 'Purchase Order Date',
                            'value' => (!empty($model->purchase_order_date)) ? Yii::$app->formatter->asDate($model->purchase_order_date) : ''
                        ],
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'format' => 'd M yyyy'
                        ]
                    ]); 
                ?>

            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'dispatched_by'); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'vehicle_number'); ?>
            </div>
        </div>

    </div>

</div>

<div class="box">

    <div class="box-header with-border">
        <h2 class="box-title">Bill Details</h2>

        <div class="box-tools pull-right">
    
        </div>
    </div>

    <div class="box-body">

        <div class="row">

            <div class="col-md-12">

             <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'limit' => 999, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add_bill_row', // css class
                    'deleteButton' => '.remove_bill_row', // css class
                    'model' => $arrBillDetails[0],
                    'formId' => 'w0',
                    'formFields' => [
                        'spare_part_id',
                        'spare_part_description',
                        'rate',
                        'quantity',
                        'amount',
                    ],
            ]); ?>

            <table class="table table-bordered">

                <thead>

                    <tr>
                        <th style="width:25%">Spare Part Code</th>
                        <th style="width:30%">Description</th>
                        <th style="width:16%">Rate</th>
                        <th>Quantity</th>
                        <th style="width:16%">Amount</th>
                        <th>&nbsp;</th>
                    </tr>

                </thead>

               

                <tbody class="container-items">
            
                
                <?php  $i = 0; foreach ($arrBillDetails as $index => $BillDetails) { ?>
                    
                    <?php
                            // necessary for update action.
                            if (! $BillDetails->isNewRecord) {
                                echo Html::activeHiddenInput($BillDetails, "[{$i}]id");
                            }
                    ?>

                    <tr class="item">

                        <td> 
                            <?= $form->field($BillDetails, "[$index]spare_part_id")
                                    ->dropDownList($spare_parts,['prompt'=>'Select spare part','class' => 'form-control select2 spare_box'])
                                    ->label(false); 
                            ?>
                        </td>

                        <td> 
                            <?php if($BillDetails->isNewRecord){ ?>
                                <?= $form->field($BillDetails, "[$index]spare_part_description")->label(false); ?>
                            <?php } else { ?>
                                <?= $form->field($BillDetails, "[$index]spare_part_description")->textInput(['value' => $BillDetails->sparePart->spare_part_name])->label(false); ?>
                            <?php } ?>
                        </td>

                        <td> 
                            <?= $form->field($BillDetails, "[$index]rate")->textInput(['class' => 'form-control rt'])->label(false); ?>
                        </td>

                        <td> 
                            <?= $form->field($BillDetails, "[$index]quantity")->textInput(['class' => 'form-control qty'])->label(false); ?>
                        </td>

                        <td>
                            <?php if($BillDetails->isNewRecord){ ?>
                                <?= $form->field($BillDetails, "[$index]amount")->textInput(['class' => 'form-control amt'])->label(false); ?>
                            <?php 
                                 } else { 
                                 $amount = $BillDetails->rate * $BillDetails->quantity;
                            ?>
                                <?= $form->field($BillDetails, "[$index]amount")->textInput(['class' => 'form-control amt','value' => $amount])->label(false); ?>
                            <?php } ?>
                        </td>

                        <td> 
                            <div class="btn-group-vertical">
                                <?= Html::a('Add', ['#'], ['class' => 'btn btn-sm btn-success add_bill_row']) ?> 
                                <?= Html::a('Delete', ['#'], ['class' => 'btn btn-sm btn-danger remove_bill_row']); ?>
                            </div>
                        </td>

                    </tr>

                <?php                        
                    }
                ?>

                </tbody>

                
                
            </table>

            <?php DynamicFormWidget::end(); ?>

            </div>

        </div>

    </div> 

</div>

</div>

<!-- Bill Invoice Amount Details -->
<div class="col-md-3">
    <div class="box box-primary">
        <div class="box-body box-profile">
            <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
                <b>Sub Total</b> 
                <a class="pull-right" id="sbtot">
                    <?= ( $model->isNewRecord ) ? '0.00' : $model->bill_subtotal_amount; ?>
                </a>
            </li>
            <?php 
                if( !$model->isNewRecord ){
                    $cgst = $model->bill_subtotal_amount*9/100;
                    $sgst = $model->bill_subtotal_amount*9/100;
                    $igst = $cgst + $sgst;
                }
            ?>
            <li class="list-group-item">
                <b>CGST (9%)</b> 
                <a class="pull-right" id="cgst">
                    <?= ( $model->isNewRecord ) ? '0.00' : number_format( $cgst, 2 ); ?>
                </a>
            </li>
            <li class="list-group-item">
                <b>SGST (9%)</b>
                <a class="pull-right" id="sgst">
                    <?= ( $model->isNewRecord ) ? '0.00' : number_format( $sgst, 2 ); ?>
                </a>
            </li>
            <li class="list-group-item">
                <b>IGST (18%)</b> 
                <a class="pull-right" id="igst">
                    <?= ( $model->isNewRecord ) ? '0.00' : number_format( $igst, 2); ?>
                </a>
            </li>

            <li class="list-group-item">
                <b>Total Amount</b> 
                <a class="pull-right" id="totamt">
                    <?= ( $model->isNewRecord ) ? '0.00' : $model->bill_total_amount; ?>
                </a>
            </li>

            <li class="list-group-item">
                <b>Amount Paid</b> 
                <a class="pull-right" id="amtpaid">
                    <?= ( $model->isNewRecord ) ? '0.00' : $model->bill_paid_amount; ?>
                </a>
            </li>

            <li class="list-group-item">
                <b>Balance</b> 
                <a class="pull-right" id="balanceamt">
                    <?= number_format(($model->bill_total_amount - $model->bill_paid_amount),2); ?>
                </a>
            </li>

            </ul>
            <?= Html::submitButton( $button_text, ['class' => 'btn btn-block btn-success']) ?>
            <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-block btn-danger']) ?>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>

</div>

<?php ActiveForm::end(); ?>

<?php 
    $this->registerJsFile(
        '@web/js/select2.full.min.js',
        ['depends' => [app\assets\AppAsset::className()]]
    ); 

    $this->registerJs(
        "
        $('.select2').select2();
        
        $('.dynamicform_wrapper').on('afterInsert', function(e, item) {
            $('.select2').select2();
        });
        
        $(document).on('change','.spare_box',function(){
            var row_id = $(this).attr('id').split('-')[1];
            var quantity = 0;
            var rate = 0;
            var total = 0;
            $.ajax({
                url: '".\Yii::$app->getUrlManager()->createUrl('spare-part/spare-details')."',
                type: 'POST',
                 data: { spare_part_id: $(this).val() },
                 success: function(data) {
                     data = JSON.parse(data);
                     if(data.code === 500 ) {
                        alert('Exception Occured in System.');
                        return false;
                     }

                     $('#billdetails-'+row_id+'-spare_part_description').val(data.spare_part_details.spare_part_name);
                     //$('#billdetails-'+row_id+'-spare_part_hsn_no').val(data.spare_part_details.spare_part_hsn_no);
                     $('#billdetails-'+row_id+'-rate').val(data.spare_part_details.spare_part_rate);

                     quantity = $('#billdetails-'+row_id+'-quantity').val();
                     rate = data.spare_part_details.spare_part_rate;
                     total = quantity * rate;
                     $('#billdetails-'+row_id+'-amount').val(total.toFixed(2));

                     $('.amt').trigger('change');
                 }
            });
        });

        $(document).on('change','.rt,.qty',function(){
            var row_id = $(this).attr('id').split('-')[1];
            var quantity = $(this).val();
            var total = 0;
            var rate = $('#billdetails-'+row_id+'-rate').val();
            total = quantity * rate;
            $('#billdetails-'+row_id+'-amount').val(total.toFixed(2));
            $('.amt').trigger('change');
            $('.amt-paid').trigger('change');
        });

        $(document).on('change','.amt',function(){
           var subtotal = 0; 
           var cgst = 0;
           var sgst = 0;
           var igst = 0;
           var total_amount = 0;

           $('.amt').each(function(){
               var str = this.value.trim();
               if(str) {
                subtotal += parseInt(str,10)
               }
           });

           $('#sbtot').text(subtotal.toFixed(2));

           if( subtotal != 0 && subtotal != 0.00 ) {
                //calculate cgst and sgst which is 9% of amount
                cgst = subtotal*9/100;
                sgst = subtotal*9/100;
                igst = cgst + sgst;
                total_amount = igst + subtotal;

                $('#cgst').text(cgst.toFixed(2));
                $('#sgst').text(sgst.toFixed(2));
                $('#igst').text(igst.toFixed(2));
                $('#totamt').text(total_amount.toFixed(2));

                $('#billmaster-bill_subtotal_amount').val(subtotal.toFixed(2));
                $('#billmaster-bill_total_amount').val(total_amount.toFixed(2));
           } else {
                $('#cgst').text(cgst.toFixed(2));
                $('#sgst').text(sgst.toFixed(2));
                $('#igst').text(igst.toFixed(2));
                $('#totamt').text(total_amount.toFixed(2));

                $('#billmaster-bill_subtotal_amount').val(subtotal.toFixed(2));
                $('#billmaster-bill_total_amount').val(total_amount.toFixed(2));
           }

        });

        $('.dynamicform_wrapper').on('afterDelete', function(e) {
            $('.amt').trigger('change');
            $('.amt-paid').trigger('change');
        });

        $('.amt-paid').on('change',function(e){
            var total_amount = 0;
            var amount_paid = 0;
            var balance = 0;

            total_amount = parseInt( $('#billmaster-bill_total_amount').val());
            amount_paid = parseInt($(this).val());
            if( total_amount && amount_paid ) {
                if( amount_paid > total_amount ){
                    alert('Amount paid should be less than total amount.');
                    $(this).val('0.00');
                    $('#billmaster-bill_paid_amount').val('0.00');
                    $('#amtpaid').text('0.00');
                    $('#balanceamt').text('0.00');
                    return false;
                }
                balance = ( total_amount - amount_paid );
                $('#billmaster-bill_paid_amount').val(amount_paid.toFixed(2));
                $('#amtpaid').text(amount_paid.toFixed(2));
                $('#balanceamt').text(balance.toFixed(2));
            } else {
                $(this).val('0.00');
                $('#billmaster-bill_paid_amount').val('0.00');
                $('#amtpaid').text('0.00');
                $('#balanceamt').text('0.00');
            }
        });

        ",
        View::POS_READY,
        'initialize-select2-box'
    )

?>