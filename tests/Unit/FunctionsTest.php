<?php
/**
 * User: alec
 * Date: 14.11.18
 * Time: 15:23
 */
declare(strict_types=1);

namespace Unit;


use PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase
{

    /**
     * @test
     * @dataProvider envDataProvider
     * @param $expected
     * @param $variableName
     * @param $default
     */
    public function FunctionEnvDefaults($expected, $variableName, $default): void
    {

        $this->assertEquals($expected, env($variableName, $default));
    }

    /**
     * @test
     * @dataProvider envWithPutDataProvider
     * @param $expected
     * @param $variableName
     */
    public function FunctionEnvWithPut($expected, $variableName): void
    {
        putenv("{$variableName}={$expected}");
        $this->assertEquals($expected, env($variableName));
    }

    /**
     * @test
     * @dataProvider envWithPutValueDataProvider
     * @param $expected
     * @param $variableName
     * @param $putValue
     */
    public function FunctionEnvWithPutValue($expected, $variableName, $putValue): void
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
                }],
        ];
    }

    public function envWithPutDataProvider(): array
    {
        return [
            // [$expected, $variableName],
            ['', 'FOO_BAR',],
            [true, 'FOO_BAR',],
            [false, 'FOO_BAR'],
        ];
    }

    public function envWithPutValueDataProvider(): array
    {
        return [
            // [$expected, $variableName, $putValue],
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