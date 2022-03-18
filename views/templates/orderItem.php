<?php

use app\models\Product;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $orderItem app\models\OrderItem */
/* @var $products Product[]  */
/* @var $form ActiveForm */
?>
<?php $form = new ActiveForm(); ?>
<?php $form->options = ['fieldConfig' => ['options' => ['class' => 'form-group m-2']]] ?>

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



