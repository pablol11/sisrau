<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoSalaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tipo Salas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-sala-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tipo Sala'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//             ['class' => 'yii\grid\SerialColumn'],

//             'tiposalaid',
            'tiposaladescripcion',

            [
//             	'class' => 'yii\grid\ActionColumn'
    			'class' => '\kartik\grid\ActionColumn',
       			'mergeHeader' => true,
       			'hAlign' => 'center',
       			'vAlign' => 'middle',
            ],
        ],
    ]); ?>

</div>
