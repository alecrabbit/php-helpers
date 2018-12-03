<?php
/**
 * User: alec
 * Date: 12.10.18
 * Time: 15:24
 */

namespace AlecRabbit;

use const \AlecRabbit\Constants\BRACKETS_ANGLE;
use const \AlecRabbit\Constants\BRACKETS_CURLY;
use const \AlecRabbit\Constants\BRACKETS_PARENTHESES;
use const \AlecRabbit\Constants\BRACKETS_SQUARE;
use const \AlecRabbit\Constants\BRACKETS_SUPPORTED;
use const \AlecRabbit\Constants\DEFAULT_PRECISION;
use const \AlecRabbit\Constants\String\BYTES_UNITS;
use const \AlecRabbit\Constants\UNIT_HOURS;
use const \AlecRabbit\Constants\UNIT_MICROSECONDS;
use const \AlecRabbit\Constants\UNIT_MILLISECONDS;
use const \AlecRabbit\Constants\UNIT_MINUTES;
use const \AlecRabbit\Constants\UNIT_SECONDS;
use function \AlecRabbit\Helpers\bounds;
use function \AlecRabbit\Helpers\is_negative;

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


function format_bytes(int $bytes, ?string $unit = null, int $decimals = 2): string
{
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
        sprintf('%s%.' . $decimals . 'f' . $unit, $negative ? '-' : '', $value);
}

function format_time(?float $value, ?int $units = null, int $precision = DEFAULT_PRECISION): string
{
    $units = $units ?? UNIT_MILLISECONDS;
    $precision = (int)bounds($precision, 0, 6);
    $value = $value ?? 0.0;
    $suffix = 'ms';
    $coefficient = 1000;

    switch ($units) {
        case UNIT_HOURS:
            $suffix = 'h';
            $coefficient = 1 / 3600;
            break;
        case UNIT_MINUTES:
            $suffix = 'm';
            $coefficient = 1 / 60;
            break;
        case UNIT_SECONDS:
            $suffix = 's';
            $coefficient = 1;
            break;
        case UNIT_MILLISECONDS:
            $suffix = 'ms';
            $coefficient = 1000;
            break;
        case UNIT_MICROSECONDS:
            $suffix = 'μs';
            $coefficient = 1000000;
            break;
    }
    return
        sprintf(
            '%s%s',
            round($value * $coefficient, $precision),
            $suffix
        );
}
