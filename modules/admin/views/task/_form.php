<?php
use app\models\Posts;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->dropDownList(Yii::$app->params['taskType']) ?>



    <?php
    if (!$model->isNewRecord) {
        $model->posts = explode(",", $model->posts);
        $model->count = explode(",", $model->count);
    }
    ?>


    <?= $form->field($model, 'posts')->widget(Select2::classname(), [

        'data' => ArrayHelper::map(Posts::find()->all(), 'id', 'id'),
        'language' => 'en',
        'options' => ['multiple' => true, 'placeholder' => Yii::t('app', 'posts')],
        'pluginOptions' => [
            'allowClear' => true,
            //'tokenSeparators' => [',', ' '],
            //'tags' => true,
        ],
    ]); ?>
    <?= $form->field($model, 'count')->widget(Select2::classname(), [

        'data' => Yii::$app->params['countries'],
        'language' => 'en',
        'options' => ['multiple' => true, 'placeholder' => Yii::t('app', 'count')],
        'pluginOptions' => [
            'allowClear' => true,
            //'tokenSeparators' => [',', ' '],
            //'tags' => true,
        ],
    ]); ?>


    <?= $form->field($model, 'gander')->dropDownList(Yii::$app->params['genderShare']) ?>


    <?= $form->field($model, 'taskfor')->dropDownList(Yii::$app->params['taskfor']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php
    /*
echo Select2::widget([

    //'model' => $model,
    //'attribute' => 'count',
    'name' => 'Task[count]',
    'value' => explode(",", ($model->isNewRecord) ? "" : $model->count),// initial value (will be ordered accordingly and pushed to the top)
    'data' => Yii::$app->params['countries'],
    'maintainOrder' => true,
    'options' => ['placeholder' => 'Select a color ...', 'multiple' => true],
    'pluginOptions' => [
       // 'tags' => true,
        'tokenSeparators' => [',', ' '],

    ],
]);
*/
    ?>

</div>
