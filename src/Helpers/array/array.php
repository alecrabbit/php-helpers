<?php declare(strict_types=1);

namespace AlecRabbit;

use const AlecRabbit\Helpers\Constants\EMPTY_ELEMENTS;

/**
 * @param array $arr
 * @param int $columns
 * @param callable|null $preprocessor
 * @param int $pad
 * @return array
 */
function formatted_array(
    array $arr,
    int $columns = 10,
    ?callable $preprocessor = null,
    int $pad = STR_PAD_RIGHT
): array {
    $result = $tmp = [];
    if ($preprocessor) {
        \array_walk($arr, $preprocessor);
    }
    $maxLength = arr_el_max_length($arr);
    $rowEmpty = true;
    foreach ($arr as $element) {
        $tmp[] = \str_pad((string)$element, $maxLength, ' ', $pad);
        $rowEmpty = $rowEmpty && \in_array($element, EMPTY_ELEMENTS, true);
        if (\count($tmp) >= $columns) {
            update_result($result, $rowEmpty, $tmp);
        }
    }
    if (!empty($tmp)) {
        update_result($result, $rowEmpty, $tmp);
    }
    return $result;
}


/**
 * @param array $data
 * @internal
 * @return int
 */
function arr_el_max_length(array &$data): int
{
    $maxLength = 0;
    foreach ($data as &$element) {
        if (\is_array($element)) {
            throw new \RuntimeException('Array to string conversion');
        }
        $len = \strlen($element = (string)$element);
        if ($maxLength < $len) {
            $maxLength = $len;
        }
    }
    return $maxLength;
}

/**
 * @param array $result
 * @param bool $rowEmpty
 * @param array $tmp
 * @internal
 */
function update_result(array &$result, bool &$rowEmpty, array &$tmp): void
{
    $result[] = \implode($rowEmpty ? '' : ' ', $tmp);
    $rowEmpty = true;
    $tmp = [];
}

/**
 * @param array $data
 * @return array
 */
function array_unset_first(array $data): array
{
    $key = \array_key_first($data);
    if (null !== $key) {
        unset($data[$key]);
    }
    return $data;
}

/**
 * @param array $data
 * @return array
 */
function array_unset_last(array $data): array
{
    $key = \array_key_last($data);
    if (null !== $key) {
        unset($data[$key]);
    }
    return $data;
}

/**
 * Known issue `array_is_homogeneous` can't handle cyclic references in arrays
 *      $a = [];
 *      $a[1] = &$a;
 *      $b = [];
 *      $b[1] = &$b;
 *      var_dump($b === $a); // 'PHP Fatal error:  Nesting level too deep - recursive dependency?'
 *
 * @param array $a
 * @return bool
 */
function array_is_homogeneous(array $a): bool
{
    $firstElement = current($a);
    foreach ($a as $element) {
        if ($firstElement !== $element) {
            return false;
        }
    }
    return true;
}
