<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>


    <?= $form->field($model, 'type')->dropDownList([ 'text' => 'Text', 'link' => 'Link', 'image' => 'Image', ], ['onchange'=>'
      $(".field-posts-link").hide();
        $(".field-posts-imagefile").hide();
       if($("#posts-type").val() == "link"){
           $(".field-posts-link").show();
       }else if($("#posts-type").val() == "image"){
           $(".field-posts-imagefile").show();
       }
    
    
    '] ); ?>

        <?php if(!$model->isNewRecord) echo $form->field($model, 'is_shared')->dropDownList(['no' => 'No','yes' => 'Yes', ]); ?>

    <?= $form->field($model, 'link')->textInput() ?>
    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->registerCss('.field-posts-link,.field-posts-imagefile{display:none}');
