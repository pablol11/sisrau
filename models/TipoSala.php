<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tiposala".
 *
 * @property integer $tiposalaid
 * @property string $tiposaladescripcion
 *
 * @property Sala[] $salas
 */
class TipoSala extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tiposala';
    }

    public static function getListaTipoSalas()
    {
    	$opciones = TipoSala::find()->asArray()->all();
    	return ArrayHelper::map($opciones, 'tiposalaid', 'tiposaladescripcion');
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tiposaladescripcion'], 'required'],
            [['tiposaladescripcion'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tiposalaid' => Yii::t('app', 'Tiposalaid'),
            'tiposaladescripcion' => Yii::t('app', 'Tiposaladescripcion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalas()
    {
        return $this->hasMany(Sala::className(), ['tiposalaid' => 'tiposalaid']);
    }
}
