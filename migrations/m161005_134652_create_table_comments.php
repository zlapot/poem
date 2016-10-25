<?php

use yii\db\Migration;

class m161005_134652_create_table_comments extends Migration
{
    public function up()
    {
        $this->createTable('comments_poem', [
            'id' => $this->primaryKey(),
            'id_poem' => $this->integer()->notNull(),
            'id_user' => $this->integer()->notNull(),
            'comment' => $this->string(100)->notNull(),
            'date' => $this->string(16)->notNull(),
            'created_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk-com_poem_id_user-user_id', 'comments_poem', 'id_user', 'user', 'id');
        $this->addForeignKey('fk-com_poem_id_poem-poem_id', 'comments_poem', 'id_poem', 'poems', 'id');
    }

    public function down()
    {
        $this->dropTable('comments_poem');
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
