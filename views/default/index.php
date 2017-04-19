<?php
use yii\helpers\Url;

$this->title = 'Клиенты';
$this->params['breadcrumbs'][] = $this->title;

\pistol88\client\assets\BackendAsset::register($this);

?>
<div class="model-index">
    <table class="table">
        <tr>
            <th>Клиенты</th>
            <td>
                <a href="<?=Url::toRoute(['/client/client/index']);?>" class="btn btn-default"><i class="glyphicon glyphicon-eye-open" /></i></a>
                <a href="<?=Url::toRoute(['/client/client/create']);?>" class="btn btn-default"><i class="glyphicon glyphicon-plus" /></i></a>
            </td>
        </tr>
        <tr>
            <th>Категории клиентов</th>
            <td>
                <a href="<?=Url::toRoute(['/client/category/index']);?>" class="btn btn-default"><i class="glyphicon glyphicon-eye-open" /></i></a>
                <a href="<?=Url::toRoute(['/client/category/create']);?>" class="btn btn-default"><i class="glyphicon glyphicon-plus" /></i></a>
            </td>
        </tr>
        <tr>
            <th>Обращения клиентов</th>
            <th>
                <a href="<?=Url::toRoute(['/client/call/index']);?>" class="btn btn-default"><i class="glyphicon glyphicon-eye-open" /></i></a>
            </th>
        </tr>
        <tr>
            <th>Категории обращений</th>
            <td>
                <a href="<?=Url::toRoute(['/client/call-category/index']);?>" class="btn btn-default"><i class="glyphicon glyphicon-eye-open" /></i></a>
                <a href="<?=Url::toRoute(['/client/call-category/create']);?>" class="btn btn-default"><i class="glyphicon glyphicon-plus" /></i></a>
            </td>
        </tr>
    </table>
</div>
