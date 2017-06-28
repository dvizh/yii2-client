<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use dvizh\client\models\Category;

$this->title = 'Клиенты';
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['/client/default/index']];
$this->params['breadcrumbs'][] = $this->title;

\dvizh\client\assets\BackendAsset::register($this);

if(yii::$app->has('organization')) {
    $organizations = yii::$app->organization->getList();
    $organizations = ArrayHelper::map($organizations, 'id', 'name');
} else {
    $organizations = [];
}
?>
<div class="model-index">

    <div class="row">
        <div class="col-md-2">
            <?= Html::a('Добавить клиента', ['create'], ['class' => 'btn btn-success']) ?>
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
            'name',
            'code',
            [
                'attribute' => 'organization_id',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'organization_id',
                    $organizations,
                    ['class' => 'form-control', 'prompt' => 'Организация']
                ),
                'content' => function($model) use ($organizations) {
                    foreach($organizations as $id => $name) {
                        if($id == $model->organization_id) {
                            return $name;
                        }
                    }
                    
                    return '';
                }
            ],
            'phone',
            'promocode',
            [
                'attribute' => 'status',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'status',
                    yii::$app->client->clientStatuses,
                    ['class' => 'form-control', 'prompt' => 'Статус']
                ),
                'content' => function($model) use ($module) {
                    return @yii::$app->client->clientStatuses[$model->status];
                }
            ],
            [
                'attribute' => 'category_id',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'category_id',
                    Category::buildTextTree(),
                    ['class' => 'form-control', 'prompt' => 'Категория']
                ),
                'value' => 'category.name'
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 155px;']],
        ],
    ]); ?>

</div>
