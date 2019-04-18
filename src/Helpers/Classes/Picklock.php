<?php declare(strict_types=1);

namespace AlecRabbit\Helpers\Classes;

use function AlecRabbit\typeOf;

/**
 * Class Picklock
 *
 * @link https://gitlab.com/m0rtis/picklock
 * @license Apache License 2.0
 * @author Anton Fomichev aka m0rtis - mail@m0rtis.ru
 *
 * @package AlecRabbit\Helpers\Objects
 * @author AlecRabbit
 *
 * @internal
 */
final class Picklock
{
    public const EXCEPTION_TEMPLATE = 'Class [%s] does not have `%s` %s';
    public const METHOD = 'method';
    public const PROPERTY = 'property';

    /**
     * Calls a private or protected method of an object.
     *
     * @psalm-suppress InvalidScope
     *
     * @param mixed $objectOrClass
     * @param string $methodName
     * @param mixed ...$args
     *
     * @return mixed
     */
    public static function callMethod($objectOrClass, string $methodName, ...$args)
    {
        $objectOrClass = self::getObject($objectOrClass);
        $closure =
            /**
             * @param string $methodName
             * @param array $args
             * @return mixed
             */
            function (string $methodName, ...$args) {
                if (\method_exists($this, $methodName)) {
                    return $this->$methodName(...$args);
                }
                throw new \RuntimeException(
                    Picklock::errorMessage($this, $methodName, true)
                );
            };
        return
            $closure->call($objectOrClass, $methodName, ...$args);
    }

    /**
     * @psalm-suppress TypeCoercion
     * @psalm-suppress InvalidStringClass
     *
     * @param object|string $objectOrClass
     *
     * @return object
     */
    protected static function getObject($objectOrClass): object
    {
        self::assertParam($objectOrClass);

        if (\is_string($objectOrClass)) {
            try {
                $objectOrClass = new $objectOrClass();
            } catch (\Error $e) {
                try {
                    $class = new \ReflectionClass($objectOrClass);
                    $objectOrClass = $class->newInstanceWithoutConstructor();
                // @codeCoverageIgnoreStart
                } catch (\ReflectionException $exception) {
                    throw new \RuntimeException(
                        '[' . typeOf($exception) . '] ' . $exception->getMessage(),
                        (int)$exception->getCode(),
                        $exception
                    );
                }
                // @codeCoverageIgnoreEnd
            }
        }
        return $objectOrClass;
    }

    /**
     * @param mixed $objectOrClass
     */
    protected static function assertParam($objectOrClass): void
    {
        if (!\is_string($objectOrClass) && !\is_object($objectOrClass)) {
            throw new \InvalidArgumentException('Param 1 should be object or a class name.');
        }
    }

    /**
     * Creates an error message.
     *
     * @param object $object
     * @param string $part
     * @param bool $forMethod
     *
     * @return string
     */
    public static function errorMessage(object $object, string $part, bool $forMethod): string
    {
        return
            sprintf(
                static::EXCEPTION_TEMPLATE,
                \get_class($object),
                $part,
                $forMethod ? static::METHOD : static::PROPERTY
            );
    }

    /**
     * Gets a value of a private or protected property of an object.
     *
     * @psalm-suppress InvalidScope
     * @psalm-suppress PossiblyInvalidFunctionCall
     * @psalm-suppress TypeCoercion
     *
     * @param mixed $objectOrClass
     * @param string $propertyName
     *
     * @return mixed
     */
    public static function getValue($objectOrClass, string $propertyName)
    {
        $objectOrClass = self::getObject($objectOrClass);
        $closure =
            /**
             * @return mixed
             */
            function () use ($propertyName) {
                if (\property_exists($this, $propertyName)) {
                    $class = new \ReflectionClass(typeOf($this));
                    $property = $class->getProperty($propertyName);
                    $property->setAccessible(true);
                    return $property->getValue($this);
                }
                throw new \RuntimeException(
                    Picklock::errorMessage($this, $propertyName, false)
                );
            };
        return
            $closure->bindTo($objectOrClass, $objectOrClass)();
    }
}
