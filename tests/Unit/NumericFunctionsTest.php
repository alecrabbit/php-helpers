<?php
/**
 * User: alec
 * Date: 12.10.18
 * Time: 14:07
 */

namespace AlecRabbit\Tests\Helpers;


use function \AlecRabbit\Helpers\bc_bounds;
use function \AlecRabbit\Helpers\bounds;
use function \AlecRabbit\Helpers\is_negative;
use function \AlecRabbit\Helpers\trim_zeros;
use PHPUnit\Framework\TestCase;

class NumericFunctionsTest extends TestCase
{
    /** @test */
    public function FunctionIsNegative(): void
    {
        $this->assertTrue(is_negative(-1));
        $this->assertFalse(is_negative(0));
        $this->assertFalse(is_negative(1));

        $this->assertTrue(is_negative('-1'));
        $this->assertFalse(is_negative('0'));
        $this->assertFalse(is_negative('1'));

        $this->assertTrue(is_negative(-1.00101));
        $this->assertFalse(is_negative(0.0));
        $this->assertFalse(is_negative(1.02030));

        $this->assertTrue(is_negative(false));
        $this->assertFalse(is_negative(null));
        $this->assertFalse(is_negative(true));
    }

    /** @test */
    public function FunctionBounds(): void
    {
        $this->assertEquals(1, bounds(5));
        $this->assertEquals(-1, bounds(-41));
        $this->assertEquals(-0.1, bounds(-0.1));
        $this->assertEquals(0.1, bounds(0.1));
        $this->assertEquals(1, bounds(1.0000001));
        $this->assertEquals(-1, bounds(-1.0000001));
        $this->assertEquals(0.000021, bounds(2.1E-5));
        $this->assertEquals(0.000021, bounds(2.1E-5, 0, 1));

    }

    /** @test */
    public function FunctionBcBounds(): void
    {
        $this->assertEquals(1, bc_bounds(1.000001));
        $this->assertEquals(-1, bc_bounds(-1.0000001));
        $this->assertEquals(1, bc_bounds(5));
        $this->assertEquals(1, bc_bounds(1.0000001, -1, 1, 7));
        $this->assertEquals(2.1E-5, bc_bounds(2.1E-5, 0, 1, 7));
    }

    /**
     * @test
     * @dataProvider trimZerosDataProvider
     * @param $expected
     * @param $value
     */
    public function FunctionTrimZeros($expected, $value): void
    {
        $this->assertEquals($expected, trim_zeros($value));
    }

    /**
     * @test
     * @dataProvider bcBoundsProvider
     * @param $expected
     * @param $value
     * @param $min
     * @param $max
     * @param $scale
     */
    public function FunctionBcBoundsString($expected, $value, $min, $max, $scale): void
    {
        $this->assertEquals($expected, bc_bounds($value, $min, $max, $scale));
    }

    public function trimZerosDataProvider(): array
    {
        return [
            // [$expected, $value]
            ['13', 13.000000],
            ['2.6', 2.6000000],
            ['2.300004', 2.3000040],
        ];
    }

    public function bcBoundsProvider(): array
    {
        return [
            // [$expected, $value, $min, $max, $scale],
            [
                '1.1245535354656456435535124124124123',
                '1.1245535354656456435535124124124123',
                '1.1241243235645645643258351241242',
                '1.1245535354656456435535124124124125',
                35
            ],
            [
                '1.1241243236',
                '1.1241243236',
                '1.1241243235',
                '1.1245535354',
                10],
            [
                '1.12412',
                '1.12412',
                '1.12411',
                '1.12455',
                5
            ],
            [
                '1.1241243235645645643258351241242',
                '1.1241243235645645643258351241242',
                '1.1241243235645645643258351241242',
                '1.1245535354656456435535124124124125',
                35
            ],
            [
                '1.1241243235645645643258351241242',
                '1.1241243235645645643258351241241',
                '1.1241243235645645643258351241242',
                '1.1245535354656456435535124124124125',
                31
            ],
            [
                '1.12412',
                '1.1241243235645645643258351241243',
                '1.1241243235645645643258351241242',
                '1.1245535354656456435535124124124125',
                5
            ],
        ];
    }
}