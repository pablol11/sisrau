<?php

use yii\helpers\Html;
use yii\helpers\Url;
// use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\TipoSector;
use app\models\Ambito;
use yii\widgets\Pjax;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SectorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sectors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sector-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Sector'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
//         'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'pjax' => true, 
   		'responsive'=>true,
   		'hover'=>true,
    	'columns' => [
//             ['class' => 'yii\grid\SerialColumn'],

//             'sectorid',
            'sectordescripcion',
//             'tiposectorid',
    		[
	    		'attribute' => 'tiposectorid',
   				'format' => 'raw',
// 	    		'value' => 'tiposector.tiposectordescripcion',
    			'value' => function($data) {
    					return Html::a(
    									$data->tiposector->tiposectordescripcion, 
    									Url::toRoute(['tipo-sector/view', 'id' => $data->tiposectorid]),
    									['data-pjax' => 0,]
    							);
    				},
    			'filter' => Html::activeDropDownList(
	    				$searchModel,
	    				'tiposectorid',
	    				TipoSector::getListaTipoSectores(),
	    				['class'=>'form-control dropdown','prompt' => Yii::t('app', '( Todos )')]
	    		),
    		],
    		//         	'ambitoid',
    		[
	    		'attribute' => 'ambitoid',
	    		'format' => 'raw',
	    		// 	    		'value' => 'ambito.ambitodescripcion',
	    		'value' => function($data) {
	    			return Html::a(
	    					$data->ambito->ambitodescripcion,
	    					Url::toRoute(['ambito/view', 'id' => $data->ambitoid]),
	    					['data-pjax' => 0,]
	    			);
	    		},
	    		'filter' => Html::activeDropDownList(
	    				$searchModel,
	    				'ambitoid',
	    				Ambito::getListaAmbitos(),
	    				['class'=>'form-control dropdown','prompt' => Yii::t('app', '( Todos )')]
	    		),
    		],
    		
            [
//             	'class' => 'yii\grid\ActionColumn'
    			'class' => '\kartik\grid\ActionColumn',
       			'mergeHeader' => true,
       			'hAlign' => 'center',
       			'vAlign' => 'middle',
            ],
    	],
    ]); ?>

</div>
