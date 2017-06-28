<?php
namespace dvizh\client\widgets;

use yii\helpers\Html;
use dvizh\client\models\Call;
use dvizh\client\models\call\CallSearch;
use yii;

class Calls extends \yii\base\Widget
{
    public $client = null;
    
    public function init()
    {
        \dvizh\client\assets\CallWidgetAsset::register($this->getView());
        
        return parent::init();
    }

    public function run()
    {
        $searchModel = new CallSearch();
        
        $params = Yii::$app->request->queryParams;
        
        if($this->client->id && empty($params['CallSearch'])) {
            $params['CallSearch']['client_id'] = $this->client->id;
        }
        
        $dataProvider = $searchModel->search($params);

        $model = new Call;
        
        return $this->render('calls', [
            'model' => $model,
            'module' => yii::$app->getModule('client'),
            'client' => $this->client,
            'clientId' => (int)$this->client->id,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
