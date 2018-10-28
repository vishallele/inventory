<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BillMaster */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bill Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bill-master-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'customer_id',
            'bill_no',
            'purchase_order_no',
            'bill_date',
            'bill_due_date',
            'bill_subtotal_amount',
            'bill_total_amount',
            'bill_paid_amount',
            'bill_cgst_rate',
            'bill_sgst_rate',
            'bill_igst_rate',
            'is_active',
            'is_deleted',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
