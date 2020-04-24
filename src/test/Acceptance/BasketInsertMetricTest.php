<?php

namespace WebArch\BitrixMonitor\Test\Acceptance;

use Throwable;

class BasketInsertMetricTest extends BitrixMetricTestBase
{
    /**
     * @throws Throwable
     */
    public function testBasketMetric()
    {
        $this->assertEquals(
            0,
            $this->monitor->exec($this->metricNameBasket)
        );
    }

    /**
     * @throws Throwable
     */
    public function testFavoritesMetric()
    {
        $this->assertEquals(
            0,
            $this->monitor->exec($this->metricNameFavorites)
        );
    }
}
