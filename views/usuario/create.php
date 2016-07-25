<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = Yii::t('app', 'Create Usuario').((!empty($model->rhid)) ? ' para '.$model->rh->getApellidoYNombre() : '');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
