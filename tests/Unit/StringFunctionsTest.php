<?php
/**
 * User: alec
 * Date: 12.10.18
 * Time: 15:29
 */

namespace Unit;


use PHPUnit\Framework\TestCase;

class StringFunctionsTest extends TestCase
{
    /** @test */
    public function FunctionTag()
    {
        $this->assertEquals('<br>str</br>', tag('str', 'br'));
        $this->assertEquals('str', tag('str'));
    }

    /** @test */
    public function FunctionBrackets()
    {
        $this->assertEquals('[str]', brackets('str'));
        $this->assertEquals('[str]', brackets('str', BRACKETS_SQUARE));
        $this->assertEquals('{str}', brackets('str', BRACKETS_CURLY));
        $this->assertEquals('(str)', brackets('str', BRACKETS_PARENTHESES));
        $this->assertEquals('⟨str⟩', brackets('str', BRACKETS_ANGLE));
        $this->assertEquals('<ddstr/dd>', brackets('str', null, '<dd', '/dd>'));
    }

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
    }

    /** @test */
    public function FunctionFormatBytesProcessParametersCorrectly(): void
    {
        $this->assertEquals('1.00KB', format_bytes(1024, null, 2));
        $this->assertEquals('1.000KB', format_bytes(1024, null, 3));
        $this->assertEquals('1.000KB', format_bytes(1024, 1, 3));
        $this->expectException('TypeError');
        $this->assertEquals('1.000KB', format_bytes(1024, null, 'sdsd'));
        $this->assertEquals('1.000KB', format_bytes(1024, [], 'sdsd'));
    }

    /** @test */
    public function FunctionFormatBytesProcessFormattingCorrectly(): void
    {
        $this->assertEquals('1.00KB', format_bytes(1024 ** 1));
        $this->assertEquals('1.00MB', format_bytes(1024 ** 2));
        $this->assertEquals('1.00GB', format_bytes(1024 ** 3));
        $this->assertEquals('1.00TB', format_bytes(1024 ** 4));
        $this->assertEquals('1.00PB', format_bytes(1024 ** 5));
    }

    /** @test */
    public function FunctionFormatBytesProcessBytesFormattingCorrectly(): void
    {
        $this->assertEquals('1024B', format_bytes(1024 ** 1,'b'));
        $this->assertEquals('1048576B', format_bytes(1024 ** 2,'b'));
        $this->assertEquals('23535235B', format_bytes(23535235,'b'));
    }

    /** @test */
    public function FunctionFormatBytesCalculatesKilobytesCorrectly(): void
    {
        // 1.010742188  = 1035 Bytes
        $this->assertEquals('1.0KB', format_bytes(1035, 'KB', 1));
        $this->assertEquals('1.01KB', format_bytes(1035, 'KB', 2));
        $this->assertEquals('1.011KB', format_bytes(1035, 'KB', 3));
        $this->assertEquals('1.0107KB', format_bytes(1035, 'KB', 4));
        $this->assertEquals('1.01074KB', format_bytes(1035, 'KB', 5));
    }

    /** @test */
    public function FunctionFormatBytesCalculatesMegabytesCorrectly(): void
    {
        // 1058.803092957  = 1110235512 Bytes
        $this->assertEquals('1058.8MB', format_bytes(1110235512, 'MB', 1));
        $this->assertEquals('1058.80MB', format_bytes(1110235512, 'MB', 2));
        $this->assertEquals('1058.803MB', format_bytes(1110235512, 'MB', 3));
        $this->assertEquals('1058.8031MB', format_bytes(1110235512, 'MB', 4));
        $this->assertEquals('1058.80309MB', format_bytes(1110235512, 'MB', 5));
        $this->assertEquals('1058.803093MB', format_bytes(1110235512, 'MB', 6));
        $this->assertEquals('1058.8030930MB', format_bytes(1110235512, 'MB', 7));
        $this->assertEquals('1058.80309296MB', format_bytes(1110235512, 'MB', 8));
        $this->assertEquals('1058.803092957MB', format_bytes(1110235512, 'MB', 9));
    }

    /** @test */
    public function FunctionFormatBytesProcessesLowercaseCorrectly(): void
    {
        // 1058.803092957  = 1110235512 Bytes
        $this->assertEquals('1058.8MB', format_bytes(1110235512, 'mB', 1));
        $this->assertEquals('1058.80MB', format_bytes(1110235512, 'Mb', 2));
        $this->assertEquals('1084214.37KB', format_bytes(1110235512, 'kb', 2));
    }

    /** @test */
    public function FunctionFormatBytesProcessNegativeCorrectly(): void
    {
        $this->assertEquals('-1024B', format_bytes(-1024, 'B'));
        $this->assertEquals('-1.00KB', format_bytes(-1024));
        $this->assertEquals('-1.18MB', format_bytes(-1234024));
    }

    /** @test */
    public function FunctionFormatBytesProcessFloatCorrectly(): void
    {
        $this->assertEquals('1B', format_bytes(1.9));
        $this->assertEquals('0B', format_bytes(0.3));
    }

    /** @test */
    public function FunctionFormatBytesProcessBigNumbersCorrectly(): void
    {
        $this->assertEquals('1.999999999068677425384521GB', format_bytes(2147483647, null, 24));
        if (PHP_INT_MAX > 2147483647) {
            $this->assertEquals('3.862645148299634456634521GB', format_bytes(4147483647, null, 24));
            $this->assertEquals('8.000000000000000000000000EB', format_bytes(9223372036854775807, null, 24));
            $this->expectException('TypeError');
            $this->assertEquals('8.000000000000000000000000EB', format_bytes(9323372036854775807, null, 24));
        } else {
            $this->expectException('TypeError');
            $this->assertEquals('3.862645148299634456634521GB', format_bytes(4147483647, null, 24));
        }
    }

}
