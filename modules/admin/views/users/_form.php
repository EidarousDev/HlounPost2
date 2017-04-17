<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fb_id')->textInput(['maxlength' => true])  ?>

    <?= $form->field($model, 'fb_name')->textInput(['maxlength' => true])  ?>

    <?= $form->field($model, 'fb_email')->textInput(['maxlength' => true])  ?>

    <?= $form->field($model, 'fb_access')->textInput(['maxlength' => true])  ?>

    <?= $form->field($model, 'birthday')->textInput(['maxlength' => true])  ?>

    <?= $form->field($model, 'fb_gender')->dropDownList(Yii::$app->params['gender'])  ?>

    <?php /* echo $form->field($model, 'reg_date')->widget(
        DatePicker::className(), [
        // inline too, not bad
        'inline' => true,
        // modify template for custom rendering
        'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'dd-M-yyyy'
        ]
    ]);*/ ?>

    <?php
    /*
     * <?= $form->field($model, 'reg_date')->widget(\yii\jui\DatePicker::classname(), [
        //'language' => 'ru',
        //'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

     */
    ?>
    <?php /* $form->field($model, 'last_login')->textInput(['maxlength' => true])  */ ?>




    <?= $form->field($model, 'country_code')->dropDownList(Yii::$app->params['countries'])  ?>

    <?php /* $form->field($model, 'last_share')->textInput()*/ ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
