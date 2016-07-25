<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\TipoRh;
use app\models\Ambito;
use app\models\Sector;

/* @var $this yii\web\View */
/* @var $model app\models\Rh */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rh-form">

    <?php $form = ActiveForm::begin();?>

    <?= $form->field($model, 'rhnombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rhapellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tiporhid')->dropDownList(TipoRh::getListaTipoRh(),
    				['prompt'=>Yii::t('app', '(Ninguno)')]
    		) 
    ?>
    
    <?= $form->field($model, 'rhambitoid')->dropDownList(Ambito::getListaAmbitos(),
					[
						'id' => 'rhambitoid',
						'prompt'=>Yii::t('app', '(Ninguno)'),
					 	'onchange' => '
							$.get( "'.Url::toRoute('sector/lists').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#rhsectorid" ).html( data );
							}
                        );'
    				]
    		) 
    ?>
    		
    <?php
	    if ($model->isNewRecord) {
	    	$sectores = Sector::getListaSectoresBy($model->rhambitoid);
	    } else {
	    	$sectores = Sector::getListaSectoresArrayBy($model->rhambitoid);
	    }
	?>
 	<?=	$form->field($model, 'rhsectorid')->dropDownList($sectores,
					[
						'id' => 'rhsectorid',
						'prompt'=>Yii::t('app', '(Ninguno)'),
					]
    		) 
 	?>
 	
    <?= $form->field($model, 'rhactivo')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
