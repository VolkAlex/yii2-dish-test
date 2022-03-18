<?php

namespace app\commands;

use app\models\Customer;
use app\models\OrderStatus;
use app\models\Product;
use Faker\Factory;
use yii\console\Controller;

class TestController extends Controller
{
    /**
     * generate product fixtures
     * @return void
     */
    public function actionProduct()
    {
        $faker = Factory::create();

        for($i = 0; $i < 10; $i++)
        {
            $product = new Product();
            $product->title = $faker->text(30);
            $product->description = $faker->text(rand(100, 200));
            $product->price = $faker->randomFloat(1, 1, 100);
            $product->save(false);
        }
        die('Data generation is complete!');
    }

    /**
     * generate customers
     * @return void
     */
    public function actionCustomer()
    {
        $faker = Factory::create();

        for($i = 0; $i < 10; $i++)
        {
            $customer = new Customer();
            $customer->firstname = $faker->name();
            $customer->lastname = $faker->lastName();
            $customer->email = $faker->email();
            $customer->telephone = $faker->phoneNumber();
            $customer->save(false);
        }
        die('Data generation is complete!');
    }

    /**
     * generate base order states
     * @return void
     */
    public function actionOrderStatus()
    {
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
}