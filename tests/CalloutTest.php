<?php
namespace CopilotTags\Tests;
use CopilotTags\Callout;

class CalloutTest extends CopilotTagTest
{
    public static function expectedRenders()
    {
        return array(
            "expect text with subtype" => array(
                new Callout("Hello world!", "type"),
                "\n\n+++type\nHello world!\n+++\n\n"
            ),
            "expect text without subtype" => array(
                new Callout("Hello world!"),
                "\n\n+++\nHello world!\n+++\n\n"
            ),
            "expect newlines to be preserved" => array(
                new Callout("\n\nHello\nworld!\n"),
                "\n\n+++\n\nHello\nworld!\n\n+++\n\n"
            ),
            "expect only whitespace" => array(
                new Callout("  "),
                "\n\n"
            ),
            "expect empty string" => array(
                new Callout(""),
                "\n\n"
            ),
            "expect multiple whitespace-only lines with spaces on the first line" => array(
                new Callout("  \n"),
                "\n\n"
            ),
            "expect multiple whitespace-only lines with spaces on the last line" => array(
                new Callout("\n  "),
                "\n\n"
            ),
            "expect single newline" => array(
                new Callout("\n"),
                "\n\n"
            ),
            "expect more than 2 newlines" => array(
                new Callout("\n\n\n\n"),
                "\n\n"
            )
        );
    }

    public static function expectedConstructExceptions()
    {
        return array(
            "expect null \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\Callout',
                array(NULL),
                '\InvalidArgumentException'
            ),
            "expect boolean false \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\Callout',
                array(FALSE),
                '\InvalidArgumentException'
            ),
            "expect boolean true \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\Callout',
                array(TRUE),
                '\InvalidArgumentException'
            ),
            "expect number \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\Callout',
                array(5),
                '\InvalidArgumentException'
            ),
            "expect array \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\Callout',
                array(array()),
                '\InvalidArgumentException'
            ),
            "expect null \$subtype argument to throw InvalidArgumentException" => array(
                'CopilotTags\Callout',
                array("", NULL),
                '\InvalidArgumentException'
            ),
            "expect boolean false \$subtype argument to throw InvalidArgumentException" => array(
                'CopilotTags\Callout',
                array("", FALSE),
                '\InvalidArgumentException'
            ),
            "expect boolean true \$subtype argument to throw InvalidArgumentException" => array(
                'CopilotTags\Callout',
                array("", TRUE),
                '\InvalidArgumentException'
            ),
            "expect number \$subtype argument to throw InvalidArgumentException" => array(
                'CopilotTags\Callout',
                array("", 5),
                '\InvalidArgumentException'
            ),
            "expect array \$subtype argument to throw InvalidArgumentException" => array(
                'CopilotTags\Callout',
                array("", array()),
                '\InvalidArgumentException'
            )
        );
    }
}
