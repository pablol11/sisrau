<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Audiencia;
use kartik\select2\Select2;
use app\models\Rh;

/* @var $this yii\web\View */
/* @var $model app\models\AudienciaParticipante */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="audiencia-participante-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    	if (!empty($model->audienciaid)) {
    		echo $form->field($model, 'audienciaid')->hiddenInput(['value' => $model->audienciaid])->label(false);
    	}
    ?>
    
	<?php 
	
		$fecha = $model->audiencia->audienciafecha;
		$horainicio = $model->audiencia->audienciahorainicio;
		$horafin = $model->audiencia->audienciahorafin;
		$audienciaid = null;
		$rhid = null;
		
		$data = Rh::getRhsDisponiblesParaAudiencia($audienciaid, $rhid, $fecha, $horainicio, $horafin); 
	?>

    <?= $form->field($model, 'rhid')
//     			->textInput() 
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
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    <?= Html::a( Yii::t('app', 'Cancelar'), ['audiencia/view', 'id' => $model->audienciaid], ['class' => 'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
