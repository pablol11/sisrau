<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "rh".
 *
 * @property integer $rhid
 * @property string $rhnombre
 * @property string $rhapellido
 * @property integer $tiporhid
 * @property integer $rhambitoid
 * @property integer $rhsectorid
 * @property boolean $rhactivo
 *
 * @property Audiencia[] $audiencias
 * @property Audienciaanulada[] $audienciaanuladas
 * @property Audienciaparticipante[] $audienciaparticipantes
//  * @property Audiencia[] $audiencias0
 * @property Audiencia[] $audienciascomoparticipante
 * @property Ambito $rhambito
 * @property Sector $rhsector
 * @property Tiporh $tiporh
 * @property Usuario $usuario
 */
class Rh extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rh';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rhnombre', 'rhapellido', 'tiporhid', 'rhsectorid'], 'required'],
            [['tiporhid', 'rhsectorid', 'rhambitoid'], 'integer'],
            [['rhactivo'], 'boolean'],
            [['rhnombre', 'rhapellido'], 'string', 'max' => 60],
       		[['rhambitoid'], 'exist', 'skipOnError' => true, 'targetClass' => Ambito::className(), 'targetAttribute' => ['rhambitoid' => 'ambitoid']],
            [['rhsectorid'], 'exist', 'skipOnError' => true, 'targetClass' => Sector::className(), 'targetAttribute' => ['rhsectorid' => 'sectorid']],
            [['tiporhid'], 'exist', 'skipOnError' => true, 'targetClass' => Tiporh::className(), 'targetAttribute' => ['tiporhid' => 'tiporhid']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rhid' => Yii::t('app', 'Rhid'),
            'rhnombre' => Yii::t('app', 'Rhnombre'),
            'rhapellido' => Yii::t('app', 'Rhapellido'),
            'tiporhid' => Yii::t('app', 'Tiporh'),
        	'rhambitoid' => Yii::t('app', 'Ambito'),
            'rhsectorid' => Yii::t('app', 'Sector'),
            'rhactivo' => Yii::t('app', 'Rhactivo'),
        ];
    }

    public  static function getRhs () {
    	$opciones = Rh::find()
	    				->select(['rhid', 'apellidoynombre' => 'apellidoynombre(rhapellido, rhnombre)'])
	    				->orderBy('rhapellido, rhnombre')
	    				->asArray()
	    				->all();
    	return ArrayHelper::map($opciones, 'rhid', 'apellidoynombre');
    }
    
    
    public static function getRhsDisponiblesParaAudiencia ($audienciaid, $rhid, $fecha, $horainicio, $horafin /*, $tiporhid=null*/) {
    
    	$esAdmin = User::esUsuarioLogueadoAdmin();
    	
    	$sql = 'SELECT rh.rhid, apellidoynombre(rh.rhapellido, rh.rhnombre) '.
      			'FROM rh '.
				'INNER JOIN ( '.
							/* Recupera todos los RH activos del ambito del usuario */ 
							'SELECT '.
									'rh.rhid '.
							'FROM rh '.
							'WHERE '.
									'rh.rhactivo = true and '.
    								'(rh.rhid = :rhid or :rhid is null) ';
//     								'and (rh.tiporhid = :tiporhid or :tiporhid is null) '.
    	 
//     	if (!$esAdmin) {
			$sql .= 				' and rh.rhambitoid = :ambitoid ';
// 		}
		
		$sql .=				'EXCEPT '.
							/* Recupera todos los RH que son participantes de alguna audiencia 
							 'en el ambito del usuario, para una fecha y horario solicitado */
							'SELECT  '.
									'audienciaparticipante.rhid '.
							'FROM audienciaparticipante '.
// 							   		'INNER JOIN rh ON (audienciaparticipante.rhid = rh.rhid) '.
									'INNER JOIN audiencia ON (audienciaparticipante.audienciaid = audiencia.audienciaid) '.
									'INNER JOIN sala ON (audiencia.salaid = sala.salaid) '.
							'WHERE ';
							
// 		if (!$esAdmin) {
			$sql .= 				'audiencia.audienciaregambitoid = :ambitoid and ';
// 		}
		
		$sql .=						'(audiencia.audienciaid <> :audienciaid or :audienciaid is null) and '.
									'audiencia.audienciafecha = :fecha and '.
									'sala.salaactiva = true and '.
									/* En estado Normal -> 1 */
									'audiencia.estadoid = '.Estado::getEstadoNormalId().' and '.
									':horainicio < audiencia.audienciahorafin and '. 
									':horafin > audiencia.audienciahorainicio and '.
    								'(audienciaparticipante.rhid = :rhid or :rhid is null) '.
//     								'and (rh.tiporhid = :tiporhid or :tiporhid is null) '.
							') AS rhvalidos '.
				'ON (rh.rhid = rhvalidos.rhid) '.
    			'ORDER BY rhapellido, rhnombre ';

// 		if (!$esAdmin) {
			$ambitoid = Usuario::getAmbitoUsuarioLogueado();
    		$params = [
    					':audienciaid' => $audienciaid, 
    					':rhid' => $rhid, 
    					':ambitoid' => $ambitoid, 
    					':fecha' => $fecha, 
    					':horainicio' => $horainicio, 
    					':horafin' => $horafin,
//     					':tiporhid' => $tiporhid
    				 ];
// 		} else {
// 			$params = [':audienciaid' => $audienciaid, ':rhid' => $rhid, ':fecha' => $fecha, ':horainicio' => $horainicio, ':horafin' => $horafin];
// 		}		
    	
    	$opciones = Rh::findBySql($sql, $params)->asArray()->all();
    	
    	return ArrayHelper::map($opciones, 'rhid', 'apellidoynombre');
    } 

    
    public function getApellidoYNombre() {
    	return $this->rhapellido.', '.$this->rhnombre;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudiencias()
    {
        return $this->hasMany(Audiencia::className(), ['audienciaregrhid' => 'rhid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudienciaanuladas()
    {
        return $this->hasMany(Audienciaanulada::className(), ['audienciaanuladarhid' => 'rhid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudienciaparticipantes()
    {
        return $this->hasMany(Audienciaparticipante::className(), ['rhid' => 'rhid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
//     public function getAudiencias0()
    public function getAudienciasComoParticipante()
    {
        return $this->hasMany(Audiencia::className(), ['audienciaid' => 'audienciaid'])->viaTable('audienciaparticipante', ['rhid' => 'rhid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRhambito()
    {
    	return $this->hasOne(Ambito::className(), ['ambitoid' => 'rhambitoid']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRhsector()
    {
        return $this->hasOne(Sector::className(), ['sectorid' => 'rhsectorid']);
    }
    
//     public function getAmbitoId() {
//     	return $this->rhsector ? $this->rhsector->ambito->ambitoid : '';
//     }
    
//     public function getAmbitoSector() {
//     	return $this->rhsector ? $this->rhsector->ambito->ambitodescripcion : '';
//     }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTiporh()
    {
        return $this->hasOne(Tiporh::className(), ['tiporhid' => 'tiporhid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['rhid' => 'rhid']);
    }
}
