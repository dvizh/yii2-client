<?php
namespace dvizh\client;

use yii\base\Component;
use dvizh\client\models\Client as ClientModel;
use yii;

class Client extends Component
{
    public $clientStatuses = [
        'client' => 'Наш клиент',
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
        'question' => 'Вопрос по продукту',
        'task' => 'Прочий вопрос',
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
    
    public function get($id)
    {
        return $this->finder->where(['id' => $id])->one();
    }
}
