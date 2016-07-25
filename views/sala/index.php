<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\TipoSala;
use app\models\Ambito;
use app\models\SalaRangoHorarioSearch;
use yii\base\Object;
use app\models\Usuario;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SalaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Salas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sala-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Sala'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?php 
    	$esUsuarioSimple = !User::esUsuarioLogueadoAdmin();
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
    	'pjax' => true,
    	'columns' => [
//             ['class' => 'yii\grid\SerialColumn'],
    		[
    			'class' => 'kartik\grid\ExpandRowcolumn',
    			'value' => function ($model, $key, $index, $column) {
    				return GridView::ROW_COLLAPSED;
    			},
    			'detail' => function ($model, $key, $index, $column) {
    				$searchModel = new SalaRangoHorarioSearch();
    				$searchModel->salaid = $model->salaid;
    				$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    				$dataProvider->pagination = false;
    				
    				return Yii::$app->controller->renderPartial('../sala-rango-horario/_sala-rangos-horarios', [
    						'searchModel' => $searchModel,
    						'dataProvider' => $dataProvider,
    				]);
    			},
    		],
//             'salaid',
            'saladescripcion',
//             'tiposalaid',
    		[
	    		'attribute' => 'tiposalaid',
				'format' => 'raw',
    			'value' => function($data) {
    				return Html::a(
    								$data->tiposala->tiposaladescripcion, 
    								Url::toRoute(['tipo-sala/view', 'id' => $data->tiposalaid]),
    								['data-pjax' => 0,]
    						);
    			},
//     			'value' => 'tiposala.tiposaladescripcion',
	    		'filter' => Html::activeDropDownList(
	    				$searchModel,
	    				'tiposalaid',
	    				TipoSala::getListaTipoSalas(),
	    				['class'=>'form-control dropdown','prompt' => '( Todos )']
	    		),
    		],
//         	'ambitoid',
    		[
	    		'attribute' => 'ambitoid',
				'format' => 'raw',
    			'hidden' => $esUsuarioSimple,
    			'value' => function($data) {
    				return Html::a(
    								$data->ambito->ambitodescripcion, 
    								Url::toRoute(['ambito/view', 'id' => $data->ambitoid]),
    								['data-pjax' => 0,]
    						);
    			},
//     			'value' => 'ambito.ambitodescripcion',
	    		'filter' => Html::activeDropDownList(
	    				$searchModel,
	    				'ambitoid',
	    				Ambito::getListaAmbitos(),
	    				['class'=>'form-control dropdown','prompt' => '( Todos )']
	    		),
    		],
//         	'salaactiva:boolean',
        	[
	        	'attribute' => 'salaactiva',
	        	'class' => '\kartik\grid\BooleanColumn',
	        	'trueLabel' => 'Si',
	        	'falseLabel' => 'No'
        	],
        			 
//         	[
//         		'attribute' => 'salaactiva',
// //         		'filter' => false,
//         		'filter' => Html::activeCheckbox(
//         				$searchModel,
//         				'salaactiva'
//         		),
//         	],
        		
//             [
// //             	'class' => 'yii\grid\ActionColumn',
//     			'class' => '\kartik\grid\ActionColumn',
//        			'mergeHeader' => true,
//        			'hAlign' => 'center',
//        			'vAlign' => 'middle',
//             ],
            [
	            'label' => 'Acciones',
	            'mergeHeader' => true,
	            'hAlign' => 'center',
	            'vAlign' => 'middle',
	            'format' => 'raw',
	            'value' => function($data) {
	            
	            	// View de la Audiencia.
	            	$icono_v = '<i class="glyphicon glyphicon-eye-open"></i>';
	            	$url_v = Url::toRoute(['sala/view', 'id' => $data->salaid]);
	            	$title_v = Yii::t('app', 'View');
	            
	            	$acciones = Html::a($icono_v, $url_v, ['title' => $title_v, 'data-pjax' => false]);
	            		
            		// Update de la Audiencia.
            		$icono_u = '<i class="glyphicon glyphicon-pencil"></i>';
            		$url_u = Url::toRoute(['sala/update', 'id' => $data->salaid]);
            		$title_u = Yii::t('app', 'Update');
            
            		$acciones .= '  '.Html::a($icono_u, $url_u, ['title' => $title_u, 'data-pjax' => false]);
            
            		if (empty($data->audiencias) and empty($data->salarangohorarios)) {
            			// Delete de la Audiencia.
            			$icono_d = '<i class="glyphicon glyphicon-trash"></i>';
            			$url_d = Url::toRoute(['sala/delete', 'id' => $data->salaid]);
            			$title_d = Yii::t('app', 'Delete');
            			 
            			$acciones .= '  '.Html::a($icono_d, $url_d,
            					[
            							'title' => $title_d, 'data-pjax' => false,
            							'data' => [
            									'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
            									'method' => 'post',
            							],
            					]);
            		}
	            
	            	return $acciones;
	            },
            ],
            
        ],
    ]); ?>

</div>
