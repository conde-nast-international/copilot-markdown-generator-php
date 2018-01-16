<?php
namespace CopilotTags\Tests;
use CopilotTags\Paragraph;

class ParagraphTest extends CopilotTagTest
{
    public static function expectedRenders()
    {
        return array(
            "expect plain text" => array(
                new Paragraph("Hello world!"),
                "\n\nHello world!\n\n"
            ),
            "expect only whitespace" => array(
                new Paragraph("  "),
                "\n\n"
            ),
            "expect empty string" => array(
                new Paragraph(""),
                "\n\n"
            )
        );
    }

    public static function expectedConstructExceptions()
    {
        return array(
            "expect null \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\Paragraph',
                array(NULL),
                '\InvalidArgumentException'
            ),
            "expect boolean false \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\Paragraph',
                array(FALSE),
                '\InvalidArgumentException'
            ),
            "expect boolean true \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\Paragraph',
                array(TRUE),
                '\InvalidArgumentException'
            ),
            "expect number \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\Paragraph',
                array(5),
                '\InvalidArgumentException'
            ),
            "expect array \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\Paragraph',
                array(array()),
                '\InvalidArgumentException'
            )
        );
    }
}
