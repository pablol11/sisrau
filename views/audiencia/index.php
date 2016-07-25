<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use app\models\Sala;
// use kartik\time\TimePicker;
// use kartik\date\DatePicker;
use yii\base\Widget;
use yii\jui\DatePicker;
use app\models\Estado;
use app\models\AudienciaParticipanteSearch;
use app\models\Usuario;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AudienciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Audiencias');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audiencia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Audiencia'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
					$searchModel->audienciaid = $model->audienciaid;
					$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
					 
					return Yii::$app->controller->renderPartial('../audiencia-participante/_audiencia-participantes', [
							'searchModel' => $searchModel,
							'dataProvider' => $dataProvider,
					]);
				},
			],
//             'audienciaid',
//             'audienciafecha',
        	[
        		'attribute' => 'audienciafecha',
        		'value' => 'audienciafecha',
				'format' =>  ['date', 'php:d-m-Y'],
        		'filter' => DatePicker::widget([
        					'model'=>$searchModel,
        					'attribute'=>'audienciafecha',
        					'language' => Yii::$app->language,
        					'dateFormat' => 'php:d-m-Y',
        					'options' => ['class' => 'form-control input-group date', 'placeholder' => ''],
        		]),
        	],
            'audienciadescripcion',
        	// 'estadoid',
        	[
        		'attribute' => 'estadoid',
//         		'value' => 'estado.estadodescripcion',
        		'format' => 'raw',
        		'value' => function ($data) {
        						return Html::tag('span', $data->estado->estadodescripcion, ($data->estadoid == Estado::getEstadoNormalId()) ? ['style' => 'color:black'] : ['style' => 'color:red']);
        					},
        		'filter' => Html::activeDropDownList(
      								$searchModel, 
       								'estadoid', 
       								Estado::getListaEstados(),
       								['class'=>'form-control dropdown','prompt' => '( Todos )']
        		),
        	],	
        	[
        		'attribute' => 'audienciahorainicio',
        		'value' => 'audienciahorainicio',
       			'mergeHeader' => true,
       			'hAlign' => 'center',
       			'vAlign' => 'middle',
        		'filter' => false,
//         		'filter' => TimePicker::widget([
//         					'model'=>$searchModel,
//         					'attribute'=>'audienciahorainicio',
//        						'containerOptions' => ['style' => 'width:50%',],
//        			]),
        	],
        	[
        		'attribute' => 'audienciahorafin',
        		'value' => 'audienciahorafin',
       			'mergeHeader' => true,
       			'hAlign' => 'center',
       			'vAlign' => 'middle',
        		'filter' => false,
//         		'filter' => TimePicker::widget([
//         					'model'=>$searchModel,
//         					'attribute'=>'audienciahorafin',
//        						'containerOptions' => ['style' => 'width:50%',],
//        			]),
        	],
        	[
        		'attribute' => 'salaid',
//         		'value' => 'sala.saladescripcion',
				'format' => 'raw',
        		'value' => function($data) {
    				return Html::a(
    								$data->sala->saladescripcion, 
    								Url::toRoute(['sala/view', 'id' => $data->salaid]),
    								['data-pjax' => false,]
    						);
    			},
        		'filter' => Html::activeDropDownList(
   								$searchModel, 
   								'salaid', 
   								Sala::getListaSalasActivas(),
   								['class'=>'form-control dropdown','prompt' => '( Todos )']
        		),
        	],
            // 'audienciaregambitoid',
            // 'audienciaregsectorid',
            // 'audienciaregrhid',
            // 'audienciaregfecha',

//             ['class' => 'yii\grid\ActionColumn'],
			[
				'label' => 'Acciones',
				'mergeHeader' => true,
				'hAlign' => 'center',
				'vAlign' => 'middle',
				'format' => 'raw',
    			'value' => function($data) {

    					// View de la Audiencia.
    					$icono_v = '<i class="glyphicon glyphicon-eye-open"></i>';
    					$url_v = Url::toRoute(['audiencia/view', 'id' => $data->audienciaid]);
    					$title_v = Yii::t('app', 'View');
	    					
    					$acciones = Html::a($icono_v, $url_v, ['title' => $title_v, 'data-pjax' => false]);
    					
	    				if ($data->estadoid == Estado::getEstadoNormalId()) {
	    					// Update de la Audiencia.
	    					$icono_u = '<i class="glyphicon glyphicon-pencil"></i>';
	    					$url_u = Url::toRoute(['audiencia/update', 'id' => $data->audienciaid]);
	    					$title_u = Yii::t('app', 'Update');
	    					
	    					$acciones .= '  '.Html::a($icono_u, $url_u, ['title' => $title_u, 'data-pjax' => false]);
	    					
	    					if (empty($data->audienciaparticipantes)) {
		    					// Delete de la Audiencia.
		    					$icono_d = '<i class="glyphicon glyphicon-trash"></i>';
		    					$url_d = Url::toRoute(['audiencia/delete', 'id' => $data->audienciaid]);
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
	    					
	    					// Acción anular de la Audiencia.
	    					$icono_a = '<i class="glyphicon glyphicon-remove-circle"></i>';
	    					$url_a = Url::toRoute(['audiencia-anulada/createbyaudiencia', 'id' => $data->audienciaid]);
	    					$title_a = Yii::t('app', 'Create Audienciaanulada');
	    				} else {
	    					// View de la Anulación.
	    					$icono_a = '<i class="glyphicon glyphicon-remove-circle" style="color:red"></i>';
	    					$url_a = Url::toRoute(['audiencia-anulada/view', 'id' => $data->audienciaid]);
	    					$title_a = Yii::t('app', 'View Audienciaanulada');
	    				}

	    				$acciones .= '  '.Html::a($icono_a, $url_a, ['title' => $title_a, 'data-pjax' => false]);
	    					
	    				return $acciones;
	    			},
			],
          ],
    ]); ?>
</div>
