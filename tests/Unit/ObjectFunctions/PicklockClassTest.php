<?php declare(strict_types=1);


namespace AlecRabbit\Tests\Helpers\Unit\ObjectFunctions;

use AlecRabbit\Helpers\Objects\Picklock;
use PHPUnit\Framework\TestCase;

class PicklockClassTest extends TestCase
{

    /** @test */
    public function callMethod(): void
    {
        $testClass =
            new class
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
                'unknownMethod',
                Picklock::METHOD
            )
        );

        Picklock::callMethod($testClass, 'unknownMethod');
    }

    /** @test */
    public function getProperty(): void
    {
        $testClass =
            new class
            {
                private $private = 10;
                protected $protected = 100;
            };

        $this->assertEquals(
            10,
            Picklock::getValue($testClass, 'private')
        );
        $this->assertEquals(
            100,
            Picklock::getValue($testClass, 'protected')
        );

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(
            sprintf(
                Picklock::EXCEPTION_TEMPLATE,
                \get_class($testClass),
                'unknownProperty',
                Picklock::PROPERTY
            )
        );

        Picklock::getValue($testClass, 'unknownProperty');
    }
}
