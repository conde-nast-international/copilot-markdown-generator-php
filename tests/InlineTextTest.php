<?php
namespace CopilotTags\Tests;
use CopilotTags\InlineText;
use CopilotTags\Embed;
use CopilotTags\EmbedSubtype;

class InlineTextTest extends CopilotTagTest
{
    public static function expectedRenders()
    {
        return array(
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
            "expect text with internal newlines" => array(
                new InlineText("First\nSecond\n\n\nThird", ":"),
                ":First:\n:Second:\n\n:Third:"
            ),
            "expect only whitespace with subtype" => array(
                new InlineText("   ", "¯\_(ツ)_/¯"),
                "   "
            ),
            "expect empty string" => array(
                new InlineText(""),
                ""
            ),
            "expect empty string with subtype" => array(
                new InlineText("", "~"),
                ""
            ),
            "expect newline to be preserved with spaces before" => array(
                new InlineText("  \n"),
                "\n"
            ),
            "expect newline to be preserved with spaces after" => array(
                new InlineText("\n  "),
                "\n"
            ),
            "expect a single newline to be preserved" => array(
                new InlineText("\n"),
                "\n"
            ),
            "expect multiple newlines to be preserved" => array(
                new InlineText("\n\n\n\n"),
                "\n\n"
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
