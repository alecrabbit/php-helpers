<?php declare(strict_types=1);

namespace AlecRabbit\Helpers;

use AlecRabbit\Helpers\Objects\Picklock;

if (!function_exists(__NAMESPACE__ . '\callMethod')) {
    /**
     * Calls method $methodName of object $object using arguments ...$args.
     *
     * @param object $object
     * @param string $methodName
     * @param mixed ...$args
     * @return mixed
     */
    function callMethod(object $object, string $methodName, ...$args)
    {
        return
            Picklock::callMethod($object, $methodName, ...$args);
    }
}

if (!function_exists(__NAMESPACE__ . '\getValue')) {
    /**
     * Gets value of property $propName of an object $object
     *
     * @param object $object
     * @param string $propName
     * @return mixed
     */
    function getValue(object $object, string $propName)
    {
        return
            Picklock::getValue($object, $propName);
    }
}
