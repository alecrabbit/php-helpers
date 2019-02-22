<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use Carbon\Carbon;
use function AlecRabbit\carbon;
use Carbon\CarbonTimeZone;

class CarbonTest extends HelpersTestCase
{
    /**
     * @test
     * @throws \Exception
     */
    public function functionCarbon(): void
    {
        $this->assertInstanceOf(Carbon::class, carbon());
        $this->assertEquals(Carbon::parse('Feb 3 2018'), carbon('Feb 3 2018'));
    }

    /**
     * @test
     * @dataProvider functionCarbonWithArgsDataProvider
     * @param $expected
     * @param $args
     * @throws \Exception
     */
    public function functionCarbonWithArgs($expected, $args): void
    {
        $this->assertEquals($expected, carbon(...$args));
    }

    public function functionCarbonWithArgsDataProvider(): array
    {
        $tz = new CarbonTimeZone('Europe/Kiev');
        return [
            [Carbon::createFromTimestamp(1550707200, $tz), [1550707200, $tz]],
            [Carbon::createFromTimestamp(1456707200, $tz), [1456707200, $tz]],
            [Carbon::create('first day of January 2008', $tz), ['first day of January 2008', $tz]],
            [Carbon::create('Feb 3 2018', $tz), ['Feb 3 2018', $tz]],
        ];
    }
}
