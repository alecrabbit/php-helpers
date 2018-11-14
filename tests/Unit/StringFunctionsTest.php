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
    public function FunctionTag(): void
    {
        $this->assertEquals('<br>str</br>', tag('str', 'br'));
        $this->assertEquals('str', tag('str'));
    }

    /** @test */
    public function FunctionBrackets(): void
    {
        $this->assertEquals('[str]', brackets('str'));
        $this->assertEquals('[str]', brackets('str', BRACKETS_SQUARE));
        $this->assertEquals('{str}', brackets('str', BRACKETS_CURLY));
        $this->assertEquals('(str)', brackets('str', BRACKETS_PARENTHESES));
        $this->assertEquals('⟨str⟩', brackets('str', BRACKETS_ANGLE));
        $this->expectException('TypeError');
        $this->assertEquals('<ddstr/dd>', brackets('str', null));
    }

    /** @test */
    public function FunctionStrDecorate(): void
    {
        $this->assertEquals('str', str_decorate('str'));
        $this->assertEquals('"str"', str_decorate('str', '"'));
        $this->assertEquals('"str"', str_decorate('str', '"', '"'));
        $this->assertEquals('>str<', str_decorate('str', '>', '<'));
        $this->assertEquals('-str-', str_decorate('str', '-'));
    }

    /** @test */
    public function FunctionBracketsTwo(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->assertEquals('"str', brackets('str', 100));
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
        $this->assertEquals('1024B', format_bytes(1024 ** 1, 'b'));
        $this->assertEquals('1048576B', format_bytes(1024 ** 2, 'b'));
        $this->assertEquals('23535235B', format_bytes(23535235, 'b'));
    }

    /**
     * @test
     * @dataProvider  FormatBytesUsesUnitsCorrectlyProvider
     * @param $expected
     * @param $bytes
     * @param $unit
     * @param $decimals
     */
    public function FunctionFormatBytesUsesUnitsCorrectly($expected, $bytes, $unit, $decimals): void
    {
        $this->assertEquals($expected, format_bytes($bytes, $unit, $decimals));
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

    public function FormatBytesUsesUnitsCorrectlyProvider(): array
    {
        return [
            ['1058.8MB', 1110235512, 'MB', 1,],
            ['1058.80MB', 1110235512, 'MB', 2,],
            ['1058.803MB', 1110235512, 'MB', 3,],
            ['1058.8031MB', 1110235512, 'MB', 4,],
            ['1058.80309MB', 1110235512, 'MB', 5,],
            ['1058.803093MB', 1110235512, 'MB', 6,],
            ['1058.8030930MB', 1110235512, 'MB', 7,],
            ['1058.80309296MB', 1110235512, 'MB', 8,],
            ['1058.803092957MB', 1110235512, 'MB', 9,],

            ['1.0KB', 1035, 'KB', 1],
            ['1.01KB', 1035, 'KB', 2],
            ['1.011KB', 1035, 'KB', 3],
            ['1.0107KB', 1035, 'KB', 4],
            ['1.01074KB', 1035, 'KB', 5],

            ['1058.8MB', 1110235512, 'mB', 1],
            ['1058.80MB', 1110235512, 'Mb', 2],
            ['1084214.37KB', 1110235512, 'kb', 2],

            ['1058.803092956542968750000000MB', 1110235512, 'MB', 29,],
        ];
    }

}
