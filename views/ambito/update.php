<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ambito */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Ambito',
]) . ' ' . $model->ambitodescripcion;
// ]) . ' ' . $model->ambitoid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ambitos'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->ambitoid, 'url' => ['view', 'id' => $model->ambitoid]];
$this->params['breadcrumbs'][] = ['label' => $model->ambitodescripcion, 'url' => ['view', 'id' => $model->ambitoid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ambito-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
