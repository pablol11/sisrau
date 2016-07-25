<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoSector */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Tipo Sector',
]) . ' ' . $model->tiposectordescripcion;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Sectors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tiposectordescripcion, 'url' => ['view', 'id' => $model->tiposectorid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tipo-sector-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
