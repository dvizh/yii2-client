Yii2-client
==========
Справочник клиентов.

В состав входит возможность управлять (CRUD):

* Клиенты (имя, фото, статус и т.д.)
* Категории сотрудников

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
* ?r=client/client/index - сотрудники
* ?r=client/category/index - категории

Виджеты
---------------------------------
Виджеты в разработке.
