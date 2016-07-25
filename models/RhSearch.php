<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rh;

/**
 * RhSearch represents the model behind the search form about `app\models\Rh`.
 */
class RhSearch extends Rh
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rhid', 'tiporhid', 'rhsectorid', 'rhambitoid'], 'integer'],
            [['rhnombre', 'rhapellido'], 'safe'],
            [['rhactivo'], 'boolean'],
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
        $query = Rh::find();

        // add conditions that should always apply here

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
        if (!User::esUsuarioLogueadoAdmin()) {
        	$ambitoid = Usuario::getAmbitoUsuarioLogueado();
        } else {
        	$ambitoid = $this->rhambitoid;
        }
        
        // grid filtering conditions
        $query->andFilterWhere([
        		'rhid' => $this->rhid,
        		'tiporhid' => $this->tiporhid,
        		'rhambitoid' => $ambitoid,
        		'rhsectorid' => $this->rhsectorid,
        		'rhactivo' => $this->rhactivo
        ]);
        
        $query->andFilterWhere(['like', 'rhnombre', $this->rhnombre])
        	  ->andFilterWhere(['like', 'rhapellido', $this->rhapellido]);
        
        $query->orderBy(['rhapellido' => SORT_ASC, 'rhnombre' => SORT_ASC]);
        
        return $dataProvider;
    }
}
