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
                'label' => 'Категории клиентов',
                'url' => ['/client/category/index'],
            ],
            [
                'label' => 'Обращения',
                'url' => ['/client/call/index'],
            ],
            [
                'label' => 'Категории обращений',
                'url' => ['/client/call-category/index'],
            ],
        ],
        'options' => ['class' =>'nav-pills'],
    ]); ?>
</div>