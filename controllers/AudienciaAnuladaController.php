<?php

namespace app\controllers;

use Yii;
use app\models\AudienciaAnulada;
use app\models\AudienciaAnuladaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Usuario;
use app\models\Audiencia;
use app\models\Estado;

/**
 * AudienciaAnuladaController implements the CRUD actions for AudienciaAnulada model.
 */
class AudienciaAnuladaController extends Controller
{
    public function behaviors()
    {
    	return [
	    	'access' => [
    			'class' => AccessControl::className(),
//     			'only' => ['index', 'view', 'create', 'update', 'delete'],
    			'only' => ['view', 'createbyaudiencia'],
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
     * Lists all AudienciaAnulada models.
     * @return mixed
     */
    public function actionIndex()
    {
//         $searchModel = new AudienciaAnuladaSearch();
//         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//         return $this->render('index', [
//             'searchModel' => $searchModel,
//             'dataProvider' => $dataProvider,
//         ]);

    	return $this->redirect(['audiencia/index']);
    }

    /**
     * Displays a single AudienciaAnulada model.
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
     * Creates a new AudienciaAnulada model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
//         $model = new AudienciaAnulada();

//         if ($model->load(Yii::$app->request->post()) && $model->save()) {
//             return $this->redirect(['view', 'id' => $model->audienciaid]);
//         } else {
//             return $this->render('create', [
//                 'model' => $model,
//             ]);
//         }

    	return $this->redirect(['audiencia/index']);
    }

    public function actionCreatebyaudiencia($id)
    {
        $model = new AudienciaAnulada();
        $model->audienciaid = $id;

        // Recuperamos el Rh del Usuario logueado.
        $rh = Usuario::getUsuarioLogueado()->rh;
        
        // Seteamos el Ambito/Sector/Rh que registro la Audiencia.
        $model->audienciaanuladaambitoid = $rh->rhsector->ambito->ambitoid;
        $model->audienciaanuladasectorid = $rh->rhsector->sectorid;
        $model->audienciaanuladarhid = $rh->rhid;
        
        // Seteamos la fecha/hora actual.
        $model->audienciaanuladafecha = date("d/m/Y (H:i:s)", time());
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//             return $this->redirect(['view', 'id' => $model->audienciaid]);
    		return $this->redirect(['audiencia/index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AudienciaAnulada model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
//         $model = $this->findModel($id);

//         if ($model->load(Yii::$app->request->post()) && $model->save()) {
//             return $this->redirect(['view', 'id' => $model->audienciaid]);
//         } else {
//             return $this->render('update', [
//                 'model' => $model,
//             ]);
//         }

    	return $this->redirect(['audiencia/index']);
    }

    /**
     * Deletes an existing AudienciaAnulada model.
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
     * Finds the AudienciaAnulada model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AudienciaAnulada the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AudienciaAnulada::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
