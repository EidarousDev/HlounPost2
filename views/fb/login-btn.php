<?php
/**
 * Created by PhpStorm.
 * User: bahaa
 * Date: 4/11/17
 * Time: 12:18 PM
 */
/* @var $this yii\web\View */

use yii\helpers\Html;
$url = Yii::$app->urlManager->createAbsoluteUrl('fb/login');
echo Html::button('Login !', ['class' => 'btn btn-primary btn-lg btn-block btn-reg', 'onclick' => ' var  screenX    = typeof window.screenX != \'undefined\' ? window.screenX : window.screenLeft,
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
