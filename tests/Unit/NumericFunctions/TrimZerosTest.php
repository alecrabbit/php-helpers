<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use function AlecRabbit\Helpers\trim_zeros;

class TrimZerosTest extends HelpersTestCase
{
    /**
     * @test
     * @dataProvider trimZerosDataProvider
     * @param string $expected
     * @param string $argument
     */
    public function FunctionTrimZeros(string $expected, string $argument): void
    {
        $this->assertEquals($expected, trim_zeros($argument));
    }

    public function trimZerosDataProvider(): array
    {
        return [
            ['0', '0'],
            ['0', '0.0'],
            ['13', '13'],
            ['13.0054', '13.00540000'],
            ['13', 13.000000],
            ['2.6', 2.6000000],
            ['2.300004', 2.3000040],
        ];
    }
}
