<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "sala".
 *
 * @property integer $salaid
 * @property string $saladescripcion
 * @property integer $tiposalaid
 * @property integer $ambitoid
 * @property boolean $salaactiva
 *
 * @property Audiencia[] $audiencias
 * @property Ambito $ambito
 * @property Tiposala $tiposala
 * @property Salarangohorario[] $salarangohorarios
 */
class Sala extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sala';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['saladescripcion', 'tiposalaid', 'ambitoid'], 'required'],
            [['tiposalaid', 'ambitoid'], 'integer'],
            [['salaactiva'], 'boolean'],
            [['saladescripcion'], 'string', 'max' => 120]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'salaid' => Yii::t('app', 'Salaid'),
            'saladescripcion' => Yii::t('app', 'Saladescripcion'),
            'tiposalaid' => Yii::t('app', 'Tiposala'),
            'ambitoid' => Yii::t('app', 'Ambito'),
            'salaactiva' => Yii::t('app', 'Salaactiva'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudiencias()
    {
        return $this->hasMany(Audiencia::className(), ['salaid' => 'salaid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmbito()
    {
        return $this->hasOne(Ambito::className(), ['ambitoid' => 'ambitoid']);
    }

    public function getAmbitoDescripcion()
    {
    	$ambito = $this->getAmbito();
        return $ambito->ambitodescripcion;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTiposala()
    {
        return $this->hasOne(Tiposala::className(), ['tiposalaid' => 'tiposalaid']);
    }

    public function getTipoSalaDescripcion()
    {
        $tiposala = $this->getTiposala();
        return $tiposala->tiposaladescripcion;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalarangohorarios()
    {
        return $this->hasMany(Salarangohorario::className(), ['salaid' => 'salaid']);
    }
    
    public function getSalaActiva()
    {
    	return $this->salaactiva->boolean;
    }
    
    public static function getListaSalas() {
    	 
        if (User::esUsuarioLogueadoAdmin()) {
    		$opciones = Sala::find()->asArray()->all();
    	} else {
		    	$opciones = Sala::find()
		    			->where(['ambitoid' => Usuario::getAmbitoUsuarioLogueado()])
		    			->asArray()->all();
    	}

    	return ArrayHelper::map($opciones, 'salaid', 'saladescripcion');
    }
    
    public static function getListaSalasActivas() {
    	 
//     	if (User::esUsuarioLogueadoAdmin()) {
//     		$opciones = Sala::find()->andWhere(['salaactiva' => true])->asArray()->all();
//     	} else {
		    	$opciones = Sala::find()
		    			->where(['ambitoid' => Usuario::getAmbitoUsuarioLogueado()])
		    			->andWhere(['salaactiva' => true])
		    			->asArray()->all();
//     	}
    	
    	return ArrayHelper::map($opciones, 'salaid', 'saladescripcion');
    }
    
    public static function getListaSalasDisponibles($salaid, $fecha, $horainicio, $horafin, $audienciaid) {
	    
    	$query1 = static::getQuerySalasPorFechaHorario($fecha);
    	$query2 = Audiencia::getQuerySalasOcupadasPorAudiencia();
    
    	$query = $query1.' EXCEPT '.$query2;
    
    	// Obtenemos el ambitoid del Usuario Logueado. Este será utilizado para obtener las salas
    	// disponibles en el Ambito.
    	$ambitoid = Usuario::getAmbitoUsuarioLogueado();
    	 
    	$params = [
    			':ambitoid' => $ambitoid,
    			':fecha' => $fecha,
    			':horainicio' => $horainicio,
    			':horafin' => $horafin,
    			':audienciaid' => $audienciaid,
    			':salaid' => $salaid,
    	];
    	 
    	$opciones = Sala::findBySql($query, $params)->asArray()->all();
    	return ArrayHelper::map($opciones, 'salaid', 'saladescripcion');
    }
    
    
    public static function getCountSalasDisponibles($salaid, $fecha, $horainicio, $horafin, $audienciaid=NULL)
    {
    
    	$query1 = static::getQuerySalasPorFechaHorario($fecha);
    	$query2 = Audiencia::getQuerySalasOcupadasPorAudiencia();
    
    	$query = $query1.' EXCEPT '.$query2;
    
    	// Obtenemos el ambitoid del Usuario Logueado. Este será utilizado para obtener las salas
    	// disponibles en el Ambito.
    	$ambitoid = Usuario::getAmbitoUsuarioLogueado();
    	 
    	$params = [
    			':ambitoid' => $ambitoid,
    			':fecha' => $fecha,
    			':horainicio' => $horainicio,
    			':horafin' => $horafin,
    			':audienciaid' => $audienciaid,
    			':salaid' => $salaid,
    	];
    	 
    	return Sala::findBySql($query, $params)->asArray()->count();

    }
    
    
    private static function getQuerySalasPorFechaHorario ($fecha) {
    	 
    	$dias = ['domingo', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'];
    	$fechaModificada = str_replace('/', '-', $fecha);
    	$datetime = strtotime($fechaModificada);
    	$dia = $dias[date('w', $datetime)];
    	
    	/* Retorna todas las salas disponibles para el dia y horario solicitado */
    	$query = 'SELECT DISTINCT salarangohorario.salaid '.
    			'FROM salarangohorario INNER JOIN sala ON (salarangohorario.salaid = sala.salaid) '.
    			'WHERE  sala.ambitoid = :ambitoid AND '.
    					'sala.salaid = :salaid AND '.
		    			'sala.salaactiva = true AND '.
		    			'salarangohorario.salarangohorariodia'.$dia.' = true AND '.
		    			'salarangohorario.salarangohorarioinicio <= :horainicio AND '.
		    			':horafin <= salarangohorario.salarangohorariofin ';
    
    	return $query;
    }
    
    
// 	public static function getSalasPorFechaHorario ($fecha, $horainicio, $horafin) {
     
//     	$query = static::getQuerySalasPorFechaHorario($fecha);

// 	    // Obtenemos el ambitoid del Usuario Logueado. Este será utilizado para obtener las salas
// 	    // disponibles en el Ambito.
// 	    $ambitoid = Usuario::getAmbitoUsuarioLogueado();
//         $params = [
//         			':ambitoid' => $ambitoid,
//         			':horaInicio' => $horainicio,
//         			':horaFin' => $horafin,
//         	];
    
//         return static::findBySql($query, $params)->all();
    
// 	}
    
    public static function getCountSalasPorFechaHorario ($salaid, $fecha, $horainicio, $horafin) {
    
    	$query = static::getQuerySalasPorFechaHorario($fecha);
    	
    	// Obtenemos el ambitoid del Usuario Logueado. Este será utilizado para obtener las salas
    	// disponibles en el Ambito.
    	$ambitoid = Usuario::getAmbitoUsuarioLogueado();
    	 
    	$params = [
    			':ambitoid' => $ambitoid,
    			':horainicio' => $horainicio,
    			':horafin' => $horafin,
    			':salaid' => $salaid,
    	];
    	
    	return static::findBySql($query, $params)->count();
    
    }
    
}
