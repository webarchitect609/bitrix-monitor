<?php

namespace WebArch\BitrixMonitor\Metric\Abstraction;

use DateInterval;
use DateTimeImmutable;
use mysqli;
use RuntimeException;

abstract class MetricBase implements MetricInterface
{
    /**
     * @var mysqli
     */
    protected $mysqli;

    /**
     * @var string
     */
    private $name;

    /**
     * @var DateInterval
     */
    private $interval;

    public function __construct(string $name)
    {
        $this->setName($name);
    }

    /**
     * Возвращает расчёт простейшей метрики, состоящей из SQL запроса и содержащей результат в одном столбце.
     *
     * @param string $query
     * @param string $colName
     *
     * @return mixed
     * @throws RuntimeException
     */
    protected function calculateSimpleSqlMetric(string $query, string $colName)
    {
        $mysqli_result = $this->getMysqli()->query($query);
        if (false === $mysqli_result) {
            throw new RuntimeException(
                sprintf(
                    'Error executing query (%s): %s',
                    $this->getMysqli()->errno,
                    $this->getMysqli()->error
                )
            );
        }
        $row = $mysqli_result->fetch_assoc();
        $mysqli_result->free();

        if (!array_key_exists($colName, $row)) {
            throw new RuntimeException(
                sprintf(
                    'Column `%s` not found in query result for metric %s',
                    $colName,
                    static::class
                )
            );
        }

        return $row[$colName];
    }

    /**
     * Возвращает дату и время начала диапазона, отступив заданный интервал от текущей метки времени
     *
     * @param string $format
     *
     * @return string
     */
    protected function getIntervalStartDateTime($format = DATE_ISO8601): string
    {
        return (new DateTimeImmutable())->sub($this->getInterval())->format($format);
    }

    /**
     * @return mysqli
     */
    public function getMysqli(): mysqli
    {
        return $this->mysqli;
    }

    /**
     * @param mysqli $mysqli
     *
     * @return $this
     */
    public function setMysqli(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return DateInterval
     */
    public function getInterval(): DateInterval
    {
        return $this->interval;
    }

    /**
     * @param DateInterval $interval
     *
     * @return $this
     */
    public function setInterval(DateInterval $interval)
    {
        $this->interval = $interval;

        return $this;
    }

}
