<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use PHPUnit\Framework\TestCase;
use function AlecRabbit\formatted_array;

class FormattedArrayTest extends TestCase
{
    /**
     * @test
     * @dataProvider formattedArrayDataProvider
     * @param array $expected
     * @param array $args
     */
    public function formattedArray(array $expected, array $args): void
    {
        dump($expected);
//        dump(formatted_array(...$args));
        $this->assertEquals($expected, formatted_array(...$args));
    }

    public function formattedArrayDataProvider(): array
    {
        return [
//            [['1'], [[1]]],
//            [['1 2 3 4 5 6 7 8 9 1'], [[1, 2, 3, 4, 5, 6, 7, 8, 9, 1]]],
//            [[], [[]]],
//            [
//                [
//                    0 => '1 2',
//                    1 => '3 4',
//                    2 => '5 6',
//                    3 => '7 8',
//                    4 => '9',
//                ]
//                ,
//                [
//                    [1, 2, 3, 4, 5, 6, 7, 8, 9],
//                    2
//                ],
//            ],
//            [
//                [
//                    '1 2',
//                    '3 4',
//                    '5 6',
//                ],
//                [
//                    [
//                        1 => 1,
//                        2 => 2,
//                        3 => 3,
//                        4 => 4,
//                        5 => 5,
//                        6 => 6,
//                    ],
//                    2,
//                ],
//            ],
//            [
//                [
//                    0 => '[1] 1 [2] 2',
//                    1 => '[3] 3 [4] 4',
//                    2 => '[5] 5 [6] 6',
//                ],
//                [
//                    [
//                        1 => 1,
//                        2 => 2,
//                        3 => 3,
//                        4 => 4,
//                        5 => 5,
//                        6 => 6,
//                    ],
//                    2,
//                    function (&$value, $key) {
//                        $value = '[' . $key . '] ' . $value;
//                    },
//                ],
//            ],
//            [
//                [
//                    0 => '[1] 1 [2] 2',
//                    1 => '[3] 3 [4] 4',
//                    2 => '[5] 5 [6] 6',
//                    3 => '[7] 0'
//                ],
//                [
//                    [
//                        1 => 1,
//                        2 => 2,
//                        3 => 3,
//                        4 => 4,
//                        5 => 5,
//                        6 => 6,
//                        7 => 0,
//                    ],
//                    2,
//                    function (&$value, $key) {
//                        $value = '[' . $key . '] ' . $value;
//                    },
//                ],
//            ],
//            [['1'], [[true]]],
//            [[''], [[false]]],
//            [['0'], [[0]]],
//            [[''], [[null]]],
//            [['1 2 3 4 5 6 7 8 9 0'], [[1, 2, 3, 4, 5, 6, 7, 8, 9, 0]]],
//            [[''], [['']]],


            [['', '', '',], [['', '', '', '', '', ''], 2]],
            [['', '', '',], [['', null, '', false, '', ''], 2]],
            [['1 1', '2 2', ' ',], [[1, 1, 2, 2, ''], 2]],
            [['1 1', '2 2', '  3',], [[1, 1, 2, 2, null, 3], 2]],
            [['1 1 1', '2 2 2', '3   3',], [[1, 1, 1, 2, 2, 2, 3, null, 3], 3]],
        ];
    }

//    /** @test */
//    public function FunctionFormattedArray(): void
//    {
//        $expectedResult =
//            [
//                0 => '1 2',
//                1 => '3 4',
//                2 => '5 6',
//                3 => '7 8',
//                4 => '9',
//            ];
//        $this->assertEquals($expectedResult, formatted_array([1, 2, 3, 4, 5, 6, 7, 8, 9], 2));
//
//        $expectedResult =
//            [
//                0 => '1 2 3',
//                1 => '4 5 6',
//                2 => '7 8 9',
//            ];
//        $this->assertEquals(
//            $expectedResult,
//            formatted_array([1, 2, 3, 4, 5, 6, 7, 8, 9], 3));
//
//        $expectedResult =
//            [
//                0 => '[0] a  [1] b  [2] c ',
//                1 => '[3] d  [4] e  [5] f ',
//                2 => '[6] g  [7] h  [8] i ',
//                3 => '[9] k  [10] l [11] m',
//                4 => '[12] n',];
//
//        $this->assertEquals(
//            $expectedResult,
//            formatted_array(['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'k', 'l', 'm', 'n'],
//                3,
//                function (string &$value, $key) {
//                    $value = brackets((string)$key) . ' ' . $value;
//                }
//            ));
//
//        $expectedResult =
//            [
//                0 => '    a         b         c    ',
//                1 => '    d         e         f    ',
//                2 => '    g         h    ',
//            ];
//
//        $this->assertEquals(
//            $expectedResult,
//            formatted_array(['a', 'b', 'c', '    d    ', 'e', 'f', 'g', 'h',],
//                3,
//                null,
//                STR_PAD_BOTH
//            ));
//
//        $expectedResult =
//            [
//                0 => '       a        b        c',
//                1 => '       d        e        f',
//                2 => '       g        h',
//            ];
//
//        $this->assertEquals(
//            $expectedResult,
//            formatted_array(['a', 'b', 'c', '       d', 'e', 'f', 'g', 'h',],
//                3,
//                null,
//                STR_PAD_LEFT
//            ));
//    }
//
}