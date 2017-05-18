<?php

use yii\db\Migration;

class m170510_145644_todoist extends Migration
{
    public function up()
    {
        $this->createTable('todoist',[
                'id' => $this->primaryKey(),
                'date' => $this->timestamp(),
                'srok' => $this->date(),
                'id_zakaz' => $this->integer(),
                'id_user' => $this->integer(),
                'status' => $this->integer(),
                'type' => $this->integer(),
                'comment' => $this->string(),
                'activate' => $this->integer(),
            ]);
    }

    public function down()
    {
        $this->dropTable('todoist');
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
