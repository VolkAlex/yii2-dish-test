<?php

namespace app\helpers;

use app\models\OrderItem;
use app\models\Product;
use Exception;
use yii\helpers\ArrayHelper;

class Order extends ArrayHelper
{
    /**
     * @param array $request
     * @return array
     * @throws Exception
     */
    static function parseFormRequest(array $request)
    {
        $resultItems = [];
        if (isset($request['OrderItem'])) {
            $orderItems = $request['OrderItem'];

            foreach ($orderItems['product_id'] as $itemNum => $value) {
                $resultItems[$itemNum]['product_id'] = $value;
            }

            foreach ($orderItems['count'] as $itemNum => $value) {
                $resultItems[$itemNum]['count'] = $value;
            }

            return $resultItems;
        }
        throw new Exception("Bad order request");
    }

    /**
     * @param array $orderItems
     * @return array
     */
    static function addProductAttributesToOrderItem(array $orderItems)
    {
        $product = new Product();
        foreach ($orderItems as $num => $item) {
            $productAttributes = $product::findOne(['id'=> $item['product_id']])->getAttributes(['price', 'title']);
            $orderItems[$num]['price'] = $productAttributes['price'] * $item['count'];
            $orderItems[$num]['title'] = $productAttributes['title'];
        }

        return $orderItems;
    }

    /**
     * @param array $itemsWithPrice
     * @return float|int
     */
    static function getTotalPrice(array $itemsWithPrice)
    {
        return array_sum(array_column($itemsWithPrice, 'price'));
    }
}