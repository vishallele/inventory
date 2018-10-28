<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BillMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>

<div class="box">

    <div class="box-header with-border">
        <h2 class="box-title"><?php echo $form_title; ?></h2>

        <div class="box-tools pull-right">
       
        </div>
    </div>

    <div class="box-body">

        <div class="row">

            <div class="col-md-3">

            <?= $form->field($model, 'purchase_order_no')->textInput(['maxlength' => true]) ?>

            </div>

            <div class="col-md-3">

            <?= $form->field($model, 'purchase_order_no')->textInput(['maxlength' => true]) ?>

            </div>

            <div class="col-md-3">

            <?= $form->field($model, 'bill_date')->textInput() ?>

            </div>

            <div class="col-md-3">

            <?= $form->field($model, 'bill_due_date')->textInput() ?>

            </div>

        </div>

        <div class="row">

            <div class="col-md-10 col-md-offset-1">

            <table class="table table-bordered">

                <thead>

                    <tr>
                        <th>Spare Part Code</th>
                        <th>Description</th>
                        <th>HSN No.</th>
                        <th>Rate</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                    </tr>

                </thead>

                <tbody>
            
                <?php  foreach ($arrBillDetails as $index => $BillDetails) { ?>

                    <tr>

                        <td> 
                            <?= $form->field($BillDetails, "[$index]spare_part_id")->label(false); ?>
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

                    </tr>

                <?php
                    }
                ?>

                </tbody>
                
            </table>

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