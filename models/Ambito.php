<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ambito".
 *
 * @property integer $ambitoid
 * @property string $ambitodescripcion
 *
 * @property Audiencia[] $audiencias
 * @property Audienciaanulada[] $audienciaanuladas
 * @property Rh[] $rhs
 * @property Sala[] $salas
 * @property Sector[] $sectors
 */
class Ambito extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ambito';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ambitodescripcion'], 'required'],
            [['ambitodescripcion'], 'string', 'max' => 120]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ambitoid' => Yii::t('app', 'Ambitoid'),
            'ambitodescripcion' => Yii::t('app', 'Ambitodescripcion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudiencias()
    {
        return $this->hasMany(Audiencia::className(), ['audienciaregambitoid' => 'ambitoid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudienciaanuladas()
    {
        return $this->hasMany(Audienciaanulada::className(), ['audienciaanuladaambitoid' => 'ambitoid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRhs()
    {
        return $this->hasMany(Rh::className(), ['rhambitoid' => 'ambitoid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalas()
    {
        return $this->hasMany(Sala::className(), ['ambitoid' => 'ambitoid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSectors()
    {
        return $this->hasMany(Sector::className(), ['ambitoid' => 'ambitoid']);
    }


    public static function getListaAmbitos()
    {
    	// Si es un usuario Simple, se filtra por el ambito del mismo,
    	// Caso contrario se visualizarán todos los ambitos existentes.    	   
    	if (!User::esUsuarioLogueadoAdmin()) {
    		$ambitoid = Usuario::getAmbitoUsuarioLogueado();
    		$opciones = Ambito::find()->where(['ambitoid' => $ambitoid])->asArray()->orderBy('ambitoid')->all();
    	} else {
    		$opciones = Ambito::find()->asArray()->orderBy('ambitoid')->all();
    	}
    	
    	return ArrayHelper::map($opciones, 'ambitoid', 'ambitodescripcion');
    }
    
}
