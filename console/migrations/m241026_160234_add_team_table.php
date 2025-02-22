<?php

use yii\db\Migration;

/**
 * Class m241026_160234_add_team_table
 */
class m241026_160234_add_team_table extends Migration
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

        $this->createTable('{{%team}}', [
            'id' => $this->primaryKey(),
            'creator_id' => $this->integer()->notNull()->defaultValue(0),
            'captain_id' => $this->integer()->notNull()->defaultValue(0),
            'name' => $this->string()->null(),
            'avatar' => $this->string()->null(),
            'created_at' => $this->dateTime()->null(),
            'updated_at' => $this->dateTime()->null(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('team');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241026_160234_add_team_table cannot be reverted.\n";

        return false;
    }
    */
}
