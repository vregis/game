<?php

use yii\db\Migration;

/**
 * Class m240630_125545_add_tours_table
 */
class m240630_125545_add_tours_table extends Migration
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

        $this->createTable('{{%tours}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'number' => $this->integer()->notNull()->defaultValue(1),
            'game_id' => $this->integer()->notNull()->defaultValue(1),
            'type' => $this->smallInteger()->notNull()->defaultValue(0),
            'is_perforate' => $this->boolean()->defaultValue(0),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-tours-game_id',
            'tours', 'game_id',
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
        $this->dropForeignKey('fk-tours-game_id', 'tours');
        $this->dropTable('{{%tours}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240630_125545_add_tours_table cannot be reverted.\n";

        return false;
    }
    */
}
