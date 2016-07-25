<?php

namespace app\controllers;

use Yii;
use app\models\TipoRh;
use app\models\TipoRhSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\User;

/**
 * TipoRhController implements the CRUD actions for TipoRh model.
 */
class TipoRhController extends Controller
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
    	
							// Este m�todo nos permite crear un filtro sobre la identidad del usuario
    						// y as� establecer si tiene permisos o no
    								
							'matchCallback' => function ($rule, $action) {
									// Llamada al m�todo que comprueba si es un administrador
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
     * Lists all TipoRh models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TipoRhSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TipoRh model.
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
     * Creates a new TipoRh model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TipoRh();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->tiporhid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TipoRh model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->tiporhid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TipoRh model.
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
     * Finds the TipoRh model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TipoRh the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TipoRh::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
