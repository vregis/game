<?php

use yii\db\Migration;

/**
 * Class m240802_162600_add_answers_table
 */
class m240802_162600_add_answers_table extends Migration
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

        $this->createTable('{{%answers}}', [
            'id' => $this->primaryKey(),
            'text' => $this->string()->null(),
            'number' => $this->integer()->notNull()->defaultValue(1),
            'question_id' => $this->integer()->notNull()->defaultValue(1),
            'created_at' => $this->dateTime()->null(),
            'updated_at' => $this->dateTime()->null(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-answers-question_id',
            'answers', 'question_id',
            'questions',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-answers-question_id', 'answers');
        $this->dropTable('{{%answers}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240802_162600_add_answers_table cannot be reverted.\n";

        return false;
    }
    */
}
