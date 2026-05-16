<?php

use yii\db\Migration;

/**
 * Class m260516_132919_add_bonus_to_quest
 */
class m260516_132919_add_bonus_to_quest extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('quest_game_to_user', 'bonus', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('quest_game_to_user', 'bonus');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260516_132919_add_bonus_to_quest cannot be reverted.\n";

        return false;
    }
    */
}
