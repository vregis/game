<?php

use yii\db\Migration;

/**
 * Class m240808_150526_add_time_to_tour
 */
class m240808_150526_add_time_to_tour extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tours', 'time', $this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tours', 'time');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240808_150526_add_time_to_tour cannot be reverted.\n";

        return false;
    }
    */
}
