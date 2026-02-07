<?php

use yii\db\Migration;

/**
 * Class m260206_210220_add_vk_fields
 */
class m260206_210220_add_vk_fields extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'vkontakte_id', $this->string());
        $this->addColumn('{{%user}}', 'vkontakte_data', $this->text());

        // Добавляем индекс для быстрого поиска по vkontakte_id
        $this->createIndex('idx-user-vkontakte_id', '{{%user}}', 'vkontakte_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-user-vkontakte_id', '{{%user}}');
        $this->dropColumn('{{%user}}', 'vkontakte_data');
        $this->dropColumn('{{%user}}', 'vkontakte_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260206_210220_add_vk_fields cannot be reverted.\n";

        return false;
    }
    */
}
