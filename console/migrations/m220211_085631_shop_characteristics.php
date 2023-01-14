<?php

use yii\db\Migration;

/**
 * Class m220211_085631_shop_characteristics
 */
class m220211_085631_shop_characteristics extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('shop_characteristics',[
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'type' => $this->string()->notNull(),
            'required' => $this->boolean()->notNull()->defaultValue(false),
            'default' => $this->string()->null(),
            'json_variants' => 'jsonb',
            'sort' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('shop_characteristics');
    }


}
