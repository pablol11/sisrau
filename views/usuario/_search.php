<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsuarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'usuarioid') ?>

    <?= $form->field($model, 'usuarionombre') ?>

    <?= $form->field($model, 'rhid') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'authkey') ?>

    <?php // echo $form->field($model, 'accesstoken') ?>

    <?php // echo $form->field($model, 'activo')->checkbox() ?>

	<?php // echo $form->field($model, 'administrador')->checkbox() ?> 

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
