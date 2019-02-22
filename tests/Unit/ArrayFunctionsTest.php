<?php
/**
 * User: alec
 * Date: 12.10.18
 * Time: 15:29
 */

namespace AlecRabbit\Tests\Helpers;

use function \AlecRabbit\arr_el_max_length;
use function \AlecRabbit\array_key_first;
use function \AlecRabbit\array_key_last;
use function \AlecRabbit\brackets;
use function \AlecRabbit\formatted_array;
use function \AlecRabbit\unset_first;
use PHPUnit\Framework\TestCase;

class ArrayFunctionsTest extends TestCase
{

    /**
     * @test
     * @dataProvider arrayKeyFirstDataProvider
     * @param $expected
     * @param $data
     */
    public function functionArrayKeyFirst($expected, $data): void
    {
        $this->assertEquals($expected, array_key_first($data));
    }

    public function arrayKeyFirstDataProvider(): array
    {
        return [
            [null, []],
            [1, [1 => 1, 2 => 2]],
            ['1', ['1' => 1, 0 => 2]],
        ];
    }
    /**
     * @test
     * @dataProvider arrayKeyLastDataProvider
     * @param $expected
     * @param $data
     */
    public function functionArrayKeyLast($expected, $data): void
    {
        $this->assertEquals($expected, array_key_last($data));
    }

    public function arrayKeyLastDataProvider(): array
    {
        return [
            [null, []],
            [2, [1 => 1, 2 => 2]],
            [0, ['1' => 1, 0 => 2]],
        ];
    }

}
