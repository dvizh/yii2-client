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

    <?php $form = ActiveForm::begin(['action' => ['/client/call/ajax-create'], 'options' => ['id' => 'call-widget-add-form', 'enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'status')->label(false)->textInput(['value' => $client->id, 'type' => 'hidden']) ?>
    
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(CallCategory::find()->all(), 'id', 'name')) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'status')->dropDownList(yii::$app->client->clientStatuses, ['prompt' => 'Не менять статус...']); ?>
            </div>
        </div>
    
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'result')->dropDownList(yii::$app->client->callResults) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'matter')->dropDownList(yii::$app->client->callMatters) ?>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'comment')->textArea() ?>
            </div>
        </div>

        <?= $form->field($model, 'client_id')->label(false)->textInput(['value' => $client->id, 'type' => 'hidden']) ?>

        <div class="form-group client-control">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>
    
    <?php Modal::end(); ?>
    
    <?php Pjax::begin(); ?>

    <a href="" class="client-calls-update"> </a>

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
    <?php Pjax::end(); ?>
</div>