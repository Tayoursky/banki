<?php

namespace app\forms\search;

use app\entities\Photo;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class PhotoSearch extends Model
{
    public $id;
    public $name;
    public $created_at;

    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            [['name'], 'safe'],
            [['created_at'], 'date', 'format' => 'php:Y-m-d']
        ];
    }


    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Photo::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['name' => SORT_ASC]
            ]
        ]);
        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'name' => $this->name,
        ]);
        $query
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'created_at', $this->created_at]);
        return $dataProvider;
    }

}