<?php
/**
 * User: alec
 * Date: 12.10.18
 * Time: 15:29
 */

namespace Unit;


use PHPUnit\Framework\TestCase;

class ArrayFunctionsTest extends TestCase
{
    /** @test */
    public function FunctionFormattedArray()
    {
        $expectedResult =
            [
                0 => '1 2',
                1 => '3 4',
                2 => '5 6',
                3 => '7 8',
                4 => '9',
            ];
        $this->assertEquals($expectedResult, formatted_array([1, 2, 3, 4, 5, 6, 7, 8, 9], 2));

        $expectedResult =
            [
                0 => '1 2 3',
                1 => '4 5 6',
                2 => '7 8 9',
            ];
        $this->assertEquals(
            $expectedResult,
            formatted_array([1, 2, 3, 4, 5, 6, 7, 8, 9], 3));

        $expectedResult =
            [
                0 => '[0] a  [1] b  [2] c ',
                1 => '[3] d  [4] e  [5] f ',
                2 => '[6] g  [7] h  [8] i ',
                3 => '[9] k  [10] l [11] m',
                4 => '[12] n',];

        $this->assertEquals(
            $expectedResult,
            formatted_array(['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'k', 'l', 'm', 'n'],
                3,
                function (string &$value, $key) {
                    $value = brackets($key) . ' ' . $value;
                }
            ));

        $expectedResult =
            [
                0 => '    a         b         c    ',
                1 => '    d         e         f    ',
                2 => '    g         h    ',
            ];

        $this->assertEquals(
            $expectedResult,
            formatted_array(['a', 'b', 'c', '    d    ', 'e', 'f', 'g', 'h',],
                3,
                null,
                STR_PAD_BOTH
            ));

        $expectedResult =
            [
                0 => '       a        b        c',
                1 => '       d        e        f',
                2 => '       g        h',
            ];

        $this->assertEquals(
            $expectedResult,
            formatted_array(['a', 'b', 'c', '       d', 'e', 'f', 'g', 'h',],
                3,
                null,
                STR_PAD_LEFT
            ));
    }

    /**
     * @test
     * @dataProvider unsetFirstDataProvider
     * @param $expected
     * @param $actual
     */
    public function functionUnsetFirst($expected, $actual): void
    {
        $this->assertEquals($expected, unset_first($actual));
    }

    public function unsetFirstDataProvider(): array
    {
        return [
            [[], [1]],
            [[1 => 1], [0 => 0, 1 => 1]],
            [[1 => 'a'], [0 => 'b', 1 => 'a']],
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
        $this->assertEquals(array_values($expected), array_values(unset_first($actual)));
    }

    public function unsetFirstDataProviderTwo(): array
    {
        return [
            [[], [1]],
            [[1], [0,1]],
            [[],['a']],
            [['b'],['a','b']],
        ];
    }
}
