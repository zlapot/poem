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
            'utime' => $this->integer()->notNull(),
            'censor' => $this->integer()->notNull(),
        ]);
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
