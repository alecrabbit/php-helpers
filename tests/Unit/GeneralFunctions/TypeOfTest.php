<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use function AlecRabbit\typeOf;

class TypeOfTest extends HelpersTestCase
{
    /**
     * @test
     * @dataProvider typeOfDataProvider
     * @param $expected
     * @param $variable
     */
    public function functionTypeOf($expected, $variable): void
    {
        $this->assertEquals($expected, typeOf($variable));
    }

    public function typeOfDataProvider(): array
    {
        return [
            // [$expected, $variable],
            ['integer', 1],
            ['float', 1.0],
            ['boolean', true],
            ['NULL', null],
            ['array', []],
            ['Closure', function () {
            }],
            ['stdClass', new \stdClass()],
            [Naodouble::class, new Naodouble()],
            [Double::class, new Double()],
            ['string', 'sss'],
            ['resource', curl_init()],
            [__CLASS__, $this],
        ];
    }
}
