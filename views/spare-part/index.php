<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SparePartSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Spare Parts';

?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
</section>

<section class="content">

    <div class="box">

        <div class="box-header">
            <h3 class="box-title">All Spare Parts</h3>

            <div class="box-tools pull-right">
                <?= Html::a('Add New Spare Part', ['create'], ['class' => 'btn btn-flat btn-danger']) ?>
            </div>
        </div>

        <div class="box-body">

            <?php Pjax::begin(); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'spare_part_name',
                    'spare_part_serial_no',
                    'spare_part_hsn_no',
                    'spare_part_rate',
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

</scetion>
