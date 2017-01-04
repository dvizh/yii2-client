<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

$this->title = Html::encode($model->name);
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Просмотр';
?>
<div class="client-view">
    <h1><?=$this->title;?></h1>

    <p><a href="<?=Url::toRoute(['update', 'id' => $model->id]);?>" class="btn btn-success">Редактировать</a></p>
    
    <div class="row">
        <div class="col-md-6">
            <p><h3>Клиент</h3></p>
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
        </div>
        <div class="col-md-6">
            <h3>Обращения</h3>
            <?=\pistol88\client\widgets\Calls::widget(['client' => $model]);?>
        </div>
    </div>


    
    <?php if(class_exists('\pistol88\service\widgets\PropertyToClient') && yii::$app->getModule('service')) { ?>
        <div class="panel panel-primary">
            <div class="panel-heading"><h3 class="panel-title">Собственность</h3></div>
            <div class="panel-body">
                <?=\pistol88\service\widgets\PropertyToClient::widget(['client' => $model]);?>
            </div>
        </div>
    <?php } ?>
    
    <?php if(class_exists('\pistol88\order\widgets\ClientOrders')) { ?>
        <div class="panel panel-primary">
            <div class="panel-heading"><h3 class="panel-title">Заказы</h3></div>
            <div class="panel-body">
                <?=\pistol88\order\widgets\ClientOrders::widget(['client' => $model]);?>
            </div>
        </div>
    <?php } ?>
    
    <?php if($fieldPanel = \pistol88\field\widgets\Show::widget(['model' => $model])) { ?>
        <div class="panel panel-primary">
            <div class="panel-heading"><h3 class="panel-title">Прочее</h3></div>
            <div class="panel-body">
                <?=$fieldPanel;?>
            </div>
        </div>
    <?php } ?>
</div>
