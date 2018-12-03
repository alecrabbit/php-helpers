<?php
/**
 * User: alec
 * Date: 12.10.18
 * Time: 15:53
 */

if (!function_exists('formatted_array')) {
    /**
     * @param array $data
     * @param int $columns
     * @param callable|null $callback
     * @param int $pad
     * @return iterable
     */
    function formatted_array(
        array $data,
        int $columns = 10,
        ?callable $callback = null,
        int $pad = STR_PAD_RIGHT
    ): iterable {
        $result = [];
        if ($callback) {
            \array_walk($data, $callback);
        }
        $maxLength = arr_el_max_length($data);
        $tmp = [];
        while ($element = \array_shift($data)) {
            $tmp[] = \str_pad($element, $maxLength, ' ', $pad);
            if (\count($tmp) >= $columns) {
                $result[] = \implode(' ', $tmp);
                $tmp = [];
            }
        }
        if (!empty($tmp)) {
            $result[] = \implode(' ', $tmp);
        }
        return $result;
    }

}

if (!function_exists('arr_el_max_length')) {
    /**
     * @param array $data
     * @return int
     */
    function arr_el_max_length(array $data): int
    {
        $maxLength = 0;
        foreach ($data as $value) {
            $len = \strlen((string)$value);
            if ($maxLength < $len) {
                $maxLength = $len;
            }
        }
        return $maxLength;
    }

}

if (!function_exists('unset_first')) {
    function unset_first(array $data): iterable
    {
        $key = array_key_first($data);
        if (null !== $key) {
            unset($data[$key]);
        }
        return $data;
    }
}

if (!function_exists('array_key_first')) {
    /**
     * @param array $data
     * @return int|null|string
     */
    function array_key_first(array $data)
    {
        reset($data);
        return key($data);
    }
}

if (!function_exists('array_key_last')) {
    /**
     * @param array $data
     * @return int|null|string
     */
    function array_key_last(array $data)
    {
        end($data);
        return key($data);
    }
}
