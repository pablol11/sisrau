<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "audienciaparticipante".
 *
 * @property integer $audienciaparticipanteid
 * @property integer $audienciaid
 * @property integer $rhid
 *
 * @property Audiencia $audiencia
 * @property Rh $rh
 * @property Audienciapartwarn $audienciapartwarn
 */
class AudienciaParticipante extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'audienciaparticipante';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['audienciaid', 'rhid'], 'required'],
            [['audienciaid', 'rhid'], 'integer'],
            [['audienciaid', 'rhid'], 'unique', 
            		'targetAttribute' => ['audienciaid', 'rhid'], 
            		'message' => Yii::t('app', 'The combination of Audienciaid and Rhid has already been taken.')]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'audienciaparticipanteid' => Yii::t('app', 'AudienciaparticipanteDescripcion'),
            'audienciaid' => Yii::t('app', 'Audiencia'),
            'rhid' => Yii::t('app', 'Rhparticipante'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudiencia()
    {
        return $this->hasOne(Audiencia::className(), ['audienciaid' => 'audienciaid']);
    }

    
    public function getAudienciaAnterior() {
    	return $this->findAudienciaAnterior($this->audiencia->audienciafecha, $this->audiencia->audienciahorainicio, $this->audiencia->audienciahorafin);
    }
    
    
    public function findAudienciaAnterior($fecha, $horainicio, $horafin)
    {
    	$nuevahora = date("H:i", strtotime($horainicio) - (10 * 60));
    	
    	return Audiencia::find()->join('INNER JOIN', 
    									'audienciaparticipante', 
    									'audienciaparticipante.audienciaid = audiencia.audienciaid')
    							->join('INNER JOIN', 
    									'sala', 
    									'audiencia.salaid = sala.salaid')
    				->where(['rhid' => $this->rhid])
    				->andWhere(['sala.salaactiva' => true])
        			->andWhere(['audienciafecha' => $fecha])
    				->andWhere(['<', 'audienciahorainicio', $horainicio])
        			->andWhere(['>', 'audienciahorafin', $nuevahora ])
        			->andWhere(['estadoid' => Estado::getEstadoNormalId()])
        			->one();
    }

    
    public function getAudienciaPosterior() {
    	return $this->findAudienciaPosterior($this->audiencia->audienciafecha, $this->audiencia->audienciahorainicio, $this->audiencia->audienciahorafin);
    }
    

    public function findAudienciaPosterior($fecha, $horainicio, $horafin)
    {
    	$nuevahora = date("H:i", strtotime($horafin) + (10 * 60));
    	 
    	return Audiencia::find()->join('INNER JOIN', 
    									'audienciaparticipante', 
    									'audienciaparticipante.audienciaid = audiencia.audienciaid')
    							->join('INNER JOIN', 
    									'sala', 
    									'audiencia.salaid = sala.salaid')
    				->where(['rhid' => $this->rhid])
    				->andWhere(['sala.salaactiva' => true])
    				->andWhere(['audienciafecha' => $fecha])
        			->andWhere(['<', 'audienciahorainicio', $nuevahora])
        			->andWhere(['>', 'audienciahorafin', $horafin])
        			->andWhere(['estadoid' => Estado::getEstadoNormalId()])
        			->one();
    }

    public function limpiarWarnAnterior() {
    	
    	$audienciapartwarn = $this->audienciapartwarn;
    	
    	if (!empty($audienciapartwarn)) {
    		$audienciapartwarn->audienciapartwarnmsgeanterior = null;
    		$audienciapartwarn->save(false);

    	   	if (empty($audienciapartwarn->audienciapartwarnmsgeposterior)) {
	    		$audienciapartwarn->delete();
	    	}
    	}
    	
    }
    
    public function limpiarWarnPosterior() {
    	
    	$audienciapartwarn = $this->audienciapartwarn;
    	
    	if (!empty($audienciapartwarn)) {
    		$audienciapartwarn->audienciapartwarnmsgeposterior = null;
    		$audienciapartwarn->save(false);
    	    	
	    	if (empty($audienciapartwarn->audienciapartwarnmsgeanterior)) {
	    		$audienciapartwarn->delete();
	    	}
    	}
    }
    
    public function eliminarWarnings() {
    	
		// Buscamos la Audiencia Anterior con 10 min. diferencia del Participante.
    	$audienciaAnterior = $this->getAudienciaAnterior();
    	 
    	if (!empty($audienciaAnterior)) {
    		// Recuperamos el rh como participante en la Audiencia Anterior.
    		$audienciaPartAnterior = AudienciaParticipante::getParticipante($audienciaAnterior->audienciaid, $this->rhid);
    		$audienciaPartAnterior->limpiarWarnPosterior();
    	}
    	 
    	// Buscamos la Audiencia Posterior con 10 min. diferencia del Participante.
    	$audienciaPosterior = $this->getAudienciaPosterior();
    	 
    	if (!empty($audienciaPosterior)) {
    		// Recuperamos el rh como participante en la Audiencia Posterior.
    		$audienciaPosteriorPart = AudienciaParticipante::getParticipante($audienciaPosterior->audienciaid, $this->rhid);
    		$audienciaPosteriorPart->limpiarWarnAnterior();
    	}
    	 
    	// Finalmente eliminamos el Warning del participante, si tiene.
    	if (!empty($this->audienciapartwarn)) {
    		$this->audienciapartwarn->delete();
    	}
    	   
    }
    
    public function eliminarWarningsPorActualizacion($fecha, $horainicio, $horafin) {
    	
		// Buscamos la Audiencia Anterior con 10 min. diferencia del Participante.
    	$audienciaAnterior = $this->findAudienciaAnterior($fecha, $horainicio, $horafin);
    	 
    	if (!empty($audienciaAnterior)) {
    		// Recuperamos el rh como participante en la Audiencia Anterior.
    		$audienciaPartAnterior = AudienciaParticipante::getParticipante($audienciaAnterior->audienciaid, $this->rhid);
    		$audienciaPartAnterior->limpiarWarnPosterior();
    	}
    	 
    	// Buscamos la Audiencia Posterior con 10 min. diferencia del Participante.
    	$audienciaPosterior = $this->findAudienciaPosterior($fecha, $horainicio, $horafin);
    	 
    	if (!empty($audienciaPosterior)) {
    		// Recuperamos el rh como participante en la Audiencia Posterior.
    		$audienciaPosteriorPart = AudienciaParticipante::getParticipante($audienciaPosterior->audienciaid, $this->rhid);
    		$audienciaPosteriorPart->limpiarWarnAnterior();
    	}
    	 
    	// Finalmente eliminamos el Warning del participante, si tiene.
    	if (!empty($this->audienciapartwarn)) {
    		$this->audienciapartwarn->delete();
    	}
    	   
    }
    
    public function actualizarWarnings($fecha, $horainicio, $horafin) {
    	
    	$this->eliminarWarningsPorActualizacion($fecha, $horainicio, $horafin);
    	$this->crearWarnings();
    	
    }
    
    public function crearWarnings() {

    	$retorno = 0;
    	$mensajeAnterior = null;
    	$mensajePosterior = null;
    	 
    	// Verificamos la existencia de una Audiencia anterior a la actual del participante.
    	// Dicha Audiencia debe solapar el rango de 10 minutos previos al inicio de la actual.
    	// En dicho caso, se registrará un Warning en la relación Participante-Audiencia.
    	$audienciaAnterior = $this->getAudienciaAnterior();
    	
    	if (!empty($audienciaAnterior)) {
    		$mensajeAnterior = $audienciaAnterior->audienciadescripcion.
    		', inicia: '.$audienciaAnterior->audienciahorainicio.
    		' - finaliza: '.$audienciaAnterior->audienciahorafin.
    		' en sala: '.$audienciaAnterior->sala->saladescripcion;
    	}
    	
    	// Verificamos la existencia de una Audiencia posterior a la actual del participante.
    	// Dicha Audiencia debe solapar el rango de 10 minutos posteriores al final de la actual.
    	// En dicho caso, se registrará un Warning en la relación Participante-Audiencia.
    	$audienciaPosterior = $this->getAudienciaPosterior();
    	
    	if (!empty($audienciaPosterior)) {
    		$mensajePosterior = $audienciaPosterior->audienciadescripcion.
    		', inicia: '.$audienciaPosterior->audienciahorainicio.
    		' - finaliza: '.$audienciaPosterior->audienciahorafin.
    		' en sala: '.$audienciaPosterior->sala->saladescripcion;
    	}
    	
    	if ((!empty($mensajeAnterior)) or (!empty($mensajePosterior))) {
    		 
    		$audienciaWarning = new AudienciaPartWarn();
    		$audienciaWarning->audienciaparticipanteid = $this->audienciaparticipanteid;
    		$audienciaWarning->audienciapartwarnmsgeanterior = $mensajeAnterior;
    		$audienciaWarning->audienciapartwarnmsgeposterior = $mensajePosterior;
    	
    		$audienciaWarning->save();
    		 
    		$retorno = 1;
    	}
    	return $retorno;
    }
    
	public function beforeDelete()
	{
	    if (parent::beforeDelete()) {
	        $this->eliminarWarnings();
	        return true;
	    } else {
	        return false;
	    }
	}
    
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRh()
    {
        return $this->hasOne(Rh::className(), ['rhid' => 'rhid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudienciapartwarn()
    {
        return $this->hasOne(Audienciapartwarn::className(), ['audienciaparticipanteid' => 'audienciaparticipanteid']);
    }
    
    
    public static function getParticipante($audienciaid, $rhid) {
    	
    	return static::find()->where(['audienciaid' => $audienciaid, 'rhid' => $rhid])->one();
    }
}
