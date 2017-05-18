<?php

use yii\db\Migration;

class m170327_071731_tovar extends Migration
{
    public function up()
    {
        $this->createTable('tovar',[
                'id' => $this->primaryKey(),
                'name' => $this->string(50)->notNull(),
            ]);
    }

    public function down()
    {
        $this->dropTable('tovar');
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
