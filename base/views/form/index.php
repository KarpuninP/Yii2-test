<?php
/** @var yii\web\View $this */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::$app->name;
$this->registerCsrfMetaTags();
?>
<main>
    <div class="container">
        <form action="<?= Url::to(['form/create']) ?>" method="post">
            <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
            <div class="row">
                <div class="col-md-4">
                    <label for="author">Автор</label>
                    <input type="text" class="form-control" id="author" name="author" placeholder="Введите автора" required>
                </div>
                <div class="col-md-4">
                    <label for="book">Название книги</label>
                    <input type="text" class="form-control" id="book" name="book" placeholder="Введите название книги" required>
                </div>
                <div class="col-md-4">
                    <label for="year">Год издания</label>
                    <input type="text" class="form-control" id="year" name="year" placeholder="Введите год издания" required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4 offset-md-8 text-md-end">
                    <button type="submit" class="btn btn-dark">Добавить</button>
                </div>
            </div>
        </form>
    </div>
</main>
