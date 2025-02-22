<?php

use yii\db\Migration;

/**
 * Class m241007_163225_add_tour_id_to_storm_game_to_user_table
 */
class m241007_163225_add_tour_id_to_storm_game_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('storm_game_stats', 'tour_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('storm_game_stats', 'tour_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241007_163225_add_tour_id_to_storm_game_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
