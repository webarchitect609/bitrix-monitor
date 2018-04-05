<?php

namespace WebArch\BitrixMonitor\Metric\Abstraction;

use DateInterval;
use mysqli;

interface MetricInterface
{
    /**
     * @param mysqli $mysqli
     *
     * @return mixed
     */
    public function setMysqli(mysqli $mysqli);

    /**
     * @return mysqli
     */
    public function getMysqli(): mysqli;

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name);

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param DateInterval $interval
     *
     * @return $this
     */
    public function setInterval(DateInterval $interval);

    /**
     * @return DateInterval
     */
    public function getInterval(): DateInterval;

    /**
     * @return mixed
     */
    public function calculate();

}
