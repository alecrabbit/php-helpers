<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use function AlecRabbit\format_time_ns;

class FormatTimeNSTest extends HelpersTestCase
{
    /**
     * @test
     * @dataProvider functionFormatTimeNSDataProvider
     * @param $expected
     * @param $value
     */
    public function functionFormatTimeNS($expected, $value): void
    {
        $this->assertEquals($expected, format_time_ns($value));
    }

    public function functionFormatTimeNSDataProvider(): array
    {
        return [
            // [$expected, $value],
            ['2.806h', 10100000000000],
            ['1.0ms', 1010000],
            ['1.2s', 1200000000],
            ['1.0s', 1000000000],
            ['135.2ms', 135235555],
            ['1.0ms', 1000000],
            ['100.0μs', 100000,],
            ['1.0μs', 1000,],
            ['10.0ns', 10,],
        ];
    }
}
