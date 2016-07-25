<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AudienciaAnulada;

/**
 * AudienciaAnuladaSearch represents the model behind the search form about `app\models\AudienciaAnulada`.
 */
class AudienciaAnuladaSearch extends AudienciaAnulada
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['audienciaid', 'audienciaanuladaambitoid', 'audienciaanuladasectorid', 'audienciaanuladarhid'], 'integer'],
            [['audienciaanuladafecha', 'audienciaanuladamotivo'], 'safe'],
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
        $query = AudienciaAnulada::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'audienciaid' => $this->audienciaid,
            'audienciaanuladafecha' => $this->audienciaanuladafecha,
            'audienciaanuladaambitoid' => $this->audienciaanuladaambitoid,
            'audienciaanuladasectorid' => $this->audienciaanuladasectorid,
            'audienciaanuladarhid' => $this->audienciaanuladarhid,
        ]);

        $query->andFilterWhere(['like', 'audienciaanuladamotivo', $this->audienciaanuladamotivo]);

        return $dataProvider;
    }
}
