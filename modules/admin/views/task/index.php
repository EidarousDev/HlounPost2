<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tasks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Task'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'value' => function ($data) {
                    return $data->id;
                },
            ],
            [
                'value' => function ($data) {
                    return Yii::$app->params['taskType'][$data->type]; // $data['name'] for array data, e.g. using SqlDataProvider.
                },
                'attribute' => 'type',
            ],
            'taskfor:ntext',
            'time:ntext',
            'posts:ntext',
            'gander:ntext',
            [
                'attribute' => 'isfinish',
                'value' => function ($data) {
                    return Yii::$app->params['taskStatus'][$data->isfinish];
                }
            ],
            'idnow',
            'totalcount',
            'successed',
            'failed',

            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width:90px;'],
                'template' => '{post} {view} {update} {delete}',
                'buttons' => [
                    'post' => function ($url) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-share-alt"></span>',
                            $url,
                            [
                                'title' => 'Post',
                                'data-pjax' => '0',
                                'target' => '_blank',
                            ]
                        );
                    },
                ],

            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
