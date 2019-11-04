## Запуск
из корня запустить консольные команды `composer install` и `php init`

в *common/config/main-local.php* добавить компонент в `components`
```
'components' => [
    ...
    'mongodb' => [
               'class' => \yii\mongodb\Connection::class,
               'dsn' => 'mongodb://<username>:<password>@localhost:27017/<db name>',
    ],
    ...
]
```
В *common/config/params-local* добавить переменную `'db_name' => <db name>`