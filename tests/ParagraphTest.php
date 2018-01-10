<?php
namespace CopilotTags\Tests;
use CopilotTags\Paragraph;

class ParagraphTest extends CopilotTagTest
{
    public static function expectedWrites()
    {
        return [
            "expect plain text" => [
                new Paragraph("Hello world!"),
                "Hello world!\n\n"
            ],
            "expect only whitespace to be removed" => [
                new Paragraph("  "),
                ""
            ],
            "expect empty string" => [
                new Paragraph(""),
                ""
            ]
        ];
    }

    public static function expectedConstructExceptions()
    {
        return [
            "expect null \$text argument to throw InvalidArgumentException" => [
                Paragraph::class,
                [NULL],
                \InvalidArgumentException::class
            ],
            "expect boolean false \$text argument to throw InvalidArgumentException" => [
                Paragraph::class,
                [FALSE],
                \InvalidArgumentException::class
            ],
            "expect boolean true \$text argument to throw InvalidArgumentException" => [
                Paragraph::class,
                [TRUE],
                \InvalidArgumentException::class
            ],
            "expect number \$text argument to throw InvalidArgumentException" => [
                Paragraph::class,
                [5],
                \InvalidArgumentException::class
            ],
            "expect array \$text argument to throw InvalidArgumentException" => [
                Paragraph::class,
                [[]],
                \InvalidArgumentException::class
            ]
        ];
    }
}
