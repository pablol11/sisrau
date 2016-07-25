<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Sector */

$this->title = $model->sectordescripcion;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sectors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sector-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->sectorid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->sectorid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sectorid',
            'sectordescripcion',
        	[
        		'attribute' => 'tiposectorid',
        		'value' => $model->tiposector->tiposectordescripcion
    		],
//             'tiposectorid',
        	[
        		'attribute' => 'ambitoid',
        		'value' => $model->ambito->ambitodescripcion
    		],
//         	'ambitoid',
        ],
    ]) ?>

</div>
