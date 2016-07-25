<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use app\models\TipoRh;
use app\models\Ambito;
use app\models\Sector;
use yii\helpers\ArrayHelper;
use yii\base\Object;
use app\models\AudienciaParticipanteSearch;
use app\models\User;
// use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $searchModel app\models\RhSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Rhs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
	    <?php 
	    	$esUsuarioSimple = !User::esUsuarioLogueadoAdmin();
	    	
	    	if (!$esUsuarioSimple) {
	    		echo Html::a(Yii::t('app', 'Create Rh'), ['create'], ['class' => 'btn btn-success']);	
	    	}
        ?>
    </p>
    
    <?php
// 		Modal::begin([
// 			'header' => '<h4>Usuario</h4>',
// 			'id' => 'modal',
// 			'size' => 'modal-lg',
// 		]);
// 			echo "<div id='modalContent'></div>";
// 		Modal::end();
		
// 		$this->registerJs("$(function() {
// 			$('.popupModal').click(function(e) {
// 		    		e.preventDefault();
// 		     		$('#modal').modal('show')
// 							.find('#modalContent')
// 		     				.load($(this).attr('href'));
// 		   	});
// 		});");
	?>
    
	<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'pjax' => true, 
   		'responsive' => true,
   		'hover' => true,
		'columns' => [
//             ['class' => 'yii\grid\SerialColumn'],
			[
				'class' => 'kartik\grid\ExpandRowcolumn',
				'value' => function ($model, $key, $index, $column) {
					return GridView::ROW_COLLAPSED;
				},
				'detail' => function ($model, $key, $index, $column) {
					$searchModel = new AudienciaParticipanteSearch();
					$searchModel->rhid = $model->rhid;
					$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
					 
					return Yii::$app->controller->renderPartial('../audiencia-participante/_participante-audiencias', [
							'searchModel' => $searchModel,
							'dataProvider' => $dataProvider,
					]);
				},
			],
        	[
        		'hidden' => $esUsuarioSimple,
				'format' => 'raw',
    			'value' => function($data) {
	    				if (empty($data->usuario)) {
	    					$icono = '<i class="glyphicon glyphicon-user" style="color:red"></i>';
	    					$url = Url::toRoute(['usuario/createbyrh', 'id' => $data->rhid]);
	    					$title = Yii::t('app', 'Create Usuario');
	    				} else {
		    				$title = Yii::t('app', 'View Usuario');
	    					if ($data->usuario->administrador) {
		    					$icono = '<i class="glyphicon glyphicon-cog"></i>';
		    					$title .= ' (Administrador)';
	    					} else {
	    						$icono = '<i class="glyphicon glyphicon-user"></i>';
	    					}
		    				$url = Url::toRoute(['usuario/view', 'id' => $data->usuario->usuarioid]);
	    				}
	        			return Html::a($icono, $url, 
	        							[
// 	        								'class' => 'popupModal',
	        								'title' => $title, 
	        								'data-pjax' => 0,
	        							]
	        					);
    			},
			],
//             'rhid',
            'rhnombre',
            'rhapellido',
//             'tiporhid',
    		[
	    		'attribute' => 'tiporhid',
// 	    		'value' => 'tiporh.tiporhdescripcion',
				'format' => 'raw',
    			'value' => function($data) {
    				return (User::esUsuarioLogueadoAdmin()) ? Html::a(
    								$data->tiporh->tiporhdescripcion, 
    								Url::toRoute(['tipo-rh/view', 'id' => $data->tiporhid]),
    								['data-pjax' => 0,]
    						) : $data->tiporh->tiporhdescripcion;
    			},
    			'filter' => Html::activeDropDownList(
	    				$searchModel,
	    				'tiporhid',
	    				TipoRh::getListaTipoRh(),
	    				['class'=>'form-control dropdown','prompt' =>  Yii::t('app', '(Todos)')]
	    		),
    		],
//         	'rhambitoid',
    		[
    			'hidden' => $esUsuarioSimple,
	    		'attribute' => 'rhambitoid',
// 	    		'value' => 'rhambito.ambitodescripcion',
				'format' => 'raw',
    			'value' => function($data) {
    				return Html::a(
    								$data->rhambito->ambitodescripcion, 
    								Url::toRoute(['tipo-rh/view', 'id' => $data->rhambitoid]),
    								['data-pjax' => 0,]
    						);
    			},
    			'filter' => Html::activeDropDownList(
	    				$searchModel,
	    				'rhambitoid',
	    				Ambito::getListaAmbitos(),
	    				[
		    				 'class'=>'form-control dropdown',
		    				 'prompt' => Yii::t('app', '(Todos)'),
// 		    				 'onchange' => '
// 								$.get( "'.Url::toRoute('sector/lists').'", { id: $(this).val() } )
// 		                            .done(function( data ) {
// 		                                $( "#rhsectorid" ).html( data );
// 		                            }
// 		                        );'
						]
	    		),
    		],
//         	'rhsectorid',
    		[
	    		'attribute' => 'rhsectorid',
// 	    		'value' => 'rhsector.sectordescripcion',
				'format' => 'raw',
    			'value' => function($data) {
    				return (User::esUsuarioLogueadoAdmin()) ? Html::a(
    								$data->rhsector->sectordescripcion, 
    								Url::toRoute(['sector/view', 'id' => $data->rhsectorid]),
    								['data-pjax' => 0,]
    						) : $data->rhsector->sectordescripcion;
    			},
	    		'filter' => Html::activeDropDownList(
	    				$searchModel,
	    				'rhsectorid',
// 	    				Sector::getListaSectores(),
	    				Sector::getListaSectoresArrayBy($searchModel->rhambitoid),
// 	    				ArrayHelper::map(Sector::find()->where(['ambitoid' => $searchModel->rhambitoid])->all(), 'sectorid', 'sectordescripcion'),
	    				[
							'id' => 'rhsectorid',
	    					'class'=>'form-control dropdown',
    						'prompt' => Yii::t('app', '(Todos)'),
		    			]
	    		),
    		],
        	// 'rhactivo:boolean',
    		[
    			'attribute' => 'rhactivo',
    			'class' => '\kartik\grid\BooleanColumn',
    			'trueLabel' => 'Si',
    			'falseLabel' => 'No'
    		],

//             ['class' => 'yii\grid\ActionColumn'],
    		[
    			'class' => '\kartik\grid\ActionColumn',
    			'updateOptions' => ['hidden' => $esUsuarioSimple],
    			'deleteOptions' => ['hidden' => $esUsuarioSimple],
    		]
    			 
        ],
    ]); ?>
</div>
