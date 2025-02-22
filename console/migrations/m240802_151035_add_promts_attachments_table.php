<?php

use yii\db\Migration;

/**
 * Class m240802_151035_add_promts_attachments_table
 */
class m240802_151035_add_promts_attachments_table extends Migration
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

        $this->createTable('{{%prompts_attachments}}', [
            'id' => $this->primaryKey(),
            'prompt_id' => $this->integer()->notNull()->defaultValue(1),
            'type' => $this->smallInteger()->notNull()->defaultValue(0),
            'url' => $this->text()->null(),
            'created_at' => $this->dateTime()->null(),
            'updated_at' => $this->dateTime()->null(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-attachments-prompts',
            'prompts_attachments', 'prompt_id',
            'prompts',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-attachments-prompts', 'prompts_attachments');
        $this->dropTable('prompts_attachments');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240802_151035_add_promts_attachments_table cannot be reverted.\n";

        return false;
    }
    */
}
