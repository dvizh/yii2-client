Yii2-client
==========
Справочник клиентов.

В состав входит возможность управлять (CRUD):

* Клиенты (имя, фото, статус и т.д.)
* Категории сотрудников
* Обращения клиентов

Установка
---------------------------------
Выполнить команду

```
php composer require pistol88/yii2-client "*"
```

Или добавить в composer.json

```
"pistol88/yii2-client": "*",
```

И выполнить

```
php composer update
```

Далее, мигрируем базу:

```
php yii migrate --migrationPath=vendor/pistol88/yii2-client/migrations
```

Не забываем выполнить миграцию модулуй, от которых зависит client

Настройка
---------------------------------

В секцию modules конфига добавить:

```
    'modules' => [
        //..
        'client' => [
            'class' => 'pistol88\client\Module',
            'adminRoles' => ['administrator'],
        ],
        //..
    ]
```

В секцию components:

```
    'client' => [
        'class' => 'pistol88\client\Client',
    ],
```

Использование
---------------------------------
* ?r=client/default/index - список CRUD

Виджеты
---------------------------------

* pistol88\client\widgets\Calls::widget(['client' => $clientModel]); - выведет список обращений с возможностью добавить новое
