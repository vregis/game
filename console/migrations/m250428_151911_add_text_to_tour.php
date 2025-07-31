<?php

use yii\db\Migration;

/**
 * Class m250428_151911_add_text_to_tour
 */
class m250428_151911_add_text_to_tour extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tours', 'text', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tours', 'text');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250428_151911_add_text_to_tour cannot be reverted.\n";

        return false;
    }
    */
}
