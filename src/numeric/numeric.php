<?php
/**
 * User: alec
 * Date: 12.10.18
 * Time: 14:04
 */

if (!function_exists('is_negative')) {
    /**
     * @param $value
     * @return bool
     */
    function is_negative($value): bool
    {
        if ($value === false)
            $value = -1;
        return ($value < 0);
    }
}

if (!function_exists('bounds')) {
    /**
     * Puts value in bounds
     *
     * @param float $value
     * @param int $min [optional] Default -1
     * @param int $max [optional] Default 1
     * @return float
     */
    function bounds(float $value, int $min = -1, int $max = 1): float
    {
        if ($value < $min)
            $value = $min;
        elseif ($value > $max)
            $value = $max;
        return (float)$value;
    }
}

if (!function_exists('bc_bounds')) {
    /**
     * Same as bounds() but uses BCMathExtended
     *
     * @param float $value
     * @param int $min [optional] Default -1
     * @param int $max [optional] Default 1
     * @param int $scale [optional] Default 5
     * @return float
     */
    function bc_bounds(float $value, int $min = -1, int $max = 1, int $scale = 5): float
    {
        if (\BCMathExtended\BC::comp($value, $min, $scale) <= 0) {
            $value = $min;
        } elseif (($comp = \BCMathExtended\BC::comp($value, $max, $scale)) == 1 || $comp == 0) {
            $value = $max;
        }
        return (float)$value;
    }
}
