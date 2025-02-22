<?php

use yii\db\Migration;

/**
 * Class m240804_135524_add_url_to_game
 */
class m240804_135524_add_url_to_game extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('games', 'url', $this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('games', 'url');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240804_135524_add_url_to_game cannot be reverted.\n";

        return false;
    }
    */
}
