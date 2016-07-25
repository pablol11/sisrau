<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "audienciapartwarn".
 *
 * @property integer $audienciaparticipanteid
 * @property string $audienciapartwarnmsgeanterior
 * @property string $audienciapartwarnmsgeposterior
 *
 * @property Audienciaparticipante $audienciaparticipante
 */
class AudienciaPartWarn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'audienciapartwarn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['audienciaparticipanteid'], 'required'],
            [['audienciaparticipanteid'], 'integer'],
            [['audienciapartwarnmsgeanterior', 'audienciapartwarnmsgeposterior'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'audienciaparticipanteid' => Yii::t('app', 'Audienciaparticipanteid'),
       		'audienciapartwarnmsgeanterior' => Yii::t('app', 'Audienciapartwarnmsgeanterior'),
       		'audienciapartwarnmsgeposterior' => Yii::t('app', 'Audienciapartwarnmsgeposterior'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudienciaparticipante()
    {
        return $this->hasOne(Audienciaparticipante::className(), ['audienciaparticipanteid' => 'audienciaparticipanteid']);
    }
}
