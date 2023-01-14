<?php

use yii\db\Migration;

/**
 * Class m220210_112903_shop_categories
 */
class m220210_112903_shop_categories extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('shop_categories', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'title' => $this->string(),
            'description' => $this->text(),
            'json_meta' => 'jsonb',
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-shop_categories-slug', 'shop_categories', 'slug', true);

        $this->insert('shop_categories', [
            'name' => '',
            'slug' => 'root',
            'title' => null,
            'description' => null,
            'json_meta' => '{}',
            'lft' => 1,
            'rgt' => 2,
            'depth' => 0,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('shop_categories');
    }


}
