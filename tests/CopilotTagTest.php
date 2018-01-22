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
    public function testConstructException($class = NULL, $args = array(), $exception = '\Exception')
    {
        if (!isset($class)) return;
        $this->setExpectedExceptionRegExp($exception, '/::__construct.+argument \$.+Given:/');
        $new = new \ReflectionClass($class);
        $instance = $new->newInstanceArgs($args);
    }

    public static function expectedConstructExceptions()
    {
        return array(array());
    }
}
