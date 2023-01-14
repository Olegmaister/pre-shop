<?php

use yii\db\Migration;

/**
 * Class m220213_145245_shop_characteristic_values
 */
class m220213_145245_shop_characteristic_values extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('shop_characteristic_values',[
            'characteristic_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'characteristic_value' => 'jsonb'
        ]);

        $this->addForeignKey(
            'fk-shop_characteristic_values_characteristic_id',
            'shop_characteristic_values',
            'characteristic_id',
            'shop_characteristics',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-shop_characteristic_values_product_id',
            'shop_characteristic_values',
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
        $this->dropTable('shop_characteristic_values');
    }


}
