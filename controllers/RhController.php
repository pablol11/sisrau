<?php

namespace app\controllers;

use Yii;
use app\models\Rh;
use app\models\RhSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\User;

/**
 * RhController implements the CRUD actions for Rh model.
 */
class RhController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
    	return [
	    	'access' => [
    			'class' => AccessControl::className(),
    			'only' => ['index', 'view', 'create', 'update', 'delete'],
    			'rules' => [
    					[
							// El administrador tiene permisos sobre las siguientes acciones
							'actions' => ['index', 'view', 'create', 'update', 'delete'],
    	
							// Esta propiedad establece que tiene permisos
							'allow' => true,
    	
							// Usuarios autenticados, el signo ? es para invitados
							'roles' => ['@'],
    	
							// Este método nos permite crear un filtro sobre la identidad del usuario
    						// y así establecer si tiene permisos o no
    								
							'matchCallback' => function ($rule, $action) {
									// Llamada al método que comprueba si es un administrador
    								return User::esAdministrador(User::getIdUsuarioLogueado());
    						},
    					],
    					[
							// El usuario simple tiene permisos sobre las siguientes acciones
							'actions' => ['index', 'view'],
    	
							// Esta propiedad establece que tiene permisos
							'allow' => true,
    	
							// Usuarios autenticados, el signo ? es para invitados
							'roles' => ['@'],
    	
							// Este método nos permite crear un filtro sobre la identidad del usuario
    						// y así establecer si tiene permisos o no
    								
							'matchCallback' => function ($rule, $action) {
									// Llamada al método que comprueba si es un administrador
    								return User::esUsuarioSimple(User::getIdUsuarioLogueado());
    						},
    					],
    			],
	    	],    							 
    		'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Rh models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RhSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rh model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Rh model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rh();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//             return $this->redirect(['view', 'id' => $model->rhid]);
        	return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Rh model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//             return $this->redirect(['view', 'id' => $model->rhid]);
        	return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Rh model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Rh model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rh the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rh::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
