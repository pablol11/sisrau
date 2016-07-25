<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Audiencia;

/**
 * AudienciaSearch represents the model behind the search form about `app\models\Audiencia`.
 */
class AudienciaSearch extends Audiencia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['audienciaid', 'salaid', 'estadoid', 'audienciaregambitoid', 'audienciaregsectorid', 'audienciaregrhid'], 'integer'],
            [['audienciadescripcion', 'audienciafecha', 'audienciahorainicio', 'audienciahorafin', 'audienciaregfecha'], 'safe'],
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
        $query = Audiencia::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
       		'pagination' => [
				'pagesize' => Yii::$app->params['MaxSizePage'],
        	],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
//             $query->where('0=1');
            return $dataProvider;
        }

        // Se visualizan todas las audiencias, cuya sala se encuentra activa.
        $query->join('INNER JOIN', 'sala', 'audiencia.salaid = sala.salaid');
        $query->andFilterWhere(['sala.salaactiva' => true]);
        
//         // Si es un usuario Simple, se filtra por el ambito del mismo,
//         // Caso contrario se visualiza el filtro en la grilla y query filtra por el valor
//         // del mismo.
//         if (!User::esUsuarioLogueadoAdmin()) {
        	$query->andWhere(['sala.ambitoid' => Usuario::getAmbitoUsuarioLogueado()]);
//         } 
        
        $query->andFilterWhere([
            'audienciaid' => $this->audienciaid,
//         	'audienciafecha' => $this->audienciafecha,
            'audienciahorainicio' => $this->audienciahorainicio,
            'audienciahorafin' => $this->audienciahorafin,
            'audiencia.salaid' => $this->salaid,
            'estadoid' => $this->estadoid,
            'audienciaregambitoid' => $this->audienciaregambitoid,
            'audienciaregsectorid' => $this->audienciaregsectorid,
            'audienciaregrhid' => $this->audienciaregrhid,
            'audienciaregfecha' => $this->audienciaregfecha,
        ]);

		$query->andFilterWhere(['=', 'audienciafecha', $this->audienciafecha]);
        
        $query->andFilterWhere(['like', 'audienciadescripcion', $this->audienciadescripcion]);

        $query->orderBy(['audienciafecha' => SORT_DESC, 'audiencia.salaid' => SORT_ASC, 'audienciahorainicio' => SORT_ASC]);
        
        
        return $dataProvider;
    }
}
