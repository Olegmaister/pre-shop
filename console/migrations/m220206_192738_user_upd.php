<?php

use yii\db\Migration;

/**
 * Class m220206_192738_user_upd
 */
class m220206_192738_user_upd extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('user','username',$this->string()->unique()->null());
        $this->alterColumn('user','password_hash',$this->string()->null());
        $this->alterColumn('user','auth_key',$this->string(32)->null());
        $this->alterColumn('user','email',$this->string()->null()->unique());
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('user','password_hash',$this->string()->notNull());
        $this->alterColumn('user','password_hash',$this->string()->notNull());
        $this->alterColumn('user','auth_key',$this->string(32)->notNull());
        $this->alterColumn('user','email',$this->string()->notNull()->unique());
    }
}


//'id' => $this->primaryKey(),
//            'username' => $this->string()->notNull()->unique(),
//            'auth_key' => $this->string(32)->notNull(),
//            'password_hash' => $this->string()->notNull(),
//            'password_reset_token' => $this->string()->unique(),
//            'email' => $this->string()->notNull()->unique(),