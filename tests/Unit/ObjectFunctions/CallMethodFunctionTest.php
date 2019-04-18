<?php declare(strict_types=1);


namespace AlecRabbit\Tests\Helpers\Unit\ObjectFunctions;

use AlecRabbit\Helpers\Classes\Picklock;
use AlecRabbit\Tests\Helpers\GuineaPigClass;
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
        $this->assertEquals(
            3,
            callMethod(GuineaPigClass::class, 'protectedStaticMethod')
        );
        $this->assertEquals(
            5,
            callMethod(GuineaPigClass::class, 'protectedMethod')
        );
        $this->assertEquals(
            4,
            callMethod(GuineaPigClass::class, 'privateStaticMethod')
        );
        $this->assertEquals(
            6,
            callMethod(GuineaPigClass::class, 'privateMethod')
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

    /** @test */
    public function callMethodWithInvalidArgument(): void
    {

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Param 1 should be object or a class name.');
        callMethod(1, 'unknownMethod');
    }
}
