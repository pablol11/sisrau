<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rh */

$rh = $model->getApellidoYNombre();
$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Rh',
]) . $rh;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rhs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $rh, 'url' => ['view', 'id' => $model->rhid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="rh-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
