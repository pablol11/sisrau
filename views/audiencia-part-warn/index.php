<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AudienciaPartWarnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Audiencia Part Warns');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audiencia-part-warn-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//             ['class' => 'yii\grid\SerialColumn'],

//             'audienciaparticipanteid',
        	[
        		'label' => 'Audiencia',
        		'value' => 'audienciaparticipante.audiencia.audienciadescripcion',
        	],
        	[
        		'label' => 'Participante',
        		'value' => 'audienciaparticipante.rh.apellidoynombre',
        	],
            'audienciapartwarnmsgeanterior',
            'audienciapartwarnmsgeposterior',

//             ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
