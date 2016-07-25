<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\TipoSector;
use app\models\Ambito;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SectorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sectors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sector-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
   		'showOnEmpty' => true,
        'columns' => [
            'sectordescripcion',
    		[
	    		'attribute' => 'tiposectorid',
	    		'value' => 'tiposector.tiposectordescripcion',
	    		'filter' => Html::activeDropDownList(
	    				$searchModel,
	    				'tiposectorid',
	    				TipoSector::getListaTipoSectores(),
	    				['class'=>'form-control dropdown','prompt' => '( Ninguno )']
	    		),
    		],
        		
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
