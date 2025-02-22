<?php

use yii\db\Migration;

/**
 * Class m240808_163650_add_quest_game_to_tour_table
 */
class m240808_163650_add_quest_game_to_tour_table extends Migration
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

        $this->createTable('{{%quest_game_tour}}', [
            'id' => $this->primaryKey(),
            'game_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull()->defaultValue(0),
            'tour_id' => $this->integer()->notNull(),
            'team_id' => $this->integer()->defaultValue(0),
            'created_at' => $this->dateTime()->null(),
            'updated_at' => $this->dateTime()->null(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%quest_game_tour}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240808_163650_add_quest_game_to_tour_table cannot be reverted.\n";

        return false;
    }
    */
}
