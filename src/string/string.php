<?php
/**
 * User: alec
 * Date: 12.10.18
 * Time: 15:24
 */

define('BRACKETS_SQUARE', 10); // []
define('BRACKETS_CURLY', 20); // {}
define('BRACKETS_PARENTHESES', 30); // ()
define('BRACKETS_ANGLE', 40); //  ⟨⟩

define(
    'BRACKETS_SUPPORTED',
    [
        BRACKETS_SQUARE,
        BRACKETS_CURLY,
        BRACKETS_PARENTHESES,
        BRACKETS_ANGLE,
    ]
);

define('TIME_DEFAULT_PRECISION', 3);
define('TIME_UNIT_MICROSECONDS', 1001);
define('TIME_UNIT_MILLISECONDS', 1002);
define('TIME_UNIT_SECONDS', 1003);
define('TIME_UNIT_MINUTES', 1004);
define('TIME_UNIT_HOURS', 1005);

define(
    'TIME_UNITS',
    [
        TIME_UNIT_MICROSECONDS => 'μs',
        TIME_UNIT_MILLISECONDS => 'ms',
        TIME_UNIT_SECONDS => 's',
        TIME_UNIT_MINUTES => 'm',
        TIME_UNIT_HOURS => 'h',
    ]
);

if (!function_exists('tag')) {
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
}

if (!function_exists('brackets')) {
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
}

if (!function_exists('str_decorate')) {
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
}

if (!function_exists('format_bytes')) {
    define(
        'BYTES_UNITS',
        [
            'B' => 0,
            'KB' => 1,
            'MB' => 2,
            'GB' => 3,
            'TB' => 4,
            'PB' => 5,
            'EB' => 6,
            'ZB' => 7,
            'YB' => 8
        ]
    );

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
}

if (!function_exists('format_time')) {
    define('DEFAULT_PRECISION', 3);
    define('UNIT_MICROSECONDS', 1001);
    define('UNIT_MILLISECONDS', 1002);
    define('UNIT_SECONDS', 1003);
    define('UNIT_MINUTES', 1004);
    define('UNIT_HOURS', 1005);

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
}
