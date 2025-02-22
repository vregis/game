<?php

use yii\db\Migration;

/**
 * Class m240629_121258_add_games_table
 */
class m240629_121258_add_games_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%games}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'game_type' => $this->smallInteger()->notNull()->defaultValue(1),
            'question_type' => $this->smallInteger()->notNull()->defaultValue(1),
            'is_paid' => $this->smallInteger()->notNull()->defaultValue(0),
            'price' => $this->integer()->notNull()->defaultValue(1),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%games}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240629_121258_add_games_table cannot be reverted.\n";

        return false;
    }
    */
}
