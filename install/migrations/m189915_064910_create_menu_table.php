<?php

use yii\db\Schema;
use yii\db\Migration;

class m189915_064910_create_menu_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions =
                'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('menu', array(
            'id' => $this->primaryKey(),
            'language' => $this->string(),
            'title' => $this->string()->notNull(),
            'type' => $this->string()->notNull(),
            'route' => $this->string(),
            'params' => $this->string(),
            'url' => $this->text(),
            'tree' => $this->integer()->notNull(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
            'createdAt' => $this->integer(),
            'updatedAt' => $this->integer(),
        ), $tableOptions);

        $this->createIndex('tree', 'menu', 'tree');
        $this->createIndex('left', 'menu', 'lft');
        $this->createIndex('right', 'menu', 'rgt');
    }

    public function safeDown()
    {
        $this->dropTable('menu');
    }
}
