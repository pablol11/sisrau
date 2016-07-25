<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\grid\GridView;
// use yii\grid\GridView;
use app\models\Sala;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SalaRangoHorarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Rango Horarios');
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="sala-rango-horario-index">

	<?php 
		if ($searchModel->sala->salaactiva == true) {
			$toolbarContent = [ ['content' => 
								Html::a('<i class="glyphicon glyphicon-plus"></i>',
									Url::toRoute(['sala-rango-horario/createbysala', 'id' => $searchModel->salaid]),
									[
        								'title' => Yii::t('app', 'Create Sala'), 
										'class' => 'btn btn-success',
										'data-pjax' => false,
									])
								] ];
		} else {
			$toolbarContent = false;
		}
	
	?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//         'filterModel' => $searchModel,
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
//         'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'pjax' => true, 
   		'responsive'=>true,
   		'hover'=>true,
    	'panel' => [
    				'heading' => '<h3 class="panel-title">'.$this->title.'</h3>',
    				'type' => 'success',
    				'footer' => false
    		],
        'toolbar'=> $toolbarContent,
    	'columns' => [
//             ['class' => 'yii\grid\SerialColumn'],

//             'salarangohorarioid',
//             'salaid',
//     		[
// 	    		'attribute' => 'salaid',
// 	    		'value' => 'sala.saladescripcion',
// // 	    		'filter' => Html::activeDropDownList(
// // 	    				$searchModel,
// // 	    				'salaid',
// // 	    				Sala::getListaSalas(),
// // 	    				['class'=>'form-control dropdown','prompt' => '( Ninguno )']
// // 	    		),
//     		],
        	[
        		'label' => Yii::t('app', 'Salarangohorarioregistrodias'),
        		'attribute' => 'registroDias',
// 				'format' => 'raw',
//     			'value' => function($data) {
//     				return Html::a(
//     								$data->getRegistroDias(), 
//     								Url::toRoute(['sala-rango-horario/view', 'id' => $data->salarangohorarioid]),
//     								['data-pjax' => false,]
//     						);
//     			},
        	],
//         	'salarangohorarioinicio',
        	[
        		'attribute' => 'salarangohorarioinicio',
        		'filter' => false,
        	],
//             'salarangohorariofin',
        	[
        		'attribute' => 'salarangohorariofin',
        		'filter' => false
        	],
        	
// //             'salarangohorariodiadomingo:boolean',
//         	[
//         		'attribute' => 'salarangohorariodiadomingo',
//         		'label' => Yii::t('app', 'salarangohorariodiadomingo')
//         	],
//             'salarangohorariodialunes:boolean',
//             'salarangohorariodiamartes:boolean',
//             'salarangohorariodiamiercoles:boolean',
//             'salarangohorariodiajueves:boolean',
//             'salarangohorariodiaviernes:boolean',
//             'salarangohorariodiasabado:boolean',

//             ['class' => 'yii\grid\ActionColumn'],
            [
	            'label' => 'Acciones',
	            'mergeHeader' => true,
	            'hAlign' => 'center',
	            'vAlign' => 'middle',
	            'format' => 'raw',
	            'value' => function($data) {
	            	 
	            	// Update del Rango Horario.
	            	$icono_u = '<i class="glyphicon glyphicon-pencil"></i>';
	            	$url_u = Url::toRoute(['sala-rango-horario/update', 'id' => $data->salarangohorarioid]);
	            	$title_u = Yii::t('app', 'Update');
	            
	            	$acciones = Html::a($icono_u, $url_u, ['title' => $title_u, 'data-pjax' => false]);
	            
            		// Delete del Rango Horario.
            		$icono_d = '<i class="glyphicon glyphicon-trash"></i>';
            		$url_d = Url::toRoute(['sala-rango-horario/delete', 'id' => $data->salarangohorarioid]);
            		$title_d = Yii::t('app', 'Delete');
            
            		$acciones .= '  '.Html::a($icono_d, $url_d,
            				[
            						'title' => $title_d, 'data-pjax' => false,
            						'data' => [
            								'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
            								'method' => 'post',
            						],
            				]);
	            	 
	            	return $acciones;
	            },
          	],
            
        ],
    ]); ?>
</div>
