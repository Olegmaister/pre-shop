<?php

use yii\db\Migration;

/**
 * Class m220213_211909_shop_products_upd
 */
class m220213_211909_shop_products_upd extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('shop_products','meta_json','json_meta');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('shop_products','json_meta','meta_json');
    }

}
