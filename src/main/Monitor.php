<?php

namespace WebArch\BitrixMonitor;

use DateInterval;
use Exception;
use mysqli;
use RuntimeException;
use WebArch\BitrixMonitor\Enum\ErrorCode;
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

    /**
     * @param string $metricName
     *
     * @return string
     */
    public function exec(string $metricName): string
    {
        try {

            return $this->evalMetricByName($metricName);

        } catch (Exception $exception) {

            header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request', true, 400);

            /**
             * Т.к. был проверен token,
             * то это сообщение увидит только сторона,
             * обладающая доступом к мониторингу.
             */
            return sprintf(
                "[%s] %s (%s) in %s:%s\n%s\n",
                get_class($exception),
                $exception->getMessage(),
                $exception->getCode(),
                $exception->getFile(),
                $exception->getLine(),
                $exception->getTraceAsString()
            );
        }
    }

    protected function checkToken(string $token)
    {
        $token = trim($token);
        if ('' === $token) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
            exit(ErrorCode::TOKEN_IS_NOT_CONFIGURED);
        }

        if ($_SERVER[self::TOKEN_HEADER_KEY] !== $token) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 401 Unauthorized', true, 401);
            exit(ErrorCode::TOKEN_IS_NOT_VALID);
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
     * @throws RuntimeException
     * @return mixed
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
