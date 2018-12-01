<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
</section>

<section class="content">

    <div class="box">

        <div class="box-header">
            <h3 class="box-title">All Customers</h3>

            <div class="box-tools pull-right">
                <?= Html::a('Add New Customer', ['create'], ['class' => 'btn btn-flat btn-danger']) ?>
            </div>
        </div>

        <div class="box-body">

            <?php Pjax::begin(); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'company_name',
                    'contact_person_name',
                    'gst_number',
                    'phone',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{update} {delete}'
                    ],
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
