<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoSala */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Tipo Sala',
]) . ' ' . $model->tiposaladescripcion;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Salas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tiposaladescripcion, 'url' => ['view', 'id' => $model->tiposalaid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tipo-sala-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
