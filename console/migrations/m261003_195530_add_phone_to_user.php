<?php

use yii\db\Migration;

/**
 * Class m261003_195530_add_phone_to_user
 */
class m261003_195530_add_phone_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'phone', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'phone');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m261003_195530_add_phone_to_user cannot be reverted.\n";

        return false;
    }
    */
}
