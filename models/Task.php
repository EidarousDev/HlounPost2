<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property integer $type
 * @property string $time
 * @property string $posts
 * @property string $count
 * @property string $gander
 * @property integer $isfinish
 * @property integer $idnow
 * @property string $taskfor
 * @property integer $totalcount
 * @property integer $successed
 * @property integer $failed
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'posts', 'gander','count'], 'required'],
            [['type', 'isfinish', 'idnow', 'totalcount', 'successed', 'failed'], 'integer'],
            [['time', 'gander', 'taskfor'], 'string'],
            [['count','posts'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'time' => Yii::t('app', 'Time'),
            'posts' => Yii::t('app', 'Posts'),
            'count' => Yii::t('app', 'Countries'),
            'gander' => Yii::t('app', 'Gander'),
            'isfinish' => Yii::t('app', 'Isfinish'),
            'idnow' => Yii::t('app', 'Idnow'),
            'taskfor' => Yii::t('app', 'Task For'),
            'totalcount' => Yii::t('app', 'Totalcount'),
            'successed' => Yii::t('app', 'Successed'),
            'failed' => Yii::t('app', 'Failed'),
        ];
    }

    public function beforeSave($insert)
    {

        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->time = date('Y/m/d H:i:s');
                $this->totalcount = 0;
                $this->successed = 0;
                $this->failed = 0;
                $this->isfinish = 0;
                $this->idnow = 0;
            }
            if(is_array($this->posts))
            $this->posts = implode(",",$this->posts);
            if(is_array($this->count))
            $this->count = implode(",",$this->count);


            return true;
        }

        return false;

    }
}
