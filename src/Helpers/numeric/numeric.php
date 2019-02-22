<?php declare(strict_types=1);

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
 * @param string $numeric
 * @return string
 */
function trim_zeros(string $numeric): string
{
    return false !== \strpos($numeric, '.') ? \rtrim(\rtrim($numeric, '0'), '.') : $numeric;
}
