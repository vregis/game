<?php

use yii\db\Migration;

/**
 * Class m260516_131328_add_real_game_create_to_storm_to_user
 */
class m260516_131328_add_real_game_create_to_storm_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('storm_game_to_user', 'real_created_at', $this->dateTime()->null());
        $this->addColumn('storm_game_to_user', 'bonus', $this->integer());

        $this->update(
            'storm_game_to_user',
            ['real_created_at' => new \yii\db\Expression('DATE(created_at)')],
            ['IS NOT', 'created_at', null]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('storm_game_to_user', 'real_created_at');
        $this->dropColumn('storm_game_to_user', 'bonus');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260516_131328_add_real_game_create_to_storm_to_user cannot be reverted.\n";

        return false;
    }
    */
}
