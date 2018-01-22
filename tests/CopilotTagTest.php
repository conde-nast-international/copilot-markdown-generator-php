<?php
namespace CopilotTags\Tests;
use PHPUnit\Framework\TestCase;

abstract class CopilotTagTest extends TestCase
{
    private static $EXCEPTION_MESSAGE_PATTERN = array(
        '\InvalidArgumentException' => '/::__construct.+argument \$.+Given:/'
    );

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
    public function testConstructException($class = NULL, $args = array(), $exceptionType = '\Exception')
    {
        if (!isset($class)) return;
        if (array_key_exists($exceptionType, self::$EXCEPTION_MESSAGE_PATTERN)) {
            $this->setExpectedExceptionRegExp($exceptionType, self::$EXCEPTION_MESSAGE_PATTERN[$exceptionType]);
        } else {
            $this->setExpectedException($exceptionType);
        }
        $new = new \ReflectionClass($class);
        $instance = $new->newInstanceArgs($args);
    }

    public static function expectedConstructExceptions()
    {
        return array(array());
    }
}
