<?php

use yii\db\Migration;

/**
 * Class m240811_121829_add_quest_tour_end
 */
class m240811_121829_add_quest_tour_end extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('quest_game_tour', 'end_at', $this->dateTime()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('quest_game_tour', 'end_at');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240811_121829_add_quest_tour_end cannot be reverted.\n";

        return false;
    }
    */
}
