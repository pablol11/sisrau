<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AudienciaParticipante;

/**
 * AudienciaParticipanteSearch represents the model behind the search form about `app\models\AudienciaParticipante`.
 */
class AudienciaParticipanteSearch extends AudienciaParticipante
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['audienciaparticipanteid', 'audienciaid', 'rhid'], 'integer'],
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
        $query = AudienciaParticipante::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
//        		'pagination' => [
// 				'pagesize' => Yii::$app->params['MaxSizePage'],
//         	],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $query->join('INNER JOIN', 'audiencia', 'audienciaparticipante.audienciaid = audiencia.audienciaid');
        $query->join('INNER JOIN', 'sala', 'audiencia.salaid = sala.salaid');
        
        $query->andFilterWhere([
            'audienciaparticipanteid' => $this->audienciaparticipanteid,
            'audienciaparticipante.audienciaid' => $this->audienciaid,
            'rhid' => $this->rhid,
        	'audiencia.estadoid' => Estado::getEstadoNormalId(),
        	'sala.salaactiva' => true,
        ]);
        
        $query->orderBy(['audiencia.audienciafecha' => SORT_DESC, 'audiencia.audienciahorainicio' => SORT_ASC]);

        return $dataProvider;
    }
}
