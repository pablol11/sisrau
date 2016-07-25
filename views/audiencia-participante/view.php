<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AudienciaParticipante */

$this->title = $model->rh->getApellidoYNombre();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Audiencia Participantes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audiencia-participante-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    	<?php 
    		if ($model->audiencia->estadoid == \app\models\Estado::getEstadoNormalId()) {
    			echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->audienciaparticipanteid], ['class' => 'btn btn-primary']);
    			
    			echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->audienciaparticipanteid], [
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
//             'audienciaparticipanteid',
			[
				'label' => Yii::t('app', 'Rhnombre'),
				'value' => $model->rh->rhnombre,
    		],
			[
				'label' => Yii::t('app', 'Rhapellido'),
				'value' => $model->rh->rhapellido,
    		],
			[
				'label' => Yii::t('app', 'Tiporh'),
				'value' => $model->rh->tiporh->tiporhdescripcion,
    		],
        	[
        		'attribute' => 'audienciaid',
        		'value' => $model->audiencia->audienciadescripcion
    		],
        	
            'rhid',
        ],
    ]) ?>

</div>
