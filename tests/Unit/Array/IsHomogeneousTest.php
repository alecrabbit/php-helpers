<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use function AlecRabbit\is_homogeneous;

class IsHomogeneousTest extends HelpersTestCase
{
    /**
     * @test
     * @dataProvider isHomogeneousDataProvider
     * @param $expected
     * @param $actual
     */
    public function functionIsHomogeneous($expected, $actual): void
    {
        $this->assertSame($expected, is_homogeneous($actual));
    }

    public function isHomogeneousDataProvider(): array
    {
        $object = new \stdClass();
        return [
            [true, [1, 1, 1, 1, 1]],
            [false, [null, 1, 1, 1, 1]],
            [true, [false, false, false]],
            [true, [[], [], []]],
            [false, [new \stdClass(), new \stdClass(),]],
            [true, [$object, $object, $object]],
        ];
    }
}