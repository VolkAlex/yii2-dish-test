<?php

use app\models\Customer;
use app\models\OrderStatus;
use app\models\Product;
use Faker\Factory;
use yii\db\Migration;

/**
 * Class m220318_174249_addBaseData
 */
class m220318_174249_addBaseData extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $faker = Factory::create();

        //sample products
        for($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->title = $faker->text(30);
            $product->description = $faker->text(rand(100, 200));
            $product->price = $faker->randomFloat(1, 1, 100);
            $product->save(false);
        }

        //sample customers
        for($i = 0; $i < 10; $i++) {
            $customer = new Customer();
            $customer->firstname = $faker->name();
            $customer->lastname = $faker->lastName();
            $customer->email = $faker->email();
            $customer->telephone = $faker->phoneNumber();
            $customer->save(false);
        }

        //order status
        $fixtures = [
            [
                'id' => 1,
                'title' => 'placed'
            ],
            [
                'id' => 2,
                'title' => 'in progress'
            ],
            [
                'id' => 3,
                'title' => 'complete'
            ]
        ];

        foreach ($fixtures as $fixture) {
            $orderStatus = new OrderStatus();
            $orderStatus->setAttributes($fixture);
            $orderStatus->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220318_174249_addBaseData cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220318_174249_addBaseData cannot be reverted.\n";

        return false;
    }
    */
}
