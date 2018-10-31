<?php
/**
 * User: alec
 * Date: 12.10.18
 * Time: 14:07
 */

namespace Unit;


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

    /** @test */
    public function FunctionBcBoundsString(): void
    {
        $this->assertEquals(
            '1.1245535354656456435535124124124123',
            bc_bounds(
                '1.1245535354656456435535124124124123',
                '1.1241243235645645643258351241242',
                '1.1245535354656456435535124124124125',
                35
            )
        );
        $this->assertEquals(
            '1.1241243235645645643258351241242',
            bc_bounds(
                '1.1241243235645645643258351241242',
                '1.1241243235645645643258351241242',
                '1.1245535354656456435535124124124125',
                35
            )
        );
        $this->assertEquals(
            '1.1241243235645645643258351241242',
            bc_bounds(
                '1.1241243235645645643258351241241',
                '1.1241243235645645643258351241242',
                '1.1245535354656456435535124124124125',
                31
            )
        );
        bc_bounds('1.1241243236', '1.1241243235', '1.1245535354', 10);

        $this->assertEquals(
            '1.1241243236',
            bc_bounds(
                '1.1241243236',
                '1.1241243235',
                '1.1245535354',
                10
            )
        );
    }

}