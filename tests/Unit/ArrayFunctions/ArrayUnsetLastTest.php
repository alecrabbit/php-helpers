<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use function AlecRabbit\array_unset_last;

class ArrayUnsetLastTest extends HelpersTestCase
{
    /**
     * @test
     * @dataProvider arrayUnsetLastDataProvider
     * @param $expected
     * @param $actual
     */
    public function arrayUnsetLast($expected, $actual): void
    {
        $this->assertEquals($expected, array_unset_last($actual));
    }

    public function arrayUnsetLastDataProvider(): array
    {
        return [
            [[], []],
            [[], [1]],
            [[0 => 0], [0 => 0, 1 => 1]],
            [[0 => 'b'], [0 => 'b', 1 => 'a']],
            [['zero' => 0,], ['zero' => 0, 'first' => 1]],
            [
                [
                    0 => 1,
                    1 => 2,
                    2 => 3,
                ],
                [
                    0 => 1,
                    1 => 2,
                    2 => 3,
                    3 => 4,
                ],
            ],
        ];
    }

    /**
     * @test
     * @dataProvider arrayUnsetLastValuesDataProvider
     * @param $expected
     * @param $actual
     */
    public function arrayUnsetLastValues($expected, $actual): void
    {
        $this->assertEquals(array_values($expected), array_values(array_unset_last($actual)));
    }

    public function arrayUnsetLastValuesDataProvider(): array
    {
        return [
            [[], [1]],
            [[0], [0, 1]],
            [[], ['a']],
            [['a'], ['a', 'b']],
            [[null,], [null, false]],
            [[1, 2, 3,], [1, 2, 3, 4,],],

        ];
    }
}
