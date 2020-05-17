<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use function AlecRabbit\array_unset_first;

class ArrayUnsetFirstTest extends HelpersTestCase
{
    /**
     * @test
     * @dataProvider unsetFirstDataProvider
     * @param $expected
     * @param $actual
     */
    public function functionUnsetFirst($expected, $actual): void
    {
        $this->assertEquals($expected, array_unset_first($actual));
    }

    public function unsetFirstDataProvider(): array
    {
        return [
            [[], []],
            [[], [1]],
            [[1 => 1], [0 => 0, 1 => 1]],
            [[1 => 'a'], [0 => 'b', 1 => 'a']],
            [['first' => 1], ['zero' => 0, 'first' => 1]],
            [
                [
                    1 => 2,
                    2 => 3,
                    3 => 4,
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
     * @dataProvider unsetFirstDataProviderTwo
     * @param $expected
     * @param $actual
     */
    public function functionUnsetFirstTwo($expected, $actual): void
    {
        $this->assertEquals(array_values($expected), array_values(array_unset_first($actual)));
    }

    public function unsetFirstDataProviderTwo(): array
    {
        return [
            [[], [1]],
            [[1], [0, 1]],
            [[], ['a']],
            [['b'], ['a', 'b']],
            [[2, 3, 4,], [1, 2, 3, 4,],],
            [[[2, 3, 4,]], [1, [2, 3, 4,]],],
        ];
    }
}
