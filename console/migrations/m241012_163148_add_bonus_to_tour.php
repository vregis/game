<?php

use yii\db\Migration;

/**
 * Class m241012_163148_add_bonus_to_tour
 */
class m241012_163148_add_bonus_to_tour extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tours', 'bonus', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tours', 'bonus');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241012_163148_add_bonus_to_tour cannot be reverted.\n";

        return false;
    }
    */
}
