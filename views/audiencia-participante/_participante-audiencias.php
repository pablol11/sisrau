<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use app\models\Estado;
use app\models\Usuario;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AudienciaParticipanteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Audiencias Participa');
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="audiencia-participante-index">

	<?php 
// 		$dataProvider = $dataProvider->query->where(['audiencia.estadoid' => Estado::getEstadoNormalId()]);
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
    	'toolbar' => false,
    	'columns' => [
//             ['class' => 'yii\grid\SerialColumn'],

//             'audienciaparticipanteid',
//             'audienciaid',
        	[
        		'label' => Yii::t('app', 'Audienciafecha'),
        		'attribute' => 'audiencia.audienciafecha',
				'format' =>  ['date', 'php:d-m-Y'],
        	],
        	[
        		'attribute' => 'audienciaid',
//         		'value' => 'audiencia.audienciadescripcion',
				'format' => 'raw',
    			'value' => function($data) {
    				if ($data->audiencia->audienciaregambitoid == Usuario::getAmbitoUsuarioLogueado()) {
	    				return Html::a(
	    								$data->audiencia->audienciadescripcion, 
	    								Url::toRoute(['audiencia/view', 'id' => $data->audiencia->audienciaid]),
	    								['data-pjax' => 0,]
	    						);
    				} else {
    					return $data->audiencia->audienciadescripcion;
    				}
    			},
        	],
        	[
        		'label' => Yii::t('app', 'Audienciahorainicio'),
        		'attribute' => 'audiencia.audienciahorainicio',
    		],
        	[
        		'label' => Yii::t('app', 'Audienciahorafin'),
        		'attribute' => 'audiencia.audienciahorafin',
    		],
    		[
        		'label' => Yii::t('app', 'Sala'),
    			'attribute' => 'audiencia.salaid',
	    		'format' => 'raw',
	    		'value' => function($data) {
	    			return Html::a(
	    					$data->audiencia->sala->saladescripcion,
	    					Url::toRoute(['sala/view', 'id' => $data->audiencia->salaid]),
	    					['data-pjax' => 0,]
	    			);
	    		},
    		],
    		
//             ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
