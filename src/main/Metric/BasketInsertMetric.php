<?php

namespace WebArch\BitrixMonitor\Metric;

use RuntimeException;
use WebArch\BitrixMonitor\Metric\Abstraction\MetricBase;

class BasketInsertMetric extends MetricBase
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
     * @return int
     * @throws RuntimeException
     */
    public function calculate()
    {
        /** @noinspection SqlDialectInspection */
        /** @noinspection SqlNoDataSourceInspection */
        $sql = <<<END
SELECT count(*) as CNT FROM b_sale_basket WHERE DELAY = '%s' AND DATE_INSERT >= '%' AND ORDER_ID IS NULL
END;

        return (int)$this->calculateSimpleSqlMetric(
            sprintf(
                $sql,
                $this->toFavorite ? 'Y' : 'N',
                $this->getIntervalStartDateTime()
            ),
            'CNT'
        );
    }

}
