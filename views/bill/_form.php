<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\BillMaster */
/* @var $form yii\widgets\ActiveForm */

$this->registerCssFile("@web/css/select2.min.css", [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()],
], 'css-select2');

?>

<?php $form = ActiveForm::begin(); ?>

<div class="box">

    <div class="box-header with-border">
        <h2 class="box-title">Bill Information</h2>

        <div class="box-tools pull-right">
       
        </div>
    </div>

    <div class="box-body">

        <div class="row">

            <div class="col-md-6">

                <?= $form->field($model, 'purchase_order_no')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'purchase_order_no')->textInput(['maxlength' => true]) ?>

            </div>


            <div class="col-md-6">

                <?= $form->field($model, 'bill_date')->textInput() ?>

                <?= $form->field($model, 'bill_due_date')->textInput() ?>

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
                        'spare_part_hsn_no',
                        'rate',
                        'quantity',
                        'amount',
                    ],
            ]); ?>

            <table class="table table-bordered">

                <thead>

                    <tr>
                        <th>Spare Part Code</th>
                        <th>Description</th>
                        <th>HSN No.</th>
                        <th>Rate</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>&nbsp;</th>
                    </tr>

                </thead>

               

                <tbody class="container-items">
            
                
                <?php  $i = 0; foreach ($arrBillDetails as $index => $BillDetails) { ?>

                    <tr class="item">

                        <td> 
                            <?= $form->field($BillDetails, "[$index]spare_part_id")
                                    ->dropDownList($spare_parts,['prompt'=>'Select spare part','class' => 'form-control select2'])
                                    ->label(false); 
                            ?>
                        </td>

                        <td> 
                            <?= $form->field($BillDetails, "[$index]spare_part_description")->label(false); ?>
                        </td>

                        <td> 
                            <?= $form->field($BillDetails, "[$index]spare_part_hsn_no")->label(false); ?>
                        </td>

                        <td> 
                            <?= $form->field($BillDetails, "[$index]rate")->label(false); ?>
                        </td>

                        <td> 
                            <?= $form->field($BillDetails, "[$index]quantity")->label(false); ?>
                        </td>

                        <td> 
                            <?= $form->field($BillDetails, "[$index]amount")->label(false); ?>
                        </td>

                        <td> 
                            <div class="btn-group-vertical">
                                <?= Html::a('Add', ['#'], ['class' => 'btn btn-sm btn-success add_bill_row']) ?> 

                                <?php
                                    if($i !== 0 ) { 
                                        echo Html::a('Delete', ['#'], ['class' => 'btn btn-sm btn-danger remove_bill_row']);
                                    }
                                ?>
                            </div>
                        </td>

                    </tr>

                <?php
                        $i++;
                    }
                ?>

                </tbody>

                
                
            </table>

            <?php DynamicFormWidget::end(); ?>

            </div>

        </div>

    </div>

    <!-- /.box-body -->
    <div class="box-footer">
        <div class="pull-right" style="margin-right:10px;">
            <?= Html::submitButton( $button_text, ['class' => 'btn btn-flat btn-success']) ?>
            <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-flat btn-danger']) ?>
        </div>
    </div>
    <!-- /.box-footer--> 

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
        
        ",
        View::POS_READY,
        'initialize-select2-box'
    )

?>