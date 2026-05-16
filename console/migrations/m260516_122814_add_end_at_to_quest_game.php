<?php

use yii\db\Migration;

/**
 * Class m260516_122814_add_end_at_to_quest_game
 */
class m260516_122814_add_end_at_to_quest_game extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('quest_game_to_user', 'end_at', $this->dateTime()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('quest_game_to_user', 'end_at');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260516_122814_add_end_at_to_quest_game cannot be reverted.\n";

        return false;
    }
    */
}
