<?php
namespace CopilotTags\Tests;
use CopilotTags\Text;

class TextTest extends CopilotTagTest
{
    public static function expectedRenders()
    {
        return array(
            "expect plain text" => array(
                new Text("Hello world!"),
                "Hello world!"
            ),
            "expect only whitespace to be preserved" => array(
                new Text("  "),
                "  "
            ),
            "expect empty string" => array(
                new Text(""),
                ""
            ),
            "expect internal newline" => array(
                new Text("Hello\nworld!"),
                "Hello\nworld!"
            ),
            "expect internal carriage return" => array(
                new Text("Hello\rworld!"),
                "Hello\nworld!"
            ),
            "expect internal CRLF" => array(
                new Text("Hello\r\nworld!"),
                "Hello\nworld!"
            ),
            "expect more than 2 newlines to be reduced to 2" => array(
                new Text("Hello\n\n\n\nworld!"),
                "Hello\n\nworld!"
            ),
            "expect whitespace on a line with no non-whitespace characters to be removed" => array(
                new Text("Hello\n       \nworld!"),
                "Hello\n\nworld!"
            ),
            "expect whitespace on a line with no non-whitespace characters to be removed and more than 2 newlines to be reduced to 2" => array(
                new Text("Hello\n\n\n       \nworld!"),
                "Hello\n\nworld!"
            ),
            "expect whitespace on multiple lines with no non-whitespace characters to be removed and more than 2 newlines to be reduced to 2" => array(
                new Text("Hello\n       \n\n       \nworld!"),
                "Hello\n\nworld!"
            ),
            "expect whitespace on the first line with no non-whitespace characters to be removed" => array(
                new Text("   \nHello\n\n\n       \nworld!"),
                "\nHello\n\nworld!"
            ),
            "expect whitespace on the last line with no non-whitespace characters to be removed" => array(
                new Text("Hello\n\n\n       \nworld!  \n    "),
                "Hello\n\nworld!  \n"
            )
        );
    }

    public static function expectedConstructExceptions()
    {
        return array(
            "expect null \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\Text',
                array(NULL),
                '\InvalidArgumentException'
            ),
            "expect boolean false \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\Text',
                array(FALSE),
                '\InvalidArgumentException'
            ),
            "expect boolean true \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\Text',
                array(TRUE),
                '\InvalidArgumentException'
            ),
            "expect number \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\Text',
                array(5),
                '\InvalidArgumentException'
            ),
            "expect array \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\Text',
                array(array()),
                '\InvalidArgumentException'
            )
        );
    }
}
