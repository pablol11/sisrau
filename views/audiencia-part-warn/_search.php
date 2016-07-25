<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AudienciaPartWarnSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="audiencia-part-warn-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'audienciaparticipanteid') ?>

    <?= $form->field($model, 'audienciapartwarnmsgeanterior') ?>

    <?= $form->field($model, 'audienciapartwarnmsgeposterior') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
