<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use Carbon\Carbon;
use Carbon\CarbonTimeZone;
use function AlecRabbit\carbon;

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
        $c = carbon(...$args);
        $this->assertEquals($expected, $c);
    }

    public function functionCarbonWithArgsDataProvider(): array
    {
        $tz = new CarbonTimeZone('Europe/Kiev');
        $tz2 = new CarbonTimeZone('America/Anchorage');
        return [
            [Carbon::createFromTimestamp(1550707200, $tz), [1550707200, $tz]],
            [Carbon::createFromTimestamp(1550707200, $tz), ['@' . 1550707200, $tz]],
            [Carbon::createFromTimestamp(1456707200, $tz), [1456707200, $tz]],
            [Carbon::createFromTimestamp(1456707200, $tz), ['@' . 1456707200, $tz]],
            [new Carbon('first day of January 2008', $tz), ['first day of January 2008', $tz]],
            [new Carbon('Feb 3 2018', $tz), ['Feb 3 2018', $tz]],
            [Carbon::createFromTimestamp(1550707200, $tz2), [1550707200, $tz2]],
            [Carbon::createFromTimestamp('1550707200', $tz2), ['@' . 1550707200, $tz2]],
            [Carbon::createFromTimestamp('1456707200', $tz2), [1456707200, $tz2]],
            [Carbon::createFromTimestamp(1456707200, $tz2), ['@' . 1456707200, $tz2]],
            [new Carbon('first day of March 2008', $tz2), ['first day of March 2008', $tz2]],
            [new Carbon('Feb 3 2018', $tz2), ['Feb 3 2018', $tz2]],
        ];
    }
}
