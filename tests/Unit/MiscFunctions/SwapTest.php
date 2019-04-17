<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use function AlecRabbit\Helpers\swap;

class SwapTest extends HelpersTestCase
{
    /**
     * @test
     * @dataProvider swapDataProvider
     * @param array $expected
     * @param array $args
     */
    public function functionSwap(array $expected, array $args): void
    {
        [$expectedVar1, $expectedVar2] = $expected;
        [$var1, $var2] = $args;
        swap($var1, $var2);
        $this->assertSame($expectedVar1, $var1);
        $this->assertSame($expectedVar2, $var2);
    }

    /**
     * @test
     * @dataProvider swapDataProvider
     * @param array $expected
     * @param array $args
     */
    public function functionSwapAlsoReturns(array $expected, array $args): void
    {
        [$expectedVar1, $expectedVar2] = $expected;
        [$var1, $var2] = $args;
        [$result1, $result2] = swap($var1, $var2);
        $this->assertSame($expectedVar1, $var1);
        $this->assertSame($expectedVar2, $var2);
        $this->assertSame($expectedVar1, $result1);
        $this->assertSame($expectedVar2, $result2);
    }

    public function swapDataProvider(): array
    {
        $a = new \stdClass();
        $b = new \stdClass();
        return [
            [[$a, $b], [$b, $a]],
            [[1, 2], [2, 1]],
            [[true, null], [null, true]],
            [['1', '2'], ['2', '1']],
        ];
    }
}
