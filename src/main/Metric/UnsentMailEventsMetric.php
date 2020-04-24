<?php

namespace WebArch\BitrixMonitor\Metric;

use DateInterval;
use DateTimeZone;
use WebArch\Monitor\Metric\MySQLiAwareMetricBase;

class UnsentMailEventsMetric extends MySQLiAwareMetricBase
{
    /**
     * @inheritDoc
     */
    public function calculate(DateInterval $interval, DateTimeZone $timeZone = null)
    {
        /** @noinspection SqlDialectInspection */
        /** @noinspection SqlNoDataSourceInspection */
        $sql = <<<END
select count(*) as CNT from b_event where SUCCESS_EXEC = 'N' or DATE_EXEC is null
END;

        return (int)$this->calculateSimpleSqlMetric($sql, 'CNT');
    }

}
