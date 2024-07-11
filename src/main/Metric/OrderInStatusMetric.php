<?php

namespace WebArch\BitrixMonitor\Metric;

use DateInterval;
use DateTimeZone;
use Exception;
use WebArch\Monitor\Metric\MySQLiAwareMetricBase;

class OrderInStatusMetric extends MySQLiAwareMetricBase
{
    /**
     * @var string
     */
    private $orderStatusId;

    public function __construct(string $name, string $orderStatusId = 'N')
    {
        parent::__construct($name);
        $this->orderStatusId = $orderStatusId;
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
select count(*) as CNT from b_sale_order where STATUS_ID = '%s' and DATE_STATUS >= '%s'
END;

        return (int)$this->calculateSimpleSqlMetric(
            sprintf(
                $sql,
                $this->orderStatusId,
                $this->getIntervalStartDateTime($interval, $timeZone)->format(DATE_ATOM)
            ),
            'CNT'
        );
    }

}
