<?php

namespace WebArch\BitrixMonitor;

use DateInterval;
use mysqli;
use RuntimeException;
use WebArch\BitrixMonitor\Metric\Abstraction\MetricInterface;

class Monitor
{
    /**
     * X-BMonitor-Token
     */
    const TOKEN_HEADER_KEY = 'HTTP_X_BMONITOR_TOKEN';

    /**
     * @var mysqli
     */
    private $mysqli;

    /**
     * @var array<MetricInterface>
     */
    protected $metrics = [];

    /**
     * @var DateInterval
     */
    private $interval;

    public function __construct(
        string $token,
        string $dbHost,
        string $dbLogin,
        string $dbPas,
        string $dbName,
        string $dbPort = null
    ) {
        $this->checkToken($token);
        $this->setMysqli(new mysqli($dbHost, $dbLogin, $dbPas, $dbName, $dbPort));
    }

    /**
     * @param string $token
     *
     * @return static
     */
    public static function create(string $token)
    {
        return new static(
            $token,
            $GLOBALS['DBHost'],
            $GLOBALS['DBLogin'],
            $GLOBALS['DBPassword'],
            $GLOBALS['DBName']
        );
    }

    protected function checkToken(string $token)
    {
        if ($_SERVER[self::TOKEN_HEADER_KEY] !== $token) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden', true, 403);
            exit();
        }
    }

    /**
     * @param MetricInterface $metric
     *
     * @return $this
     */
    public function addMetric(MetricInterface $metric)
    {
        $this->metrics[$metric->getName()] = $metric->setMysqli($this->getMysqli());

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
     * @param string $name
     *
     * @return mixed
     * @throws RuntimeException
     */
    public function evalMetricByName(string $name)
    {
        if (!array_key_exists($name, $this->metrics)) {
            throw new RuntimeException(
                sprintf(
                    'Metric `%s` does not exist.',
                    $name
                )
            );
        }

        /** @var MetricInterface $metric */
        $metric = $this->metrics[$name];

        return $metric->setInterval($this->getInterval())->calculate();
    }

}