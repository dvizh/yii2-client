<?php
namespace pistol88\client;

use yii\base\Component;
use pistol88\client\models\Client as ClientModel;
use yii;

class Client extends Component
{
    public $clientStatuses = [
        'cold' => 'Холодный',
        'potencial' => 'Потенциальный',
        'warm' => 'Теплый',
        'hot' => 'Горячий',
        'active' => 'Обычный',
        'dismissed' => 'Постоянный',
        'missing' => 'Пропавший'
    ];
    
    public $callResults = [
        'cold' => 'Негатив',
        'warm' => 'Положительно',
        'hot' => 'Нейтрально',
        'our' => 'Недозвон',
        'call_later' => 'Перезвонить позже',
        'sosi' => 'Неадекват',
    ];
    
    public $callStatuses = [
        'neitral' => 'Нейтрально',
        'bad' => 'Плохо',
        'good' => 'Хорошо',
    ];
    
    public $callMatters = [
        'rework' => 'Сайт',
        'task' => 'Продвижение',
    ];
    
    public $finder = null;
    
    public $clientProfileUrl = '/client/client/view';
    
    public $stafferProfileUrl = '/staffer/staffer/view';
    
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
