<?php
namespace pistol88\client\controllers;

use yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use pistol88\client\models\Client;
use yii\filters\VerbFilter;

class ToolsController  extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => $this->module->adminRoles,
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'get-clients-by-name' => ['post'],
                ],
            ],
        ];
    }
    
    public function actionGetClientsByName()
    {
        $return = ['result' => 'success', 'elements' => []];
        $str = yii::$app->request->post('str');
        $clients = Client::find()->andFilterWhere(['LIKE', 'name', $str])->limit(50)->all();
        
        foreach($clients as $client) {
            if($client->category) {
                $categoryName = $client->category->name;
            } else {
                $categoryName = '';
            }
            
            $return['elements'][$client->id] = [
                'name' => $client->name,
                'category' => $categoryName,
                'id' => $client->id,
            ];
        }
        
        return json_encode($return);
    }
}
