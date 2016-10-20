<?php

use yii\db\Migration;

class m161016_152248_create_table_user extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(40)->notNull(),
            'email' => $this->string(100)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'status' => $this->integer(3)->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'secret_key' => $this->string(),
            'service' => $this->string(),
            'service_id' => $this->string(),
            'role' => $this->integer(2),
            'img' => $this->string(20),
        ]);
    }

    public function down()
    {
        $this->dropTable('user');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
