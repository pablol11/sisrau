<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "estado".
 *
 * @property integer $estadoid
 * @property string $estadodescripcion
 *
 * @property Audiencia[] $audiencias
 */
class Estado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estado';
    }

    public static function getListaEstados()
    {
    	$opciones = Estado::find()->asArray()->all();
    	return ArrayHelper::map($opciones, 'estadoid', 'estadodescripcion');
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estadodescripcion'], 'required'],
            [['estadodescripcion'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'estadoid' => Yii::t('app', 'Estadoid'),
            'estadodescripcion' => Yii::t('app', 'Estadodescripcion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudiencias()
    {
        return $this->hasMany(Audiencia::className(), ['estadoid' => 'estadoid']);
    }
    
    public static function getEstadoNormalId () {
    	return 1;
    }
    
    public static function getEstadoAnuladoId () {
    	return 2;
    }
}
