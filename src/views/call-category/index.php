<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use dvizh\client\models\CallCategory;

$this->title = 'Категории';
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['/client/default/index']];
$this->params['breadcrumbs'][] = $this->title;

\dvizh\client\assets\BackendAsset::register($this);
?>
<div class="category-index">
    
    <div class="row">
        <div class="col-md-2">
            <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="col-md-10">

        </div>
    </div>

    <br style="clear: both;"></div>

    <?=\kartik\grid\GridView::widget([
            'export' => false,
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'filter' => false, 'options' => ['style' => 'width: 55px;']],
                'name',
                [
                    'attribute' => 'parent_id',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'parent_id',
                        CallCategory::buildTextTree(),
                        ['class' => 'form-control', 'prompt' => 'Категория']
                    ),
                    'value' => 'parent.name'
                ],
                ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}']
            ],
        ]); ?>

</div>
