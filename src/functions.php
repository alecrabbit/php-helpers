<?php
/**
 * User: alec
 * Date: 12.10.18
 * Time: 13:21
 */

if (!function_exists('env')) {
    if (!\defined('STRING_TRUE')) {
        define('STRING_TRUE', 'true');
    }
    if (!\defined('STRING_FALSE')) {
        define('STRING_FALSE', 'false');
    }
    if (!\defined('STRING_EMPTY')) {
        define('STRING_EMPTY', 'empty');
    }
    if (!\defined('STRING_NULL')) {
        define('STRING_NULL', 'null');
    }

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
            case STRING_TRUE:
                $value = true;
                break;
            case STRING_FALSE:
                $value = false;
                break;
            case STRING_EMPTY:
                $value = '';
                break;
            case STRING_NULL:
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
