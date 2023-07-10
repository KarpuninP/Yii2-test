<?php

use app\assets\AppAsset;
use yii\helpers\Html;


AppAsset::register($this);
$this->registerCsrfMetaTags();
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>"
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="меняем тут">
    <meta name="author" content="меняем тут">
    <meta name="generator" content="меняем тут">
    <title><?= Html::encode($this->title) ?></title>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="site-wrapper">


    <header>
        <div class="container">
            <h1>Поиск книги</h1>
            <nav class="navbar navbar-expand-lg nav-user">
                <div class="container-fluid">
                    <a class="navbar-brand .logo" href="<?= Yii::$app->homeUrl ?>">
                        <img src="<?= Yii::$app->request->baseUrl ?>/img/logo.png" alt="logo" class="d-inline-block align-text-top img-user">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= Yii::$app->homeUrl ?>">Книги</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['form/index']) ?>">Добавить книгу</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <?= $content; ?>


    <!-- Подвал -->
    <footer>
        <div class="navbar-fixed-bottom row-fluid bg-dark p">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <div class="container d-flex justify-content-evenly">
                        <a href="#">О сайте</a>
                        <a href="#">Поиск</a>
                        <a href="#">Git</a>
                        <a href="#">Контакты</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
