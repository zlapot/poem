<?php

use yii\db\Migration;

class m161007_154306_create_table_anekdot extends Migration
{
    public function up()
    {
        $this->createTable('anekdots', [
            'id' => $this->primaryKey(),            
            'id_user' => $this->integer()->notNull(),            
            'anekdot' => $this->text()->notNull(),
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

        $this->addForeignKey('fk-anekdot_id_user-user_id', 'anekdots', 'id_user', 'user', 'id');
    }

    public function down()
    {
       $this->dropTable('anekdots');
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
