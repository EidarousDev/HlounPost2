<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users;

/**
 * UsersSearch represents the model behind the search form about `app\models\Users`.
 */
class UsersSearch extends Users
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'last_share'], 'integer'],
            [['fb_id', 'fb_name', 'fb_email', 'fb_access', 'fb_gender', 'reg_date', 'last_login', 'country_code','birthday'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Users::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'last_share' => $this->last_share,
        ]);

        $query->andFilterWhere(['like', 'fb_id', $this->fb_id])
            ->andFilterWhere(['like', 'fb_name', $this->fb_name])
            ->andFilterWhere(['like', 'fb_email', $this->fb_email])
            ->andFilterWhere(['like', 'fb_access', $this->fb_access])
            ->andFilterWhere(['like', 'fb_gender', $this->fb_gender])
            ->andFilterWhere(['like', 'reg_date', $this->reg_date])
            ->andFilterWhere(['like', 'last_login', $this->last_login])
            ->andFilterWhere(['like', 'birthday', $this->birthday])
            ->andFilterWhere(['like', 'country_code', $this->country_code]);

        return $dataProvider;
    }
}
