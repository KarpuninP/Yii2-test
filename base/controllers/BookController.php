<?php

namespace app\controllers;

use Yii;
use app\models\Book;
use app\models\Author;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class BookController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Выводит список всех моделей Book.
     * Если таблицы не существуют, перенаправляет на FormController.
     * @return mixed
     */
    public function actionIndex()
    {
        $booksExist = Book::find()->exists();
        $authorsExist = Author::find()->exists();

        if ($booksExist && $authorsExist) {

            $books = Book::find()->all();
            $authors = Author::find()->all();
            return $this->render('index', compact('books', 'authors'));
        } else {
            return $this->redirect(['form/index']);
        }
    }

    /**
     * Обновляет существующую модель Book.
     * Если обновление успешно, то будет выполнено перенаправление на страницу просмотра списка (index).
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException, если модель не найдена
     */
    public function actionUpdate(int $id)
    {
        if ($id) {
          return $this->redirect(['form/update', 'id' => $id]);
        }
    }

    /**
     * Удаляет существующую модель Book.
     * Если удаление успешно, то будет выполнено перенаправление на страницу списка (index).
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException, если модель не найдена
     */
    public function actionDel($id)
    {
        if ($id) {
            return $this->redirect(['form/delete', 'id' => $id]);
        }
    }


}
