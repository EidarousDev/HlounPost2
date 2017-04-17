<?php

namespace app\components;


use Facebook\Exceptions\FacebookClientException;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use app\models\Configs;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use linslin\yii2\curl;
use yii\db\Exception;

class FbComponent extends Component
{
    public $fb;

    public function __construct(array $config = [])
    {

        parent::__construct($config);
        //echo 'hello world';
        if (!session_id()) {
            session_start();
        }
        $this->fb = new Facebook([
            'app_id' => Configs::getInstance()->app_id, // Replace {app-id} with your app id
            'app_secret' => Configs::getInstance()->app_key,
            'default_graph_version' => 'v2.2',
        ]);


    }

    public function loginUrl()
    {
        $helper = $this->fb->getRedirectLoginHelper();
        $loginUrl = $helper->getLoginUrl(Yii::$app->urlManager->createAbsoluteUrl('fb/login-callback'), explode(",", Yii::$app->params['permissions']));
        return $loginUrl . '&display=popup';
    }


    public function PhpCallBack()
    {
        $helper = $this->fb->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
        } catch (FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        $oAuth2Client = $this->fb->getOAuth2Client();
        if (!$accessToken->isLongLived()) {
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
                exit;
            }
        }
        Yii::$app->session->set('fb_access_token', (string)$accessToken);
        return (string)$accessToken;


    }

    /**
     * @param $accessToken string
     * @return \Facebook\GraphNodes\GraphUser
     */
    public function getUserInfo($accessToken)
    {
        try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $this->fb->get('/me?fields=id,name,email,gender,birthday', $accessToken);
        } catch (FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        return $response->getDecodedBody();
    }


    public function countryCode()
    {


        $ip = Yii::$app->request->getUserIP();
        //$ip = "79.173.199.93";
        $curl = new curl\Curl();
        $response = $curl->get("http://www.geoplugin.net/json.gp?ip=" . $ip);
        $ip_data = @json_decode($response);
        if ($ip_data && $ip_data->geoplugin_countryCode != null) {
            $result = $ip_data->geoplugin_countryCode;
            return $result;
        } else {
            return 'Unknown';
        }
    }


    public function postMsg($userid, $msg, $accessToken)
    {


        try {
            $this->fb->post('/' . $userid . '/feed', ['message' => $msg], $accessToken);
        } catch (FacebookResponseException $e) {
            return 'Graph returned an error: ' . $e->getMessage();
        } catch (FacebookSDKException $e) {
            return 'Facebook SDK returned an error: ' . $e->getMessage();
        }catch (Exception $e) {
            return "ERROR NOT FROM SDK ! " . $e->getMessage();
        }

        return 1;
    }

    public function postLink($userid, $msg, $link, $accessToken)
    {

        try {
            $this->fb->post('/' . $userid . '/feed', ['link' => $link, 'message' => $msg], $accessToken);
        } catch (FacebookResponseException $e) {
            return 'Graph returned an error: ' . $e->getMessage();
        } catch (FacebookSDKException $e) {
            return 'Facebook SDK returned an error: ' . $e->getMessage();
        } catch (Exception $e) {
            return "ERROR NOT FROM SDK ! " . $e->getMessage();
        }

        return 1;
    }


    public function postImage($userid, $msg, $imagePath, $accessToken)
    {

        try {
            $this->fb->post('/' . $userid . '/photos', ['source' => $this->fb->fileToUpload($imagePath), 'message' => $msg], $accessToken);
        } catch (FacebookResponseException $e) {
            return 'Graph returned an error: ' . $e->getMessage();
        } catch (FacebookSDKException $e) {
            return 'Facebook SDK returned an error: ' . $e->getMessage();
        } catch (Exception $e) {
            return "ERROR NOT FROM SDK ! " . $e->getMessage();
        }

        return 1;
    }


}

