<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Configs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="configs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'site_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keyword')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>


    <?= $form->field($model, 'site_status')->dropDownList(['open' => 'Open', 'close' => 'Close',], ['prompt' => '']) ?>

    <?= $form->field($model, 'close_msg')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
       // 'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'home_msg')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
      //  'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'home_ad')->textarea(['rows' => 6]) ?>



    <?= $form->field($model, 'home_reg_msg')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
      //  'preset' => 'basic'
    ]) ?>
    <?= $form->field($model, 'privacy')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        //'preset' => 'basic'
    ]) ?>


    <hr/>

    <?= $form->field($model, 'app_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'app_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fb_page')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reg_msg')->dropDownList(['0' => 'close', '1' => 'open']) ?>

    <?= $form->field($model, 'reg_text')->textarea(['rows' => 3]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
