<?php

namespace app\controllers;

use Yii;
use app\models\AudienciaPartWarn;
use app\models\AudienciaPartWarnSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AudienciaPartWarnController implements the CRUD actions for AudienciaPartWarn model.
 */
class AudienciaPartWarnController extends Controller
{
    public function behaviors()
    {
    	return [
	    	'access' => [
    			'class' => AccessControl::className(),
//     			'only' => ['index', 'view', 'create', 'update', 'delete'],
    			'only' => ['view'],
	    		'rules' => [
    					[
							// Esta propiedad establece que tiene permisos
							'allow' => true,
    	
							// Usuarios autenticados, el signo ? es para invitados
							'roles' => ['@'],
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
     * Lists all AudienciaPartWarn models.
     * @return mixed
     */
    public function actionIndex()
    {
//         $searchModel = new AudienciaPartWarnSearch();
//         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//         return $this->render('index', [
//             'searchModel' => $searchModel,
//             'dataProvider' => $dataProvider,
//         ]);

    	return $this->redirect(['audiencia/index']);
    }

    /**
     * Displays a single AudienciaPartWarn model.
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
     * Creates a new AudienciaPartWarn model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
//         $model = new AudienciaPartWarn();

//         if ($model->load(Yii::$app->request->post()) && $model->save()) {
//             return $this->redirect(['view', 'id' => $model->audienciaparticipanteid]);
//         } else {
//             return $this->render('create', [
//                 'model' => $model,
//             ]);
//         }

    	return $this->redirect(['audiencia/index']);
    }

    /**
     * Updates an existing AudienciaPartWarn model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
//         $model = $this->findModel($id);

//         if ($model->load(Yii::$app->request->post()) && $model->save()) {
//             return $this->redirect(['view', 'id' => $model->audienciaparticipanteid]);
//         } else {
//             return $this->render('update', [
//                 'model' => $model,
//             ]);
//         }

    	return $this->redirect(['audiencia/index']);
    }

    /**
     * Deletes an existing AudienciaPartWarn model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
//         $this->findModel($id)->delete();

//         return $this->redirect(['index']);

    	return $this->redirect(['audiencia/index']);
    }

    /**
     * Finds the AudienciaPartWarn model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AudienciaPartWarn the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AudienciaPartWarn::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
