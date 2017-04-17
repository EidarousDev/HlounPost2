<?php

namespace app\models;

use phpDocumentor\Reflection\Types\Self_;
use Yii;

/**
 * This is the model class for table "configs".
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $keyword
 * @property string $description
 * @property string $site_name
 * @property string $site_status
 * @property string $close_msg
 * @property string $home_msg
 * @property string $home_ad
 * @property string $app_id
 * @property string $app_key
 * @property string $fb_page
 * @property string $reg_msg
 * @property string $reg_text
 * @property string $privacy
 * @property string $home_reg_msg
 */
class Configs extends \yii\db\ActiveRecord
{

    private static $instance = null;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'configs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'url', 'keyword', 'description', 'site_name', 'site_status', 'close_msg', 'home_msg', 'home_ad', 'app_id', 'app_key', 'fb_page', 'reg_msg', 'reg_text', 'privacy', 'home_reg_msg'], 'required'],
            [['keyword', 'description', 'site_name', 'site_status', 'close_msg', 'home_msg', 'home_ad', 'reg_msg', 'reg_text', 'privacy', 'home_reg_msg'], 'string'],
            [['title', 'url', 'app_id', 'app_key'], 'string', 'max' => 255],
            [['fb_page'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'url' => Yii::t('app', 'Url'),
            'keyword' => Yii::t('app', 'Keyword'),
            'description' => Yii::t('app', 'Description'),
            'site_name' => Yii::t('app', 'Site Name'),
            'site_status' => Yii::t('app', 'Site Status'),
            'close_msg' => Yii::t('app', 'Close Site Message'),
            'home_msg' => Yii::t('app', 'Home Message'),
            'home_ad' => Yii::t('app', 'Home AD CODE'),
            'app_id' => Yii::t('app', 'App ID'),
            'app_key' => Yii::t('app', 'App Key'),
            'fb_page' => Yii::t('app', 'Fb Page'),
            'reg_msg' => Yii::t('app', 'Auto Post Welcome Message on facebook'),
            'reg_text' => Yii::t('app', 'Auto Message'),
            'privacy' => Yii::t('app', 'Privacy Policy'),
            'home_reg_msg' => Yii::t('app', 'Home Page Message For Registed Users'),
        ];
    }

    public static function getInstance(){
        if(Self::$instance == null){
            Self::$instance = Configs::findOne(1);
        }
        return Self::$instance;
    }
}
