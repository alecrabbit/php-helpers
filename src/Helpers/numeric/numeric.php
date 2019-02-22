<?php
declare(strict_types=1);

namespace AlecRabbit\Helpers;

/**
 * @param bool|float|int|null $value
 * @return bool
 */
function is_negative($value): bool
{
    if ($value === false) {
        $value = -1;
    }
    return ((float)$value < 0);
}

/**
 * Puts value in bounds
 *
 * @param float $value
 * @param float $min [optional] Default -1
 * @param float $max [optional] Default 1
 * @return float
 */
function bounds(float $value, float $min = -1.0, float $max = 1.0): float
{
    if ($value < $min) {
        $value = $min;
    } elseif ($value > $max) {
        $value = $max;
    }
    return $value;
}

/**
 * Same as bounds() but uses BCMathExtended
 *
 * @param string $value
 * @param string $min [optional] Default -1
 * @param string $max [optional] Default 1
 * @param int $scale [optional] Default 5
 * @return string
 * @depracetd to be removed since 0.5.0
 */
function bc_bounds(string $value, string $min = '-1', string $max = '1', int $scale = 5): string
{
    if (\BCMathExtended\BC::comp($value, $min, $scale) <= 0) {
        $value = \BCMathExtended\BC::add($min, '0', $scale);
    } elseif (($comp = \BCMathExtended\BC::comp($value, $max, $scale)) === 1 || $comp === 0) {
        $value = \BCMathExtended\BC::add($max, '0', $scale);
    }
    return trim_zeros($value);
}

/**
 * @param string $numeric
 * @return string
 */
function trim_zeros(string $numeric): string
{
    return false !== \strpos($numeric, '.') ? \rtrim(\rtrim($numeric, '0'), '.') : $numeric;
}
