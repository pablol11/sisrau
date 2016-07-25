<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "sector".
 *
 * @property integer $sectorid
 * @property string $sectordescripcion
 * @property integer $tiposectorid
 * @property integer $ambitoid
 *
 * @property Audiencia[] $audiencias
 * @property Audienciaanulada[] $audienciaanuladas
 * @property Rh[] $rhs
 * @property Ambito $ambito
 * @property Tiposector $tiposector
 */
class Sector extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sector';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sectordescripcion', 'tiposectorid', 'ambitoid'], 'required'],
            [['tiposectorid', 'ambitoid'], 'integer'],
            [['sectordescripcion'], 'string', 'max' => 120]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sectorid' => Yii::t('app', 'Sectorid'),
            'sectordescripcion' => Yii::t('app', 'Sectordescripcion'),
            'tiposectorid' => Yii::t('app', 'Tipo'),
            'ambitoid' => Yii::t('app', 'Ambito'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudiencias()
    {
        return $this->hasMany(Audiencia::className(), ['audienciaregsectorid' => 'sectorid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudienciaanuladas()
    {
        return $this->hasMany(Audienciaanulada::className(), ['audienciaanuladasectorid' => 'sectorid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRhs()
    {
        return $this->hasMany(Rh::className(), ['rhsectorid' => 'sectorid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmbito()
    {
        return $this->hasOne(Ambito::className(), ['ambitoid' => 'ambitoid']);
    }

    public function getAmbitoDescripcion()
    {
        $ambito = $this->getAmbito();
        return $ambito->ambitodescripcion;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTiposector()
    {
        return $this->hasOne(Tiposector::className(), ['tiposectorid' => 'tiposectorid']);
    }
    
    public function getTiposectorDescripcion()
    {
        $tiposector = $this->getTiposector();
        return $tiposector->tiposectordescripcion;
    }

    public static function getListaSectores()
    {
    	if (!User::esUsuarioLogueadoAdmin()) {
    		$ambitoid = Usuario::getAmbitoUsuarioLogueado();
    		$opciones = Sector::find()->where(['ambitoid' => $ambitoid])->orderBy('sectordescripcion')->asArray()->all();
    	} else {
    		$opciones = Sector::find()->orderBy('sectordescripcion')->asArray()->all();
    	}

    	return ArrayHelper::map($opciones, 'sectorid', 'sectordescripcion');
    }
    
    public static function getListaSectoresArrayBy($id)
    {
    	if (!User::esUsuarioLogueadoAdmin()) {
    		$id = Usuario::getAmbitoUsuarioLogueado();
    	}
    	if ((isset($id)) and ($id <> '')) {

    		$opciones = Sector::find()
    						->where(['ambitoid' => $id])
							->orderBy('sectordescripcion')
							->asArray()->all();
    	
    		return ArrayHelper::map($opciones, 'sectorid', 'sectordescripcion');
    	} else {
//     		return static::getListaSectores();
			return Array();
    	}
    }
    
    public static function getListaSectoresBy($id)
    {
        if (!User::esUsuarioLogueadoAdmin()) {
    		$id = Usuario::getAmbitoUsuarioLogueado();
    	}
    	//     	$opciones = Sector::find()->where(['ambitoid' => $id])->orderBy('sectordescripcion')->asArray()->all();
    	//     	return ArrayHelper::map($opciones, 'sectorid', 'sectordescripcion');
    	return Sector::find()->where(['ambitoid' => $id])->orderBy('sectordescripcion')->all();
    
    }
    
    public static function getCountListaSectoresBy($id)
    {
        if (!User::esUsuarioLogueadoAdmin()) {
    		$id = Usuario::getAmbitoUsuarioLogueado();
    	}
    	return static::find()->where(['ambitoid' => $id])->count();
    }
    
    
}
