<?php

use app\models\Product;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $orderItem app\models\OrderItem */
/* @var $product app\models\Product */
/* @var $products Product[]  */
/* @var $form ActiveForm */
?>
<div class="Order">

    <?php
        $form = ActiveForm::begin([
            'action' => ['site/order'],
            'method' => 'post',
            'fieldConfig' => ['options' => ['class' => 'form-group m-2']]
        ]);
    ?>

        <div class="form-group order-items">
            <div class="row">
                <?php echo $form->field($orderItem, 'product_id[]')
                    ->dropDownList(
                        ArrayHelper::map($products, 'id', 'title'),
                        [
                            'prompt'=>'Select product',
                            'class' => 'form-control',
                        ]
                    );
                ?>

                <?= $form->field($orderItem, 'count[]') ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::button('Add more item', ['class' => 'btn btn-primary add-order-item']) ?>
        </div>


        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
