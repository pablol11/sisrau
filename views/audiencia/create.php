<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Audiencia */

$this->title = Yii::t('app', 'Create Audiencia');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Audiencias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audiencia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
