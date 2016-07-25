<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\time\TimePicker;
// use kartik\date\DatePicker;
use app\models\Sala;
use yii\jui\DatePicker;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\Audiencia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="audiencia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'audienciadescripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'audienciafecha')
    			->widget(DatePicker::className(),
    					[
    						'id' => 'audienciafecha',
			               	'language' => Yii::$app->language,
			               	'dateFormat' => 'php:d-m-Y',
    						'options' => [ 
    								'class' => 'form-control', 
    								'style' => 'width:30%',
    						],
    					])
    ?>

    <?= $form->field($model, 'audienciahorainicio')
				->widget(TimePicker::className(),
						[
    						'id' => 'audienciahorainicio',
							'name' => 'audienciahorainicio',
							'containerOptions' => [
    							'style' => 'width:30%; z-index:1;',
    						],
							'pluginOptions' => [
								'showSeconds' => false,
								'showMeridian' => false
							]
						])
    ?>

    <?= $form->field($model, 'audienciahorafin')
				->widget(TimePicker::className(),
						[
    						'id' => 'audienciahorafin',
							'name' => 'audienciahorafin',
							'containerOptions' => [
    							'style' => 'width:30%; z-index:0;',
	    					],
							'pluginOptions' => [
								'showSeconds' => false,
								'showMeridian' => false
							]
						])
    ?>
	
    <?= $form->field($model, 'salaid')
    		->dropDownList(Sala::getListaSalasActivas(),
    				[
    					'id' => 'salaid',
    					'prompt'=>Yii::t('app', '(Ninguno)')
				    ]
    			)
    			 
    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
