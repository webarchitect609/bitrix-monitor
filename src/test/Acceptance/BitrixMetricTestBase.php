<?php

namespace WebArch\BitrixMonitor\Test\Acceptance;

use DateInterval;
use PHPUnit\Framework\TestCase;
use WebArch\BitrixMonitor\Metric\BasketInsertMetric;
use WebArch\BitrixMonitor\Metric\OrderInStatusMetric;
use WebArch\BitrixMonitor\Metric\UnsentMailEventsMetric;
use WebArch\BitrixMonitor\Metric\UserAuthorizeMetric;
use WebArch\Monitor\Service\MySQLiAwareMonitor;

abstract class BitrixMetricTestBase extends TestCase
{
    /**
     * @var MySQLiAwareMonitor
     */
    protected $monitor;

    /**
     * @var BasketInsertMetric
     */
    protected $basketInsertMetric;

    /**
     * @var string
     */
    protected $metricNameBasket;

    /**
     * @var string
     */
    protected $metricNameFavorites;

    /**
     * @var BasketInsertMetric
     */
    protected $favoritesInsertMetric;

    /**
     * @var string
     */
    protected $metricNameOrderInStatus;

    /**
     * @var OrderInStatusMetric
     */
    protected $orderInStatusMetric;

    /**
     * @var string
     */
    protected $metricNameUnsentMail;

    /**
     * @var UnsentMailEventsMetric
     */
    protected $unsentMailEventsMetric;

    /**
     * @var string
     */
    protected $metricNameUserAuth;

    /**
     * @var UserAuthorizeMetric
     */
    protected $userAuthMetric;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        /**
         * Suppress warning "Cannot modify header information - headers already sent by"
         * and notice "Undefined index"
         */
        $this->iniSet('error_reporting', ini_get('error_reporting') & ~E_WARNING & ~E_NOTICE);
        $this->metricNameBasket = 'basket';
        $this->basketInsertMetric = new BasketInsertMetric($this->metricNameBasket, false);
        $this->metricNameFavorites = 'favorites';
        $this->favoritesInsertMetric = new BasketInsertMetric($this->metricNameFavorites, true);
        $this->metricNameOrderInStatus = 'order-status-N';
        $this->orderInStatusMetric = new OrderInStatusMetric($this->metricNameOrderInStatus, 'N');
        $this->metricNameUnsentMail = 'unsent-mail';
        $this->unsentMailEventsMetric = new UnsentMailEventsMetric($this->metricNameUnsentMail);
        $this->metricNameUserAuth = 'user-auth';
        $this->userAuthMetric = new UserAuthorizeMetric($this->metricNameUserAuth);

        $this->monitor = MySQLiAwareMonitor::create(
            'very-long-token-to-be-placed-here',
            getenv('DB_HOST'),
            getenv('DB_USERNAME'),
            getenv('DB_PASSWORD'),
            getenv('DB_NAME'),
            getenv('DB_PORT')
        )
                                           ->setInterval(
                                               new DateInterval('PT1M')
                                           )
                                           ->addMetric($this->basketInsertMetric)
                                           ->addMetric($this->favoritesInsertMetric)
                                           ->addMetric($this->orderInStatusMetric)
                                           ->addMetric($this->unsentMailEventsMetric)
                                           ->addMetric($this->userAuthMetric);
    }

}
