<?php

namespace WebArch\BitrixMonitor\Metric\Abstraction;

use DateInterval;
use mysqli;

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

    public function __construct(string $name = '')
    {
        $this->setName($name);
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
