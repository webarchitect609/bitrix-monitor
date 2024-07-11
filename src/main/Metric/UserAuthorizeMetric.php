<?php

namespace WebArch\BitrixMonitor\Metric;

use DateInterval;
use DateTimeZone;
use Exception;
use WebArch\Monitor\Metric\MySQLiAwareMetricBase;

class UserAuthorizeMetric extends MySQLiAwareMetricBase
{
    /**
     * @inheritDoc
     * @throws Exception
     */
    public function calculate(DateInterval $interval, DateTimeZone $timeZone = null)
    {
        /** @noinspection SqlDialectInspection */
        /** @noinspection SqlNoDataSourceInspection */
        $sql = <<<END
select count(*) as CNT from b_user where LAST_LOGIN >= '%s'
END;

        return (int)$this->calculateSimpleSqlMetric(
            sprintf(
                $sql,
                $this->getIntervalStartDateTime($interval, $timeZone)->format(DATE_ATOM)
            ),
            'CNT'
        );
    }

}
