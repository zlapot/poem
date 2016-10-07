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
            'utime' => $this->integer()->notNull(),
            'censor' => $this->integer()->notNull(),
        ]);
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
