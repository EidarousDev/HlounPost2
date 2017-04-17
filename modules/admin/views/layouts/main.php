<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Configs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Configs::getInstance()->title ?> Admin Panel-<?= Html::encode($this->title) ?></title>
    <meta name="keywords" content="<?= Configs::getInstance()->keyword?>" />
    <meta name="description" content="<?= Configs::getInstance()->description?>" />

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Configs::getInstance()->title,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    if (!Yii::$app->user->isGuest) {
        $items[] = ['label' => 'Home', 'url' => ['/admin/default/index']];
        $items[] = ['label' => 'Configs', 'url' => ['/admin/configs/index']];
        $items[] = ['label' => 'Admins', 'url' => ['/admin/admins/index']];
        $items[] = ['label' => 'Users', 'url' => ['/admin/users/index']];
        $items[] = ['label' => 'Pages', 'url' => ['/admin/pages/index']];
        $items[] = ['label' => 'Posts', 'url' => ['/admin/posts/index']];
        $items[] = ['label' => 'Task', 'url' => ['/admin/task/index']];
        $items[] = '<li>' . Html::beginForm(['/admin/default/logout'], 'post') . Html::submitButton('Logout (' . Yii::$app->user->identity->first_name . ')', ['class' => 'btn btn-link logout']) . Html::endForm() . '</li>';
    } else {
        $items[] = ['label' => 'Login', 'url' => ['/admin/default/login']];

    }


    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?=Configs::getInstance()->title?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
