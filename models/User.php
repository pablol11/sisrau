<?php

namespace app\models;

use app\models\Usuario;
use Yii;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
//     public $id;
//     public $username;
//     public $password;
//     public $authKey;
//     public $accessToken;

    public $usuarioid;
    public $usuarionombre;
    public $rhid;
    public $email;
    public $password;
    public $authkey;
    public $accesstoken;
    public $activo;
    public $administrador;
    
//     private static $users = [
//         '100' => [
//             'id' => '100',
//             'username' => 'admin',
//             'password' => 'admin',
//             'authKey' => 'test100key',
//             'accessToken' => '100-token',
//         ],
//         '101' => [
//             'id' => '101',
//             'username' => 'demo',
//             'password' => 'demo',
//             'authKey' => 'test101key',
//             'accessToken' => '101-token',
//         ],
//     ];

    /**
     * @inheritdoc
     */
    
    /* busca la identidad del usuario a través de su $id */
    
    public static function findIdentity($id)
    {
//     	return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    	
    	$user = Usuario::find()
    					->where("activo = :activate", [":activate" => true])
						->andWhere("usuarioid = :id", [":id" => $id])
						->one();

		return isset($user) ? new static($user) : null;
    }

    /**
     * @inheritdoc
     */
    
    /* Busca la identidad del usuario a través de su token de acceso */
    
    public static function findIdentityByAccessToken($token, $type = null)
    {
    	$users = Usuario::find()
				    	->where("activo = :activate", [":activate" => true])
				    	->andWhere("accesstoken = :accessToken", [":accessToken" => $token])
				    	->all();
				    	 
//     	foreach (self::$users as $user) {
//             if ($user['accessToken'] === $token) {
    	foreach ($users as $user) {
        	if ($user->accesstoken === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    
    /* Busca la identidad del usuario a través del username */
    
    public static function findByUsername($username)
    {
    	$user = Usuario::find()
				    	->where('usuarionombre = :username', [':username' => $username])
    					->andWhere('activo = :activate', [':activate' => true])
				    	->one();
    	
//         foreach (self::$users as $user) {
//             if (strcasecmp($user['username'], $username) === 0) {
//     			return new static($user);
//     		}
//     	}

//         return null;

    	return isset($user) ? new static($user) : null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
//         return $this->id;
        return $this->usuarioid;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
//         return $this->authKey;
        return $this->authkey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
//         return $this->authKey === $authKey;
    	return $this->authkey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
    	return (crypt($password, Yii::$app->params["salt"]) == $this->password); 
//     	if ($password == $this->password) {
//         	return $this->password === $password;
//     	}
    }

    public static function getIdUsuarioLogueado () {
    
    	// Recuperamos el Id del usuario logueado.
    	return \Yii::$app->user->identity->id;
    }
    
    
    public static function esAdministrador($id) {
    	
    	return Usuario::esUsuarioAdministrador($id);
    }
    
    public static function esUsuarioSimple($id) {
    	
    	return Usuario::esUsuarioSimple($id);
    }

    public static function esUsuarioLogueadoAdmin () {
    	
    	return static::esAdministrador(static::getIdUsuarioLogueado());
    }
}
