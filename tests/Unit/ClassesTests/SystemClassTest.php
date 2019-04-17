<?php declare(strict_types=1);


namespace AlecRabbit\Tests\Helpers\Unit\ClassesTests;

use AlecRabbit\Helpers\Classes\System;
use PHPUnit\Framework\TestCase;

class SystemClassTest extends TestCase
{
    /** @test */
    public function inContainer(): void
    {
        $this->assertIsBool(System::inContainer());
    }
}
