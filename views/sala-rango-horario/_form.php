<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Sala;
use kartik\time\TimePicker;


/* @var $this yii\web\View */
/* @var $model app\models\SalaRangoHorario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sala-rango-horario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    	if (!empty($model->salaid)) {
    		echo $form->field($model, 'salaid')->hiddenInput(['value' => $model->salaid])->label(false);
    	} else {
    		echo $form->field($model, 'salaid')
//    					->textInput() 
		    		->dropDownList(Sala::getListaSalas(),	
		    				['prompt'=>Yii::t('app', '(Ninguno)')]
		    			);
    	}
    ?>

    <?= $form->field($model, 'salarangohorarioinicio')
//     		->textInput() 
			->widget(TimePicker::className(),
					[
						'name' => 'salarangohorarioinicio',
						'containerOptions' => [
   							'style' => 'width:30%',
   						],
						'pluginOptions' => [
							'showSeconds' => false,
							'showMeridian' => false
						]
					])
    ?>

    <?= $form->field($model, 'salarangohorariofin')
//     		->textInput() 
			->widget(TimePicker::className(),
					[
						'name' => 'salarangohorariofin',
						'containerOptions' => [
   							'style' => 'width:30%',
   						],
						'pluginOptions' => [
							'showSeconds' => false,
							'showMeridian' => false
						]
					])
    ?>

	<div class="container-fluid">
		<div class="row">
			<label class="control-label" ><?= Yii::t('app', 'Salarangohorarioregistrodias') ?></label>
		</div>
		<div class="row">
			<div class="col-md-1">
			    <?= $form->field($model, 'salarangohorariodiadomingo',[
			     		'options' => ['class'=>'checkbox icheck']
			       ])->checkbox() 
			    ?>
			</div>
			<div class="col-md-1">
			    <?= $form->field($model, 'salarangohorariodialunes',[
			     		'options' => ['class'=>'checkbox icheck']
			       ])->checkbox() 
			    ?>
			</div>
			<div class="col-md-1">
			    <?= $form->field($model, 'salarangohorariodiamartes',[
			     		'options' => ['class'=>'checkbox icheck']
			       ])->checkbox() 
			    ?>
			</div>
			<div class="col-md-1">
			    <?= $form->field($model, 'salarangohorariodiamiercoles',[
			     		'options' => ['class'=>'checkbox icheck']
			       ])->checkbox() 
			    ?>
			</div>
			<div class="col-md-1">
			    <?= $form->field($model, 'salarangohorariodiajueves',[
			     		'options' => ['class'=>'checkbox icheck']
			       ])->checkbox() 
			    ?>
			</div>
			<div class="col-md-1">
			    <?= $form->field($model, 'salarangohorariodiaviernes',[
			     		'options' => ['class'=>'checkbox icheck']
			       ])->checkbox() 
			    ?>
			</div>
			<div class="col-md-1">
			    <?= $form->field($model, 'salarangohorariodiasabado',[
			     		'options' => ['class'=>'checkbox icheck']
			       ])->checkbox() 
			    ?>
			</div>
		</div>
	</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a( Yii::t('app', 'Cancel'), ['sala/view', 'id' => $model->salaid], ['class' => 'btn btn-default']); ?>
        
    </div>

    <?php ActiveForm::end(); ?>

</div>
