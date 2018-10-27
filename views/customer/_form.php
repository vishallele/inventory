<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
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

        <div class="col-md-6">

            <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'contact_person_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'alt_phone')->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-md-6">

            <?= $form->field($model, 'address_1')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'address_2')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'zipcode')->textInput(['maxlength' => true]) ?>

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
    

  


    
