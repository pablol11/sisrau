<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoRh */

$this->title = Yii::t('app', 'Create Tipo Rh');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Rhs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-rh-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
