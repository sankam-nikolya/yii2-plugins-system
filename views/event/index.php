<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel lo\plugins\models\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('plugin', 'Events');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('/_menu') ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'app_id',
                'label' =>  Yii::t('plugin','App'),
                'options' => ['style' => 'width: 25px; align: center;'],
                'value' => function ($model, $key, $index, $column) {
                    switch ($model->app_id) {
                        case 1:
                            return '<span class="label label-primary">F</span>';
                            break;
                        case 2:
                            return '<span class="label label-success">C</span>';
                            break;
                        case 3:
                            return '<span class="label label-danger">B</span>';
                            break;
                    }
                },
                'filter' => [
                    1 => Yii::t('plugin', 'Frontend'),
                    2 => Yii::t('plugin', 'Common'),
                    3 => Yii::t('plugin', 'Backend')
                ],
                'format' => "raw"
            ],
            'trigger_class',
            'trigger_event',
            'plugin.handler_class',
            'handler_method',
            [
                'attribute' => 'status',
                'options' => ['style' => 'width: 75px; align: center;'],
                'value' => function ($model, $key, $index, $column) {
                    return $model->status == $model::STATUS_ACTIVE ? '<span class="label label-success">Enabled</span>' : '<span class="label label-danger">Disabled</span>';
                },
                'filter' => [
                    1 => Yii::t('plugin', 'Enabled'),
                    0 => Yii::t('plugin', 'Disabled')
                ],
                'format' => "raw"
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {view} {delete}',
                'options' => ['style' => 'width: 100px;'],
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, [
                            'class' => 'btn btn-xs btn-primary',
                            'title' => Yii::t('plugin', 'Update'),
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', $url, [
                            'class' => 'btn btn-xs btn-warning',
                            'title' => Yii::t('plugin', 'View'),
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url, [
                            'class' => 'btn btn-xs btn-danger',
                            'data-method' => 'post',
                            'data-confirm' => Yii::t('plugin', 'Are you sure to delete this item?'),
                            'title' => Yii::t('plugin', 'Delete'),
                        ]);
                    },
                ]
            ],
        ],
    ]); ?>

</div>
