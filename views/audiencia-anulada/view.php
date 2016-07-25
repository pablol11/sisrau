<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AudienciaAnulada */

$this->title = $model->audiencia->audienciadescripcion. ' (Anulada)';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Audiencia Anuladas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audiencia-anulada-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//             'audienciaid',
//             'audienciaanuladafecha',
        	[
        		'attribute' => 'audienciaanuladafecha',
        		'format' =>  ['date', 'php:d-m-Y (H:i:s)'],
        	],
//             'audienciaanuladaambitoid',
            [
            	'attribute' => 'audienciaanuladaambitoid',
            	'value' => $model->audienciaanuladaambito->ambitodescripcion
            ],
//         	'audienciaanuladasectorid',
            [
            	'attribute' => 'audienciaanuladasectorid',
            	'value' => $model->audienciaanuladasector->sectordescripcion
            ],
//         	'audienciaanuladarhid',
            [
            	'attribute' => 'audienciaanuladarhid',
            	'value' => $model->audienciaanuladarh->getApellidoYNombre()
            ],
        	'audienciaanuladamotivo',
        ],
    ]) ?>

</div>
