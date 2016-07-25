<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AudienciaPartWarn */

$this->title = Yii::t('app', 'Advertencias Participante');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Audiencia Part Warns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audiencia-part-warn-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//         		'audienciaparticipanteid',
        		[
					'label' => Yii::t('app', 'Participante'),
        			'value' => $model->audienciaparticipante->rh->getApellidoYNombre(),
    			],
        		[
					'label' => Yii::t('app', 'Tiporh'),
        			'value' => $model->audienciaparticipante->rh->tiporh->tiporhdescripcion,
    			],
	        	'audienciapartwarnmsgeanterior',
	            'audienciapartwarnmsgeposterior',
        ],
    ]) ?>
    
    <?= Html::a( Yii::t('app', 'Confirmar'), ['audiencia/view', 'id' => $model->audienciaparticipante->audienciaid], ['class' => 'btn btn-primary']); ?>

</div>
