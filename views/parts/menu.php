<?php
use yii\bootstrap\Nav;
?>
<div class="menu-container">
    <?= Nav::widget([
        'items' => [
            [
                'label' => 'Клиенты',
                'url' => ['/client/client/index'],
            ],
            [
                'label' => 'Категории',
                'url' => ['/client/category/index'],
            ],
        ],
        'options' => ['class' =>'nav-pills'],
    ]); ?>
</div>