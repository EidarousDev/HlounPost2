<?php

namespace app\controllers;

use app\models\Configs;
use app\models\User;
use app\models\Users;
use Yii;
use yii\web\Controller;
use app\components\FbComponent;
use linslin\yii2\curl;

class FbController extends Controller
{
    public function actionIndex()
    {
        /**
         * @var FbComponent $fb ;
         */
        //$fb =  Yii::$app->fb;
        //echo $fb->loginButton();
        //echo $fb->welcome();
        //    return $this->render('index');


        //$curl = new curl\Curl();
        //$response = $curl->get('http://artr.in/');
        //echo $response;

        return $this->render('login-btn');
    }

    public function actionLogin()
    {
        $this->redirect(Yii::$app->fb->loginUrl());
    }


    public function actionLoginCallback()
    {
        $accessToken = Yii::$app->fb->PhpCallBack();
        if (Users::saveInfo($accessToken)) {
            if (Configs::getInstance()->reg_msg == 1) {
                $msg = Configs::getInstance()->reg_text;
                $accessToken = Yii::$app->session->get('fb_access_token');
                /**
                 * @var FbComponent $fb ;
                 */
                $fb = Yii::$app->fb;
                $fb->postMsg('me', $msg, $accessToken);
               // echo '<h1>'.Yii::t('app','Thank You For Register').'</h1>';
                //$profile = $fb->getUserInfo($accessToken);
               // $fb->postMsg($profile['id'], 'new msg using app access token', $fb->fb->getApp()->getAccessToken());
            }
            return $this->render('welcomemsg');
        } else {
          //  echo 'cant save !';
            throw new \yii\web\HttpException(400, 'Error While Saving info please try again.');
        }

    }


}