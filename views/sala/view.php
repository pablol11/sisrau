<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\SalaRangoHorarioSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Sala */

$this->title = $model->saladescripcion;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Salas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sala-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->salaid], ['class' => 'btn btn-primary']) ?>
        <?php 
        	if (empty($model->audiencias) and empty($model->salarangohorarios)) {
	        	echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->salaid], [
		            'class' => 'btn btn-danger',
		            'data' => [
		                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
		                'method' => 'post',
		            ],
        		]);
        	}
	    ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'salaid',
            'saladescripcion',
//             'tiposalaid',
        	[
        		'attribute' => 'tiposalaid',
        		'value' => $model->tiposala->tiposaladescripcion
    		],
//         	'ambitoid',
        	[
        		'attribute' => 'ambitoid',
        		'value' => $model->ambito->ambitodescripcion
    		],
        	'salaactiva:boolean',
        ],
    ]) ?>
    
    <?php 
	    $searchModel = new SalaRangoHorarioSearch();
	    $searchModel->salaid = $model->salaid;
	    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
	     
	    echo Yii::$app->controller->renderPartial('../sala-rango-horario/_sala-rangos-horarios', [
	    		'searchModel' => $searchModel,
	    		'dataProvider' => $dataProvider,
	    ]);
    
    ?>

</div>
