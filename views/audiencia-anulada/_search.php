<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AudienciaAnuladaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="audiencia-anulada-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'audienciaid') ?>

    <?= $form->field($model, 'audienciaanuladafecha') ?>

    <?= $form->field($model, 'audienciaanuladaambitoid') ?>

    <?= $form->field($model, 'audienciaanuladasectorid') ?>

    <?= $form->field($model, 'audienciaanuladarhid') ?>

    <?php // echo $form->field($model, 'audienciaanuladamotivo') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
