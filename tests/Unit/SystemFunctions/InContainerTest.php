<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use function AlecRabbit\Helpers\inContainer;

class InContainerTest extends HelpersTestCase
{

    /** @test */
    public function functionInContainer(): void
    {
        $this->assertIsBool(inContainer());
    }
}
