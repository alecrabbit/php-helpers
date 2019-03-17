<?php declare(strict_types=1);

namespace AlecRabbit\Helpers\Objects;

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
     * @param object $object
     * @param string $methodName
     * @param mixed ...$args
     *
     * @return mixed
     */
    public static function callMethod(object $object, string $methodName, ...$args)
    {
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
            $closure->call($object, $methodName, ...$args);
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
     *
     * @param object $object
     * @param string $propertyName
     *
     * @return mixed
     */
    public static function getValue(object $object, string $propertyName)
    {
        $closure =
            /**
             * @return mixed
             */
            function () use ($propertyName) {
                if (\property_exists($this, $propertyName)) {
                    return $this->$propertyName;
                }
                throw new \RuntimeException(
                    Picklock::errorMessage($this, $propertyName, false)
                );
            };
        return
            $closure->bindTo($object, $object)();
    }
}
