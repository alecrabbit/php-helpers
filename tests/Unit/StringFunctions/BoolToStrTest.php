<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use function AlecRabbit\boolToStr;
use const AlecRabbit\Helpers\Strings\Constants\STR_FALSE;
use const AlecRabbit\Helpers\Strings\Constants\STR_NULL;
use const AlecRabbit\Helpers\Strings\Constants\STR_TRUE;

class BoolToStrTest extends HelpersTestCase
{
    /**
     * @test
     * @dataProvider boolToStrDataProvider
     * @param string $expected
     * @param array $args
     */
    public function functionBoolToStr($expected, $args): void
    {
        $this->assertEquals($expected, boolToStr(...$args));
    }

    public function boolToStrDataProvider(): array
    {
        return [
            [STR_TRUE, [true]],
            [STR_FALSE, [false]],
            [STR_NULL, [null]],
        ];
    }

    /**
     * @test
     * @dataProvider boolToStrDataProviderExceptions
     * @param string $expected
     * @param array $args
     */
    public function functionBoolToStrExceptions($expected, $args): void
    {
        $this->expectException($expected);
        $this->assertEquals($expected, boolToStr(...$args));
    }

    public function boolToStrDataProviderExceptions(): array
    {
        return [
            [
                \TypeError::class,
                [1],
            ],
            [
                \TypeError::class,
                [new \stdClass()],
            ],
            [
                \TypeError::class,
                ['new \stdClass()'],
            ],
        ];
    }
}
