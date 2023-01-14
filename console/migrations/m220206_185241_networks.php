<?php

use yii\db\Migration;

/**
 * Class m220206_185241_networks
 */
class m220206_185241_networks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('networks',[
           'id' => $this->primaryKey(),
           'user_id' => $this->integer()->notNull(),
           'network_id' => $this->integer()->notNull(),
           'network_name' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-networks-user_id',
            'networks',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex('idx-networks_network_id_network_name','networks',['network_id','network_name'],true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('networks');
    }

}
