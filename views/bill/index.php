<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Customer;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BillSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bill Masters';

?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
</section>

<section class="content">

    <div class="box">

        <div class="box-header">
            <h3 class="box-title">Bill Invoices</h3>

            <div class="box-tools pull-right">
                <?= Html::a('Add New bill', ['create'], ['class' => 'btn btn-flat btn-danger']) ?>
            </div>
        </div>

        <div class="box-body">
            <?php Pjax::begin(); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'label' => 'Company Name',
                            'attribute' => 'customer',
                            'value' => 'customer.company_name',
                            'filter' => Html::activeDropDownList($searchModel, 'customer_id', ArrayHelper::map(Customer::find()->asArray()->all(), 'id', 'company_name'),['class'=>'form-control select2','prompt' => 'Select Company Name']),
                        ],
                        'bill_no',
                        'purchase_order_no',
                        'bill_date',
                        //'bill_subtotal_amount',
                        'bill_total_amount',
                        //'bill_paid_amount',
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            <?php Pjax::end(); ?>
        </div>

        <!-- /.box-body -->
        <div class="box-footer">
            <div class="pull-right"></div>
        </div>
        <!-- /.box-footer-->


    </div>

</section>
