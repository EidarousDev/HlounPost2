<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Privacy';
/*$this->params['breadcrumbs'][] = $this->title;
*/?>
<div class="">
    <h1><?= Html::encode($this->title) ?></h1>
    <div>
        <?=\app\models\Configs::getInstance()->privacy?>
    </div>
</div>
