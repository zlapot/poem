<?php

use yii\db\Migration;

class m161012_192219_create_table_comments_anekdot extends Migration
{
    public function up()
    {
        $this->createTable('comments_anekdot', [
            'id' => $this->primaryKey(),
            'id_poem' => $this->integer()->notNull(),
            'id_user' => $this->integer()->notNull(),
            'comment' => $this->string(100)->notNull(),
            'date' => $this->string(16)->notNull(),
            'created_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk-com_anek_id_user-user_id', 'comments_anekdot', 'id_user', 'user', 'id');
        $this->addForeignKey('fk-com_anek_id_poem-anek_id', 'comments_anekdot', 'id_poem', 'anekdots', 'id');
    }

    public function down()
    {
        $this->dropTable('comments_anekdot');
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
