<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoSala */

$this->title = Yii::t('app', 'Create Tipo Sala');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Salas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-sala-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
