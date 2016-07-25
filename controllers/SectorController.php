<?php

namespace app\controllers;

use Yii;
use app\models\Sector;
use app\models\SectorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\User;
use app\models\Ambito;
use yii\helpers\Json;

/**
 * SectorController implements the CRUD actions for Sector model.
 */
class SectorController extends Controller
{
    public function behaviors()
    {
    	return [
	    	'access' => [
    			'class' => AccessControl::className(),
    			'only' => ['index', 'view', 'create', 'createbyambito', 'update', 'delete', 'lists'],
    			'rules' => [
    					[
							// El administrador tiene permisos sobre las siguientes acciones
							'actions' => ['index', 'view', 'create', 'createbyambito', 'update', 'delete', 'lists'],
    	
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
    					[
	    					// Los usuarios simples tienen permisos sobre las siguientes acciones
	    					'actions' => ['lists'],
	    					
	    					// Esta propiedad establece que tiene permisos
	    					'allow' => true,
	    					
	    					// Usuarios autenticados, el signo ? es para invitados
	    					'roles' => ['@'],
	    					
	    					// Este método nos permite crear un filtro sobre la identidad del usuario
	    					// y así establecer si tiene permisos o no
	    					'matchCallback' => function ($rule, $action) {
								// Llamada al método que comprueba si es un usuario simple
	    						return User::esUsuarioSimple(Yii::$app->user->identity->id);
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
     * Lists all Sector models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SectorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sector model.
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
     * Creates a new Sector model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sector();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//             return $this->redirect(['view', 'id' => $model->sectorid]);
        	return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreatebyambito($id)
    {
        $model = new Sector();
        $model->ambitoid = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//             return $this->redirect(['view', 'id' => $model->sectorid]);
        	return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Sector model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//             return $this->redirect(['view', 'id' => $model->sectorid]);
        	return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Sector model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionLists($id)
    {
//     	echo "<option value=null>(Ninguno)</option>";
    	
    	if (!empty($id)) {
	    	$sectores = Sector::getListaSectoresBy($id);
	    	
	    	if ($sectores) {
	    		foreach($sectores as $sector) {
	    			echo "<option value='".$sector->sectorid."'>".$sector->sectordescripcion."</option>";
	    		}
	    	}
    	}
    }
    
//     public function actionLists2() {
//     	$out = [];
//     	if (isset($_POST['depends'])) {
//     		$parents = $_POST['depends'];
//     		if ($parents != null) {
//     			$id = $parents[0];
//     			$out = Sector::getListaSectoresArrayBy($id);
//     			echo Json::encode(['output' => $out, 'selected' => '']);
//     			return;
//     		}
//     	}
//     	echo Json::encode(['output' => '', 'selected' => '']);
//     }
    
    /**
     * Finds the Sector model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sector the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sector::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
