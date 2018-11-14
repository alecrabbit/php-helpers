<?php
/**
 * User: alec
 * Date: 12.10.18
 * Time: 13:21
 */

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
            case 'true':
                $value = true;
                break;
            case 'false':
                $value = false;
                break;
            case 'empty':
                $value = '';
                break;
            case 'null':
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
        return $value instanceof Closure ? $value() : $value;
    }
}