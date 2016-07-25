<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $usuarioid
 * @property string $usuarionombre
 * @property integer $rhid
 * @property string $email
 * @property string $password
 * @property string $authkey
 * @property string $accesstoken
 * @property boolean $activo
 * @property boolean $administrador
 *
 * @property Rh $rh
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//             [['usuarionombre', 'rhid', 'password', 'authkey', 'accesstoken'], 'required'],
            [['usuarionombre', 'rhid', 'password'], 'required'],
        	[['rhid'], 'integer'],
            [['activo', 'administrador'], 'boolean'],
        	[['activo'], 'default', 'value' => true],
        	[['usuarionombre'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 80],
            [['password', 'authkey', 'accesstoken'], 'string', 'max' => 250],
//         	[['usuarionombre'], 'unique'],
//             [['email'], 'unique'],
            [['rhid'], 'exist', 'skipOnError' => true, 'targetClass' => Rh::className(), 'targetAttribute' => ['rhid' => 'rhid']],
        ];
    }

    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'usuarioid' => Yii::t('app', 'Usuarioid'),
            'usuarionombre' => Yii::t('app', 'Usuarionombre'),
            'rhid' => Yii::t('app', 'Rh'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'authkey' => Yii::t('app', 'Authkey'),
            'accesstoken' => Yii::t('app', 'Accesstoken'),
            'activo' => Yii::t('app', 'Activo'),
        	'administrador' => Yii::t('app', 'Administrador'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRh()
    {
        return $this->hasOne(Rh::className(), ['rhid' => 'rhid']);
    }
    
    private function randKey($str = '', $long = 0)
    {
    	$key = null;
    	$str = str_split($str);
    	$start = 0;
    	$limit = count($str) - 1;
    
    	for($x=0; $x < $long; $x++)
    	{
    		$key .= $str[rand($start, $limit)];
    	}
    	return $key;
    }
    
    public function beforeSave($insert)
    {
    	if (parent::beforeSave($insert)) {

    		$encriptarPass = false;
    		
    		if ($insert) {
    			// Creamos una cookie para autenticar al usuario cuando decida recordar la sesión, esta misma
    			// clave será utilizada para activar el usuario
    			$this->authkey = $this->randKey("abcdef0123456789", 200);
    			
    			//Creamos un token de acceso único para el usuario
    			$this->accesstoken = $this->randKey("abcdef0123456789", 200);
    		}
    		
    		$oldPass = $this->getOldAttribute('password');
    		
    		if (isset($oldPass)) {
    			if ($oldPass <> $this->password) {
    				$encriptarPass = true;
    			}
    		}
    		
    		if (($insert) or ($encriptarPass)) {
    			// Encriptamos el password
    			$this->password = crypt($this->password, \Yii::$app->params["salt"]);
    		}
    		return true;
    		
    	} else {
    		
    		return false;
    		
    	}
    }
    
    public static function getUsuarioLogueado () {
    	
    	return Usuario::findOne(['usuarioid' => User::getIdUsuarioLogueado()]);
    }

    public static function getAmbitoUsuarioLogueado () {
    	
    	// Recuperamos el Rh asociado al usuario.
    	$rh = Usuario::getUsuarioLogueado()->rh;
    	
    	// Recuperamos el Ambito del Usuario Logueado.
    	return $rh->rhsector->ambito->ambitoid;
    	 
    }
    
    public static function esUsuarioAdministrador($id) {
    	
    	if (Usuario::findOne(['usuarioid' => $id, 'activo' => true, 'administrador' => true])) {
    		return true;
    	} else {
    		return false;
    	}
    }
    
    public static function esUsuarioSimple($id) {
    	
    	if (Usuario::findOne(['usuarioid' => $id, 'activo' => true, 'administrador' => false])) {
    		return true;
    	} else {
    		return false;
    	}
    }
    
}
