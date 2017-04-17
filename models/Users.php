<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $fb_id
 * @property string $fb_name
 * @property string $fb_email
 * @property string $fb_access
 * @property string $fb_gender
 * @property string $reg_date
 * @property string $last_login
 * @property string $country_code
 * @property integer $last_share
 * @property string $birthday;
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fb_id', 'fb_name', 'fb_access'], 'required'],
            [['fb_id', 'fb_name', 'fb_email', 'fb_access', 'fb_gender', 'reg_date', 'last_login', 'country_code'], 'string'],
            [['fb_email', 'fb_gender', 'country_code,birthday'], 'safe'],
            [['last_share'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fb_id' => Yii::t('app', 'Facebook Id'),
            'fb_name' => Yii::t('app', 'Facebook Name'),
            'fb_email' => Yii::t('app', 'Facebook Email'),
            'fb_access' => Yii::t('app', 'Facebook Access'),
            'fb_gender' => Yii::t('app', 'Facebook Gender'),
            'reg_date' => Yii::t('app', 'Register Date'),
            'last_login' => Yii::t('app', 'Last Login'),
            'country_code' => Yii::t('app', 'Country Code'),
            'last_share' => Yii::t('app', 'Last Share'),
            'birthday' => Yii::t('app', 'Birthday'),

        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {

        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->reg_date = date('Y/m/d H:i:s');
                $this->last_login = date('Y/m/d H:i:s');
                $this->last_share = 0;
            }
            return true;
        } else {
            return false;
        }
    }



    public static function saveInfo($accessToken)
    {
        $info = (Yii::$app->fb->getUserInfo($accessToken));
        $success = false;
        if (($user = Users::findOne(['fb_id' => $info['id']])) != null) {
            $user->fb_access = $accessToken;
            if ($user->update(false)) {
                $success = true;
            }
        } else {
            $user = new Users();
            $user->fb_access = $accessToken;
            $user->fb_id = $info['id'];
            $user->fb_name = $info['name'];
            $user->fb_email = isset($info['email']) ? $info['email'] : '';
            $user->fb_gender = isset($info['gender']) ? $info['gender'] : '';
            $user->birthday = isset($info['birthday']) ? $info['birthday'] : '';
            $user->country_code = Yii::$app->fb->countryCode();
            if ($user->save()) {
                $success = true;
            } else {
                print_r($user->getErrors());
            }
        }
        return $success;
    }
}
