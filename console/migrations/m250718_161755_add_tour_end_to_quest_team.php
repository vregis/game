<?php

use yii\db\Migration;

/**
 * Class m250718_161755_add_tour_end_to_quest_team
 */
class m250718_161755_add_tour_end_to_quest_team extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('quest_game_team_tour', 'end_at', $this->dateTime()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('quest_game_team_tour', 'end_at');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250718_161755_add_tour_end_to_quest_team cannot be reverted.\n";

        return false;
    }
    */
}
