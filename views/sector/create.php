<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Sector */

$this->title = Yii::t('app', 'Create Sector');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sectors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sector-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
