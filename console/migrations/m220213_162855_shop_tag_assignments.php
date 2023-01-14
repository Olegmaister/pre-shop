<?php

use yii\db\Migration;

/**
 * Class m220213_162855_shop_tag_assignments
 */
class m220213_162855_shop_tag_assignments extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('shop_tag_assignments',[
            'id' => $this->primaryKey(),
            'tag_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull()
        ]);

        $this->createIndex(
            'idx-shop_tag_assignments_tag_id_product_id',
            'shop_tag_assignments',
            ['tag_id','product_id'],
            true
        );

        $this->addForeignKey(
            'fk-shop_tag_assignments_tag_id',
            'shop_tag_assignments',
            'tag_id',
            'shop_tags',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-shop_tag_assignments_product_id',
            'shop_tag_assignments',
            'product_id',
            'shop_products',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('shop_tag_assignments');
    }

}
