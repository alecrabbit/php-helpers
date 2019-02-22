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
    public function functionBcBounds(): void
    {
        $this->assertEquals(1, bc_bounds(1.000001));
        $this->assertEquals(-1, bc_bounds(-1.0000001));
        $this->assertEquals(1, bc_bounds(5));
        $this->assertEquals(1, bc_bounds(1.0000001, -1, 1, 7));
        $this->assertEquals(2.1E-5, bc_bounds(2.1E-5, 0, 1, 7));
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
