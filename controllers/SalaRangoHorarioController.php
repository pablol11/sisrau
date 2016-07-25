<?php

namespace app\controllers;

use Yii;
use app\models\SalaRangoHorario;
use app\models\SalaRangoHorarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * SalaRangoHorarioController implements the CRUD actions for SalaRangoHorario model.
 */
class SalaRangoHorarioController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
    	return [
	    	'access' => [
    			'class' => AccessControl::className(),
    			'only' => ['index', 'view', 'create', 'createbysala', 'update', 'delete'],
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all SalaRangoHorario models.
     * @return mixed
     */
    public function actionIndex()
    {
//         $searchModel = new SalaRangoHorarioSearch();
//         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//         return $this->render('index', [
//             'searchModel' => $searchModel,
//             'dataProvider' => $dataProvider,
//         ]);
        return  $this->redirect(['sala/index']);
    }

    /**
     * Displays a single SalaRangoHorario model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
//         return $this->render('view', [
//             'model' => $this->findModel($id),
//         ]);
        $model = $this->findModel($id);
        return  $this->renderAjax(['sala/view', 'id' => $model->salaid]);
//         return  $this->redirect(['sala/view', 'id' => $model->salaid]);
    }

    /**
     * Creates a new SalaRangoHorario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SalaRangoHorario();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//             return $this->redirect(['view', 'id' => $model->salarangohorarioid]);
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreatebysala($id)
    {
        $model = new SalaRangoHorario();
        $model->salaid = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//             return $this->redirect(['view', 'id' => $model->salarangohorarioid]);
//         	return $this->redirect(['index']);
        	return $this->redirect(['sala/view', 'id' => $model->salaid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SalaRangoHorario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//             return $this->redirect(['view', 'id' => $model->salarangohorarioid]);
//         	return $this->redirect(['index']);
            return $this->redirect(['sala/view', 'id' => $model->salaid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SalaRangoHorario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
//         $this->findModel($id)->delete();

//         return $this->redirect(['index']);
        
        $model = $this->findModel($id);
        $salaid = $model->salaid;
        $model->delete();
        
        return $this->redirect(['sala/view', 'id' => $salaid]);
    }

    /**
     * Finds the SalaRangoHorario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SalaRangoHorario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SalaRangoHorario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
