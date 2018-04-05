<?php

/**
 * 0 Подключите /vendor/autoload.php
 */
require_once realpath(__DIR__) . '/vendor/autoload.php';
require_once realpath(__DIR__) . '/bitrix/php_interface/dbconn.php';

/**
 * 1 Укажите токен, который при запросе должен быть отправлен в заголовке X-BMonitor-Token
 */
$monitor = \WebArch\BitrixMonitor\Monitor::create('very-long-token-to-be-placed-here!');

/**
 * 2 Укажите интервал, за который должны быть подсчитаны метрики.
 */
$monitor->setInterval(new DateInterval('PT1M'));

/**
 * 3 Укажите какие метрики и с какими именами должны быть добавлены в монитор.
 */
$monitor->addMetric(new \WebArch\BitrixMonitor\Metric\UserAuthorizeMetric('userauth'));

try {
    /**
     * 4 Укажите, в каком параметре запроса будет приходить имя запрашиваемой метрики.
     */
    echo $monitor->evalMetricByName(trim($_REQUEST['metric']));

} catch (Exception $exception) {

    /**
     * Т.к. был проверен token,
     * то это сообщение увидит только сторона,
     * обладающая доступом к мониторингу.
     */
    echo sprintf(
        "[%s] %s (%s)\n%s\n",
        get_class($exception),
        $exception->getMessage(),
        $exception->getCode(),
        $exception->getTraceAsString()
    );
}

/**
 * 5 Настройте Zabbix или аналогичное ПО на отправку HTTP запроса с токеном и именем метрики.
 * В теле ответа будет только значение метрики.
 */
