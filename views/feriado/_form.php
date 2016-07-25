<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\Feriado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feriado-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'feriadofecha')
//     			->textInput()
		    ->widget(DatePicker::className(),
		    		[
	    				'language' => Yii::$app->language,
	    				'dateFormat' => 'php:d-m-Y',
	    				'options' => [
	    						'class' => 'form-control',
	    						'style' => 'width:30%',
	    				],
		    		] )
    ?>
        

    <?= $form->field($model, 'feriadotexto')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
