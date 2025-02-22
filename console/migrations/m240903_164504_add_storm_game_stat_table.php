<?php

use yii\db\Migration;

/**
 * Class m240903_164504_add_storm_game_stat_table
 */
class m240903_164504_add_storm_game_stat_table extends Migration
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

        $this->createTable('{{%storm_game_stats}}', [
            'id' => $this->primaryKey(),
            'game_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'team_id' => $this->integer()->defaultValue(0),
            'question_id' => $this->integer()->notNull(),
            'answer' => $this->string()->null(),
            'is_correct' => $this->boolean()->notNull(),
            'created_at' => $this->dateTime()->null(),
            'updated_at' => $this->dateTime()->null(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%storm_game_stats}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240903_164504_add_storm_game_stat_table cannot be reverted.\n";

        return false;
    }
    */
}
