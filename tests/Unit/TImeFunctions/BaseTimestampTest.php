<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use function AlecRabbit\base_timestamp;
use const AlecRabbit\Helpers\Constants\I_01DAY;
use const AlecRabbit\Helpers\Constants\I_01HOUR;
use const AlecRabbit\Helpers\Constants\I_01MIN;
use const AlecRabbit\Helpers\Constants\I_02HOUR;
use const AlecRabbit\Helpers\Constants\I_03HOUR;
use const AlecRabbit\Helpers\Constants\I_03MIN;
use const AlecRabbit\Helpers\Constants\I_04HOUR;
use const AlecRabbit\Helpers\Constants\I_05MIN;
use const AlecRabbit\Helpers\Constants\I_15MIN;
use const AlecRabbit\Helpers\Constants\I_30MIN;
use const AlecRabbit\Helpers\Constants\I_45MIN;

class BaseTimestampTest extends HelpersTestCase
{

    /**
     * @test
     * @dataProvider timestampsDataProvider
     * @param $expected
     * @param $timestamp
     * @param $interval
     */
    public function functionBaseTimestamp($expected, $timestamp, $interval): void
    {
        $this->assertEquals($expected, base_timestamp($timestamp, $interval));
    }

    public function timestampsDataProvider(): array
    {
        return [
            [1514851080, 1514851122, I_01MIN],
            [1514851020, 1514851122, I_03MIN],
            [1514850900, 1514851122, I_05MIN],
            [1514850300, 1514851122, I_15MIN],
            [1514849400, 1514851122, I_30MIN],
            [1514848500, 1514851122, I_45MIN],
            [1514847600, 1514851122, I_01HOUR],
            [1514844000, 1514851122, I_02HOUR],
            [1514840400, 1514851122, I_03HOUR],
            [1514836800, 1514851122, I_04HOUR],
            [1514764800, 1514851122, I_01DAY],
        ];
    }

    /**
     * @test
     * @dataProvider timestampsDataProviderArgs
     * @param int $expected
     * @param array $args
     */
    public function functionBaseTimestampArgs(int $expected, array $args): void
    {
        $this->assertEquals($expected, base_timestamp(...$args));
    }

    public function timestampsDataProviderArgs(): array
    {
        return [
            [1514851080, [1514851122,]],
            [1514851080, [1514851122, I_01MIN]],
            [1514851020, [1514851122, I_03MIN]],
            [1514850900, [1514851122, I_05MIN]],
            [1514850300, [1514851122, I_15MIN]],
            [1514849400, [1514851122, I_30MIN]],
            [1514848500, [1514851122, I_45MIN]],
            [1514847600, [1514851122, I_01HOUR]],
            [1514844000, [1514851122, I_02HOUR]],
            [1514840400, [1514851122, I_03HOUR]],
            [1514836800, [1514851122, I_04HOUR]],

            [1514764800, [1514851122, I_01DAY]],
            [1514764800, [1514801122, I_01DAY]],
            [1514764800, [1514811122, I_01DAY]],
            [1514764800, [1514821122, I_01DAY]],
            [1514764800, [1514831122, I_01DAY]],
            [1514764800, [1514841122, I_01DAY]],
            [1514764800, [1514851122, I_01DAY]],
            [1514764800, [1514851122, I_01DAY]],
            [1514851200, [1514852122, I_01DAY]],
            [1514851200, [1514853122, I_01DAY]],
            [1514851200, [1514854122, I_01DAY]],
            [1514851200, [1514855122, I_01DAY]],
            [1514851200, [1514856122, I_01DAY]],
            [1514851200, [1514857122, I_01DAY]],
        ];
    }
}
