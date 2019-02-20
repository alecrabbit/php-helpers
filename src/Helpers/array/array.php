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
    $result = $tmp = [];
    if ($callback) {
        \array_walk($data, $callback);
    }
    $maxLength = arr_el_max_length($data);
    $rowEmpty = true;
    foreach ($data as $element) {
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


///******


//
//
//function formatted_array_3(
//}

///******


/**
 * @param array $data
 * @return array
 */
function unset_first(array $data): array
{
    // TODO for PHP >=7.3 this line should use \array_key_first
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

/**
 * @param array $arr
 * @return bool
 */
function is_homogeneous(array $arr): bool
{
    $firstValue = current($arr);
    foreach ($arr as $val) {
        if ($firstValue !== $val) {
            return false;
        }
    }
    return true;
}
