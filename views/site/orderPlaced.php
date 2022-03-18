<?php

use yii\helpers\Url;

$this->title = 'Success!';
$this->params['breadcrumbs'][] = $this->title;

/* @var $orderItems array */
/* @var $totalPrice array */

?>

<h1>Success!</h1>

<h2>Your order:</h2>

<table class="table text-center">
    <thead>
    <tr>
        <td>Number</td>
        <td>Name</td>
        <td>Count</td>
        <td>Price</td>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($orderItems as $num => $item): ?>
        <tr>
            <td><?= ($num + 1) ?></td>
            <td><?= $item['title'] ?></td>
            <td><?= $item['count'] ?></td>
            <td><?= $item['price'] ?></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="4">Total price: <?= $totalPrice ?></td>
    </tr>
    </tbody>
</table>

<div class="jumbotron text-center bg-transparent">
    <p><a class="btn btn-lg btn-success" href="<?=Url::to('order')?>">New order</a></p>
</div>

