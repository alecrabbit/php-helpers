<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use function AlecRabbit\Helpers\trim_zeros;

class TrimZerosTest extends HelpersTestCase
{
    /**
     * @test
     * @dataProvider trimZerosDataProvider
     * @param string $expected
     * @param string|int|float $argument
     */
    public function functionTrimZeros(string $expected, $argument): void
    {
        $this->assertEquals($expected, trim_zeros((string)$argument));
    }

    public function trimZerosDataProvider(): array
    {
        return [
            ['0', '0'],
            ['0', ' 0'],
            ['0', ' .0'],
            ['0', '0.0'],
            ['13', '13'],
            ['13 000', '13 000'],
            ['13,000', '13,000'],
            ['13,000.45', '13,000.45000000'],
            ['13 000.45', '000 13 000.45000000'],
            ['13.0054', '13.00540000'],
            ['13.0054', '00013.00540000'],
            ['13', 13.000000],
            ['13', 13],
            ['2.6', 2.6000000],
            ['2.300004', 2.3000040],
        ];
    }
}
