<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


/**
 *
 * @property int $id
 * @property string $title
 * @property int $year
 * @property int $author_id
 *
 * @property Author $author
 */
class Book extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'year', 'author_id'], 'required'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::class, 'targetAttribute' => ['author_id' => 'id']],
            [['title'], 'string', 'max' => 255],
            ['year', 'integer'],
            ['year', 'validateYear'],
        ];
    }

    public function validateYear($attribute, $params)
    {
        if (!is_numeric($this->$attribute)) {
            $this->addError($attribute, 'Год должен быть числом.');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название книги',
            'year' => 'Год издания',
            'author_id' => 'Автор',
        ];
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }
}
