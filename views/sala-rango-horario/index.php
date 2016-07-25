<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use app\models\Sala;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SalaRangoHorarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sala Rango Horarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sala-rango-horario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Sala Rango Horario'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
//         'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'pjax' => true, 
   		'responsive' => true,
   		'hover' => true,
    	'columns' => [
//             ['class' => 'yii\grid\SerialColumn'],

//             'salarangohorarioid',
//             'salaid',
    		[
	    		'attribute' => 'salaid',
// 	    		'value' => 'sala.saladescripcion',
				'format' => 'raw',
    			'value' => function($data) {
    				return Html::a(
    								$data->sala->saladescripcion, 
    								Url::toRoute(['sala/view', 'id' => $data->salaid]),
    								['data-pjax' => 0,]
    						);
    			},
    			'filter' => Html::activeDropDownList(
	    				$searchModel,
	    				'salaid',
	    				Sala::getListaSalasActivas(),
	    				['class'=>'form-control dropdown','prompt' => '( Ninguno )']
	    		),
    		],
        	[
        		'attribute' => 'registroDias',
        		'label' => Yii::t('app', 'Salarangohorarioregistrodias')
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
