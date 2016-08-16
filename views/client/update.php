<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = Html::encode($model->name);
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="model-update">
    <?= $this->render('_form', [
        'model' => $model,
        'module' => $module,
    ]) ?>
    
    <?php if(class_exists('\pistol88\order\widgets\ClientOrders')) { ?>
        <div class="block">
            <h2>Заказы</h2>
            <?=\pistol88\order\widgets\ClientOrders::widget(['client' => $model]);?>
        </div>
    <?php } ?>
    
    <?php if($fieldPanel = \pistol88\field\widgets\Choice::widget(['model' => $model])) { ?>
        <div class="block">
            <h2>Прочее</h2>
            <?=$fieldPanel;?>
        </div>
    <?php } ?>
</div>
