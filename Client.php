<?php
namespace pistol88\client;

use yii\base\Component;
use pistol88\client\models\Client as ClientModel;
use yii;

class Client extends Component
{
    public $finder = null;
    
    public function init()
    {
        $this->finder = ClientModel::find();
        
        parent::init();
    }
    
    public function status($status)
    {
        $this->finder->andWhere(['status' => $status]);
        
        return $this;
    }

    public function all()
    {
        return $this->finder->all();
    }
    
    public function one()
    {
        return $this->finder->one();
    }
}
