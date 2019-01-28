<?php
/**
 * User: alec
 * Date: 03.12.18
 * Time: 17:10
 */

namespace AlecRabbit\Tests\Helpers;


use const \AlecRabbit\Helpers\Strings\Constants\STR_TRUE;
use const \AlecRabbit\Helpers\Strings\Constants\STR_FALSE;
use const \AlecRabbit\Helpers\Strings\Constants\STR_EMPTY;
use const \AlecRabbit\Helpers\Strings\Constants\STR_NULL;
use PHPUnit\Framework\TestCase;

class ConstantsTest extends TestCase
{
    /** @test */
    public function constants(): void
    {
        $this->assertEquals(STR_TRUE, 'true');
        $this->assertEquals(STR_FALSE, 'false');
        $this->assertEquals(STR_EMPTY, 'empty');
        $this->assertEquals(STR_NULL, 'null');
    }
}