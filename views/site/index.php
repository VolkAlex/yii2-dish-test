<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'Welcome!';
?>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent">
        <p><a class="btn btn-lg btn-success" href="<?=Url::to('order')?>">Go to order</a></p>
    </div>
</div>
