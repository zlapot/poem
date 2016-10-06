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
            'date' => $this->integer()->notNull(),
            'censor' => $this->integer()->notNull(),
        ]);

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
