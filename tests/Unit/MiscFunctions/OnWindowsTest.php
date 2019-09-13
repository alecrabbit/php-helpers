<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use function AlecRabbit\Helpers\onWindows;

class OnWindowsTest extends HelpersTestCase
{
    /**
     * @test
     */
    public function functionOnWindows(): void
    {
        if ('\\' === \DIRECTORY_SEPARATOR) {
            $this->assertTrue(onWindows());
        } else {
            $this->assertFalse(onWindows());
        }
    }
}
