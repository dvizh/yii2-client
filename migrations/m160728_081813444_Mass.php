<?php

use yii\db\Schema;
use yii\db\Migration;

class m160728_081813444_Mass extends Migration {

    public function safeUp() {
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        else {
            $tableOptions = null;
        }
        
        $connection = Yii::$app->db;

        try {
            $this->createTable('{{%client_client}}', [
                'id' => Schema::TYPE_PK . "",
                'category_id' => Schema::TYPE_INTEGER . "(11)",
                'user_id' => Schema::TYPE_INTEGER . "(10) NOT NULL",
                'name' => Schema::TYPE_STRING . "(200) NOT NULL",
				'code' => Schema::TYPE_STRING . "(200)",
                'phone' => Schema::TYPE_STRING . "(55) NULL",
                'birthday' => Schema::TYPE_STRING . "(55) NULL",
                'email' => Schema::TYPE_STRING . "(55) NULL",
                'comment' => Schema::TYPE_TEXT . " NULL",
                'sort' => Schema::TYPE_INTEGER . "(11)",
                'promocode' => Schema::TYPE_TEXT . "(55)",
                'status' => Schema::TYPE_STRING . "(55)",
				'updated_at' => Schema::TYPE_TIMESTAMP,
				'created_at' => Schema::TYPE_TIMESTAMP,
                ], $tableOptions);

            $this->createIndex('category_id', '{{%client_client}}', 'category_id', 0);
            $this->createTable('{{%client_category}}', [
                'id' => Schema::TYPE_PK . "",
                'parent_id' => Schema::TYPE_INTEGER . "(11)",
                'name' => Schema::TYPE_STRING . "(55) NOT NULL",
                'text' => Schema::TYPE_TEXT . "",
                'sort' => Schema::TYPE_INTEGER . "(11)",
                ], $tableOptions);

            $this->createIndex('id', '{{%client_category}}', 'id,parent_id', 0);
            $this->createIndex('status', '{{%client_client}}', 'status', 0);
            
            $this->addForeignKey(
                'fk_category_id', '{{%client_client}}', 'category_id', '{{%client_category}}', 'id', 'CASCADE', 'CASCADE'
            );
        } catch (Exception $e) {
            echo 'Catch Exception ' . $e->getMessage() . ' ';
        }
    }

    public function safeDown() {
        $connection = Yii::$app->db;
        try {
            $this->dropTable('{{%client_client}}');
            $this->dropTable('{{%client_category}}');
        } catch (Exception $e) {
            echo 'Catch Exception ' . $e->getMessage() . ' ';
        }
    }

}
