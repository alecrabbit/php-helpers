<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use function AlecRabbit\format_time;
use function AlecRabbit\format_time_auto;
use const AlecRabbit\Helpers\Constants\UNIT_HOURS;
use const AlecRabbit\Helpers\Constants\UNIT_MICROSECONDS;
use const AlecRabbit\Helpers\Constants\UNIT_MINUTES;
use const AlecRabbit\Helpers\Constants\UNIT_SECONDS;

class FormatTimeAutoTest extends HelpersTestCase
{
    /**
     * @test
     * @dataProvider functionFormatTimeAutoDataProvider
     * @param $expected
     * @param $value
     */
    public function functionFormatTimeAuto($expected, $value): void
    {
        $this->assertEquals($expected, format_time_auto($value));
    }

    public function functionFormatTimeAutoDataProvider(): array
    {
        return [
            // [$expected, $value],
            ['2.806h', 10100],
            ['16.83m', 1010],
            ['101s', 101],
            ['1.2s', 1.2],
            ['1.0s', 1],
            ['100.0ms', 0.1],
            ['135.2ms', 0.135235555],
            ['1.0ms', 0.001],
            ['100.0μs', 0.0001,],
            ['1.0μs', 0.000001,],
            ['10.0ns', 0.00000001,],
        ];
    }
}
