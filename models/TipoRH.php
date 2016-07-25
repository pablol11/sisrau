<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tiporh".
 *
 * @property integer $tiporhid
 * @property string $tiporhdescripcion
 *
 * @property Rh[] $rhs
 */
class TipoRh extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tiporh';
    }

    public static function getListaTipoRh()
    {
    	$opciones = TipoRh::find()->orderBy('tiporhdescripcion')->asArray()->all();
    	return ArrayHelper::map($opciones, 'tiporhid', 'tiporhdescripcion');
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tiporhdescripcion'], 'required'],
            [['tiporhdescripcion'], 'string', 'max' => 120]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tiporhid' => Yii::t('app', 'Tiporhid'),
            'tiporhdescripcion' => Yii::t('app', 'Tiporhdescripcion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRhs()
    {
        return $this->hasMany(Rh::className(), ['tiporhid' => 'tiporhid']);
    }
}
