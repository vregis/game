<?php

use yii\db\Migration;

/**
 * Class m240718_192610_add_prompt_table
 */
class m240718_192610_add_prompt_table extends Migration
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

        $this->createTable('{{%prompts}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->null(),
            'number' => $this->integer()->notNull()->defaultValue(1),
            'question_id' => $this->integer()->notNull()->defaultValue(1),
            'text' => $this->string()->null(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-prompt-question_id',
            'prompts', 'question_id',
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
        $this->dropForeignKey('fk-prompt-question_id', 'prompts');
        $this->dropTable('{{%prompts}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240718_192610_add_prompt_table cannot be reverted.\n";

        return false;
    }
    */
}
