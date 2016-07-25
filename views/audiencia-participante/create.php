<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AudienciaParticipante */

$this->title = Yii::t('app', 'Create Audiencia Participante');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Audiencia Participantes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audiencia-participante-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
