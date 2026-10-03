<?php

use yii\db\Migration;

/**
 * Class m261003_165829_add_tour_attachments_table
 */
class m261003_165829_add_tour_attachments_table extends Migration
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

        $this->createTable('{{%tour_attachments}}', [
            'id' => $this->primaryKey(),
            'tour_id' => $this->integer()->notNull()->defaultValue(1),
            'type' => $this->smallInteger()->notNull()->defaultValue(0),
            'url' => $this->text()->null(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-attachments-tour',
            'tour_attachments', 'tour_id',
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
        $this->dropForeignKey('fk-attachments-tour', 'tour_attachments');
        $this->dropTable('tour_attachments');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m261003_165829_add_tour_attachments_table cannot be reverted.\n";

        return false;
    }
    */
}
