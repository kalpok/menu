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
            'route' => $this->string(),
            'params' => $this->string(),
            'url' => $this->text(),
            'type' => $this->string()->notNull()->comment('either root, module or link.'),
            'origin' => $this->string()->comment("module name if it is from one."),
            'openInNewTab' => $this->boolean()->notNull()->defaultValue(0),
            'isActive' => $this->boolean()->notNull()->defaultValue(1),
            'tree' => $this->integer(),
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
