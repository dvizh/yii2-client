<?php
namespace dvizh\client\models\client;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use dvizh\client\models\Client;

class ClientSearch extends Client
{
    public function rules()
    {
        return [
            [['id', 'category_id', 'organization_id'], 'integer'],
            [['name', 'comment', 'status', 'birthday', 'phone', 'email', 'code', 'promocode'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Client::scenarios();
    }

    public function search($params)
    {
        $query = Client::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => new \yii\data\Sort([
                'attributes' => [
                    'birthday',
                    'status',
                    'id',
                ],
            ])
        ]);
        
        $dataProvider->sort = ['defaultOrder' => ['id' => SORT_DESC]];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'code' => $this->code,
            'promocode' => $this->promocode,
            'status' => $this->status,
            'organization_id' => $this->organization_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'birthday', $this->birthday])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }
}
