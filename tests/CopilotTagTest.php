<?php
namespace CopilotTags\Tests;
use PHPUnit\Framework\TestCase;

abstract class CopilotTagTest extends TestCase
{
    /**
     * @dataProvider expectedRenders
     */
    public function testRender($tag, $expected)
    {
        $this->assertEquals($expected, $tag->render());
    }

    /**
     * @dataProvider expectedConstructExceptions
     */
    public function testConstructException($class = NULL, $args = [], $exceptionType = Exception::class)
    {
        if(!isset($class)) return;
        $this->expectException($exceptionType);
        new $class(...$args);
    }

    public static function expectedRenders() {}
    public static function expectedConstructExceptions() { return [[]]; }
}
