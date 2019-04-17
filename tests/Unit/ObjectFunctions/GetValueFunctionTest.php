<?php declare(strict_types=1);


namespace AlecRabbit\Tests\Helpers\Unit\ObjectFunctions;

use AlecRabbit\Helpers\Classes\Picklock;
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
}
