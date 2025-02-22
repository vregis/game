<?php

use yii\db\Migration;

/**
 * Class m241012_173416_add_time_to_prompts
 */
class m241012_173416_add_time_to_prompts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('prompts', 'time', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('prompts', 'time');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241012_173416_add_time_to_prompts cannot be reverted.\n";

        return false;
    }
    */
}
