<?php
namespace pistol88\client\widgets;

use yii\helpers\Html;
use pistol88\client\models\Call;
use pistol88\client\models\call\CallSearch;
use yii;

class Calls extends \yii\base\Widget
{
    public $client = null;
    
    public function init()
    {
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
