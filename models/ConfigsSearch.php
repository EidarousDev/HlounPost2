<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Configs;

/**
 * ConfigsSearch represents the model behind the search form about `app\models\Configs`.
 */
class ConfigsSearch extends Configs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'url', 'keyword', 'description', 'site_name', 'site_status', 'close_msg', 'home_msg', 'home_ad', 'app_id', 'app_key', 'fb_page', 'reg_msg', 'reg_text', 'privacy', 'home_reg_msg'], 'safe'],
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
        $query = Configs::find();

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
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'keyword', $this->keyword])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'site_name', $this->site_name])
            ->andFilterWhere(['like', 'site_status', $this->site_status])
            ->andFilterWhere(['like', 'close_msg', $this->close_msg])
            ->andFilterWhere(['like', 'home_msg', $this->home_msg])
            ->andFilterWhere(['like', 'home_ad', $this->home_ad])
            ->andFilterWhere(['like', 'app_id', $this->app_id])
            ->andFilterWhere(['like', 'app_key', $this->app_key])
            ->andFilterWhere(['like', 'fb_page', $this->fb_page])
            ->andFilterWhere(['like', 'reg_msg', $this->reg_msg])
            ->andFilterWhere(['like', 'reg_text', $this->reg_text])
            ->andFilterWhere(['like', 'privacy', $this->privacy])
            ->andFilterWhere(['like', 'home_reg_msg', $this->home_reg_msg]);

        return $dataProvider;
    }
}
