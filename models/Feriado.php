<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feriado".
 *
 * @property string $feriadoid
 * @property string $feriadofecha
 * @property string $feriadotexto
 */
class Feriado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feriado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['feriadofecha', 'feriadotexto'], 'required'],
            [['feriadofecha'], 'safe'],
            [['feriadotexto'], 'string', 'max' => 120],
            [['feriadofecha'], 'unique'],
        	[['feriadofecha'], 'date', 'format'=>'php:d-m-Y'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'feriadoid' => Yii::t('app', 'Feriadoid'),
            'feriadofecha' => Yii::t('app', 'Feriadofecha'),
            'feriadotexto' => Yii::t('app', 'Feriadotexto'),
        ];
    }
    
    public static function validarFecha ($fecha) {
    	
    	$cant = static::find()->where('feriadofecha = :feriadofecha', [':feriadofecha' => $fecha])->count();
    	return ($cant > 0);
    	 
    }
}
