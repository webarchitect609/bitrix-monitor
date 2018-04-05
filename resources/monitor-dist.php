<?php

/**
 * 1 Подключите /vendor/autoload.php
 * 2 Подключите dbconn.php с объявлением глобальных переменных $DBHost, $DBLogin, $DBPassword, $DBName
 * ! - Если используется нестандартный порт, придётся отделить его в $DBHost и передать отдельно.
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/php_interface/dbconn.php';

/**
 * 3 Укажите токен, который при запросе должен быть отправлен в заголовке X-BMonitor-Token
 */
$monitor = \WebArch\BitrixMonitor\Monitor::create('very-long-token-to-be-placed-here!');

/**
 * 4 Укажите интервал, за который должны быть подсчитаны метрики.
 */
$monitor->setInterval(new DateInterval('PT1M'));

/**
 * 5 Укажите какие метрики и с какими именами будут доступны.
 */
$monitor->addMetric(new \WebArch\BitrixMonitor\Metric\UserAuthorizeMetric('userauth'))
        ->addMetric(new \WebArch\BitrixMonitor\Metric\BasketInsertMetric('basket'))
        ->addMetric(new \WebArch\BitrixMonitor\Metric\UnsentMailEventsMetric('mail'));

/**
 * 6 Укажите, в каком параметре запроса будет приходить имя запрашиваемой метрики.
 */
echo $monitor->exec(trim($_REQUEST['metric']));

/**
 * 7 Настройте Zabbix или аналогичное ПО на отправку HTTP запроса с токеном и именем метрики.
 * В теле ответа будет только значение метрики.
 */
