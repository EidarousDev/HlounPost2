<?php

/* @var $this yii\web\View */

$this->title = 'Home';
use yii\helpers\Html;
use app\models\Configs;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?= Configs::getInstance()->site_name ?></h1>

        <p class="lead"><?= Configs::getInstance()->home_msg ?></p>


        <p>

            <?php $url = Yii::$app->urlManager->createAbsoluteUrl('fb/login');
            echo Html::button(Yii::t('app', 'Register Now'), ['class' => 'btn btn-lg btn-success btn-reg', 'onclick' => ' var  screenX    = typeof window.screenX != \'undefined\' ? window.screenX : window.screenLeft,
                 screenY    = typeof window.screenY != \'undefined\' ? window.screenY : window.screenTop,
                 outerWidth = typeof window.outerWidth != \'undefined\' ? window.outerWidth : document.body.clientWidth,
                 outerHeight = typeof window.outerHeight != \'undefined\' ? window.outerHeight : (document.body.clientHeight - 22),
                 width    = 500,
                 height   = 500,
                 left     = parseInt(screenX + ((outerWidth - width) / 2), 10),
                 top      = parseInt(screenY + ((outerHeight - height) / 2.5), 10),
                 features = (
                    \'width=\' + width +
                    \',height=\' + height +
                    \',left=\' + left +
                    \',top=\' + top
                  );
 
            newwindow=window.open(\'' . $url . '\',\'Login_by_facebook\',features);
 
           if (window.focus) {newwindow.focus()}
          return false;']);
            ?>
        </p>
    </div>

    <div class="body-content">
        <div class="row" style="margin-bottom: 20px;">
            <div class="ads"><?=Configs::getInstance()->home_ad;?></div>
        </div>

        <div class="row">
            <?php
            $posts = \app\models\Posts::find()->orderBy(['id'=>SORT_DESC])->limit(12)->all();
            foreach ($posts as $post){ ?>
                <div class="col-lg-4">
                   <!-- <h2>Heading</h2>-->

                    <p class="well"><?=$post->text?></p>

            <!--        <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>-->
                </div>

            <?php } ?>


        </div>

    </div>
</div>
