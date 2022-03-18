<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m220318_100005_createBaseTables
 */
class m220318_100005_createBaseTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('customer', [
            'id' => $this->primaryKey(),
            'firstname' => $this->text()->notNull(),
            'lastname' => $this->text(),
            'email' => $this->text()->notNull(),
            'telephone' => $this->text()
        ], 'ENGINE=InnoDB');

        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer()->notNull(),
            'state_id' => $this->smallInteger()->notNull()
        ], 'ENGINE=InnoDB');

        $this->createTable('order_status', [
            'id' => $this->smallInteger()->unique(),
            'title' => $this->text()->notNull(),
        ], 'ENGINE=InnoDB');

        $this->createTable('order_item', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'count' => $this->smallInteger()->notNull(),
        ],'ENGINE=InnoDB');

        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'title' => $this->text()->notNull(),
            'price' => $this->float()->notNull(),
            'description' => $this->text()->notNull(),
            'image_url' => $this->text(),
        ], 'ENGINE=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220318_100005_createBaseTables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220318_100005_createBaseTables cannot be reverted.\n";

        return false;
    }
    */
}
