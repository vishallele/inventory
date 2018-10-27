<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SparePart */
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
        <div class="col-md-6 col-md-offset-3">
            <?= $form->field($model, 'spare_part_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'spare_part_serial_no')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'spare_part_hsn_no')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'spare_part_rate')->textInput(['maxlength' => true]) ?>
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