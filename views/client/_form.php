<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use nex\datepicker\DatePicker;
use pistol88\client\models\Category;
use pistol88\client\models\Mark;
use pistol88\gallery\widgets\Gallery;
use kartik\select2\Select2;
use pistol88\promocode\widgets\AddNew;

\pistol88\client\assets\BackendAsset::register($this);
?>

<div class="model-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <div class="form-group client-control">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    
    <div class="row">
        <div class="col-lg-2 col-md-4 col-xs-6">
            <?= $form->field($model, 'code')->textInput() ?>
        </div>
        <?php if($module->clientStatuses) { ?>
            <div class="col-lg-2 col-md-4 col-xs-6">
                <?= $form->field($model, 'status')
                    ->widget(Select2::classname(), [
                    'data' => $module->clientStatuses,
                    'language' => 'ru',
                    'options' => ['placeholder' => 'Выберите статус ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>
            </div>
        <?php } ?>
        <div class="col-lg-2 col-md-4 col-xs-6">
            <?= $form->field($model, 'birthday')->widget(
                DatePicker::className(), [
                    'addon' => false,
                    'size' => 'sm',
                    'language' => 'ru',
                    'clientOptions' => [
                        'format' => 'L',
                        'minDate' => '1922-01-01',
                        'maxDate' => date('Y-m-d'),
                    ],
            ]);?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-2 col-md-4 col-xs-6">
            <?= $form->field($model, 'name')->textInput() ?>
        </div>
        <div class="col-lg-2 col-md-4 col-xs-6">
            <?= $form->field($model, 'phone')->textInput() ?>
        </div>
        <div class="col-lg-2 col-md-4 col-xs-6">
            <?= $form->field($model, 'email')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-4 col-xs-6">
            <?= $form->field($model, 'category_id')
                ->widget(Select2::classname(), [
                'data' => Category::buildTextTree(),
                'language' => 'ru',
                'options' => ['placeholder' => 'Выберите категорию ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
        <div class="col-lg-2 col-md-3 col-xs-5">
            <?= $form->field($model, 'promocode')->textInput(['class' => 'place-to-new-promocode form-control']) ?>
        </div>
        <div class="col-lg-1 col-md-1 col-xs-1">
            <label>Новый</label>
            <?=AddNew::widget();?>
        </div>
    </div>

    <?= $form->field($model, 'comment')->textArea() ?>

    <?=Gallery::widget(['model' => $model]); ?>

    <br />
    
    <div class="form-group client-control">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php if(!$model->isNewRecord) { ?>
            <a class="btn btn-default" href="<?=Url::toRoute(['model/delete', 'id' => $model->id]);?>" title="Удалить" aria-label="Удалить" data-confirm="Вы уверены, что хотите удалить этот элемент?" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a>
        <?php } ?>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>
