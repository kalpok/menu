<?php
namespace modules\menu\backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class MenuSearch extends Menu
{
    public function rules()
    {
        return [
            [['id', 'isActive'], 'integer'],
            [['title', 'language'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Menu::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'depth' => 0,
            'isActive' => $this->isActive
        ]);
        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'language', $this->language]);
        return $dataProvider;
    }
}
