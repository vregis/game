<?php

use yii\db\Migration;

/**
 * Class m240808_151852_add_quest_game_to_user
 */
class m240808_151852_add_quest_game_to_user extends Migration
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

        $this->createTable('{{%quest_game_to_user}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->defaultValue(0),
            'game_id' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->dateTime()->null(),
            'updated_at' => $this->dateTime()->null(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-quest-game_user_id',
            'quest_game_to_user', 'game_id',
            'games',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-quest-game_user_id', 'quest_game_to_user');
        $this->dropTable('{{%quest_game_to_user}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240808_151852_add_quest_game_to_user cannot be reverted.\n";

        return false;
    }
    */
}
