<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Task */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Post'), ['post', 'id' => $model->id], ['class' => 'btn btn-success','target'=>'_blank']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [                                                  // the owner name of the model
                'label' => 'type',
                'value' => Yii::$app->params['taskType'][$model->type],
                //'contentOptions' => ['class' => 'bg-red'],     // HTML attributes to customize value tag
                //'captionOptions' => ['tooltip' => 'Tooltip'],  // HTML attributes to customize label tag
            ],
            'taskfor:ntext',
            'time:ntext',
            'posts:ntext',
            'count:text',
            'gander:ntext',
            [
                'label' => 'isfinish',
                'value' => Yii::$app->params['taskStatus'][$model->isfinish],
            ],
            'idnow',
            'totalcount',
            'successed',
            'failed',
        ],
    ]) ?>

</div>

<?php
$this->registerCss('td{
    max-width:200px;
    word-wrap: break-word;
    }');

?>