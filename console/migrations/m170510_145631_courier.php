<?php

use yii\db\Migration;

class m170510_145631_courier extends Migration
{
    public function up()
    {
        $this->createTable('courier',[
                'id' => $this->primaryKey(),
                'id_user' => $this->integer(),
                'to' => $this->string(50),
                'date_to' => $this->datetime(),
                'from' => $this->string(50),
                'status' => $this->integer(),
                'commit' => $this->string(),
            ]);
    }

    public function down()
    {
        $this->dropTable('courier');
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
