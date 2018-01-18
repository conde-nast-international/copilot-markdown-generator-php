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
            "expect newlines to be preserved" => array(
                new Paragraph("\n\nHello\nworld!\n"),
                "\n\nHello\nworld!\n\n"
            ),
            "expect multiple internal newlines to be preserved" => array(
                new Paragraph("\n\nHello\n\n\nworld!\n"),
                "\n\nHello\n\nworld!\n\n"
            ),
            "expect only whitespace" => array(
                new Paragraph("  "),
                "\n\n"
            ),
            "expect empty string" => array(
                new Paragraph(""),
                "\n\n"
            ),
            "expect multiple lines of whitespace only to be preserved with spaces on the first line" => array(
                new Paragraph("  \n"),
                "\n\n"
            ),
            "expect multiple lines of whitespace only to be preserved with spaces on the last line" => array(
                new Paragraph("\n  "),
                "\n\n"
            ),
            "expect a single newline to be preserved" => array(
                new Paragraph("\n"),
                "\n\n"
            ),
            "expect multiple newlines to be preserved" => array(
                new Paragraph("\n\n\n\n"),
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
