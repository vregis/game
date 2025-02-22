<?php

use yii\db\Migration;

/**
 * Class m241012_163652_add_bonus_to_question
 */
class m241012_163652_add_bonus_to_question extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('questions', 'bonus', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('questions', 'bonus');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241012_163652_add_bonus_to_question cannot be reverted.\n";

        return false;
    }
    */
}
