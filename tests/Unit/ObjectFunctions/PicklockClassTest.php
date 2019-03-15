<?php declare(strict_types=1);


namespace AlecRabbit\Tests\Helpers\Unit\ObjectFunctions;

use AlecRabbit\Helpers\Objects\Picklock;
use PHPUnit\Framework\TestCase;

class PicklockClassTest extends TestCase
{

    public function testCallMethod(): void
    {
        $testClass = new class
        {
            private function test(string $value): string
            {
                return $value;
            }
        };

        $this->assertEquals(
            'testValue',
            Picklock::callMethod($testClass, 'test', 'testValue')
        );

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(
            sprintf(
                Picklock::EXCEPTION_TEMPLATE,
                \get_class($testClass),
                'unknownMethod'
            )
        );

        Picklock::callMethod($testClass, 'unknownMethod');
    }
}
