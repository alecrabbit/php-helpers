<?php

declare(strict_types=1);

namespace AlecRabbit;

use function AlecRabbit\Helpers\bounds;
use const AlecRabbit\Helpers\Constants\UNITS;
use function AlecRabbit\Helpers\is_negative;
use const AlecRabbit\Helpers\Constants\BRACKETS_ANGLE;
use const AlecRabbit\Helpers\Constants\BRACKETS_CURLY;
use const AlecRabbit\Helpers\Constants\BRACKETS_PARENTHESES;
use const AlecRabbit\Helpers\Constants\BRACKETS_SQUARE;
use const AlecRabbit\Helpers\Constants\BRACKETS_SUPPORTED;
use const AlecRabbit\Helpers\Constants\UNIT_HOURS;
use const AlecRabbit\Helpers\Constants\UNIT_MILLISECONDS;
use const AlecRabbit\Helpers\Constants\UNIT_MINUTES;
use const AlecRabbit\Helpers\Constants\UNIT_SECONDS;
use const AlecRabbit\Helpers\Strings\Constants\BYTES_UNITS;
use const AlecRabbit\Helpers\Strings\Constants\TIME_COEFFICIENTS;
use const AlecRabbit\Helpers\Strings\Constants\TIME_UNITS;

/**
 * @param string $text
 * @param string|null $tag
 * @return string
 */
function tag(string $text, string $tag = null): string
{
    return
        $tag ? "<{$tag}>$text</{$tag}>" : $text;
}

/**
 * @param string $text
 * @param int $brackets
 * @return string
 */
function brackets(string $text, int $brackets = BRACKETS_SQUARE): string
{
    if (!\in_array($brackets, BRACKETS_SUPPORTED, true)) {
        throw new \InvalidArgumentException(
            'Parameter 2 should be BRACKETS_SQUARE | BRACKETS_CURLY | BRACKETS_PARENTHESES | BRACKETS_ANGLE'
        );
    }
    switch ($brackets) {
        case BRACKETS_CURLY:
            $text = "{{$text}}";
            break;
        case BRACKETS_SQUARE:
            $text = "[{$text}]";
            break;
        case BRACKETS_PARENTHESES:
            $text = "({$text})";
            break;
        case BRACKETS_ANGLE:
            $text = "⟨{$text}⟩";
            break;
    }
    return $text;
}

/**
 * @param string $text
 * @param null|string $open
 * @param null|string $close
 * @return string
 */
function str_decorate(string $text, ?string $open = null, ?string $close = null): string
{
    if (null !== $open && null === $close) {
        $close = $open;
    }
    return "{$open}{$text}{$close}";
}


function format_bytes(
    int $bytes,
    ?string $unit = null,
    ?int $decimals = null,
    string $decimalPoint = '.',
    string $thousandsSeparator = ''
): string {
    $decimals = $decimals ?? 2;
    $negative = is_negative($bytes);
    /** @noinspection CallableParameterUseCaseInTypeContextInspection */
    $bytes = \abs($bytes);
    $value = 0;
    $unit = \strtoupper($unit ?? '');
    if ($bytes > 0) {
        // Generate automatic prefix by bytes
        // If wrong prefix given
        if (!\array_key_exists($unit, BYTES_UNITS)) {
            $pow = (int)\floor(\log($bytes) / \log(1024));
            $unit = (string)\array_search($pow, BYTES_UNITS, true);
        }
        // Calculate byte value by prefix
        $value = ($bytes / 1024 ** \floor(BYTES_UNITS[$unit]));
    } else {
        $unit = 'B';
    }
    if ($unit === 'B') {
        $decimals = 0;
    }
    $decimals = (int)bounds($decimals, 0, 24);

    // Format output
    return
        ($negative ? '-' : '') . number_format($value, $decimals, $decimalPoint, $thousandsSeparator) . $unit;
}

function format_time(
    ?float $value,
    ?int $units = null,
    ?int $decimals = null,
    string $decimalPoint = '.',
    string $thousandsSeparator = ''
): string {
    $units = $units ?? UNIT_MILLISECONDS;
    $decimals = (int)bounds($decimals ?? 1, 0, 6);
    $value = $value ?? 0.0;

    return
        number_format(
            round($value * TIME_COEFFICIENTS[$units], $decimals),
            $decimals,
            $decimalPoint,
            $thousandsSeparator
        ) .
        TIME_UNITS[$units];
}

function format_time_auto(
    float $value,
    string $decimalPoint = '.',
    string $thousandsSeparator = ''
): string {
    if ($value > 10000) {
        return format_time($value, UNIT_HOURS, 3, $decimalPoint, $thousandsSeparator);
    }
    if ($value > 1000) {
        return format_time($value, UNIT_MINUTES, 2, $decimalPoint, $thousandsSeparator);
    }
    if ($value > 100) {
        return format_time($value, UNIT_SECONDS, 0, $decimalPoint, $thousandsSeparator);
    }
    $pow =
        (int)bounds(
            \abs(
                \floor(
                    \log($value) / \log(1000)
                )
            ),
            0,
            3
        );
    return
        \number_format(
            \round($value * 1000 ** $pow, 1),
            1,
            $decimalPoint,
            $thousandsSeparator
        ) .
        TIME_UNITS[UNITS[$pow]];
}

function format_time_ns(
    int $value,
    string $decimalPoint = '.',
    string $thousandsSeparator = ''
): string {
    return format_time_auto($value / 1000000000, $decimalPoint, $thousandsSeparator);
}
