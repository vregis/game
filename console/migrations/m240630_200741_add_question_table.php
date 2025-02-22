<?php

use yii\db\Migration;

/**
 * Class m240630_200741_add_question_table
 */
class m240630_200741_add_question_table extends Migration
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

        $this->createTable('{{%questions}}', [
            'id' => $this->primaryKey(),
            'text' => $this->text()->notNull(),
            'tour_id' => $this->integer()->notNull()->defaultValue(1),
            'type' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-questions-tour_id',
            'questions', 'tour_id',
            'tours',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240630_200741_add_question_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240630_200741_add_question_table cannot be reverted.\n";

        return false;
    }
    */
}
