<?php

use yii\db\Migration;

/**
 * Class m261003_175259_add_game_end_text
 */
class m261003_175259_add_game_end_text extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('games', 'end_text', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('games', 'end_text');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m261003_175259_add_game_end_text cannot be reverted.\n";

        return false;
    }
    */
}
