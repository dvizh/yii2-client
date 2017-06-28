<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = Html::encode($model->name);
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="model-update">
    <?= $this->render('_form', [
        'model' => $model,
        'module' => $module,
    ]) ?>

   <?php if(class_exists('\dvizh\service\widgets\PropertyToClient') && yii::$app->getModule('service')) { ?>
        <div class="panel panel-primary">
            <div class="panel-heading"><h3 class="panel-title">Собственность</h3></div>
            <div class="panel-body">
                <?=\dvizh\service\widgets\PropertyToClient::widget(['client' => $model]);?>
            </div>
        </div>
    <?php } ?>

    <?php if($fieldPanel = \dvizh\field\widgets\Choice::widget(['model' => $model])) { ?>
        <div class="panel panel-primary">
            <div class="panel-heading"><h3 class="panel-title">Прочее</h3></div>
            <div class="panel-body">
                <?=$fieldPanel;?>
            </div>
        </div>
    <?php } ?>
</div>
