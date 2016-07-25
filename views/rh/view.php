<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Rh */

$this->title = $model->getApellidoYNombre();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rhs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
	    <?php 
	    	$esUsuarioSimple = !User::esUsuarioLogueadoAdmin();
	    	
	    	if (!$esUsuarioSimple) {
	    		echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->rhid], ['class' => 'btn btn-primary']);
	    		echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->rhid], [
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
            'rhid',
            'rhnombre',
            'rhapellido',
//             'tiporhid',
        	[
        		'attribute' => 'tiporhid',
        		'value' => $model->tiporh->tiporhdescripcion
    		],
        	[
        		'attribute' => 'rhambitoid',
        		'value' => $model->rhambito->ambitodescripcion,
    		],
//         	'rhsectorid',
        	[
        		'attribute' => 'rhsectorid',
        		'value' => $model->rhsector->sectordescripcion,
    		],
        	'rhactivo:boolean',
        ],
    ]) ?>

</div>
