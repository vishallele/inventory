<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BillMaster */

$this->title = 'Bill Invoice';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
</section>

<section class="content">
    <?= $this->render('_form', [
        'model' => $model,
        'arrBillDetails' => $arrBillDetails,
        'form_title' => 'Create New Bill',
        'button_text' => 'Generate Bill',
        'spare_parts' =>$spare_parts,
        'customers' => $customers,
        'unique_invoice_no' => $unique_invoice_no
    ]) ?>
</section>
