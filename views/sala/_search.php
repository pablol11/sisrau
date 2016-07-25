<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SalaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sala-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'salaid') ?>

    <?= $form->field($model, 'saladescripcion') ?>

    <?= $form->field($model, 'tiposalaid') ?>

    <?= $form->field($model, 'ambitoid') ?>

    <?= $form->field($model, 'salaactiva')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
