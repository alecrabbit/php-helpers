<?php
/**
 * User: alec
 * Date: 12.10.18
 * Time: 13:21
 */

namespace AlecRabbit;

use const AlecRabbit\Constants\STR_EMPTY;
use const AlecRabbit\Constants\STR_FALSE;
use const AlecRabbit\Constants\STR_NULL;
use const AlecRabbit\Constants\STR_TRUE;

    /**
     * Gets the value of an environment variable.
     *
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
function env($key, $default = null)
{
    if (false === $value = \getenv($key)) {
        $value = value($default);
    }

    $value = \ltrim(\rtrim($value, ')"'), '("');

    switch (strtolower($value)) {
        case STR_TRUE:
            $value = true;
            break;
        case STR_FALSE:
            $value = false;
            break;
        case STR_EMPTY:
        case STR_NULL:
            $value = '';
            break;
    }

    return $value;
}

    /**
     * Return the default value of the given value.
     *
     * @param  mixed $value
     * @return mixed
     */
function value($value)
{
    return
        $value instanceof \Closure ?
            $value() : $value;
}

    /**
     * Returns the type of a variable.
     *
     * @param mixed $var
     * @return string
     */
function typeOf($var): string
{
    return
        \is_object($var) ? \get_class($var) : \gettype($var);
}
