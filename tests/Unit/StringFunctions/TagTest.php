<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Helpers;

use function AlecRabbit\tag;

class TagTest extends HelpersTestCase
{
    /**
     * @test
     * @dataProvider tagDataProvider
     * @param string $expected
     * @param array $args
     */
    public function functionTag($expected, $args): void
    {
        $this->assertEquals($expected, tag(...$args));
    }

    public function tagDataProvider(): array
    {
        $str = 'str';
        return [
            [$str, [$str]],
            ['<br>' . $str . '</br>', [$str, 'br']],
            ['<tag>' . $str . '</tag>', [$str, 'tag']],
            ['<info>' . $str . '</info>', [$str, 'info']],
        ];
    }

    /**
     * @test
     * @dataProvider tagDataProviderExceptions
     * @param string $expected
     * @param array $args
     */
    public function functionTagExceptions($expected, $args): void
    {
        $this->expectException($expected);
        $this->assertEquals($expected, tag(...$args));
    }

    public function tagDataProviderExceptions(): array
    {
        return [
            [\ArgumentCountError::class, []],
            [\TypeError::class, [null]],
        ];
    }
}
