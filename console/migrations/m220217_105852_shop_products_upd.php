<?php

use yii\db\Migration;

/**
 * Class m220217_105852_shop_products_upd
 */
class m220217_105852_shop_products_upd extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_products','status',$this->tinyInteger()->notNull()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('shop_products','status');
    }


}
