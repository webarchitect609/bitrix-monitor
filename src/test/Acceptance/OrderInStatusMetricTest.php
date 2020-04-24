<?php

namespace WebArch\BitrixMonitor\Test\Acceptance;

use Throwable;

class OrderInStatusMetricTest extends BitrixMetricTestBase
{
    /**
     * @throws Throwable
     */
    public function testOrderInStatusMetric()
    {
        $this->assertEquals(
            0,
            $this->monitor->exec($this->metricNameOrderInStatus)
        );
    }
}
