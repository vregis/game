<?php

use yii\db\Migration;

/**
 * Class m250415_103049_add_welcome_game_text
 */
class m250415_103049_add_welcome_game_text extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('games', 'text', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('games', 'text');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250415_103049_add_welcome_game_text cannot be reverted.\n";

        return false;
    }
    */
}
