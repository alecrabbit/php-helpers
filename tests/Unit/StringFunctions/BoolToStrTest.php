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
     * @dataProvider BoolToStrDataProviderExceptions
     * @param string $expected
     * @param string $message
     * @param array $args
     */
    public function functionBoolToStrExceptions($expected, $message, $args): void
    {
        $this->expectException($expected);
        $this->expectExceptionMessage($message);
        $this->assertEquals($expected, boolToStr(...$args));
    }

    public function BoolToStrDataProviderExceptions(): array
    {
        return [
            [
                \InvalidArgumentException::class,
                'AlecRabbit\boolToStr expects parameter 1 to null|bool, integer given',
                [1],
            ],
            [
                \InvalidArgumentException::class,
                'AlecRabbit\boolToStr expects parameter 1 to null|bool, stdClass given',
                [new \stdClass()],
            ],
            [
                \InvalidArgumentException::class,
                'AlecRabbit\boolToStr expects parameter 1 to null|bool, string given',
                ['new \stdClass()'],
            ],
        ];
    }
}
