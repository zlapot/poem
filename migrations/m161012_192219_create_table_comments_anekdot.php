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
            'utime' => $this->integer()->notNull(),
        ]);
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
