<?php

use yii\db\Migration;

/**
 * Class m220216_134835_shop_products_upd
 */
class m220216_134835_shop_products_upd extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_products', 'main_photo_id', $this->integer()->null());
        $this->addForeignKey(
            'fk-shop_products_main_photo_id',
            'shop_products',
            'main_photo_id',
            'shop_photos',
            'id',
            'SET NULL',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('shop_products','main_photo_id');
        $this->dropForeignKey('fk-shop_products_main_photo_id','shop_products');
    }

}
