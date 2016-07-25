<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SalaRangoHorarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sala-rango-horario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'salarangohorarioid') ?>

    <?= $form->field($model, 'salaid') ?>

    <?= $form->field($model, 'salarangohorarioinicio') ?>

    <?= $form->field($model, 'salarangohorariofin') ?>

    <?= $form->field($model, 'salarangohorariodiadomingo')->checkbox() ?>

    <?php // echo $form->field($model, 'salarangohorariodialunes')->checkbox() ?>

    <?php // echo $form->field($model, 'salarangohorariodiamartes')->checkbox() ?>

    <?php // echo $form->field($model, 'salarangohorariodiamiercoles')->checkbox() ?>

    <?php // echo $form->field($model, 'salarangohorariodiajueves')->checkbox() ?>

    <?php // echo $form->field($model, 'salarangohorariodiaviernes')->checkbox() ?>

    <?php // echo $form->field($model, 'salarangohorariodiasabado')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
