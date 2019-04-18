<?php

declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

final class GuineaPigClass
{
    protected static $protectedStaticField = 20;
    private static $privateStaticField = 10;
    protected $protectedField = 2;
    private $privateField = 1;

    private function __construct()
    {
    }

    protected static function protectedStaticMethod(): int
    {
        return 3;
    }

    protected static function privateStaticMethod(): int
    {
        return 4;
    }

    protected function protectedMethod(): int
    {
        return 5;
    }

    protected function privateMethod(): int
    {
        return 6;
    }
}
