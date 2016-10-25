<?php

use yii\db\Migration;

class m161007_154326_create_table_hokky extends Migration
{
    public function up()
    {
        $this->createTable('hokkys', [
            'id' => $this->primaryKey(),            
            'id_user' => $this->integer()->notNull(),
            'title' => $this->string(20),
            'hokky' => $this->text()->notNull(),
            'autor' => $this->string(100)->notNull(),
            'date' => $this->string(16)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'isDelete' => $this=>boolean()->notNull(),
            'status' => $this=>boolean()->notNull(),
            'censor' => $this=>boolean()->notNull(),
        ]);

        $this->addForeignKey('fk-hokky_id_user-user_id', 'hokkys', 'id_user', 'user', 'id');
    }

    public function down()
    {
        $this->dropTable('hokkys');
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
