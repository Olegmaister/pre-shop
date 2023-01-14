<?php

use yii\db\Migration;

/**
 * Class m220209_162244_brands
 */
class m220209_162244_brands extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('shop_brands',[
            'id' => $this->primaryKey(),
            'name' => $this->string()->unique()->notNull(),
            'slug' => $this->string()->notNull(),
            'json_meta' => 'jsonb'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('shop_brands');
    }


}
