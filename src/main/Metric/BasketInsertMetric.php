<?php

namespace WebArch\BitrixMonitor\Metric;

use DateInterval;
use DateTimeZone;
use Exception;
use WebArch\Monitor\Metric\MySQLiAwareMetricBase;

class BasketInsertMetric extends MySQLiAwareMetricBase
{
    /**
     * @var bool
     */
    private $toFavorite;

    public function __construct(string $name, bool $toFavorite = false)
    {
        parent::__construct($name);
        $this->toFavorite = $toFavorite;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function calculate(DateInterval $interval, DateTimeZone $timeZone = null)
    {
        /** @noinspection SqlDialectInspection */
        /** @noinspection SqlNoDataSourceInspection */
        $sql = <<<END
select count(*) as CNT from b_sale_basket where DELAY = '%s' and DATE_INSERT >= '%s' and ORDER_ID is null
END;

        return (int)$this->calculateSimpleSqlMetric(
            sprintf(
                $sql,
                $this->toFavorite ? 'Y' : 'N',
                $this->getIntervalStartDateTime($interval, $timeZone)
                     ->format(DATE_ATOM)
            ),
            'CNT'
        );
    }
}
