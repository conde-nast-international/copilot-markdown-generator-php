<?php
namespace CopilotTags\Tests;
use CopilotTags\InlineText;

class InlineTextTest extends CopilotTagTest
{
    public static function expectedRenders()
    {
        return array(
            "expect empty string" => array(
                new InlineText(""),
                ""
            ),
            "expect empty string with subtype" => array(
                new InlineText("", "~"),
                ""
            ),
            "expect text without subtype" => array(
                new InlineText("Hello world!"),
                "Hello world!"
            ),
            "expect text with subtype" => array(
                new InlineText("Hello world!", "¯\_(ツ)_/¯"),
                "¯\_(ツ)_/¯Hello world!¯\_(ツ)_/¯"
            ),
            "expect text with leading and trailing whitespace" => array(
                new InlineText("  Hello world!  ", "¯\_(ツ)_/¯"),
                "  ¯\_(ツ)_/¯Hello world!¯\_(ツ)_/¯  "
            ),
            "expect only whitespace and subtype" => array(
                new InlineText("   ", "¯\_(ツ)_/¯"),
                "   "
            ),
            "expect text with internal newline and trailing whitespace" => array(
                new InlineText("First\nSecond ", ":"),
                ":First:\n:Second: "
            ),
            "expect only embed" => array(
                new InlineText("[#image: /photos/123ID]|||caption|||", ":"),
                "\n[#image: /photos/123ID]|||caption|||\n"
            ),
            "expect embed with text after" => array(
                new InlineText("[#image: /photos/123ID]|||caption|||Hello world!", ":"),
                "\n[#image: /photos/123ID]|||caption|||\n:Hello world!:"
            ),
            "expect embed with text before" => array(
                new InlineText("Hello world! [#image: /photos/123ID]|||caption|||", ":"),
                ":Hello world!: \n[#image: /photos/123ID]|||caption|||\n"
            ),
            "expect embed with text before and after" => array(
                new InlineText("Hello world! [#image: /photos/123ID]|||caption||| It's me again", ":"),
                ":Hello world!: \n[#image: /photos/123ID]|||caption|||\n :It's me again:"
            )
        );
    }

    public static function expectedConstructExceptions()
    {
        return array(
            "expect null \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\InlineText',
                array(NULL),
                '\InvalidArgumentException'
            ),
            "expect boolean false \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\InlineText',
                array(FALSE),
                '\InvalidArgumentException'
            ),
            "expect boolean true \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\InlineText',
                array(TRUE),
                '\InvalidArgumentException'
            ),
            "expect number \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\InlineText',
                array(5),
                '\InvalidArgumentException'
            ),
            "expect array \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\InlineText',
                array(array()),
                '\InvalidArgumentException'
            ),
            "expect null \$delimiter argument to throw InvalidArgumentException" => array(
                'CopilotTags\InlineText',
                array("", NULL),
                '\InvalidArgumentException'
            ),
            "expect boolean false \$delimiter argument to throw InvalidArgumentException" => array(
                'CopilotTags\InlineText',
                array("", FALSE),
                '\InvalidArgumentException'
            ),
            "expect boolean true \$delimiter argument to throw InvalidArgumentException" => array(
                'CopilotTags\InlineText',
                array("", TRUE),
                '\InvalidArgumentException'
            ),
            "expect number \$delimiter argument to throw InvalidArgumentException" => array(
                'CopilotTags\InlineText',
                array("", 5),
                '\InvalidArgumentException'
            ),
            "expect array \$delimiter argument to throw InvalidArgumentException" => array(
                'CopilotTags\InlineText',
                array("", array()),
                '\InvalidArgumentException'
            )
        );
    }
}
