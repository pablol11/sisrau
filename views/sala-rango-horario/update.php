<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SalaRangoHorario */

$this->title = Yii::t('app', 'Update {modelClass} ', [
    'modelClass' => $model->getSalaRangoHorarioDescripcion(),
]) ;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sala Rango Horarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->getSalaRangoHorarioDescripcion(), 'url' => ['view', 'id' => $model->salarangohorarioid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sala-rango-horario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
