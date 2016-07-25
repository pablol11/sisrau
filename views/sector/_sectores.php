<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\grid\GridView;
// use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\TipoSector;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SectorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sectors');
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="sector-index">

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
        'toolbar'=> [
        		['content'=>
        				Html::a('<i class="glyphicon glyphicon-plus"></i>', 
        						Url::toRoute(['sector/createbyambito', 'id' => $searchModel->ambitoid]),
        							[
        								'title' => Yii::t('app', 'Create Sector'), 
        								'class' => 'btn btn-success', 
        								'data-pjax' => 0,
        							])
        		],
        	],
    	'columns' => [
    		[
    			'label' => Yii::t('app', 'Sector'),
	    		'attribute' => 'sectordescripcion',
//     			'filter' => false,
				'format' => 'raw',
    			'value' => function($data) {
    				return Html::a(
    								$data->sectordescripcion, 
    								Url::toRoute(['sector/view', 'id' => $data->sectorid]),
    								['data-pjax' => 0,]
    						);
    			},
        	],
    		[
	    		'attribute' => 'tiposectorid',
				'format' => 'raw',
    			'value' => function($data) {
    				return Html::a(
    								$data->tiposector->tiposectordescripcion, 
    								Url::toRoute(['tipo-sector/view', 'id' => $data->tiposectorid]),
    								['data-pjax' => 0,]
    						);
    			},
//     			'value' => 'tiposector.tiposectordescripcion',
//     			'filter' => false
//     			'filter' => Html::activeDropDownList(
// 	    				$searchModel,
// 	    				'tiposectorid',
// 	    				TipoSector::getListaTipoSectores(),
// 	    				['class'=>'form-control dropdown','prompt' => '( Ninguno )']
// 	    		),
    		],
        		
//             ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
