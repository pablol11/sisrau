<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AudienciaAnulada */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="audiencia-anulada-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'audienciaid')->hiddenInput(['value' => $model->audienciaid])->label(false) ?>

    <?= $form->field($model, 'audienciaanuladafecha')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'audienciaanuladamotivo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'audienciaanuladaambitoid')->hiddenInput(['value' => $model->audienciaanuladaambitoid])->label(false) ?>

    <?= $form->field($model, 'audienciaanuladasectorid')->hiddenInput(['value' => $model->audienciaanuladasectorid])->label(false) ?>

    <?= $form->field($model, 'audienciaanuladarhid')->hiddenInput(['value' => $model->audienciaanuladarhid])->label(false) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
