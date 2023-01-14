<?php

use yii\db\Migration;

/**
 * Class m220213_143102_shop_category_assignments
 */
class m220213_143102_shop_category_assignments extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('shop_category_assignments',[
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull()
        ]);

        $this->createIndex(
            'idx-shop_category_assignments_category_id_product_id',
            'shop_category_assignments',
            ['category_id','product_id'],
            true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('shop_category_assignments');
    }


}
