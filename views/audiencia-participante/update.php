<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AudienciaParticipante */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Audiencia Participante',
]) . ' ' . $model->audienciaparticipanteid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Audiencia Participantes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->audienciaparticipanteid, 'url' => ['view', 'id' => $model->audienciaparticipanteid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="audiencia-participante-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
