<?php

use yii\db\Migration;

/**
 * Class m220209_091402_tags
 */
class m220209_091402_tags extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('shop_tags', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->unique()->notNull(),
            'slug' => $this->string()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('shop_tags');
    }

}
