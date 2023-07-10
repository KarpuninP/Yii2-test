<?php
/** @var yii\web\View $this */
$this->title = Yii::$app->name;

?>
<main>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>Автор</th>
                <th>Название книги</th>
                <th>Год издания</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= $book->author->name ?></td>
                    <td><?= $book->title ?></td>
                    <td><?= $book->year ?></td>
                    <td><a href="<?= Yii::$app->urlManager->createUrl(['book/update', 'id' => $book->id]) ?>" class="btn btn-primary">Обновить</a></td>
                    <td><a href="<?= Yii::$app->urlManager->createUrl(['book/del', 'id' => $book->id]) ?>" class="btn btn-danger">Удалить</a></td>

                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
    </div>


</main>