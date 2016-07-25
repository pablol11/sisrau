<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tiposector".
 *
 * @property integer $tiposectorid
 * @property string $tiposectordescripcion
 *
 * @property Sector[] $sectors
 */
class TipoSector extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tiposector';
    }

    public static function getListaTipoSectores()
    {
    	$opciones = TipoSector::find()->orderBy(['tiposectordescripcion' => SORT_ASC])->asArray()->all();
    	return ArrayHelper::map($opciones, 'tiposectorid', 'tiposectordescripcion');
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tiposectordescripcion'], 'required'],
            [['tiposectordescripcion'], 'string', 'max' => 120],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tiposectorid' => Yii::t('app', 'Tiposectorid'),
            'tiposectordescripcion' => Yii::t('app', 'Tiposectordescripcion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSectors()
    {
        return $this->hasMany(Sector::className(), ['tiposectorid' => 'tiposectorid']);
    }
    
}
