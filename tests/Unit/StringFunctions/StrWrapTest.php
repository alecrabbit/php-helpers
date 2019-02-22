<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use function AlecRabbit\str_wrap;

class StrWrapTest extends HelpersTestCase
{
    /**
     * @test
     * @dataProvider strWrapDataProvider
     * @param string $expected
     * @param array $args
     */
    public function functionStrWrap(string $expected, array $args): void
    {
        $this->assertEquals($expected, str_wrap(...$args));
    }

    /**
     * @test
     * @dataProvider strWrapDataProviderExceptions
     * @param string $expected
     * @param array $args
     */
    public function functionStrWrapException(string $expected, array $args): void
    {
        $this->expectException($expected);
        $this->assertEquals($expected, str_wrap(...$args));
    }

    public function strWrapDataProvider(): array
    {
        $str = 'str';
        return [
            ['1', ['1']],
            ['"1"', ['1', '"']],
            [$str, [$str]],
            ['"' . $str . '"', [$str, '"']],
            ['1' . $str . '1', [$str, '1']],
            ['1' . $str . '2', [$str, '1', '2']],
            ['"' . $str . '"', [$str, '"', '"']],
            ['>' . $str . '<', [$str, '>', '<']],
            ['-' . $str . '-', [$str, '-']],
            ['-text-', ['text', '-']],
            ['--text--', ['text', '--']],
        ];
    }
    public function strWrapDataProviderExceptions(): array
    {
        return [
            [\ArgumentCountError::class, []],
            [\TypeError::class, ['str', 1]],
        ];
    }
}
