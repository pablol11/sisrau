<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TipoSala;

/**
 * TipoSalaSearch represents the model behind the search form about `app\models\TipoSala`.
 */
class TipoSalaSearch extends TipoSala
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tiposalaid'], 'integer'],
            [['tiposaladescripcion'], 'safe'],
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
        $query = TipoSala::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
       		'pagination' => [
				'pagesize' => Yii::$app->params['MaxSizePage'],
        	],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'tiposalaid' => $this->tiposalaid,
        ]);

        $query->andFilterWhere(['like', 'tiposaladescripcion', $this->tiposaladescripcion]);

        return $dataProvider;
    }
}
