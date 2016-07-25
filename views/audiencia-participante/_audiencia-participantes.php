<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use app\models\Estado;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AudienciaParticipanteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Participantes');
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="audiencia-participante-index">


	<?php 
		if ($searchModel->audiencia->estadoid == Estado::getEstadoNormalId()) {
			$toolbarContent = [ ['content' => 
								Html::a('<i class="glyphicon glyphicon-plus"></i>',
									Url::toRoute(['audiencia-participante/createbyaudiencia', 'id' => $searchModel->audienciaid]),
									[
											'title' => Yii::t('app', 'Create Audiencia Participante'),
											'class' => 'btn btn-success',
											'data-pjax' => 0,
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
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    	'pjax' => true, 
   		'responsive' => true,
   		'hover' => true,
    	'panel' => [
    				'heading' => '<h3 class="panel-title">'.$this->title.'</h3>',
    				'type' => 'success',
    				'footer' => false,
    		],
        'toolbar'=> $toolbarContent,
    	'columns' => [
//             ['class' => 'yii\grid\SerialColumn'],

//             'audienciaparticipanteid',
        	[
				'format' => 'raw',
        		'hAlign' => 'center',
        		'vAlign' => 'middle',
        		'width' => '5%',
    			'value' => function($data) {
	    				if (!empty($data->audienciapartwarn)) {
	    					$icono = '<i class="glyphicon glyphicon-warning-sign" style="color:orange"></i>';
	    					$url = Url::toRoute(['audiencia-part-warn/view', 'id' => $data->audienciaparticipanteid]);
	    					$title = Yii::t('app', 'View Audienciapartwarns');

		        			return Html::a($icono, $url, ['title' => $title, 'data-pjax' => 0]);
		        			
	    				} else {
	    					return false;
	    				}
	    			},
			],
    		[
        		'attribute' => 'rhid',
				'format' => 'raw',
    			'value' => function($data) {
    				return Html::a(
    								$data->rh->apellidoYNombre, 
    								Url::toRoute(['rh/view', 'id' => $data->rhid]),
    								['data-pjax' => 0,]
    						);
    			},
        	],
        	[
        		'label' => Yii::t('app', 'Tiporh'),
        		'value' => 'rh.tiporh.tiporhdescripcion',
        	],
//             'audienciaid',
    		[
				'format' => 'raw',
        		'hAlign' => 'center',
        		'vAlign' => 'middle',
        		'width' => '5%',
    			'value' => function($data) {
    					if ($data->audiencia->estadoid == \app\models\Estado::getEstadoNormalId()) {
	    					$icono = '<i class="glyphicon glyphicon-trash"></i>';
	    					$title = Yii::t('app', 'Delete');
	    					$url = Url::toRoute(['audiencia-participante/delete', 'id' => $data->audienciaparticipanteid]);
	
		        			return Html::a($icono, $url, [
	        								'title' => $title, 
	        								'data-pjax' => false,
				        					'data' => [
				        						'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
				        						'method' => 'post',
		        							],
		        						]);
    					} else {
    						return false;
    					}
	    			},
    		]
    		
//             ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
