<?php

use yii\db\Migration;

/**
 * Class m260206_212237_add_city_game_table
 */
class m260206_212237_add_city_game_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%city_games}}', [
            'city_id' => $this->integer()->notNull(),
            'game_id' => $this->integer()->notNull(),
        ]);

        // Создаем составной первичный ключ
        $this->addPrimaryKey('pk-city_games', '{{%city_games}}', ['city_id', 'game_id']);

        // Внешние ключи
        $this->addForeignKey(
            'fk-city_games-city_id',
            '{{%city_games}}',
            'city_id',
            '{{%city}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-city_games-game_id',
            '{{%city_games}}',
            'game_id',
            '{{%games}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // Индексы для оптимизации
        $this->createIndex('idx-city_games-city_id', '{{%city_games}}', 'city_id');
        $this->createIndex('idx-city_games-game_id', '{{%city_games}}', 'game_id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-city_games-city_id', '{{%city_games}}');
        $this->dropForeignKey('fk-city_games-game_id', '{{%city_games}}');
        $this->dropTable('{{%city_games}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260206_212237_add_city_game_table cannot be reverted.\n";

        return false;
    }
    */
}
