<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $page_id
 * @property string $page_name
 * @property integer $last_share
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'page_id', 'page_name', 'last_share'], 'required'],
            [['user_id', 'page_id', 'last_share'], 'integer'],
            [['page_name'], 'string', 'max' => 500],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Users::className(), ['fb_id' => 'user_id']);
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'page_id' => Yii::t('app', 'Page ID'),
            'page_name' => Yii::t('app', 'Page Name'),
            'last_share' => Yii::t('app', 'Last Share'),
        ];
    }
}
