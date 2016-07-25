<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoRh */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Tipo Rh',
]) . ' ' . $model->tiporhdescripcion;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Rhs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tiporhdescripcion, 'url' => ['view', 'id' => $model->tiporhid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tipo-rh-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
