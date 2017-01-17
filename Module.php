<?php
namespace pistol88\client;

use yii;

class Module extends \yii\base\Module
{
    public $adminRoles = ['admin', 'superadmin', 'administrator'];
    public $clientStatuses = []; //Depricated
    public $activeStatuses = ['active'];
    public $payTypes = ['base' => 'Базовый'];
    public $stafferModel = 'pistol88\staffer\models\Staffer';
    
    public function init()
    {
        parent::init();
    }
}