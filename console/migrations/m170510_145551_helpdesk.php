<?php

use yii\db\Migration;

class m170510_145551_helpdesk extends Migration
{
    public function up()
    {
        $this->createTable('helpdesk',[
                'id' => $this->primaryKey(),
                'id_user' => $this->integer(),
                'commetnt' => $this->string(),
                'status' => $this->integer(),
                'date' => $this->datetime(),
                'sotrud' => $this->string(50),
                'date_end' => $this->datetime(),
            ]);
    }

    public function down()
    {
        $this->dropTable('helpdesk');
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
