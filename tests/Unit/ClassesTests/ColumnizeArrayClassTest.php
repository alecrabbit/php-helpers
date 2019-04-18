<?php declare(strict_types=1);


namespace AlecRabbit\Tests\Helpers\Unit\ClassesTests;

use AlecRabbit\Helpers\Classes\ColumnizeArray;
use AlecRabbit\Tests\Helpers\HelpersTestCase;
use function AlecRabbit\Helpers\callMethod;

class ColumnizeArrayClassTest extends HelpersTestCase
{
    /**
     * @test
     * @dataProvider formattedArrayDataProvider
     * @param array $expected
     * @param array $args
     */
    public function formattedArray(array $expected, array $args): void
    {
        $this->assertEquals($expected, ColumnizeArray::process(...$args));
    }

    /**
     * @test
     * @dataProvider formattedArrayWithExceptionDataProvider
     * @param string $expectedException
     * @param array $args
     */
    public function formattedArrayWithException(string $expectedException, array $args): void
    {
        $this->expectException($expectedException);
        $this->assertEquals(null, ColumnizeArray::process(...$args), self::EXCEPTION_EXPECTED);
    }

    public function formattedArrayDataProvider(): array
    {
        return [
            [['1'], [[1]]],
            [['1 2 3 4 5 6 7 8 9 1'], [[1, 2, 3, 4, 5, 6, 7, 8, 9, 1]]],
            [[], [[]]],
            [
                [
                    0 => '1 2',
                    1 => '3 4',
                    2 => '5 6',
                    3 => '7 8',
                    4 => '9',
                ]
                ,
                [
                    [1, 2, 3, 4, 5, 6, 7, 8, 9],
                    2,
                ],
            ],
            [
                [
                    '1 2',
                    '3 4',
                    '5 6',
                ],
                [
                    [
                        1 => 1,
                        2 => 2,
                        3 => 3,
                        4 => 4,
                        5 => 5,
                        6 => 6,
                    ],
                    2,
                ],
            ],
            [
                [
                    0 => '[1] 1 [2] 2',
                    1 => '[3] 3 [4] 4',
                    2 => '[5] 5 [6] 6',
                ],
                [
                    [
                        1 => 1,
                        2 => 2,
                        3 => 3,
                        4 => 4,
                        5 => 5,
                        6 => 6,
                    ],
                    2,
                    function (&$value, $key) {
                        $value = '[' . $key . '] ' . $value;
                    },
                ],
            ],
            [
                [
                    0 => '[1] 1 [2] 2',
                    1 => '[3] 3 [4] 4',
                    2 => '[5] 5 [6] 6',
                    3 => '[7] 0',
                ],
                [
                    [
                        1 => 1,
                        2 => 2,
                        3 => 3,
                        4 => 4,
                        5 => 5,
                        6 => 6,
                        7 => 0,
                    ],
                    2,
                    function (&$value, $key) {
                        $value = '[' . $key . '] ' . $value;
                    },
                ],
            ],
            [['1'], [[true]]],
            [[''], [[false]]],
            [['0'], [[0]]],
            [[''], [[null]]],
            [['1 2 3 4 5 6 7 8 9 0'], [[1, 2, 3, 4, 5, 6, 7, 8, 9, 0]]],
            [[''], [['']]],
            [['', '', '',], [['', '', '', '', '', ''], 2]],
            [['', '', '',], [['', null, '', false, '', ''], 2]],
            [['1 1', '2 2', ' ',], [[1, 1, 2, 2, ''], 2]],
            [['1 1', '2 2', '  3',], [[1, 1, 2, 2, null, 3], 2]],
            [['1 1 1', '2 2 2', '3   3',], [[1, 1, 1, 2, 2, 2, 3, null, 3], 3]],
            [
                [
                    0 => ' [0] a  [1] b  [2] c',
                    1 => ' [3] d  [4] e  [5] f',
                    2 => ' [6] g  [7] h  [8] i',
                    3 => ' [9] k [10] l [11] m',
                    4 => '[12] n [13] 0',
                ],
                [
                    ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'k', 'l', 'm', 'n', '0'],
                    3,
                    function (&$value, $key) {
                        $value = '[' . $key . '] ' . $value;
                    },
                    STR_PAD_LEFT,
                ],
            ],
            [
                [
                    0 => '       a        b        c',
                    1 => '       d        e        f',
                    2 => '       g        h',
                ],
                [
                    ['a', 'b', 'c', '       d', 'e', 'f', 'g', 'h',],
                    3,
                    null,
                    STR_PAD_LEFT,
                ],
            ],
            [
                [
                    0 => '    a         b         c    ',
                    1 => '    d         e         f    ',
                    2 => '    g         h    ',
                ],
                [
                    ['a', 'b', 'c', '    d    ', 'e', 'f', 'g', 'h',],
                    3,
                    null,
                    STR_PAD_BOTH,
                ],
            ],
        ];
    }

    public function formattedArrayWithExceptionDataProvider(): array
    {
        return
            [
                [\RuntimeException::class, [[[[]]]]],
                [
                    \TypeError::class,
                    [[], ''],
                ],
                [
                    \TypeError::class,
                    [[], 1, 1],
                ],
                [
                    \TypeError::class,
                    [
                        [],
                        1,
                        function () {
                        },
                        '',
                    ],
                ],
            ];
    }

    /**
     * @test
     * @dataProvider arrElMaxLengthDataProvider
     * @param $expected
     * @param $array
     */
    public function internalArrElMaxLength($expected, $array): void
    {
        $this->assertEquals($expected, callMethod(new ColumnizeArray(), 'getMaxLength', $array, null));
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

    /**
     * @test
     * @dataProvider updateResultDataProvider
     * @param array $expected
     * @param array $result
     * @param bool $rowEmpty
     * @param array $tmp
     */
    public function internalUpdateResult($expected, $result, $rowEmpty, $tmp): void
    {
        [$result, $rowEmpty, $tmp] = callMethod(new ColumnizeArray(), 'updateResult', $result, $rowEmpty, $tmp);
        $this->assertTrue($rowEmpty);
        $this->assertEquals([], $tmp);
        $this->assertEquals($expected, $result);
    }

    public function updateResultDataProvider(): array
    {
        return [
            [[''], [], true, []],
            [[''], [], false, []],
            [['1 2'], [], false, [1, 2]],
            [['12'], [], true, [1, 2]],
        ];
    }
}
