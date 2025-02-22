<?php

use yii\db\Migration;

/**
 * Class m240629_133411_add_public_to_game
 */
class m240629_133411_add_public_to_game extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('games', 'public', $this->boolean()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('games', 'public');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240629_133411_add_public_to_game cannot be reverted.\n";

        return false;
    }
    */
}
