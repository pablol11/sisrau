<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AudienciaAnulada */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Audiencia Anulada',
]) . ' ' . $model->audienciaid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Audiencia Anuladas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->audienciaid, 'url' => ['view', 'id' => $model->audienciaid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="audiencia-anulada-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
