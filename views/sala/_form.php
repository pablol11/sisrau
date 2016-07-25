<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\TipoSala;
use app\models\Ambito;
use app\models\Usuario;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Sala */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sala-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'saladescripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tiposalaid')->dropDownList(TipoSala::getListaTipoSalas(),
    					[
    						'prompt'=>Yii::t('app', '(Ninguno)'),
							'disabled' => ((!$model->isNewRecord) and (!empty($model->audiencias))) ? true : false,
					    ]
    				) 
    ?>

    <?php 
    
    	// Si es un usuario Simple, se filtra por el ambito del mismo,
    	// Caso contrario se visualizarán todos los ambitos existentes.    	   
    	if (!User::esUsuarioLogueadoAdmin()) {
	    	$ambitoid = Usuario::getAmbitoUsuarioLogueado();
    
	    	echo $form->field($model, 'ambitoid')->hiddenInput(['value' => $ambitoid])->label(false);
	    	
    	} else {
    		echo $form->field($model, 'ambitoid')->dropDownList(Ambito::getListaAmbitos(),
	    			[
	    				'prompt'=>Yii::t('app', '(Ninguno)'),
	    				'disabled' => ((empty($model->audiencias)) ? 'disabled' : 'enabled'),		
    				]
	    		);
    	}
    
    ?>

    <?= $form->field($model, 'salaactiva')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
