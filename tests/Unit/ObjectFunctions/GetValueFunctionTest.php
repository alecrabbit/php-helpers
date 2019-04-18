<?php declare(strict_types=1);


namespace AlecRabbit\Tests\Helpers\Unit\ObjectFunctions;

use AlecRabbit\Helpers\Classes\Picklock;
use AlecRabbit\Tests\Helpers\GuineaPigClass;
use PHPUnit\Framework\TestCase;
use function AlecRabbit\Helpers\getValue;

class GetValueFunctionTest extends TestCase
{
    /** @test */
    public function getValue(): void
    {
        $testClass =
            new class
            {
                private $private = 10;
                protected $protected = 100;
            };

        $this->assertEquals(
            10,
            getValue($testClass, 'private')
        );
        $this->assertEquals(
            100,
            getValue($testClass, 'protected')
        );
        $this->assertEquals(
            20,
            getValue(GuineaPigClass::class, 'protectedStaticField')
        );
        $this->assertEquals(
            10,
            getValue(GuineaPigClass::class, 'privateStaticField')
        );
        $this->assertEquals(
            2,
            getValue(GuineaPigClass::class, 'protectedField')
        );
        $this->assertEquals(
            1,
            getValue(GuineaPigClass::class, 'privateField')
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

        getValue($testClass, 'unknownProperty');
    }

    /** @test */
    public function getValueWithInvalidArgument(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Param 1 should be object or a class name.');
        getValue(1, 'unknownProperty');
    }
}
