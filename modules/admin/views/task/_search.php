<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaskSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'time') ?>

    <?= $form->field($model, 'posts') ?>

    <?= $form->field($model, 'count') ?>

    <?php // echo $form->field($model, 'gander') ?>

    <?php // echo $form->field($model, 'isfinish') ?>

    <?php // echo $form->field($model, 'idnow') ?>

    <?php // echo $form->field($model, 'taskfor') ?>

    <?php // echo $form->field($model, 'totalcount') ?>

    <?php // echo $form->field($model, 'successed') ?>

    <?php // echo $form->field($model, 'failed') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
