<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use function AlecRabbit\env;

class EnvTest extends HelpersTestCase
{
    /**
     * @test
     * @dataProvider envDataProvider
     * @param $expected
     * @param $variableName
     * @param $default
     */
    public function functionEnvDefaults($expected, $variableName, $default): void
    {
        $this->assertEquals($expected, env($variableName, $default));
    }

    /**
     * @test
     * @dataProvider envWithPutDataProvider
     * @param $expected
     * @param $variableName
     */
    public function functionEnvWithPut($expected, $variableName): void
    {
        \putenv("{$variableName}={$expected}");
        $this->assertEquals($expected, env($variableName));
    }

    /**
     * @test
     * @dataProvider envWithPutValueDataProvider
     * @param $expected
     * @param $variableName
     * @param $putValue
     */
    public function functionEnvWithPutValue($expected, $variableName, $putValue): void
    {
        putenv("{$variableName}={$putValue}");
        $this->assertEquals($expected, env($variableName));
    }

    public function envDataProvider(): array
    {
        return [
            // [$expected, $variableName, $default],
            ['', 'FOO_BAR', null],
            ['', 'FOO_BAR', 'null'],
            ['', 'FOO_BAR', '(null)'],
            [true, 'FOO_BAR', true],
            [true, 'FOO_BAR', 'true'],
            [true, 'FOO_BAR', '(true)'],
            [false, 'FOO_BAR', false],
            [false, 'FOO_BAR', 'false'],
            [false, 'FOO_BAR', '(false)'],
            ['value', 'FOO_BAR', '"value"'],
            ['value', 'FOO_BAR', 'value'],
            ['value', 'FOO_BAR', '(value)'],
            ['', 'FOO_BAR', 'empty'],
            ['', 'FOO_BAR', '(empty)'],
            ['some_value', 'FOO_BAR', 'some_value'],
            ['some value', 'FOO_BAR', '"some value"'],
            ['Some Value', 'FOO_BAR', '"Some Value"'],
            [
                'Some Value',
                'FOO_BAR',
                function () {
                    return '"Some Value"';
                },
            ],
        ];
    }

    public function envWithPutDataProvider(): array
    {
        return [
            // [$expected, $variableName],
            ['', 'FOO_BAR',],
            [true, 'FOO_BAR',],
            [false, 'FOO_BAR'],
            [1, 'FOO_BAR'],
            ['value', 'FOO_BAR'],
            [null, 'FOO_BAR'],
        ];
    }

    public function envWithPutValueDataProvider(): array
    {
        return [
            // [$expected, $variableName, $putValue],
            [1, 'FOO_BAR', 1],
            ['', 'FOO_BAR', null],
            ['', 'FOO_BAR', 'null'],
            ['', 'FOO_BAR', '(null)'],
            [true, 'FOO_BAR', true],
            [true, 'FOO_BAR', 'true'],
            [true, 'FOO_BAR', '(true)'],
            [false, 'FOO_BAR', false],
            [false, 'FOO_BAR', 'false'],
            [false, 'FOO_BAR', '(false)'],
            ['value', 'FOO_BAR', '"value"'],
            ['value', 'FOO_BAR', 'value'],
            ['value', 'FOO_BAR', '(value)'],
            ['', 'FOO_BAR', 'empty'],
            ['', 'FOO_BAR', '(empty)'],
            ['some_value', 'FOO_BAR', 'some_value'],
            ['some value', 'FOO_BAR', '"some value"'],
            ['Some Value', 'FOO_BAR', '"Some Value"'],
        ];
    }
}
