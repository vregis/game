<?php

use yii\db\Migration;

/**
 * Class m250731_205753_add_end_game_to_storm
 */
class m250731_205753_add_end_game_to_storm extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('storm_game_to_user', 'end_at', $this->dateTime()->null());
        $this->addColumn('storm_game_to_user', 'start_at', $this->dateTime()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('storm_game_to_user', 'end_at');
        $this->dropColumn('storm_game_to_user', 'start_at');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250731_205753_add_end_game_to_storm cannot be reverted.\n";

        return false;
    }
    */
}
