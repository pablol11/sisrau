<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Estado;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\base\Object;
use app\models\AudienciaParticipanteSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Audiencia */

$this->title = $model->audienciadescripcion;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Audiencias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audiencia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        	
        	if ($model->estadoid == Estado::getEstadoNormalId()) {
        		echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->audienciaid], ['class' => 'btn btn-primary']);
        		
        		if (empty($model->audienciaparticipantes)) {
	        		echo '  '.Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->audienciaid], [
				            'class' => 'btn btn-danger',
				            'data' => [
				                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
				                'method' => 'post',
				            ],
				        ]);
        		}
        	}
        
         ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'audienciaid',
            'audienciadescripcion',
//             'audienciafecha',
        	[
        		'attribute' => 'audienciafecha',
				'format' =>  ['date', 'php:d-m-Y'],
// 				'format' => Yii::$app->formatter->dateFormat,
    		],	
        	'audienciahorainicio',
        	'audienciahorafin',
        	[
        		'attribute' => 'salaid',
        		'value' => $model->sala->saladescripcion
    		],
            [
            	'attribute' => 'estadoid',
            	'format' => 'raw',
            	'value' => Html::tag('span', $model->estado->estadodescripcion, ($model->estadoid == Estado::getEstadoNormalId()) ? ['style' => 'color:black'] : ['style' => 'color:red'])
            ],
        	[
            	'label' => Yii::t('app', 'Registrado'),
            	'value' => date('d-m-Y (H:i:s)', strtotime($model->audienciaregfecha)).' - '.
        					$model->audienciaregrh->getApellidoYNombre().' - '.
        					'('.$model->audienciaregambito->ambitodescripcion.' / '.$model->audienciaregsector->sectordescripcion.')'
            ],
//         	[
//         		'attribute' => 'audienciaregfecha',
//         		'format' =>  ['date', 'php:d-m-Y (H:i:s)'],
// // 				'format' => Yii::$app->formatter->datetimeFormat,
//     		],	
//         	[
// //             	'attribute' => 'audienciaregambitoid',
//             	'label' => Yii::t('app', 'Ambito / Sector Registró'),
//             	'value' => $model->audienciaregambito->ambitodescripcion.' / '.$model->audienciaregsector->sectordescripcion
//             ],
// //             [
// //             	'attribute' => 'audienciaregsectorid',
// //             	'value' => $model->audienciaregsector->sectordescripcion
// //             ],
//             [
//             	'attribute' => 'audienciaregrhid',
//             	'value' => $model->audienciaregrh->getApellidoYNombre()
//             ],
//             'audienciaregfecha',
        	
        ],
    ]) ?>
    
    <?php 
        	$searchModel = new AudienciaParticipanteSearch();
        	$searchModel->audienciaid = $model->audienciaid;
        	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        		
        	echo Yii::$app->controller->renderPartial('../audiencia-participante/_audiencia-participantes', [
        				'searchModel' => $searchModel,
        				'dataProvider' => $dataProvider,
        	]);
    ?>

</div>
