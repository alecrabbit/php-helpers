<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use function AlecRabbit\Helpers\bounds;

class BoundsTest extends HelpersTestCase
{
    /**
     * @test
     * @dataProvider boundsDataProvider
     * @param float $expected
     * @param array $args
     */
    public function functionBounds(float $expected, array $args): void
    {
        $this->assertSame($expected, bounds(...$args));
    }

    public function boundsDataProvider(): array
    {
        return [
            [1, [5]],
            [-1, [-5]],
            [0.1, [0.1]],
            [-0.1, [-0.1]],
            [1, [1.000000001]],
            [-1, [-1.000000001]],
            [0.000000012, [0.000000012]],
            [0.000000012, [0.000000012, 0, 1]],
            [0, [-0.000000012, 0, 1]],
            [0.999999, [0.999999, 0, 1]],
        ];
    }
}
