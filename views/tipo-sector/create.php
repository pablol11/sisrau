<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoSector */

$this->title = Yii::t('app', 'Create Tipo Sector');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Sectors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-sector-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
