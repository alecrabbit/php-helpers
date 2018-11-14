<?php
/**
 * User: alec
 * Date: 12.10.18
 * Time: 13:21
 */

if (!\defined('HELPERS_STR_TRUE')) {
    define('HELPERS_STR_TRUE', 'true');
}
if (!\defined('HELPERS_STR_FALSE')) {
    define('HELPERS_STR_FALSE', 'false');
}
if (!\defined('HELPERS_STR_EMPTY')) {
    define('HELPERS_STR_EMPTY', 'empty');
}
if (!\defined('HELPERS_STR_NULL')) {
    define('HELPERS_STR_NULL', 'null');
}


if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        if (false === $value = getenv($key)) {
            $value = value($default);
        }

        $value = \ltrim(\rtrim($value, ')"'), '("');

        switch (strtolower($value)) {
            case HELPERS_STR_TRUE:
                $value = true;
                break;
            case HELPERS_STR_FALSE:
                $value = false;
                break;
            case HELPERS_STR_EMPTY:
                $value = '';
                break;
            case HELPERS_STR_NULL:
                $value = null;
                break;
        }

        return $value;
    }
}

if (!function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param  mixed $value
     * @return mixed
     */
    function value($value)
    {
        return
            $value instanceof Closure ?
                $value() : $value;
    }
}
