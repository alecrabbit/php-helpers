<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use function AlecRabbit\Helpers\inRange;

class InRangeTest extends HelpersTestCase
{
    /**
     * @test
     * @dataProvider inRangeDataProvider
     * @param bool $expected
     * @param array $args
     */
    public function functionInRange(bool $expected, array $args): void
    {
        $this->assertSame($expected, inRange(...$args));
    }

    public function inRangeDataProvider(): array
    {
        return [
            [true, [2, 1, 2]],
            [true, [1, 1, 2]],
            [true, [10, 10, 22]],
            [true, [10, 22, 10]],
            [false, [0, 1, 2]],
            [false, [-10, 20, 280]],
            [false, [1000, 20, 280]],
        ];
    }
}
