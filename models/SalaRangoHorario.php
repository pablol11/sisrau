<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "salarangohorario".
 *
 * @property integer $salarangohorarioid
 * @property integer $salaid
 * @property string $salarangohorarioinicio
 * @property string $salarangohorariofin
 * @property boolean $salarangohorariodiadomingo
 * @property boolean $salarangohorariodialunes
 * @property boolean $salarangohorariodiamartes
 * @property boolean $salarangohorariodiamiercoles
 * @property boolean $salarangohorariodiajueves
 * @property boolean $salarangohorariodiaviernes
 * @property boolean $salarangohorariodiasabado
 *
 * @property Sala $sala
 */
class SalaRangoHorario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'salarangohorario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['salaid', 'salarangohorarioinicio', 'salarangohorariofin'], 'required'],
            [['salaid'], 'integer'],
            [['salarangohorarioinicio', 'salarangohorariofin'], 'safe'],
        	[['salarangohorarioinicio'], 'compare', 'compareAttribute' => 'salarangohorariofin', 'operator' => '<'],
       		[['salarangohorariofin'], 'compare', 'compareAttribute' => 'salarangohorarioinicio', 'operator' => '>'],
       		[['salarangohorariodiadomingo', 'salarangohorariodialunes', 'salarangohorariodiamartes', 'salarangohorariodiamiercoles', 'salarangohorariodiajueves', 'salarangohorariodiaviernes', 'salarangohorariodiasabado'], 'boolean'],
        	[['salarangohorariodiadomingo', 'salarangohorariodialunes', 'salarangohorariodiamartes', 'salarangohorariodiamiercoles', 'salarangohorariodiajueves', 'salarangohorariodiaviernes', 'salarangohorariodiasabado'], 'default', 'value' => false],
