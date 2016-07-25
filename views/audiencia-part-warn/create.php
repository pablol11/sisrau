<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AudienciaPartWarn */

$this->title = Yii::t('app', 'Create Audiencia Part Warn');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Audiencia Part Warns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audiencia-part-warn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
