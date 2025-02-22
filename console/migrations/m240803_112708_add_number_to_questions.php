<?php

use yii\db\Migration;

/**
 * Class m240803_112708_add_number_to_questions
 */
class m240803_112708_add_number_to_questions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('questions', 'number', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('questions', 'number');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240803_112708_add_number_to_questions cannot be reverted.\n";

        return false;
    }
    */
}
