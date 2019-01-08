<?php
/**
 * User: alec
 * Date: 12.10.18
 * Time: 15:29
 */

namespace AlecRabbit\Tests\Helpers;


use function AlecRabbit\format_time_auto;
use PHPUnit\Framework\TestCase;
use function AlecRabbit\brackets;
use function AlecRabbit\format_bytes;
use function AlecRabbit\format_time;
use function AlecRabbit\str_decorate;
use function AlecRabbit\tag;
use const AlecRabbit\Helpers\Constants\BRACKETS_ANGLE;
use const AlecRabbit\Helpers\Constants\BRACKETS_CURLY;
use const AlecRabbit\Helpers\Constants\BRACKETS_PARENTHESES;
use const AlecRabbit\Helpers\Constants\BRACKETS_SQUARE;
use const AlecRabbit\Helpers\Constants\UNIT_HOURS;
use const AlecRabbit\Helpers\Constants\UNIT_MICROSECONDS;
use const AlecRabbit\Helpers\Constants\UNIT_MINUTES;
use const AlecRabbit\Helpers\Constants\UNIT_SECONDS;

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

    /**
     * @test
     * @dataProvider  FormatBytesUsesUnitsCorrectlyProvider
     * @param $expected
     * @param $bytes
     * @param $unit
     * @param $decimals
     */
    public function FunctionFormatBytes($expected, $bytes, $unit, $decimals): void
    {
        if (null !== $decimals) {
            $this->assertEquals($expected, format_bytes($bytes, $unit, $decimals));
        } else {
            $this->assertEquals($expected, format_bytes($bytes, $unit));
        }

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

    /**
     * @test
     * @dataProvider functionFormatTimeDataProvider
     * @param $expected
     * @param $value
     * @param $units
     * @param $precision
     */
    public function functionFormatTime($expected, $value, $units, $precision): void
    {
        if (null === $precision) {
            $this->assertEquals($expected, format_time($value, $units));
        } else {
            $this->assertEquals($expected, format_time($value, $units, $precision));
        }
    }

    /**
     * @test
     * @dataProvider functionFormatTimeAutoDataProvider
     * @param $expected
     * @param $value
     */
    public function functionFormatTimeAuto($expected, $value): void
    {
        $this->assertEquals($expected, format_time_auto($value));
    }

    public function FormatBytesUsesUnitsCorrectlyProvider(): array
    {
        return [
            ['1059MB', 1110235512, 'MB', -1,],
            ['1059MB', 1110235512, 'MB', 0,],
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

            ['1.00KB', 1024 ** 1, null, null],
            ['1.00MB', 1024 ** 2, null, null],
            ['1.00GB', 1024 ** 3, null, null],
            ['1.00TB', 1024 ** 4, null, null],
            ['1.00PB', 1024 ** 5, null, null],

            ['1058.8MB', 1110235512, 'mB', 1],
            ['1058.80MB', 1110235512, 'Mb', 2],
            ['1084214.37KB', 1110235512, 'kb', 2],

            ['1.00KB', 1024, null, 2],
            ['1.000KB', 1024, null, 3],
            ['1.000KB', 1024, 1, 3],

            ['1024B', 1024 ** 1, 'b', null],
            ['1048576B', 1024 ** 2, 'B', null],
            ['23535235B', 23535235, 'b', null],

            ['-1024B', -1024, 'B', null],
            ['-1.00KB', -1024, null, null],
            ['-1.18MB', -1234024, null, null],

            ['1B', 1.9, null, null],
            ['0B', 0.3, null, null],

            ['1058.803092956542968750000000MB', 1110235512, 'MB', 29,],
        ];
    }

    public function functionFormatTimeDataProvider(): array
    {
        return [
            // [$expected, $value],
            ['100ms', 0.1, null, null],
            ['0.01μs', 0.00000001, UNIT_MICROSECONDS, null],
            ['1000ms', 1.0000000001, null, 7],
            ['1000.01ms', 1.00001, null, 7],
            ['0.000278h', 1.0000000001, UNIT_HOURS, 7],
            ['0.000278h', 1.0000000001, UNIT_HOURS, 6],
            ['0.017m', 1.0000000001, UNIT_MINUTES, 3],
            ['0.016667m', 1.0000000001, UNIT_MINUTES, 7],
            ['0.016667m', 1.0000000001, UNIT_MINUTES, 6],
            ['1s', 1.0000000001, UNIT_SECONDS, 7],
            ['1.02s', 1.02, UNIT_SECONDS, 7],
            ['1.02s', 1.02, UNIT_SECONDS, 4],
        ];
    }

    public function functionFormatTimeAutoDataProvider(): array
    {
        return [
            // [$expected, $value],
            ['2.806h', 10100],
            ['16.83m', 1010],
            ['101s', 101],
            ['1.2s', 1.2],
            ['1s', 1],
            ['100ms', 0.1],
            ['135.2ms', 0.135235555],
            ['1ms', 0.001],
            ['100μs', 0.0001,],
            ['1μs', 0.000001,],
            ['10ns', 0.00000001,],
        ];
    }
}
