<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\AudienciaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="audiencia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'audienciaid') ?>

    <?= $form->field($model, 'audienciadescripcion') ?>

    <?= $form->field($model, 'audienciafecha')
    			->widget(DatePicker::className(),
    					[
			               	'language' => Yii::$app->language,
			               	'dateFormat' => 'dd/MM/yyyy',
    					]) 
    ?> 

    <?= $form->field($model, 'audienciahorainicio') ?>

    <?= $form->field($model, 'audienciahorafin') ?>

    <?php // echo $form->field($model, 'salaid') ?>

    <?php // echo $form->field($model, 'estadoid') ?>

    <?php // echo $form->field($model, 'audienciaregambitoid') ?>

    <?php // echo $form->field($model, 'audienciaregsectorid') ?>

    <?php // echo $form->field($model, 'audienciaregrhid') ?>

    <?php // echo $form->field($model, 'audienciaregfecha') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
