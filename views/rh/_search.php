<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RhSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rh-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'rhid') ?>

    <?= $form->field($model, 'rhnombre') ?>

    <?= $form->field($model, 'rhapellido') ?>

    <?= $form->field($model, 'tiporhid') ?>

	<?php // echo $form->field($model, 'rhambitoid') ?> 

    <?php // echo $form->field($model, 'rhsectorid') ?>

    <?php // echo $form->field($model, 'rhactivo')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
