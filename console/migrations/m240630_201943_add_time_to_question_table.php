<?php

use yii\db\Migration;

/**
 * Class m240630_201943_add_time_to_question_table
 */
class m240630_201943_add_time_to_question_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('questions', 'time', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('questions', 'time');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240630_201943_add_time_to_question_table cannot be reverted.\n";

        return false;
    }
    */
}
