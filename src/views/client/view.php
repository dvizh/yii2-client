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
                    ['attribute' => 'status', 'value' => @yii::$app->client->clientStatuses[$model->status]],
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
            <?php if($fieldPanel = \dvizh\field\widgets\Show::widget(['model' => $model])) { ?>
                <p><h3>Прочее</h3></p>
                <?=$fieldPanel;?>
            <?php } ?>
        </div>
    </div>

    
    <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">Обращения</h3></div>
        <div class="panel-body">
            <?=\dvizh\client\widgets\Calls::widget(['client' => $model]);?>
        </div>
    </div>

    
    <?php if(class_exists('\dvizh\service\widgets\PropertyToClient') && yii::$app->getModule('service')) { ?>
        <div class="panel panel-primary">
            <div class="panel-heading"><h3 class="panel-title">Собственность</h3></div>
            <div class="panel-body">
                <?=\dvizh\service\widgets\PropertyToClient::widget(['client' => $model]);?>
            </div>
        </div>
    <?php } ?>
    
    <?php if(class_exists('\dvizh\order\widgets\ClientOrders')) { ?>
        <div class="panel panel-primary">
            <div class="panel-heading"><h3 class="panel-title">Заказы</h3></div>
            <div class="panel-body">
                <?=\dvizh\order\widgets\ClientOrders::widget(['client' => $model]);?>
            </div>
        </div>
    <?php } ?>
    

</div>
