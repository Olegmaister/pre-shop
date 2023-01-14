<?php

use yii\db\Migration;

/**
 * Class m220213_115946_shop_products
 */
class m220213_115946_shop_products extends Migration
{
    public function up()
    {

        $this->createTable('shop_products', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'brand_id' => $this->integer()->notNull(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'price_old' => $this->integer(),
            'price_new' => $this->integer(),
            'rating' => $this->decimal(3, 2),
            'meta_json' => 'jsonb',
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->null()
        ]);

        $this->createIndex(
            'idx-shop_products-code',
            'shop_products',
            'code',
            true);

        $this->createIndex(
            'idx-shop_products-category_id',
            'shop_products',
            'category_id');

        $this->createIndex(
            'idx-shop_products-brand_id',
            'shop_products',
            'brand_id');

        $this->addForeignKey(
            'fk-shop_products-category_id',
            'shop_products',
            'category_id',
            'shop_categories',
            'id');

        $this->addForeignKey(
            'fk-shop_products-brand_id',
            'shop_products',
            'brand_id',
            'shop_brands',
            'id');
    }

    public function down()
    {
        $this->dropTable('shop_products');
    }
}
