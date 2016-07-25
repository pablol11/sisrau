<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\base\Object;
use app\models\SectorSearch;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AmbitoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ambitos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ambito-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Ambito'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
    	'pjax' => true,
//     	'pjaxSettings' => [
// 	        'neverTimeout' => true,
// // 	        'beforeGrid'=>'My fancy content before.',
// // 	        'afterGrid'=>'My fancy content after.',
// 	    ],
        'columns' => [
//             ['class' => 'yii\grid\SerialColumn'],
			[
        		'class' => 'kartik\grid\ExpandRowcolumn',
        		'value' => function ($model, $key, $index, $column) {
					return GridView::ROW_COLLAPSED;
        		},
        		'detail' => function ($model, $key, $index, $column) {
        			$searchModel = new SectorSearch();
        			$searchModel->ambitoid = $model->ambitoid;
        			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        			$dataProvider->pagination = false;
        		
        			return Yii::$app->controller->renderPartial('../sector/_sectores', [
        					'searchModel' => $searchModel,
        					'dataProvider' => $dataProvider,
        			]);
        		},
       		],
//             'ambitoid',
            'ambitodescripcion',

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
