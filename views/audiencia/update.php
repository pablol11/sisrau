<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Audiencia */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Audiencia',
]) . ' ' . $model->audienciadescripcion;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Audiencias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->audienciadescripcion, 'url' => ['view', 'id' => $model->audienciaid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="audiencia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
