<?php
namespace pistol88\client;

use yii;

class Module extends \yii\base\Module
{
    public $adminRoles = ['admin', 'superadmin'];
    public $clientStatuses = ['active' => 'Обычный', 'dismissed' => 'Постоянный', 'missing' => 'Пропавший'];
    public $activeStatuses = ['active'];
    public $payTypes = ['base' => 'Базовый'];
    
    public function init()
    {
        parent::init();
    }
}