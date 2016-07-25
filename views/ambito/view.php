<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ambito */

// $this->title = $model->ambitoid;
$this->title = $model->ambitodescripcion;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ambitos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ambito-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->ambitoid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->ambitoid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ambitoid',
            'ambitodescripcion',
        ],
    ]) ?>

</div>
