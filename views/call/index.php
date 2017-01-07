<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use pistol88\client\models\Category;

$this->title = 'Клиенты';
$this->params['breadcrumbs'][] = $this->title;

\pistol88\client\assets\BackendAsset::register($this);

?>
<div class="model-index">

    <div class="row">
        <div class="col-md-2">
            
        </div>
        <div class="col-md-10">
            <?=$this->render('../parts/menu');?>
        </div>
    </div>
    
    <?php
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'columns' => [
            /*
            [
                'attribute' => 'image',
                'filter' => false,
                'content' => function ($image) {
                    if($image->image && $image = $image->image->getUrl('100x100')) {
                        return "<img src=\"{$image}\" class=\"thumb\" />";
                    }
                }
            ],
             * */
            ['attribute' => 'id', 'filter' => false, 'options' => ['style' => 'width: 55px;']],
            [
                'attribute' => 'client_id',
                'content' => function($model) use ($module) {
                    return $model->client->name;
                }
            ],
            [
                'attribute' => 'staffer_id',
                'content' => function($model) use ($module) {
                    return $model->staffer->name;
                }
            ],
            'time',
            'status',
            [
                'attribute' => 'matter',
                'filter' => function($model) {
                    return yii::$app->client->callMatters;
                },
                'content' => function($model) use ($module) {
                    return @yii::$app->client->callMatters[$model->matter];
                }
            ],
            [
                'attribute' => 'category_id',
                'filter' => function($model) {
                    return ArrayHelper::map(CallCategory::findAll([]), 'id', 'name');
                },
                'content' => function($model) use ($module) {
                    return $model->category->name;
                }
            ],
            [
                'attribute' => 'result',
                'filter' => function($model) {
                    return yii::$app->client->callResults;
                },
                'content' => function($model) use ($module) {
                    return @yii::$app->client->callResults[$model->result];
                }
            ],
            'comment',
            'created_at',
        ],
    ]); ?>

</div>
