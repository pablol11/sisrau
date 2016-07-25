<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Rh */

$this->title = Yii::t('app', 'Create Rh');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rhs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
