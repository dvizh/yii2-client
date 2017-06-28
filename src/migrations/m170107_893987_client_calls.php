<?php
use yii\db\Migration;
use yii\db\Schema;

class m170107_893987_client_calls extends Migration
{
    public function safeUp() {
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        else {
            $tableOptions = null;
        }

        $connection = Yii::$app->db;

        try {
            $this->createTable('{{%client_call}}', [
                'id' => Schema::TYPE_PK . "",
                'type' => Schema::TYPE_STRING . "(55) NULL",
                'category_id' => Schema::TYPE_INTEGER . "(11)",
                'client_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
                'staffer_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
                'time' => Schema::TYPE_DATE,
                'status' => Schema::TYPE_STRING . "(55) NULL",
                'matter' => Schema::TYPE_STRING . "(55) NULL",
				'result' => Schema::TYPE_STRING . "(55) NULL",
                'comment' => Schema::TYPE_STRING . "(1000) NULL",
				'updated_at' => Schema::TYPE_TIMESTAMP,
				'created_at' => Schema::TYPE_TIMESTAMP,
                ], $tableOptions);

            $this->createTable('{{%client_call_category}}', [
                'id' => Schema::TYPE_PK . "",
                'parent_id' => Schema::TYPE_INTEGER . "(11)",
                'name' => Schema::TYPE_STRING . "(55) NOT NULL",
                'sort' => Schema::TYPE_INTEGER . "(11)",
                ], $tableOptions);

            $this->createIndex('id', '{{%client_call_category}}', 'id,parent_id', 0);
            $this->createIndex('status', '{{%client_call}}', 'status', 0);
            $this->createIndex('matter', '{{%client_call}}', 'matter', 0);
            $this->createIndex('result', '{{%client_call}}', 'result', 0);

            $this->addForeignKey(
                'fk_category_id', '{{%client_call}}', 'category_id', '{{%client_call_category}}', 'id', 'CASCADE', 'CASCADE'
            );
        } catch (Exception $e) {
            echo 'Catch Exception ' . $e->getMessage() . ' ';
        }
    }

    public function safeDown() {
        $connection = Yii::$app->db;

        try {
            $this->dropTable('{{%client_call}}');
            $this->dropTable('{{%client_call_category}}');
        } catch (Exception $e) {
            echo 'Catch Exception ' . $e->getMessage() . ' ';
        }
    }
}
