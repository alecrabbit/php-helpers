<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use function AlecRabbit\unset_first;

class UnsetFirstTest extends HelpersTestCase
{
    /**
     * @test
     * @dataProvider unsetFirstDataProvider
     * @param $expected
     * @param $actual
     */
    public function functionUnsetFirst($expected, $actual): void
    {
        $this->assertEquals($expected, unset_first($actual));
    }

    public function unsetFirstDataProvider(): array
    {
        return [
            [[], []],
            [[], [1]],
            [[1 => 1], [0 => 0, 1 => 1]],
            [[1 => 'a'], [0 => 'b', 1 => 'a']],
            [['first' => 1], ['zero' => 0, 'first' => 1]],
            [
                [
                    1 => 2,
                    2 => 3,
                    3 => 4,
                ],
                [
                    0 => 1,
                    1 => 2,
                    2 => 3,
                    3 => 4,
                ],
            ],
        ];
    }
}
