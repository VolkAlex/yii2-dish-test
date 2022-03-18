<?php

use yii\db\Migration;

/**
 * Class m220318_102322_createForeignKeys
 */
class m220318_102322_createForeignKeys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'order_state_id',
            'order',
            'state_id',
            'order_status',
            'id'
        );

        $this->addForeignKey(
            'order_customer_id',
            'order',
            'customer_id',
            'customer',
            'id'
        );

        $this->addForeignKey(
            'order_item_order_id',
            'order_item',
            'order_id',
            'order',
            'id'
        );

        $this->addForeignKey(
            'order_item_product_id',
            'order_item',
            'product_id',
            'product',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220318_102322_createForeignKeys cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220318_102322_createForeignKeys cannot be reverted.\n";

        return false;
    }
    */
}
