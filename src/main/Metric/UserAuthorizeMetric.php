<?php

namespace WebArch\BitrixMonitor\Metric;

use DateTimeImmutable;
use RuntimeException;
use WebArch\BitrixMonitor\Metric\Abstraction\MetricBase;

class UserAuthorizeMetric extends MetricBase
{
    /**
     * @return int
     * @throws RuntimeException
     */
    public function calculate()
    {
        /** @noinspection SqlDialectInspection */
        /** @noinspection SqlNoDataSourceInspection */
        $sql = <<<END
SELECT count(*) as CNT FROM b_user WHERE LAST_LOGIN >= '%s'
END;

        return (int)$this->calculateSimpleSqlMetric(sprintf($sql, $this->getIntervalStartDateTime()), 'CNT');
    }

}
