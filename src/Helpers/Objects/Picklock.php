<?php declare(strict_types=1);

namespace AlecRabbit\Helpers\Objects;

/**
 * Class Picklock
 * @package AlecRabbit\Helpers\Objects
 *
 * @link https://gitlab.com/m0rtis/picklock
 * @license Apache License 2.0
 * @author Anton Fomichev aka m0rtis - mail@m0rtis.ru
 */
final class Picklock
{
    public const EXCEPTION_TEMPLATE = 'Class [%s] does not have the method `%s`';

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
        $closure = function (string $methodName, ...$args) {
            if (\method_exists($this, $methodName)) {
                return $this->$methodName(...$args);
            }
            throw new \RuntimeException(
                sprintf(
                    Picklock::EXCEPTION_TEMPLATE,
                    \get_class($this),
                    $methodName
                )
            );
        };
        return
            $closure->call($object, $methodName, ...$args);
    }
}
