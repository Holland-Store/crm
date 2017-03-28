<?php

use yii\db\Migration;

class m170327_071607_zakaz extends Migration
{
    public function up()
    {
        $this->createTable('zakaz',[
                'id_zakaz' => $this->primaryKey(),
                'srok' => $this->data(),
                'minut' => $this->time(),
                'id_sotrud' => $this->integer(),
                'prioritet' => $this->string(36),
                'status' => $this->integer(),
                'action' => $this->integer(),
                'id_tovar' => $this->integer(),
                'oplata' => $this->integer(),
                'fast_oplata' => $this->integer(),
                'number' => $this->integer(),
                'data' => $this->data(),
                'description' => $this->string(100),
                'information' => $this->string(500),
                'img' => $this->string(50),
                'name' => $this->string(50),
                'phone' => $this->integer(11),
                'email' => $this->string(50),
                'comment' => $this->$text(),
            ]);

        $this->addForeignKey('zakaz_ibfk_2', 'zakaz', 'id_var', 'tovar', 'id', 'CASCADE');
        $this->addForeignKey('zakaz_ibfk_4', 'zakaz', 'id_sotrud', 'user', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('zakaz');
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
