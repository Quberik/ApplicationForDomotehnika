# Readme #

Реализовано приложение — API для доступа к пользовательским данным через веб. Данные пользователей хранятся в БД. У каждого пользователя есть nick, login и email. Выбор типа возвращаемых данных (json или xml, по выбору клиентского приложения).

## Установка приложения ##

Качаем и устанавливаем [Composer](https://getcomposer.org/download/)  
Закачиваем приложение через Composer
```JSON
composer.phar create-project quberik/application-for-domotehnika -s dev
```  
Создаём пользователя и пароль к базе: `user_domotehnika` и `Amyk9As449MhnO7`  
Host: `localhost` (`127.0.0.1`)  
Создаём базу данных
```JSON  
php app/console doctrine:database:create
```  
Открываем консоль. Переходим в директорию проекта и создаём таблицы в базе данных:  
```JSON 
php app/console doctrine:schema:update --force  
```  
Загружаем фикстуры:  
```JSON
php app/console doctrine:fixtures:load
```  
[Устанавливаем сервер ElasticSearch](http://www.elasticsearch.org/guide/en/elasticsearch/reference/current/setup-service.html) локально. Порт `9200`  
Запускаем сервер ElasticSearch  
Создаём индекс Elastic из базы данных  
```JSON
app/console fos:elastica:populate
```  
Устанавливаем права на папку app/cache и app/logs `777` и всех вложенных файлов и папок

## Функциональность приложения ##

Получение списка пользователей в базе, GETзапрос:
```HTTP
http://your_site.ru/api/user.json
```
Получение списка пользователей по критерию (nick, login, email), GETзапрос:
```HTTP
http://your_site.ru/api/user.json?search=@hotmail.com
```
Получение пользователя по id, GETзапрос:
```HTTP
http://your_site.ru/api/user/5.json
```
Обновление пользователя (изменение ника, email), POSTзапрос:
```HTTP
http://your_site.ru/api/user/5.json
```

## Опционально ##

1. Переключение окружения (development, production):  
`http://your-site.ru/` - prod  
`http://your-site.ru/app_dev.php/` - dev  
2. > Кастомные страницы 404й и 500й ошибок - не совсем понял, что тут имелось ввиду. Сейчас, если клиент делает запрос на сервер и ожидает json, то приходит json ответ с 404 или 500 ошибкой. Если клиент запрашивает xml, то ответ с ошибкой приходит также, только в формате xml.
3. Доступ к API осуществляется только авторизованному клиентскому приложению. Логин и пароль: `demo` и `demo`   

## Дополнительное задание ##

#### Окружение для посещаемости 5 млн ####
1. Linux CentOs, version > 6
2. PHP 5.3.3 или выше
3. MySql 5.5.33 или выше
4. Nginx 1.5.3
5. Отключаем Access log `access_log off;` в файле nginx.conf
6. Устанавливаем внутренний кеш PHP - APC
7. Так как mysql движок будет использоваться innodb, то устанавливаем размер буфера до 75% (`innodb_buffer_pool_size`) от всей доступной памяти на сервере (`key_buffer` соответственно уменьшаем) в файле my.cnf.
8. `innodb_flush_log_at_trx_commit` в этом же файле устанавливаем значение в 0. Значительно повыситься скорость записи при больших объёмах (не нужно буфер записи скидывать на диск после каждой операции).
9. Включаем внутренний кеш MySQL: `query_cache_size = 32М`
10. Выставляем количество воркеров для Nginx равное количеству ядер
11. Переносим сервер ElasticSearch на отдельный сервер или несколько серверов
12. Переносим MySQL базу на другой сервер. Можно настроить MySQL репликацию на несколько серверов. 
13. Включаем кеш Doctrine, файловый кеш
14. Вертикальное и горизонтальное масштабирование
15. С помощью zabbix следим за нагрузкой и работой узлов системы
16. Ну и последнее, используем несколько серверов на отдачу вместо одного   

## Демо ##  
```HTTP
http://ussurka.ru/api/user.json
http://ussurka.ru/api/user.json?search=@gmail.com
http://ussurka.ru/api/user/2.json
```
Логин: `demo`  
Пароль: `demo`  

###### Юнит тестирование не писал, к сожалению, небыло времени