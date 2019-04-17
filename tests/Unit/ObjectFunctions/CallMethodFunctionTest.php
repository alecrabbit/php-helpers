<?php declare(strict_types=1);


namespace AlecRabbit\Tests\Helpers\Unit\ObjectFunctions;

use AlecRabbit\Helpers\Classes\Picklock;
use PHPUnit\Framework\TestCase;
use function AlecRabbit\Helpers\callMethod;

class CallMethodFunctionTest extends TestCase
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
            callMethod($testClass, 'test', 'testValue')
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

        callMethod($testClass, 'unknownMethod');
    }
}
