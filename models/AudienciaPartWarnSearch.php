<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AudienciaPartWarn;

/**
 * AudienciaPartWarnSearch represents the model behind the search form about `app\models\AudienciaPartWarn`.
 */
class AudienciaPartWarnSearch extends AudienciaPartWarn
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['audienciaparticipanteid'], 'integer'],
        	[['audienciapartwarnmsgeanterior', 'audienciapartwarnmsgeposterior'], 'safe'],
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
        $query = AudienciaPartWarn::find();

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
            'audienciaparticipanteid' => $this->audienciaparticipanteid,
        ]);
        

		$query->andFilterWhere(['like', 'audienciapartwarnmsgeanterior', $this->audienciapartwarnmsgeanterior])
        	  ->andFilterWhere(['like', 'audienciapartwarnmsgeposterior', $this->audienciapartwarnmsgeposterior]);
		
        return $dataProvider;
    }
}
