<?php

use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron" style="padding-top: 60px;padding-bottom: 20px;">
        <h1><?= Yii::t('app', 'Congratulations!') ?></h1>

	    <div class=".container-fluid ">
	
	        <div class="row">
	            <div class="col-md-12" >
	            	<?= Html::img('@web/images/encabezado.jpg', ['style' => 'padding: 70px 15px;']); ?>
	            </div>
	        </div>
	
	    </div>
    </div>

</div>
