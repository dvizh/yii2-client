<?php
namespace dvizh\client;

use yii;

class Module extends \yii\base\Module
{
    public $adminRoles = ['admin', 'superadmin', 'administrator'];
    public $clientStatuses = []; //Depricated
    public $activeStatuses = ['active'];
    public $payTypes = ['base' => 'Базовый'];
    public $stafferModel = 'dvizh\staffer\models\Staffer';
    public $userRoles = ['user' => 'Клиент'];
    public $defaultRole = 'user';
    public $registerUserCallback = false;
    
    public function init()
    {
        parent::init();
    }
    
    public function registerUser(models\Client $client)
    {
        if(is_callable($this->registerUserCallback)) {
            $registerUserCallback = $this->registerUserCallback;
            return $registerUserCallback($client);
        }
        return false;
    }
}