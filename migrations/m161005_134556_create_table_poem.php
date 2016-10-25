<?php

use yii\db\Migration;

class m161005_134556_create_table_poem extends Migration
{
    public function up()
    {
        $this->createTable('poems', [
            'id' => $this->primaryKey(),            
            'id_user' => $this->integer()->notNull(),
            'title' => $this->string(100)->notNull(),
            'poem' => $this->text()->notNull(),
            'autor' => $this->string(100)->notNull(),
            'date' => $this->string(16)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'isDelete' => $this=>boolean()->notNull(),
            'status' => $this=>boolean()->notNull(),
            'censor' => $this=>boolean()->notNull(),
        ]);

        $this->addForeignKey('fk-poem_id_user-user_id', 'poems', 'id_user', 'user', 'id');
    }

    public function down()
    {
        $this->dropTable('poems');
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
