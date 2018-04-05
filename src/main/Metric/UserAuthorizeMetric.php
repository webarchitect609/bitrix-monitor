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
        $fromDateTime = (new DateTimeImmutable())->sub($this->getInterval())->format(DATE_ISO8601);

        $mysqli_result = $this->getMysqli()->query(sprintf($sql, $fromDateTime));
        $row = $mysqli_result->fetch_assoc();
        $mysqli_result->free();

        if (array_key_exists('CNT', $row)) {
            return (int)$row['CNT'];
        }

        throw new RuntimeException('Error calculating result!');
    }

}
