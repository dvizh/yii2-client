<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use pistol88\client\models\Client;
use pistol88\client\models\CallCategory;
use kartik\select2\Select2;
?>
<div class="call-to-client-widget">
    
    <?php Modal::begin([
        'header' => '<h2>Добавить</h2>',
        'toggleButton' => ['class' => 'btn btn-success', 'label' => 'Добавить'],
    ]);
    ?>

    <?php $form = ActiveForm::begin(['action' => ['/client/call/ajax-create'], 'options' => ['enctype' => 'multipart/form-data']]); ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'status')->label(false)->dropDownList(['value' => $client->id, 'type' => 'hidden']) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'matter_id')->label(false)->dropDownList(['value' => $client->id, 'type' => 'hidden']) ?>
            </div>
        </div>

        <?= $form->field($model, 'client_id')->label(false)->textInput(['value' => $client->id, 'type' => 'hidden']) ?>

        <div class="form-group client-control">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>
    
    <?php Modal::end(); ?>
    
    <?php Pjax::begin(); ?>

    <a href="" class="client-property-update"> </a>

    <?php
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'columns' => [
            //['attribute' => 'id', 'filter' => false, 'options' => ['style' => 'width: 55px;']],
            'time',
            ['attribute' => 'client.name', 'label' => 'Клиент'],
            ['attribute' => 'staffer.name', 'label' => 'Сотрудник'],
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
                    $module->callStatuses,
                    ['class' => 'form-control', 'prompt' => 'Статус']
                ),
                'content' => function($model) use ($module) {
                    return @$module->callStatuses[$model->status];
                }
            ],
            //['class' => 'yii\grid\ActionColumn', 'controller' => '/client/property', 'template' => '{view} {update} {delete}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 155px;']],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>