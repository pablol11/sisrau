<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "audiencia".
 *
 * @property integer $audienciaid
 * @property string $audienciadescripcion
 * @property string $audienciafecha
 * @property string $audienciahorainicio
 * @property string $audienciahorafin
 * @property integer $salaid
 * @property integer $estadoid
 * @property integer $audienciaregambitoid
 * @property integer $audienciaregsectorid
 * @property integer $audienciaregrhid
 * @property string $audienciaregfecha
 *
 * @property Ambito $audienciaregambito
 * @property Estado $estado
 * @property Rh $audienciaregrh
 * @property Sala $sala
 * @property Sector $audienciaregsector
 * @property Audienciaanulada $audienciaanulada
 * @property Audienciaparticipante[] $audienciaparticipantes
 * @property Rh[] $rhs
 */
class Audiencia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'audiencia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['audienciafecha'], 'date', 'format' => 'php:d-m-Y'],
        	[['audienciafecha'], 'validarFecha'],
        	[['audienciafecha'], 'validarSalaDisponible'],
        	[['audienciafecha'], 'validarParticipantes'],
        	[['audienciadescripcion', 'audienciafecha', 'audienciahorainicio', 'audienciahorafin', 'salaid', 'audienciaregambitoid', 'audienciaregsectorid', 'audienciaregrhid', 'audienciaregfecha'], 'required'],
            [['audienciafecha', 'audienciahorainicio', 'audienciahorafin', 'audienciaregfecha'], 'safe'],
        	[['salaid', 'estadoid', 'audienciaregambitoid', 'audienciaregsectorid', 'audienciaregrhid'], 'integer'],
            [['audienciadescripcion'], 'string', 'max' => 255],
        	[['audienciahorainicio'], 'compare', 'compareAttribute' => 'audienciahorafin', 'operator' => '<'],
        	[['audienciahorafin'], 'compare', 'compareAttribute' => 'audienciahorainicio', 'operator' => '>'],
        	[['estadoid'], 'default', 'value' => 1],
       		[['audienciaregambitoid'], 'exist', 'skipOnError' => true, 'targetClass' => Ambito::className(), 'targetAttribute' => ['audienciaregambitoid' => 'ambitoid']],
       		[['estadoid'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['estadoid' => 'estadoid']],
       		[['audienciaregrhid'], 'exist', 'skipOnError' => true, 'targetClass' => Rh::className(), 'targetAttribute' => ['audienciaregrhid' => 'rhid']],
       		[['salaid'], 'exist', 'skipOnError' => true, 'targetClass' => Sala::className(), 'targetAttribute' => ['salaid' => 'salaid']],
       		[['audienciaregsectorid'], 'exist', 'skipOnError' => true, 'targetClass' => Sector::className(), 'targetAttribute' => ['audienciaregsectorid' => 'sectorid']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'audienciaid' => Yii::t('app', 'Audienciaid'),
            'audienciadescripcion' => Yii::t('app', 'Audienciadescripcion'),
            'audienciafecha' => Yii::t('app', 'Audienciafecha'),
            'audienciahorainicio' => Yii::t('app', 'Audienciahorainicio'),
            'audienciahorafin' => Yii::t('app', 'Audienciahorafin'),
            'salaid' => Yii::t('app', 'Sala'),
            'estadoid' => Yii::t('app', 'Estado'),
            'audienciaregambitoid' => Yii::t('app', 'Audienciaregambitoid'),
            'audienciaregsectorid' => Yii::t('app', 'Audienciaregsectorid'),
            'audienciaregrhid' => Yii::t('app', 'Audienciaregrhid'),
            'audienciaregfecha' => Yii::t('app', 'Audienciaregfecha'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudienciaregambito()
    {
        return $this->hasOne(Ambito::className(), ['ambitoid' => 'audienciaregambitoid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstado()
    {
        return $this->hasOne(Estado::className(), ['estadoid' => 'estadoid']);
    }

    public function getEstadoDescripcion()
    {
        $estado = $this->getEstado();
        return $estado->estadodescripcion;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudienciaregrh()
    {
        return $this->hasOne(Rh::className(), ['rhid' => 'audienciaregrhid']);
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
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudienciaregsector()
    {
        return $this->hasOne(Sector::className(), ['sectorid' => 'audienciaregsectorid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudienciaanulada()
    {
        return $this->hasOne(Audienciaanulada::className(), ['audienciaid' => 'audienciaid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudienciaparticipantes()
    {
        return $this->hasMany(Audienciaparticipante::className(), ['audienciaid' => 'audienciaid']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRhs()
    {
    	return $this->hasMany(Rh::className(), ['rhid' => 'rhid'])->viaTable('audienciaparticipante', ['audienciaid' => 'audienciaid']);
    }

    
    public function validarFecha($attribute, $params) {

    	if ($this->audienciafecha < date('d-m-Y')) {
    		$this->addError($attribute, \Yii::t('app', 'Error validacion con fecha actual'));
    	} else {
			if (Feriado::validarFecha($this->audienciafecha)) {
	    		$this->addError($attribute, Yii::t('app', 'Error validacion feriado'));
	    	}
    	}
    }

    
    public function validarSalaDisponible($attribute) {

    	// Recupero la cantidad de Salas disponibles para una Fecha y Horario.
    	$cant = Sala::getCountSalasPorFechaHorario($this->salaid, $this->audienciafecha, $this->audienciahorainicio, $this->audienciahorafin);
    	
    	if ($cant > 0) {
    	
    		// Recupero la cantidad de Salas Ocupadas por Audiencias en una Fecha y Horario.
    		$cant = Sala::getCountSalasDisponibles($this->salaid, $this->audienciafecha, $this->audienciahorainicio, $this->audienciahorafin, $this->audienciaid);

	    	if ($cant == 0) {
	    		$this->addError($attribute, Yii::t('app', 'Error validacion sala no disponible'));
	    	}
	    	
    	} else {
    		$this->addError($attribute, Yii::t('app', 'No hay rango horario disponible para el dia en la sala'));
    	}    		
    }
    
    public static function getQuerySalasOcupadasPorAudiencia () {
    	 
    	/* Retorna todas las salas que se solapan con la fecha y el horario solicitado */
    	$query = 'SELECT DISTINCT audiencia.salaid '.
    			'FROM audiencia '.
    			'WHERE audiencia.audienciaregambitoid = :ambitoid AND '.
		    			/* Audiencias en estado Normal -> 1 */
				    	'audiencia.estadoid = '.Estado::getEstadoNormalId().' AND '.
				    	'audiencia.salaid = :salaid AND '.
				    	'audiencia.audienciafecha = :fecha AND '.
				    	':horainicio < audiencia.audienciahorafin AND '.
				    	':horafin > audiencia.audienciahorainicio AND '.
				    	'(audienciaid <> :audienciaid OR :audienciaid IS NULL) ';
    	 
    	return $query;
    }
    
    public function afterSave($insert, $changedAttributes) {
    	 
    	if (!$insert) {
    
    		// Procesamos la actualización de los warnings, solamente si no se cambió el estado de
    		// la Audiencia. Caso contrario, la Audiencia fue Anulada, y los warnings son procesados
    		// por la clase AudienciaAnulada.
    		$procesar = array_key_exists('estadoid', $changedAttributes) ? false : true;
    		    		
    		if ($procesar) {
	   			// Obtenemos los valores que fueron modificados en la audiencia.
	   			$fecha = (array_key_exists('audienciafecha', $changedAttributes)) ? $changedAttributes['audienciafecha'] : $this->audienciafecha;
	   			$fechaAudienciaOld = date("d-m-Y", strtotime($fecha));
	   			$horaInicio = (array_key_exists('audienciahorainicio', $changedAttributes)) ? $changedAttributes['audienciahorainicio'] : $this->audienciahorainicio;
	   			$horaInicioOld = date("H:i", strtotime($horaInicio));
	   			$horaFin = (array_key_exists('audienciahorafin', $changedAttributes)) ? $changedAttributes['audienciahorafin'] : $this->audienciahorafin;
	   			$horaFinOld = date("H:i", strtotime($horaFin));
	    		
	    		// Si se modificó la fecha, la hora de inicio o la hora de fin, 
	    		// entonces actualizamos los warnings de los participantes, caso contrario, no hacemos nada.
	    		if (($this->audienciafecha != $fechaAudienciaOld) or
	    			($this->audienciahorainicio != $horaInicioOld) or
	    			($this->audienciahorafin != $horaFinOld)) {
	    		
		   			// Recorremos los participantes de la Audiencia para actualizarles los warnings. 
		    		$audienciaparticipantes = $this->audienciaparticipantes;
		    
		    		foreach ($audienciaparticipantes as $participante) {
		    			$participante->actualizarWarnings($fechaAudienciaOld, $horaInicioOld, $horaFinOld);
		    		}
	    		}
    		}
    	}
    	return parent::afterSave($insert, $changedAttributes);
    }
    
    
    
    public function validarParticipantes($attribute) {
    	
    	if (!$this->isNewRecord) {
    		
    		$error = null;
    		$cant = 0;
    		
    		$fechaAudienciaOld = date("d-m-Y", strtotime($this->oldAttributes['audienciafecha']));
    		$horaInicioOld = date("H:i", strtotime($this->oldAttributes['audienciahorainicio']));
    		$horaFinOld = date("H:i", strtotime($this->oldAttributes['audienciahorafin']));

    		// Si se modificó la fecha, la hora de inicio o la hora de fin, 
    		// entonces revalidamos los participantes, caso contrario, no hacemos nada.
    		if (($this->audienciafecha != $fechaAudienciaOld) or
    			($this->audienciahorainicio != $horaInicioOld) or
    			($this->audienciahorafin != $horaFinOld)) {
    		
	    		// Recorremos todos los participantes vinculados a la Audiencia para verificar
	    		// que la modificación de la fecha y los horarios sean válidos para ellos.
	    		$audienciaparticipantes = $this->audienciaparticipantes;
	    
	    		foreach ($audienciaparticipantes as $participante) {
	    		
	    			$Rhs = Rh::getRhsDisponiblesParaAudiencia($this->audienciaid, $participante->rhid, $this->audienciafecha, $this->audienciahorainicio, $this->audienciahorafin);
	    			
	    			if (empty($Rhs)) {
	    				$error .= '"'.$participante->rh->getApellidoYNombre().'" ';
	    				$cant++;
	    			}
	    		}
	    		
	    		if (!empty($error)) {
	    			if ($cant > 1) {
	    				$error = \Yii::t('app', 'Los participantes: {participantes}', ['participantes' => $error]);
	    			} else {
	    				if ($cant == 1) {
	    					$error = Yii::t('app', 'El participante: {participantes}', ['participantes' => $error]);
	    				}
	    			}
	    			$this->addError($attribute, $error);
	    		}
    		}
    	}
    }
    
    public function updateEstado ($estadoid) {
    	try {
//     		$sqlUpdate = 'UPDATE audiencia SET estadoid = :estadoid WHERE audienciaid = :audienciaid';
//     		$params = [':audienciaid' => $this->audienciaid, ':estadoid' => $estadoid];
//     		\Yii::$app->db->createCommand($sqlUpdate, $params)->execute();

    		$this->estadoid = $estadoid;
    		$this->save(false);
    		return true;
    		
    	} catch (Exception $e) {
    		return false;
    	}
    	 
    }
    
}
