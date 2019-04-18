<?php declare(strict_types=1);

namespace AlecRabbit\Helpers\Classes;

use const AlecRabbit\Helpers\Constants\EMPTY_ELEMENTS;

/**
 * Class ColumnizeArray
 *
 * @internal
 */
class ColumnizeArray
{
    /**
     * @param array $arr
     * @param int $columns
     * @param callable|null $preprocessor
     * @param int $pad
     * @return array
     */
    public static function process(
        array $arr,
        int $columns = 10,
        ?callable $preprocessor = null,
        int $pad = STR_PAD_RIGHT
    ): array {
        $result = $tmp = [];
        $maxLength = static::getMaxLength($arr, $preprocessor);
        $rowEmpty = true;
        foreach ($arr as $element) {
            $tmp[] = \str_pad((string)$element, $maxLength, ' ', $pad);
            $rowEmpty = $rowEmpty && \in_array($element, EMPTY_ELEMENTS, true);
            if (\count($tmp) >= $columns) {
                [$result, $rowEmpty, $tmp] = static::updateResult($result, $rowEmpty, $tmp);
            }
        }
        if (!empty($tmp)) {
            [$result, $rowEmpty, $tmp] = static::updateResult($result, $rowEmpty, $tmp);
        }
        return $result;
    }


    /**
     * @param array $data
     * @param callable|null $preprocessor
     * @return int
     */
    protected static function getMaxLength(array &$data, ?callable $preprocessor): int
    {
        $maxLength = 0;
        foreach ($data as $key => &$element) {
            if (\is_array($element)) {
                throw new \RuntimeException('Passed array is multidimensional.');
            }
            if ($preprocessor instanceof \Closure) {
                $preprocessor($element, $key);
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
     * @return array
     */
    protected static function updateResult(array $result, bool $rowEmpty, array $tmp): array
    {
        $result[] = \implode($rowEmpty ? '' : ' ', $tmp);
        $rowEmpty = true;
        $tmp = [];
        return [$result, $rowEmpty, $tmp];
    }
}
