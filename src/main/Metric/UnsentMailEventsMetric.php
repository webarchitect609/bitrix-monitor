<?php

namespace WebArch\BitrixMonitor\Metric;

use RuntimeException;
use WebArch\BitrixMonitor\Metric\Abstraction\MetricBase;

class UnsentMailEventsMetric extends MetricBase
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
select count(*) as CNT from b_event where SUCCESS_EXEC = 'N' or DATE_EXEC is null
END;

        return (int)$this->calculateSimpleSqlMetric($sql, 'CNT');

    }

}
