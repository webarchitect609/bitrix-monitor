<?php

namespace WebArch\BitrixMonitor\Test\Acceptance;

use Throwable;

class UnsentMailEventsMetricTest extends BitrixMetricTestBase
{
    /**
     * @throws Throwable
     */
    public function testUnsetMailEventsMetric()
    {
        $this->assertEquals(
            0,
            $this->monitor->exec($this->metricNameUnsentMail)
        );
    }
}
