<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Estado */

$this->title = $model->estadoid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Estados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estado-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->estadoid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->estadoid], [
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
            'estadoid',
            'estadodescripcion',
        ],
    ]) ?>

</div>
