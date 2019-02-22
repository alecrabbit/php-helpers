<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use Carbon\Carbon;
use function AlecRabbit\carbon;

class CarbonTest extends HelpersTestCase
{
    /** @test
     * @throws \Exception
     */
    public function functionCarbon(): void
    {
        $this->assertInstanceOf(Carbon::class, carbon());
        $this->assertEquals(Carbon::parse('Feb 3 2018'), carbon('Feb 3 2018'));
    }
}
