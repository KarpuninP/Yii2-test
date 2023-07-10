<?php

namespace app\controllers;

use app\models\Book;
use app\models\Author;
use Yii;
use yii\web\Controller;
use app\helpers\ModelHelper;

class FormController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Создает новую модель Book.
     * Если создание успешно, то будет выполнено перенаправление на страницу просмотра
     * @return mixed
     */
    public function actionCreate()
    {
        // то что пришло постом
        $request = Yii::$app->request;
        $authorName = $request->post('author');
        $bookTitle = $request->post('book');
        $year = $request->post('year');

        // Проверка существования таблицы "authors"
        $db = Yii::$app->db;
        $authorsTableExists = $db->getTableSchema('authors') !== null;

        // Проверка существования таблицы "books"
        $booksTableExists = $db->getTableSchema('books') !== null;

        if (!$authorsTableExists) {
            // Создание таблицы "authors"
            $migration = new \yii\db\Migration();
            $migration->createTable('authors', [
                'id' => $migration->primaryKey(),
                'name' => $migration->string()->notNull(),
            ]);
        }

        if (!$booksTableExists) {
            // Создание таблицы "books"
            $migration = new \yii\db\Migration();
            $migration->createTable('books', [
                'id' => $migration->primaryKey(),
                'title' => $migration->string()->notNull(),
                'year' => $migration->integer()->notNull(),
                'author_id' => $migration->integer()->notNull(),
            ]);

            // Добавление внешнего ключа
            $migration->addForeignKey(
                'fk-books-author_id',
                'books',
                'author_id',
                'authors',
                'id',
                'CASCADE',
                'CASCADE'
            );
        }

        // Создание записи в таблице "authors"
        $authorModel = new Author();
        $authorModel->name = $authorName;
        $authorModel->save();

        // Создание записи в таблице "books"
        $bookModel = new Book();
        $bookModel->title = $bookTitle;
        $bookModel->year = $year;
        $bookModel->author_id = $authorModel->id;
        $bookModel->save();

        return $this->redirect(['book/index']);
    }

    /**
     * Обновляет существующую модель Book.
     * Если обновление успешно, то будет выполнено перенаправление на страницу просмотра главную страницу.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException, если модель не найдена
     */
    public function actionUpdate(int $id)
    {
        // Проверяем, что передано значение $id
        if ($id) {
            // Находим модель Book по переданному $id
            $book = $this->findModel($id);

            // Проверяем, что модель найдена
            if ($book !== null) {
                // Получаем связанную модель Author
                $author = $book->author;

                // Проверяем, что связанная модель Author найдена
                if ($author !== null) {
                    // Проверяем, является ли запрос POST-запросом
                    if (Yii::$app->request->isPost) {
                        // Обрабатываем данные формы
                        $request = Yii::$app->request;
                        $authorName = $request->post('author');
                        $bookTitle = $request->post('book');
                        $year = $request->post('year');

                        // Обновляем значения модели Book
                        $book->title = $bookTitle;
                        $book->year = $year;

                        // Обновляем значение связанной модели Author
                        $author->name = $authorName;

                        // Сохраняем изменения в базе данных
                        $book->save();
                        $author->save();

                        // Перенаправляем пользователя на страницу со списком книг
                        return $this->redirect(['book/index']);
                    } else {
                        // Отображаем форму для обновления с заполненными значениями полей
                        return $this->render('update', [
                            'book' => $book,
                            'author' => $author,
                        ]);
                    }
                }
            }
        }

        // Если не удалось найти модель Book или Author, перенаправляем пользователя на страницу со списком книг
        return $this->redirect(['book/index']);
    }


    /**
     * Удаляет существующую модель Book и Author.
     * Если удаление успешно, то будет выполнено перенаправление на страницу списка (index).
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException, если модель не найдена
     */
    public function actionDelete($id)
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $book = $this->findModel($id);
            $authorId = $book->author_id;

            // Удаляем запись в таблице books
            $book->delete();

            // Удаляем запись в таблице authors
            Author::deleteAll(['id' => $authorId]);

            $transaction->commit();

            return $this->redirect(['book/index']);
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    /**
     * Находит модель Book по ее идентификатору.
     * Если модель не найдена, то будет выброшено исключение NotFoundHttpException.
     * @param integer $id
     * @return Book загруженная модель
     * @throws NotFoundHttpException, если модель не найдена
     */
    protected function findModel($id)
    {
        return ModelHelper::findModel(Book::class, $id);
    }
}