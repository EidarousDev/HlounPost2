<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $date
 * @property string $type
 * @property string $is_shared
 * @property string $text
 * @property string $link
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'text'], 'required'],
            [['date'], 'safe'],
            [['link'],'url'],
            [['link'], 'required', 'when' => function ($model) {
                return $model->type == 'link';
            }, 'whenClient' => "function (attribute, value) {
        return $('#type').val() == 'link';
    }"],
            [['type', 'is_shared', 'text', 'link'], 'string'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg'],
            [['imageFile'], 'required', 'when' => function ($model) {
                return $model->type == 'image';
            }, 'whenClient' => "function (attribute, value) {
        return $('#type').val() == 'image';
    }"],
        ];
    }


    public function upload()
    {
        if ($this->validate()) {
            $img = 'uploads/' . $this->imageFile->baseName .md5(time()). '.' . $this->imageFile->extension;
            $this->imageFile->saveAs($img);
            $this->link = $img;
            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Date'),
            'type' => Yii::t('app', 'Type'),
            'is_shared' => Yii::t('app', 'Is Shared'),
            'text' => Yii::t('app', 'Text'),
            'link' => Yii::t('app', 'Link'),
        ];
    }

    public function beforeSave($insert)
    {

        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->date = date('Y/m/d H:i:s');
                $this->is_shared = 'no';
            }
            if ($this->type == 'link' && empty($this->link)) {
                return false;
            } else if ($this->type == 'image' && empty($this->link)) {
                return false;
            }
            return true;
        } else {
            return false;
        }
    }
}
