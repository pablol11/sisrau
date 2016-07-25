<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SalaRangoHorario */

$this->title = Yii::t('app', 'Create Sala Rango Horario');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sala Rango Horarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sala-rango-horario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
