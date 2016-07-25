<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SalaRangoHorario;

/**
 * SalaRangoHorarioSearch represents the model behind the search form about `app\models\SalaRangoHorario`.
 */
class SalaRangoHorarioSearch extends SalaRangoHorario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['salarangohorarioid', 'salaid'], 'integer'],
            [['salarangohorarioinicio', 'salarangohorariofin'], 'safe'],
            [['salarangohorariodiadomingo', 'salarangohorariodialunes', 'salarangohorariodiamartes', 'salarangohorariodiamiercoles', 'salarangohorariodiajueves', 'salarangohorariodiaviernes', 'salarangohorariodiasabado'], 'boolean'],
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
        $query = SalaRangoHorario::find();

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

        // Solamente se visualizarán los Rangos Horarios de las salas activas.
        $query->join('INNER JOIN', 'sala', 'salarangohorario.salaid = sala.salaid');
        
        // Si es un usuario Simple, se filtra por el ambito del mismo,
        // Caso contrario se visualiza el filtro en la grilla y query filtra por el valor
        // del mismo.
        if (!User::esUsuarioLogueadoAdmin()) {
        	$query->andWhere(['sala.ambitoid' => Usuario::getAmbitoUsuarioLogueado()]);
        } 
        
        // grid filtering conditions
        $query->andFilterWhere([
        	'salarangohorarioid' => $this->salarangohorarioid,
            'salarangohorario.salaid' => $this->salaid,
        	'sala.salaactiva' => true,
            'salarangohorarioinicio' => $this->salarangohorarioinicio,
            'salarangohorariofin' => $this->salarangohorariofin,
            'salarangohorariodiadomingo' => $this->salarangohorariodiadomingo,
            'salarangohorariodialunes' => $this->salarangohorariodialunes,
            'salarangohorariodiamartes' => $this->salarangohorariodiamartes,
            'salarangohorariodiamiercoles' => $this->salarangohorariodiamiercoles,
            'salarangohorariodiajueves' => $this->salarangohorariodiajueves,
            'salarangohorariodiaviernes' => $this->salarangohorariodiaviernes,
            'salarangohorariodiasabado' => $this->salarangohorariodiasabado,
        ]);
        
        $query->orderBy(['salarangohorario.salaid' => SORT_ASC, 'salarangohorarioinicio' => SORT_ASC]);

        return $dataProvider;
    }
}
