<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use Carbon\Carbon;
use function AlecRabbit\now;

class NowTest extends HelpersTestCase
{
    /**
     * @test
     * @throws \Exception
     */
    public function functionNow(): void
    {
        $now = now();
        $this->assertInstanceOf(Carbon::class, $now);
    }
}
