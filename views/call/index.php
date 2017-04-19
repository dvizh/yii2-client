<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use pistol88\client\models\Category;
use pistol88\client\models\CallCategory;

$this->title = 'Клиенты';
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['/client/default/index']];
$this->params['breadcrumbs'][] = $this->title;

\pistol88\client\assets\BackendAsset::register($this);

?>
<div class="model-index">

    <div class="row">
        <div class="col-md-2">
            
        </div>
        <div class="col-md-10">

        </div>
    </div>
    
    <?php
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'columns' => [
            //['attribute' => 'id', 'filter' => false, 'options' => ['style' => 'width: 55px;']],
            ['attribute' => 'time', 'label' => 'Время', 'content' => function($model) {
                return date('d.m.Y H:i:s', strtotime($model->time));
            }],
            [
                'attribute' => 'type',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'type',
                    ['in' => 'Входящий', 'out' => 'Исходящий'],
                    ['class' => 'form-control', 'prompt' => 'Тип']
                ),
                'content' => function($model) {
                    $types = ['in' => 'Входящий', 'out' => 'Исходящий'];
                    return $types[$model->type];
                }
            ],
            ['attribute' => 'client.name', 'label' => 'Клиент', 'content' => function($model) {
                if($model->client) {
                    return Html::a($model->client->name, [yii::$app->client->clientProfileUrl, 'id' => $model->client_id]);
                }
            }],
            ['attribute' => 'staffer.name', 'label' => 'Сотрудник', 'content' => function($model) {
                if($model->staffer) {
                    return Html::a($model->staffer->name, [yii::$app->client->stafferProfileUrl, 'id' => $model->staffer_id]);
                }
            }],
            [
                'attribute' => 'matter',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'matter',
                    yii::$app->client->callMatters,
                    ['class' => 'form-control', 'prompt' => 'Предмет']
                ),
                'content' => function($model) {
                    return @yii::$app->client->callMatters[$model->matter];
                }
            ],
            [
                'attribute' => 'result',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'result',
                    yii::$app->client->callResults,
                    ['class' => 'form-control', 'prompt' => 'Результат']
                ),
                'content' => function($model) {
                    return @yii::$app->client->callResults[$model->result];
                }
            ],
            [
                'attribute' => 'category_id',
                'label' => 'Категория',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'category_id',
                    CallCategory::buildTextTree(),
                    ['class' => 'form-control', 'prompt' => 'Категория']
                ),
                'value' => 'category.name'
            ],
            [
                'attribute' => 'status',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'status',
                    yii::$app->client->clientStatuses,
                    ['class' => 'form-control', 'prompt' => 'Статус']
                ),
                'content' => function($model) {
                    return @yii::$app->client->clientStatuses[$model->status];
                }
            ],
            ['class' => 'yii\grid\ActionColumn', 'controller' => '/client/call', 'template' => '{delete}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 155px;']],
        ],
    ]); ?>

</div>
