<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = $model->rh->getApellidoYNombre().' ('.$model->usuarionombre.')';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->usuarioid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->usuarioid], [
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
            'usuarioid',
            'usuarionombre',
//             'rhid',
        	[
        		'attribute' => 'rhid',
        		'value' => $model->rh->getApellidoYNombre()
    		],
            'email:email',
//             'password',
//             'authkey',
//             'accesstoken',
            'activo:boolean',
        	'administrador:boolean',
        ],
    ]) ?>

</div>
