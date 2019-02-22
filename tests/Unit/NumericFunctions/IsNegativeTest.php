<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use function AlecRabbit\Helpers\is_negative;

class IsNegativeTest extends HelpersTestCase
{
    /**
     * @test
     * @dataProvider isNegativeDataProvider
     * @param bool $expected
     * @param $argument
     */
    public function functionIsNegative(bool $expected, $argument): void
    {
        $this->assertSame($expected, is_negative($argument));
    }

    public function isNegativeDataProvider(): array
    {
        return [
            [true, -1],
            [false, 0],
            [false, 1],
            [true, -1.90768],
            [false, 0.0],
            [false, 1.345342],
            [true, '-1'],
            [false, '0'],
            [false, '1'],
            [false, ''],
            [true, false],
            [false, null],
            [false, true],
        ];
    }
}
