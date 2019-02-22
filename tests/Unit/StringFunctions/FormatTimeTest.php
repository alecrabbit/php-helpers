<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use function AlecRabbit\format_time;
use const AlecRabbit\Helpers\Constants\UNIT_HOURS;
use const AlecRabbit\Helpers\Constants\UNIT_MICROSECONDS;
use const AlecRabbit\Helpers\Constants\UNIT_MINUTES;
use const AlecRabbit\Helpers\Constants\UNIT_SECONDS;

class FormatTimeTest extends HelpersTestCase
{
    /**
     * @test
     * @dataProvider functionFormatTimeDataProvider
     * @param string $expected
     * @param array $args
     */
    public function functionFormatTime(string $expected, array $args): void
    {
        $this->assertEquals($expected, format_time(...$args));
    }

    /**
     * @test
     * @dataProvider functionFormatTimeDataProviderExceptions
     * @param string $expected
     * @param array $args
     */
    public function functionFormatTimeExceptions(string $expected, array $args): void
    {
        $this->expectException($expected);
        $this->assertEquals($expected, format_time(...$args));
    }

    public function functionFormatTimeDataProviderExceptions(): array
    {
        return [
            [\ArgumentCountError::class, []],
            [\TypeError::class, [1, '']],
            [\TypeError::class, [1, UNIT_MICROSECONDS, '']],
        ];
    }

    public function functionFormatTimeDataProvider(): array
    {
        return [
            // [$expected, [...$args]],
            ['0.0ms', [null],],
            ['100.0ms', [0.1,],],
            ['100.1ms', [0.100111,],],
            ['0.1μs', [0.0000001, UNIT_MICROSECONDS,],],
            ['0.01μs', [0.00000001, UNIT_MICROSECONDS, 2],],
            ['1000.0ms', [1.0000000001,],],
            ['1000.01ms', [1.00001, null, 2],],
            ['0.000278h', [1.0000000001, UNIT_HOURS, 7],],
            ['0.000278h', [1.0000000001, UNIT_HOURS, 6],],
            ['0.017m', [1.0000000001, UNIT_MINUTES, 3],],
            ['0.016667m', [1.0000000001, UNIT_MINUTES, 7],],
            ['0.016667m', [1.0000000001, UNIT_MINUTES, 6],],
            ['5 758 723.7m', [345523421.0000000001, UNIT_MINUTES, null, '.', ' '],],
            ['1.0s', [1.0000000001, UNIT_SECONDS,],],
            ['1.02s', [1.02, UNIT_SECONDS, 2],],
            ['1.0200s', [1.02, UNIT_SECONDS, 4],],
        ];
    }
}
