<?php

use yii\db\Migration;

/**
 * Class m210709_123456_create_tables
 */
class m210709_123456_create_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Создание таблицы "authors"
        $this->createTable('authors', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        // Создание таблицы "books"
        $this->createTable('books', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'year' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
        ]);

        // Добавление внешнего ключа
        $this->addForeignKey(
            'fk-books-author_id',
            'books',
            'author_id',
            'authors',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Удаление внешнего ключа
        $this->dropForeignKey('fk-books-author_id', 'books');

        // Удаление таблицы "books"
        $this->dropTable('books');

        // Удаление таблицы "authors"
        $this->dropTable('authors');
    }
}
