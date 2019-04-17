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
     * Calls method $methodName of object $object using arguments ...$args.
     *
     * @psalm-suppress InvalidScope
     *
     * @param object $object
     * @param string $methodName
     * @param mixed ...$args
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
                    sprintf(
                        Picklock::EXCEPTION_TEMPLATE,
                        \get_class($this),
                        $methodName,
                        Picklock::METHOD
                    )
                );
            };
        return
            $closure->call($object, $methodName, ...$args);
    }

    /**
     * @psalm-suppress InvalidScope
     * @psalm-suppress PossiblyInvalidFunctionCall
     *
     * @param object $object
     * @param string $propName
     * @return mixed
     */
    public static function getValue(object $object, string $propName)
    {
        $closure =
            /**
             * @return mixed
             */
            function () use ($propName) {
                if (\property_exists($this, $propName)) {
                    return $this->$propName;
                }
                throw new \RuntimeException(
                    sprintf(
                        Picklock::EXCEPTION_TEMPLATE,
                        \get_class($this),
                        $propName,
                        Picklock::PROPERTY
                    )
                );
            };
        return
            $closure->bindTo($object, $object)();
    }
}
