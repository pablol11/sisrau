<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Rh;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

	<?php $form = ActiveForm::begin([
// 						'method' => 'post',
// 						'id' => 'formulario',
// 						'enableClientValidation' => false,
// 						'enableAjaxValidation' => true,
				]);
	?>

    <?= $form->field($model, 'usuarionombre')->textInput(['maxlength' => true]) ?>

    <?php
    	if (!empty($model->rhid)) {
    		echo $form->field($model, 'rhid')->hiddenInput(['value' => $model->rhid])->label(false);
    	} else {
    		$data = Rh::getRhs();
    		echo $form->field($model, 'rhid')
//     				->textInput();
//     				->dropDownList(Rh::getRhs(),
// 		    				['prompt'=>Yii::t('app', '(Ninguno)')]
// 		    		);
			    	->widget(Select2::classname(), [
			    			'data' => $data,
			    			//     					'attribute' => 'rhid',
			    			'maintainOrder' => false,
			    			'language' => Yii::$app->language,
			    			'options' => ['placeholder' => Yii::t('app', '(Ninguno)')],
			    			'pluginOptions' => [
			    					'allowClear' => true
			    			],
			    	]);
    	}
    	 
    ?>
    

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'authkey')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'accesstoken')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'activo')->checkbox() ?>
    
    <?= $form->field($model, 'administrador')->checkbox() ?> 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
