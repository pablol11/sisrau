<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AudienciaAnulada */

$this->title = Yii::t('app', 'Create Audiencia Anulada');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Audiencia Anuladas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audiencia-anulada-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
