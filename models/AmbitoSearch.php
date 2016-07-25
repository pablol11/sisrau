<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ambito;

/**
 * AmbitoSearch represents the model behind the search form about `app\models\Ambito`.
 */
class AmbitoSearch extends Ambito
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ambitoid'], 'integer'],
            [['ambitodescripcion'], 'safe'],
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
        $query = Ambito::find();

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

        if (isset($this->ambitoid)) {
	        $query->andFilterWhere([
	            'ambitoid' => $this->ambitoid,
	        ]);
        }
        
        $query->andFilterWhere(['like', 'ambitodescripcion', $this->ambitodescripcion ]);

        
        
        return $dataProvider;
    }
}
