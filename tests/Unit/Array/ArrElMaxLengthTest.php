<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use function AlecRabbit\arr_el_max_length;

class ArrElMaxLengthTest extends HelpersTestCase
{
    /**
     * @test
     * @dataProvider arrElMaxLengthDataProvider
     * @param $expected
     * @param $array
     */
    public function functionArrElMaxLength($expected, $array): void
    {
        $this->assertEquals($expected, arr_el_max_length($array));
    }

    public function arrElMaxLengthDataProvider(): array
    {
        return [
            // [$expected, $array],
            [1, ['', '1']],
            [2, ['', '22']],
            [0, ['', '']],
            [0, [null]],
            [0, [false]],
            [1, [true]],
            [4, ['1', '22', 333, 4444]],
            [6, ['1', 666.66, 333, 4444]],
            [7, ['1', 0.000000000001, 333, 4444]],
            [4, ['1', '1100', 333, 4444]],
            [13, ['1', 1100.00000001, 333, 4444]],
        ];
    }

}
