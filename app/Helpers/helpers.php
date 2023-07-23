<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Round $number up to specified $precision (number of digits after the decimal point)
if (! function_exists('ceiling')) {
    /**
     * @param float|int $number
     * @param int       $precision
     *
     * @return float
     */
    function ceiling(float|int $number, int $precision = 1): float
    {
        $mult = 10 ** max($precision, 0);

        return ceil($number * $mult) / $mult;
    }
}

// Key Value array explode function
if (! function_exists('kv_implode')) {
    /**
     * @param array<string> $array
     * @param string        $keyDelimiter
     * @param string        $delimiter
     *
     * @return string
     */
    function kv_implode(
        array $array,
        string $keyDelimiter = ':',
        string $delimiter = ','
    ): string {
        $str = '';
        foreach ($array as $key => $item) {
            $str .= $key . $keyDelimiter . $item . $delimiter;
        }

        return rtrim($str, $delimiter);
    }
}
// Check if array is multidimensional
if (! function_exists('is_multi')) {
    /**
     * @param array<array<mixed>> $a
     *
     * @return bool
     */
    function is_multi(array $a): bool
    {
        foreach ($a as $v) {
            if (is_array($v)) {
                return true;
            }
        }

        return false;
    }
}
// Multiple elements array unset
if (! function_exists('multi_unset')) {
    /**
     * @template T
     *
     * @param array<string> $removeKeys
     * @param array<T>      $a
     *
     * @return array<T>
     */
    function multi_unset(array $removeKeys, array $a): array
    {
        foreach ($removeKeys as $key) {
            unset($a[$key]);
        }

        return $a;
    }
}

// Multiple elements array unset
if (! function_exists('is_soft_deletable')) {
    /**
     * @param Model $model
     *
     * @return bool
     */
    function is_soft_deletable(Model $model): bool
    {
        return in_array(
            SoftDeletes::class,
            class_uses($model),
            true
        );
    }
}
