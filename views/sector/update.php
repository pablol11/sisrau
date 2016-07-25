<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sector */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Sector',
]) . ' ' . $model->sectordescripcion;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sectors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sectordescripcion, 'url' => ['view', 'id' => $model->sectorid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sector-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
