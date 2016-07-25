<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SalaRangoHorario */

$this->title = $model->getSalaRangoHorarioDescripcion();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sala Rango Horarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sala-rango-horario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->salarangohorarioid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->salarangohorarioid], [
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
//             'salarangohorarioid',
//             'salaid',
        	[
        		'attribute' => 'salaid',
        		'value' => $model->sala->saladescripcion
    		],
        	[
        		'attribute' => 'registroDias',
        		'label' => Yii::t('app', 'Salarangohorarioregistrodias')
        	],
        	'salarangohorarioinicio',
            'salarangohorariofin',
//             'salarangohorariodiadomingo:boolean',
//             'salarangohorariodialunes:boolean',
//             'salarangohorariodiamartes:boolean',
//             'salarangohorariodiamiercoles:boolean',
//             'salarangohorariodiajueves:boolean',
//             'salarangohorariodiaviernes:boolean',
//             'salarangohorariodiasabado:boolean',
        ],
    ]) ?>

</div>
