<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;

$this->title = Html::encode($model->name);
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Просмотр';
?>
<div class="client-view">
    <p><a href="<?=Url::toRoute(['update', 'id' => $model->id]);?>" class="btn btn-success">Редактировать</a></p>
    
    <?=DetailView::widget([
        'model' => $model,
        'attributes' => [
            'code',
            'category.name',
            'name',
            'birthday',
            'email:email',
            'phone',
            'promocode',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]);?>
    
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
