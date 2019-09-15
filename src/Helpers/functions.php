<?php

namespace AlecRabbit;

use const AlecRabbit\Helpers\Strings\Constants\STR_DOUBLE;
use const AlecRabbit\Helpers\Strings\Constants\STR_DOUBLE_LENGTH;
use const AlecRabbit\Helpers\Strings\Constants\STR_EMPTY;
use const AlecRabbit\Helpers\Strings\Constants\STR_FALSE;
use const AlecRabbit\Helpers\Strings\Constants\STR_FLOAT;
use const AlecRabbit\Helpers\Strings\Constants\STR_NULL;
use const AlecRabbit\Helpers\Strings\Constants\STR_TRUE;

/**
 * Gets the value of an environment variable.
 *
 * @param string $key
 * @param mixed $default
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
 * @param mixed $value
 * @return mixed
 */
function value($value)
{
    return
        $value instanceof \Closure ?
            $value() : $value;
}

/**
 * Returns string representation of a bool value.
 *
 * @param null|bool $value
 * @return string
 */
function boolToStr($value): string
{
    if (null === $value) {
        return STR_NULL;
    }
    if (!\is_bool($value)) {
        throw new \InvalidArgumentException(
            __FUNCTION__ . ' expects parameter 1 to null|bool, ' . typeOf($value) . ' given'
        );
    }
    return $value ? STR_TRUE : STR_FALSE;
}

/**
 * Returns the type of a variable.
 *
 * @param mixed $var
 * @return string
 */
function typeOf($var): string
{
    $type = \is_object($var) ? \get_class($var) : \gettype($var);
    if (strlen($type) === STR_DOUBLE_LENGTH) {
        $type = str_replace(STR_DOUBLE, STR_FLOAT, $type);
    }
    return $type;
}
