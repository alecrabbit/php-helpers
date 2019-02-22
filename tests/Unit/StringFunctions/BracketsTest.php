<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use function AlecRabbit\brackets;
use const AlecRabbit\Helpers\Constants\BRACKETS_ANGLE;
use const AlecRabbit\Helpers\Constants\BRACKETS_CURLY;
use const AlecRabbit\Helpers\Constants\BRACKETS_PARENTHESES;
use const AlecRabbit\Helpers\Constants\BRACKETS_SQUARE;

class BracketsTest extends HelpersTestCase
{
    /**
     * @test
     * @dataProvider bracketsDataProvider
     * @param string $expected
     * @param array $args
     */
    public function functionBrackets($expected, $args): void
    {
        $this->assertEquals($expected, brackets(...$args));
    }

    public function bracketsDataProvider(): array
    {
        $str = 'str';
        return [
            ['[' . $str . ']', [$str]],
            ['[' . $str . ']', [$str, BRACKETS_SQUARE]],
            ['{' . $str . '}', [$str, BRACKETS_CURLY]],
            ['(' . $str . ')', [$str, BRACKETS_PARENTHESES]],
            ['⟨' . $str . '⟩', [$str, BRACKETS_ANGLE]],
        ];
    }

    /**
     * @test
     * @dataProvider bracketsDataProviderExceptions
     * @param string $expected
     * @param array $args
     */
    public function functionBracketsExceptions($expected, $args): void
    {
        $this->expectException($expected);
        $this->assertEquals($expected, brackets(...$args));
    }

    public function bracketsDataProviderExceptions(): array
    {
        return [
            [\ArgumentCountError::class, []],
            [\TypeError::class, ['str', null]],
            [\InvalidArgumentException::class, ['str', 100]],
        ];
    }

    /** @test */
    public function functionBracketsTwo(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->assertEquals('"str', brackets('str', 100));
    }
}