//             [['salaid', 'salarangohorariodiadomingo', 'salarangohorariodialunes', 'salarangohorariodiamartes', 'salarangohorariodiamiercoles', 'salarangohorariodiajueves', 'salarangohorariodiaviernes', 'salarangohorariodiasabado', 'salarangohorarioinicio', 'salarangohorariofin'], 'unique', 'targetAttribute' => ['salaid', 'salarangohorariodiadomingo', 'salarangohorariodialunes', 'salarangohorariodiamartes', 'salarangohorariodiamiercoles', 'salarangohorariodiajueves', 'salarangohorariodiaviernes', 'salarangohorariodiasabado', 'salarangohorarioinicio', 'salarangohorariofin'], 'message' => 'The combination of Salaid, Salarangohorarioinicio, Salarangohorariofin, Salarangohorariodiadomingo, Salarangohorariodialunes, Salarangohorariodiamartes, Salarangohorariodiamiercoles, Salarangohorariodiajueves, Salarangohorariodiaviernes and Salarangohorariodiasabado has already been taken.'],
            [['salaid'], 'exist', 'skipOnError' => true, 'targetClass' => Sala::className(), 'targetAttribute' => ['salaid' => 'salaid']],
			[['salaid', 'salarangohorarioinicio', 'salarangohorariofin', 'salarangohorariodiadomingo', 'salarangohorariodialunes', 'salarangohorariodiamartes', 'salarangohorariodiamiercoles', 'salarangohorariodiajueves', 'salarangohorariodiaviernes', 'salarangohorariodiasabado'],'validarSalaRangoHorario'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'salarangohorarioid' => Yii::t('app', 'Salarangohorarioid'),
            'salaid' => Yii::t('app', 'Sala'),
            'salarangohorarioinicio' => Yii::t('app', 'Salarangohorarioinicio'),
            'salarangohorariofin' => Yii::t('app', 'Salarangohorariofin'),
            'salarangohorariodiadomingo' => Yii::t('app', 'Salarangohorariodiadomingo'),
            'salarangohorariodialunes' => Yii::t('app', 'Salarangohorariodialunes'),
            'salarangohorariodiamartes' => Yii::t('app', 'Salarangohorariodiamartes'),
            'salarangohorariodiamiercoles' => Yii::t('app', 'Salarangohorariodiamiercoles'),
            'salarangohorariodiajueves' => Yii::t('app', 'Salarangohorariodiajueves'),
            'salarangohorariodiaviernes' => Yii::t('app', 'Salarangohorariodiaviernes'),
            'salarangohorariodiasabado' => Yii::t('app', 'Salarangohorariodiasabado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSala()
    {
        return $this->hasOne(Sala::className(), ['salaid' => 'salaid']);
    }

	public function getSalaDescripcion()
	{
		$sala = $this->getSala();
		return $sala->saladescripcion;
	}
	
	public function getRegistroDias() {
	
		$registroDias = [];

		$dia = $this->salarangohorariodiadomingo ? Yii::t('app', 'Salarangohorariodiadomingo') : null;
		if (isset($dia)) {
			array_push ($registroDias , $dia);
		}
		$dia = $this->salarangohorariodialunes ? Yii::t('app', 'Salarangohorariodialunes') : null;
		if (isset($dia)) {
			array_push ($registroDias , $dia);
		}
		$dia = $this->salarangohorariodiamartes ? Yii::t('app', 'Salarangohorariodiamartes') : null;
		if (isset($dia)) {
			array_push ($registroDias , $dia);
		}
		$dia = $this->salarangohorariodiamiercoles ? Yii::t('app', 'Salarangohorariodiamiercoles') : null;
		if (isset($dia)) {
			array_push ($registroDias , $dia);
		}
		$dia = $this->salarangohorariodiajueves ? Yii::t('app', 'Salarangohorariodiajueves') : null;
		if (isset($dia)) {
			array_push ($registroDias , $dia);
		}
		$dia = $this->salarangohorariodiaviernes ? Yii::t('app', 'Salarangohorariodiaviernes') : null;
		if (isset($dia)) {
			array_push ($registroDias , $dia);
		}
		$dia = $this->salarangohorariodiasabado ? Yii::t('app', 'Salarangohorariodiasabado') : null;
		if (isset($dia)) {
			array_push ($registroDias , $dia);
		}
		
		if (isset($registroDias)) {
			return implode(' - ', $registroDias);
		} else {
			return '';
		}
	}
	
	public function getRangoHorario() {
		return $this->salarangohorarioinicio.' - '.$this->salarangohorariofin;
	}
	
	public function getSalaRangoHorarioDescripcion() {
		return $this->sala->saladescripcion.' - '.$this->getRegistroDias().' ('.$this->getRangoHorario().')';
	}
	
	public function validarSalaRangoHorario($attribute) {
		
		$query = 'SELECT salarangohorarioid '.
				 'FROM salarangohorario INNER JOIN sala ON (salarangohorario.salaid = sala.salaid) '.
				 'WHERE  salarangohorario.salaid = :salaid AND '.
				 		'sala.salaactiva = true AND '.
					   	':horaInicio < salarangohorariofin AND '.
					   	':horaFin > salarangohorarioinicio AND '.
					   	'(salarangohorarioid <> :salarangohorarioid OR :salarangohorarioid IS NULL) AND '.
						'('.
							'(salarangohorariodiadomingo = :domingo AND :domingo = true) OR '.
							'(salarangohorariodialunes = :lunes AND :lunes = true) OR '.
							'(salarangohorariodiamartes = :martes AND :martes = true) OR '.
							'(salarangohorariodiamiercoles = :miercoles AND :miercoles = true) OR '.
							'(salarangohorariodiajueves = :jueves AND :jueves = true) OR '.
							'(salarangohorariodiaviernes = :viernes AND :viernes = true) OR '.
							'(salarangohorariodiasabado = :sabado AND :sabado = true) '.
						')';
		$params = [
					':salaid' => $this->salaid,
					':horaInicio' => $this->salarangohorarioinicio,
					':horaFin' => $this->salarangohorariofin,
					':salarangohorarioid' => $this->salarangohorarioid,
					':domingo' => $this->salarangohorariodiadomingo,
					':lunes' => $this->salarangohorariodialunes,
					':martes' => $this->salarangohorariodiamartes,
					':miercoles' => $this->salarangohorariodiamiercoles,
					':jueves' => $this->salarangohorariodiajueves,
					':viernes' => $this->salarangohorariodiaviernes,
					':sabado' => $this->salarangohorariodiasabado
			];
		
		$cant = $this->findBySql($query, $params)->count();

		if ($cant > 0) {
			$this->addError('salaid', Yii::t('app', 'Error validacion sala rango horario'));
		}
			
	}
   
}
