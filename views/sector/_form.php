<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\TipoSector;
use app\models\Ambito;


/* @var $this yii\web\View */
/* @var $model app\models\Sector */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sector-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sectordescripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tiposectorid')->dropDownList(TipoSector::getListaTipoSectores(),
    					['prompt'=>Yii::t('app', '(Ninguno)')]
    				) 
    ?>

    <?php
    	if (!empty($model->ambitoid)) {
    		echo $form->field($model, 'ambitoid')->hiddenInput(['value' => $model->ambitoid])->label(false);
    	} else {
    		echo $form->field($model, 'ambitoid')->dropDownList(Ambito::getListaAmbitos(),
    				['prompt'=>Yii::t('app', '(Ninguno)')]
    		);
    	}
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
