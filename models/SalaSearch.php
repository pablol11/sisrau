<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sala;

/**
 * SalaSearch represents the model behind the search form about `app\models\Sala`.
 */
class SalaSearch extends Sala
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['salaid', 'tiposalaid', 'ambitoid'], 'integer'],
            [['saladescripcion'], 'safe'],
            [['salaactiva'], 'boolean'],
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
        $query = Sala::find();

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

        // Si es un usuario Simple, se filtra por el ambito del mismo,
        // Caso contrario se visualiza el filtro en la grilla y query filtra por el valor
        // del mismo.
        $ambitoid = null;
        if (!User::esUsuarioLogueadoAdmin()) {
        	$ambitoid = Usuario::getAmbitoUsuarioLogueado();
        } else {
        	if (!empty($this->ambitoid)) {
        		$ambitoid = $this->ambitoid;
        	}
        }
        
        $query->andFilterWhere([
            'salaid' => $this->salaid,
            'tiposalaid' => $this->tiposalaid,
//             'ambitoid' => $this->ambitoid,
            'ambitoid' => $ambitoid,
        	'salaactiva' => $this->salaactiva,
        ]);

        $query->andFilterWhere(['like', 'saladescripcion', $this->saladescripcion]);

        return $dataProvider;
    }
}
