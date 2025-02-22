<?php

use yii\db\Migration;

/**
 * Class m240810_142431_add_tour_to_quest_stat
 */
class m240810_142431_add_tour_to_quest_stat extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('quest_game_stats', 'tour_id', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('quest_game_stats', 'tour_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240810_142431_add_tour_to_quest_stat cannot be reverted.\n";

        return false;
    }
    */
}
