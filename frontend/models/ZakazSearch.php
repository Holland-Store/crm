<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Zakaz;

/**
 * ZakazSearch represents the model behind the search form about `app\models\Zakaz`.
 */
class ZakazSearch extends Zakaz
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_zakaz', 'id_sotrud', 'id_tovar', 'oplata', 'number', 'id_client'], 'integer'],
            [['srok', 'minut', 'prioritet', 'status', 'data'], 'safe'],
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
        $query = Zakaz::find();

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
            'id_zakaz' => $this->id_zakaz,
            'srok' => $this->srok,
            'id_sotrud' => $this->id_sotrud,
            'id_tovar' => $this->id_tovar,
            'oplata' => $this->oplata,
            // 'number' => $this->number,
            'data' => $this->data,
            'id_client' => $this->id_client,
        ]);

        $query->andFilterWhere(['like', 'prioritet', $this->prioritet])
            ->andFilterWhere(['like', 'status', $this->status]);
            // ->andFilterWhere(['like', 'description', $this->description])
            // ->andFilterWhere(['like', 'information', $this->information])
            // ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
    public function attributeLabels()
    {
        return [];
    }
}
