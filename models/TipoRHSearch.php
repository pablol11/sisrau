<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TipoRh;

/**
 * TipoRhSearch represents the model behind the search form about `app\models\TipoRh`.
 */
class TipoRhSearch extends TipoRh
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tiporhid'], 'integer'],
            [['tiporhdescripcion'], 'safe'],
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
        $query = TipoRh::find();

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
            'tiporhid' => $this->tiporhid,
        ]);

        $query->andFilterWhere(['like', 'tiporhdescripcion', $this->tiporhdescripcion]);

        return $dataProvider;
    }
}
