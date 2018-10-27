<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */

$this->title = 'Customer';

?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
</section>

<section class="content">
    <?= $this->render('_form', [
            'model' => $model,
            'form_title' => 'Add New Customer',
            'button_text' => 'Save'
    ]) ?>
</section>
