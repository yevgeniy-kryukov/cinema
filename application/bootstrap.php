<?php

// подключаем файлы ядра
require_once 'core/Model.php';
require_once 'core/View.php';
require_once 'core/Controller.php';

require_once 'config/db.php';
require_once 'core/DataBase.php';
require_once 'vendor/PHPMailer/Exception.php';
require_once 'vendor/PHPMailer/SMTP.php';
require_once 'vendor/PHPMailer/PHPMailer.php';
require_once 'core/Utils.php';

/*
Здесь обычно подключаются дополнительные модули, реализующие различный функционал:
    > аутентификацию
    > кеширование
    > работу с формами
    > абстракции для доступа к данным
    > ORM
    > Unit тестирование
    > Benchmarking
    > Работу с изображениями
    > Backup
    > и др.
*/

session_start();

require_once 'core/route.php';
Route::Start(); // запускаем маршрутизатор
