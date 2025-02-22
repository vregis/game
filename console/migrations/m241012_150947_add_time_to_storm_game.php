<?php

use yii\db\Migration;

/**
 * Class m241012_150947_add_time_to_storm_game
 */
class m241012_150947_add_time_to_storm_game extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('games', 'time', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('games', 'time');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241012_150947_add_time_to_storm_game cannot be reverted.\n";

        return false;
    }
    */
}
