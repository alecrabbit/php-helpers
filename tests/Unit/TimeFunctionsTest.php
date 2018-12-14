<?php
/**
 * User: alec
 * Date: 12.10.18
 * Time: 14:07
 */

namespace Unit;


use function \AlecRabbit\base_timestamp;
use function \AlecRabbit\now;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class TimeFunctionsTest extends TestCase
{
    /** @test */
    public function FunctionNow(): void
    {
        $now = now();
        $this->assertInstanceOf(Carbon::class, $now);
    }

    /**
     * @test
     * @dataProvider timestampsDataProvider
     * @param $expected
     * @param $timestamp
     * @param $interval
     */
    public function FunctionBaseTimestamp($expected, $timestamp, $interval): void
    {
        $this->assertEquals($expected, base_timestamp($timestamp,$interval));
    }

    public function timestampsDataProvider(): array
    {
        return [
            [1514851080, 1514851122, 60],
            [1514851020, 1514851122, 180],
            [1514850900, 1514851122, 300],
            [1514850300, 1514851122, 900],
            [1514849400, 1514851122, 1800],
            [1514848500, 1514851122, 2700],
            [1514847600, 1514851122, 3600],
            [1514844000, 1514851122, 7200],
            [1514840400, 1514851122, 10800],
            [1514836800, 1514851122, 14400],
            [1514764800, 1514851122, 86400],
        ];
    }


}