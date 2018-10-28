<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BillSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bill-master-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'customer_id') ?>

    <?= $form->field($model, 'bill_no') ?>

    <?= $form->field($model, 'purchase_order_no') ?>

    <?= $form->field($model, 'bill_date') ?>

    <?php // echo $form->field($model, 'bill_due_date') ?>

    <?php // echo $form->field($model, 'bill_subtotal_amount') ?>

    <?php // echo $form->field($model, 'bill_total_amount') ?>

    <?php // echo $form->field($model, 'bill_paid_amount') ?>

    <?php // echo $form->field($model, 'bill_cgst_rate') ?>

    <?php // echo $form->field($model, 'bill_sgst_rate') ?>

    <?php // echo $form->field($model, 'bill_igst_rate') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'is_deleted') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
