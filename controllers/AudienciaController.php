<?php

namespace app\controllers;

use Yii;
use app\models\Audiencia;
use app\models\AudienciaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Usuario;
use app\models\Estado;

/**
 * AudienciaController implements the CRUD actions for Audiencia model.
 */
class AudienciaController extends Controller
{
    public function behaviors()
    {
    	return [
	    	'access' => [
    			'class' => AccessControl::className(),
    			'only' => ['index', 'view', 'create', 'update', 'delete'],
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
     * Lists all Audiencia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AudienciaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Audiencia model.
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
     * Creates a new Audiencia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Audiencia();

        // Seteamos la Audiencia con el estado "Normal" -> 1.
        $model->estadoid = Estado::getEstadoNormalId();
        
        // Recuperamos el Id del usuario logueado, y luego el Rh asociado al mismo.
		$rh = Usuario::getUsuarioLogueado()->rh;
        
        // Seteamos el Ambito/Sector/Rh que registro la Audiencia.
        $model->audienciaregambitoid = $rh->rhsector->ambito->ambitoid;
        $model->audienciaregsectorid = $rh->rhsector->sectorid;
        $model->audienciaregrhid = $rh->rhid;
        
        // Seteamos la fecha/hora actual.
        $model->audienciaregfecha = date("d/m/Y (H:i:s)", time());

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->audienciaid]);
//         	return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Audiencia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->audienciaid]);
//         	return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Audiencia model.
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
     * Finds the Audiencia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Audiencia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Audiencia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
