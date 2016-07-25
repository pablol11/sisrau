<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$usuario = $model->rh->getApellidoYNombre().' ('.$model->usuarionombre.')';

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Usuario',
]) . $usuario;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $usuario, 'url' => ['view', 'id' => $model->usuarioid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="usuario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
