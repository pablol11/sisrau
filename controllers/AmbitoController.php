<?php

namespace app\controllers;

use Yii;
use app\models\Ambito;
use app\models\AmbitoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\User;

/**
 * AmbitoController implements the CRUD actions for Ambito model.
 */
class AmbitoController extends Controller
{
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
    								return User::esAdministrador(\Yii::$app->user->identity->id);
    						},
    					],
    			],
	    	],    							 
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Ambito models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AmbitoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ambito model.
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
     * Creates a new Ambito model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ambito();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ambitoid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Ambito model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ambitoid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Ambito model.
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
     * Finds the Ambito model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ambito the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ambito::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
