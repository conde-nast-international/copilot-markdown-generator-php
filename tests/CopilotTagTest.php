<?php
namespace CopilotTags\Tests;
use PHPUnit\Framework\TestCase;

abstract class CopilotTagTest extends TestCase
{
    /**
     * @dataProvider expectedWrites
     */
    public function testWrite($tag, $expected)
    {
        $this->assertEquals($expected, $tag->write());
    }

    /**
     * @dataProvider expectedBeautifys
     */
    public function testBeautify($class = NULL, $markdown = "", $expected = "")
    {
        if(!isset($class)) return;
        $this->assertEquals($expected, $class::beautify($markdown));
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

    abstract public static function expectedWrites();
    public static function expectedBeautifys() { return [[]]; }
    public static function expectedConstructExceptions() { return [[]]; }
}
