<?php

namespace WebArch\BitrixMonitor\Metric;

use RuntimeException;
use WebArch\BitrixMonitor\Metric\Abstraction\MetricBase;

class OrderInStatusMetric extends MetricBase
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
     * @return int
     * @throws RuntimeException
     */
    public function calculate()
    {
        /** @noinspection SqlDialectInspection */
        /** @noinspection SqlNoDataSourceInspection */
        $sql = <<<END
SELECT count(*) as CNT FROM b_sale_order WHERE STATUS_ID = '%s' AND DATE_STATUS >= '%s'
END;

        return (int)$this->calculateSimpleSqlMetric(
            sprintf(
                $sql,
                $this->orderStatusId,
                $this->getIntervalStartDateTime()
            ),
            'CNT'
        );
    }
}
