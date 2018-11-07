<?php
/**
 * User: alec
 * Date: 12.10.18
 * Time: 14:04
 */

if (!function_exists('is_negative')) {
    /**
     * @param $value bool|float|int|null
     * @return bool
     */
    function is_negative($value): bool
    {
        if ($value === false) {
            $value = -1;
        }
        return ((float)$value < 0);
    }
}

if (!function_exists('bounds')) {
    /**
     * Puts value in bounds
     *
     * @param float $value
     * @param float $min [optional] Default -1
     * @param float $max [optional] Default 1
     * @return float
     */
    function bounds(float $value, float $min = -1, float $max = 1): float
    {
        if ($value < $min) {
            $value = $min;
        } elseif ($value > $max) {
            $value = $max;
        }
        return $value;
    }
}

if (!function_exists('bc_bounds')) {
    /**
     * Same as bounds() but uses BCMathExtended
     *
     * @param string $value
     * @param string $min [optional] Default -1
     * @param string $max [optional] Default 1
     * @param int $scale [optional] Default 5
     * @return string
     */
    function bc_bounds(string $value, string $min = '-1', string $max = '1', int $scale = 5): string
    {
        if (\BCMathExtended\BC::comp($value, $min, $scale) <= 0) {
            $value = $min;
        } elseif (($comp = \BCMathExtended\BC::comp($value, $max, $scale)) === 1 || $comp === 0) {
            $value = $max;
        }
        return $value;
    }
}

if (!function_exists('trim_zeros')) {
    /**
     * @param string $numeric
     * @return string
     */
    function trim_zeros(string $numeric): string
    {
        return false !== \strpos($numeric, '.') ? \rtrim(\rtrim($numeric, '0'), '.') : $numeric;
    }
}
