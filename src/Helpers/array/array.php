<?php declare(strict_types=1);

namespace AlecRabbit;

use const AlecRabbit\Helpers\Constants\EMPTY_ELEMENTS;

/**
 * @param array $data
 * @param int $columns
 * @param callable|null $callback
 * @param int $pad
 * @return array
 */
function formatted_array(
    array $data,
    int $columns = 10,
    ?callable $callback = null,
    int $pad = STR_PAD_RIGHT
): array {
    $result = [];
    if ($callback) {
        \array_walk($data, $callback);
    }
    $maxLength = arr_el_max_length($data);
    $tmp = [];
    $rowEmpty = true;
    foreach ($data as $element) {
        $tmp[] = \str_pad((string)$element, $maxLength, ' ', $pad);
        $rowEmpty &= \in_array($element, EMPTY_ELEMENTS, true);
        if (\count($tmp) >= $columns) {
            $result[] = \implode($rowEmpty ? '' : ' ', $tmp);
            $rowEmpty = true;
            $tmp = [];
        }
    }
    if (!empty($tmp)) {
        $result[] = \implode($rowEmpty ? '' : ' ', $tmp);
    }
    return $result;
}


/**
 * @param array $data
 * @internal
 * @return int
 */
function arr_el_max_length(array $data): int
{
    $maxLength = 0;
    foreach ($data as $element) {
        if (\is_array($element)) {
            throw new \RuntimeException('Array to string conversion');
        }
        $len = \strlen((string)$element);
        if ($maxLength < $len) {
            $maxLength = $len;
        }
    }
    return $maxLength;
}


function unset_first(array $data): iterable
{
    $key = array_key_first($data);
    if (null !== $key) {
        unset($data[$key]);
    }
    return $data;
}

/**
 * @param array $data
 * @return int|null|string
 */
function array_key_first(array $data)
{
    foreach ($data as $key => $value) {
        // this loop does not loop
        return $key;
    }
}

/**
 * @param array $data
 * @return int|null|string
 */
function array_key_last(array $data)
{
    end($data);
    return key($data);
}
