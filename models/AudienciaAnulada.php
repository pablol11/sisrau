<?php

namespace app\models;

use Yii;
use yii\db\Connection;

/**
 * This is the model class for table "audienciaanulada".
 *
 * @property integer $audienciaid
 * @property string $audienciaanuladafecha
 * @property integer $audienciaanuladaambitoid
 * @property integer $audienciaanuladasectorid
 * @property integer $audienciaanuladarhid
 * @property string $audienciaanuladamotivo
 *
 * @property Ambito $audienciaanuladaambito
 * @property Audiencia $audiencia
 * @property Rh $audienciaanuladarh
 * @property Sector $audienciaanuladasector
 */
class AudienciaAnulada extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'audienciaanulada';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['audienciaid', 'audienciaanuladafecha', 'audienciaanuladaambitoid', 'audienciaanuladasectorid', 'audienciaanuladarhid', 'audienciaanuladamotivo'], 'required'],
            [['audienciaid', 'audienciaanuladaambitoid', 'audienciaanuladasectorid', 'audienciaanuladarhid'], 'integer'],
            [['audienciaanuladafecha'], 'safe'],
            [['audienciaanuladamotivo'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'audienciaid' => Yii::t('app', 'Audienciaid'),
            'audienciaanuladafecha' => Yii::t('app', 'Audienciaanuladafecha'),
            'audienciaanuladaambitoid' => Yii::t('app', 'Audienciaanuladaambitoid'),
            'audienciaanuladasectorid' => Yii::t('app', 'Audienciaanuladasectorid'),
            'audienciaanuladarhid' => Yii::t('app', 'Audienciaanuladarhid'),
            'audienciaanuladamotivo' => Yii::t('app', 'Audienciaanuladamotivo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudienciaanuladaambito()
    {
        return $this->hasOne(Ambito::className(), ['ambitoid' => 'audienciaanuladaambitoid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudiencia()
    {
        return $this->hasOne(Audiencia::className(), ['audienciaid' => 'audienciaid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudienciaanuladarh()
    {
        return $this->hasOne(Rh::className(), ['rhid' => 'audienciaanuladarhid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudienciaanuladasector()
    {
        return $this->hasOne(Sector::className(), ['sectorid' => 'audienciaanuladasectorid']);
    }
    
    
    public function afterSave($insert, $changedAttributes) {
    	
   		if ($insert) {
    		$audiencia = $this->audiencia;
	    		
    		// Registramos el cambio de estado en la Audiencia a "Anulada".
    		if (!$audiencia->updateEstado(Estado::getEstadoAnuladoId())) {
    			return false;
    		}
    		
    		// Recorremos los participantes de la Audiencia para eliminarles los warnings y
    		// desvincularlos de la Audiencia Anulada.
    		$audienciaparticipantes = $audiencia->audienciaparticipantes;
    		
    		foreach ($audienciaparticipantes as $participante) {

    			$participante->eliminarWarnings();
    			
    			// Eliminamos el vínculo del participante con la Audiencia Anulada.
    			$participante->delete();
    		}
   		}    		
    	return parent::afterSave($insert, $changedAttributes);
    }
    
}
