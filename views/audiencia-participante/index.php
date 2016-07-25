<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AudienciaParticipanteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Audiencia Participantes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audiencia-participante-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Audiencia Participante'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//             ['class' => 'yii\grid\SerialColumn'],

//             'audienciaparticipanteid',
//             'audienciaid',
        	[
        		'attribute' => 'audienciaid',
        		'value' => 'audiencia.audienciadescripcion',
    		],
//         	'rhid',
        	[
        		'attribute' => 'rhid',
        		'value' => 'rh.apellidoynombre', 
    		],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
