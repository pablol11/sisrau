<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TipoSector;

/**
 * TipoSectorSearch represents the model behind the search form about `app\models\TipoSector`.
 */
class TipoSectorSearch extends TipoSector
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tiposectorid'], 'integer'],
            [['tiposectordescripcion'], 'safe'],
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
        $query = TipoSector::find();

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
            'tiposectorid' => $this->tiposectorid,
        ]);

        $query->andFilterWhere(['like', 'tiposectordescripcion', $this->tiposectordescripcion]);
        
        $query->orderBy(['tiposectordescripcion' => SORT_ASC]);

        return $dataProvider;
    }
}
