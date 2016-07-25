<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoSectorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tipo Sectors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-sector-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tipo Sector'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//             ['class' => 'yii\grid\SerialColumn'],

//             'tiposectorid',
            'tiposectordescripcion',

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
