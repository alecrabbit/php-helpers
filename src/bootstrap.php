<?php declare(strict_types=1);

namespace AlecRabbit\Helpers;

use AlecRabbit\Helpers\Classes\Picklock;
use AlecRabbit\Helpers\Classes\System;

if (!function_exists(__NAMESPACE__ . '\callMethod')) {
    /**
     * Calls method $methodName of object $object using arguments ...$args.
     *
     * @param mixed $objectOrClass
     * @param string $methodName
     * @param mixed ...$args
     * @return mixed
     */
    function callMethod($objectOrClass, string $methodName, ...$args)
    {
        return
            Picklock::callMethod($objectOrClass, $methodName, ...$args);
    }
}

if (!function_exists(__NAMESPACE__ . '\getValue')) {
    /**
     * Gets value of property $propName of an object $object
     *
     * @param mixed $objectOrClass
     * @param string $propName
     * @return mixed
     */
    function getValue($objectOrClass, string $propName)
    {
        return
            Picklock::getValue($objectOrClass, $propName);
    }
}

if (!function_exists(__NAMESPACE__ . '\inContainer')) {
    /**
     * Determine if run in container
     *
     * @return bool
     */
    function inContainer()
    {
        return System::inContainer();
    }
}

if (!function_exists(__NAMESPACE__ . '\swap')) {
    /**
     * Swap variables values by references
     *
     * @param mixed $var1
     * @param mixed $var2
     * @return void
     */
    function swap(&$var1, &$var2): void
    {
        [$var1, $var2] = [$var2, $var1];
    }
}

if (!function_exists(__NAMESPACE__ . '\swapTo')) {
    /**
     * Swap variables values to array
     *
     * @param mixed $var1
     * @param mixed $var2
     * @return array
     */
    function swapTo($var1, $var2): array
    {
        return [$var2, $var1];
    }
}

if (!function_exists(__NAMESPACE__ . '\inRange')) {
    /**
     * Checks if int is in range
     *
     * @param int $value
     * @param int $min
     * @param int $max
     * @return bool
     */
    function inRange(int $value, int $min, int $max): bool
    {
        if ($min > $max) {
            swap($min, $max);
        }
        return ($min <= $value && $value <= $max);
    }
}
