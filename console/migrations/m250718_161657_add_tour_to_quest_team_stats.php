<?php

use yii\db\Migration;

/**
 * Class m250718_161657_add_tour_to_quest_team_stats
 */
class m250718_161657_add_tour_to_quest_team_stats extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('quest_game_team_stats', 'tour_id', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('quest_game_team_stats', 'tour_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250718_161657_add_tour_to_quest_team_stats cannot be reverted.\n";

        return false;
    }
    */
}
