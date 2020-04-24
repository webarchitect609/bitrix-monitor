<?php

namespace WebArch\BitrixMonitor\Test\Acceptance;

use Throwable;

class UserAuthorizeMetric extends BitrixMetricTestBase
{
    /**
     * @throws Throwable
     */
    public function testUserAuthorizeMetric()
    {
        $this->assertEquals(
            0,
            $this->monitor->exec($this->metricNameUserAuth)
        );
    }
}
