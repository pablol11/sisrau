<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoRhSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tipo Rhs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-rh-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tipo Rh'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//             ['class' => 'yii\grid\SerialColumn'],

//             'tiporhid',
            'tiporhdescripcion',

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
