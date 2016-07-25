<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\User;
use app\models\Usuario;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
//         'brandLabel' => Yii::t('app', 'My Company'),
    	'brandLabel' => Html::img('@web/images/logo-justicia.png'),
   		'brandOptions' => ['class' => '.navbar-left', 'style'=>'margin-top: -15px;margin-left: -25px;padding-top: 0px;'],
    	'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $menuItems = [
    		['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
    ];
    if (!Yii::$app->user->isGuest) {
    	$menuItems[] = ['label' => Yii::t('app', 'Audiencias'), 'url' => ['/audiencia/index']];
    	
    	if (User::esAdministrador(User::getIdUsuarioLogueado())) {
	    	$subitems[] = ['label' => Yii::t('app', 'Ambitos'), 'url' => ['ambito/index']];
	    	$subitems[] = ['label' => Yii::t('app', 'Sectores'), 'url' => ['sector/index']];
	    	$subitems[] = ['label' => Yii::t('app', 'Tipos de Sectores'), 'url' => ['tipo-sector/index']];
    	}
    	
	    $subitems[] = ['label' => Yii::t('app', 'Salas'), 'url' => ['sala/index']];
    	$subitems[] = ['label' => Yii::t('app', 'Tipos de Salas'), 'url' => ['tipo-sala/index']];
    	$subitems[] = ['label' => Yii::t('app', 'Feriados'), 'url' => ['feriado/index']];
    	 
    	
    	$menuItems[] = ['label' => Yii::t('app', 'Clasificadores'), 'url' => ['#'], 
						'items' => $subitems,
			];
    	
    	if (User::esAdministrador(User::getIdUsuarioLogueado())) {
	    	$menuItems[] = ['label' => Yii::t('app', 'Administracion de Usuarios'), 'url' => ['#'], 
							'items' => [
									['label' => Yii::t('app', 'Tipos de Recursos Humanos'), 'url' => ['tipo-rh/index']],
									['label' => Yii::t('app', 'Recursos Humanos'), 'url' => ['rh/index']],
									['label' => Yii::t('app', 'Usuarios'), 'url' => ['usuario/index']],
							],
					];
    	} else {
    		$menuItems[] = ['label' => Yii::t('app', 'Recursos Humanos'), 'url' => ['rh/index']];
    	}
    	
    }
    
//     $menuItems[] = ['label' => Yii::t('app', 'About'), 'url' => ['/site/about']]; 
    
    if (Yii::$app->user->isGuest) {
    	$menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
    } else {
    	$usuario = Usuario::getUsuarioLogueado();
    	$nombreUsuario = $usuario->rh->getApellidoYNombre();
    	$title = 'Ambito: '.$usuario->rh->rhambito->ambitodescripcion;
    	$menuItems[] = [
    			'label' => Yii::t('app', 'Logout') . ' (' . $nombreUsuario . ')',
    			'url' => ['/site/logout'],
    			'linkOptions' => ['data-method' => 'post', 'title' => $title]
    	];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
    	'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::t('app', 'Developer') ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::t('app', 'Powered by {yii}') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
