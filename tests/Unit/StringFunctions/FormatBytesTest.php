<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use function AlecRabbit\format_bytes;
use const AlecRabbit\Helpers\Constants\PHP_ARCH;

class FormatBytesTest extends HelpersTestCase
{
    /** @test */
    public function functionFormatBytesProcessBigNumbersCorrectly(): void
    {
        $this->assertEquals('1.999999999068677425384521GB', format_bytes(2147483647, null, 24));
        if (PHP_INT_MAX > 2147483647) {
            $this->assertEquals('3.862645148299634456634521GB', format_bytes(4147483647, null, 24));
            $this->assertEquals('8.000000000000000000000000EB', format_bytes(9223372036854775807, null, 24));
            $this->expectException(\TypeError::class);
            $this->assertEquals('8.000000000000000000000000EB', format_bytes(9323372036854775807, null, 24));
        } else {
            $this->expectException(\TypeError::class);
            $this->assertEquals('3.862645148299634456634521GB', format_bytes(4147483647, null, 24));
        }
    }

    /**
     * @test
     * @dataProvider  FormatBytesUsesUnitsCorrectlyProvider
     * @param string $expected
     * @param array $args
     */
    public function functionFormatBytes(string $expected, array $args): void
    {
        $this->assertEquals($expected, format_bytes(...$args));
    }

    public function formatBytesUsesUnitsCorrectlyProvider(): array
    {
        $arr = [
            ['1059MB', [1110235512, 'MB', -1,],],
            ['1059MB', [1110235512, 'MB', 0,],],
            ['1058.8MB', [1110235512, 'MB', 1,],],
            ['1058.80MB', [1110235512, 'MB', 2,],],
            ['1058.803MB', [1110235512, 'MB', 3,],],
            ['1058.8031MB', [1110235512, 'MB', 4,],],
            ['1058.80309MB', [1110235512, 'MB', 5,],],
            ['1058.803093MB', [1110235512, 'MB', 6,],],
            ['1058.8030930MB', [1110235512, 'MB', 7,],],
            ['1058.80309296MB', [1110235512, 'MB', 8,],],
            ['1058.803092957MB', [1110235512, 'MB', 9,],],

            ['1.0KB', [1035, 'KB', 1],],
            ['1.01KB', [1035, 'KB', 2],],
            ['1.011KB', [1035, 'KB', 3],],
            ['1.0107KB', [1035, 'KB', 4],],
            ['1.01074KB', [1035, 'KB', 5],],

            ['1.00KB', [1024 ** 1,],],
            ['1.00MB', [1024 ** 2,],],
            ['1.00GB', [1024 ** 3,],],

            ['1058.8MB', [1110235512, 'mB', 1],],
            ['1058.80MB', [1110235512, 'Mb', 2],],
            ['1084214.37KB', [1110235512, 'kb', 2],],

            ['1.00KB', [1024, null, 2],],
            ['1.000KB', [1024, null, 3],],
            ['1.000KB', [1024, 'KB', 3],],

            ['1024B', [1024 ** 1, 'b',],],
            ['1048576B', [1024 ** 2, 'B',],],
            ['23535235B', [23535235, 'b',],],
            ['23,535,235B', [23535235, 'b', null, '.', ','],],
            ['22,983.63KB', [23535235, 'kb', null, '.', ','],],

            ['-1024B', [-1024, 'B',],],
            ['-1.00KB', [-1024,],],
            ['-1.18MB', [-1234024,],],

            ['1B', [1,],],
            ['0B', [0,],],

            ['1058.803092956542968750000000MB', [1110235512, 'MB', 29,],],
        ];
        if (64 === PHP_ARCH) {
            $arr[] = ['1009753315884.15MB', [1058803092956542968, 'MB', 2,],];
            $arr[] = ['1.00TB', [1024 ** 4,],];
            $arr[] = ['1.00PB', [1024 ** 5,],];
        } elseif (32 === PHP_ARCH) {
            $arr[] = ['2048.00MB', [2147483647, 'MB', 2,],];
        } else {
            throw new \RuntimeException('Unknown architecture nor 64bit nor 32bit.');
        }

        return $arr;
    }
}
