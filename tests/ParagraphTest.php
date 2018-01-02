<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\Paragraph;

class ParagraphTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            [
                new Paragraph("Hello world!"),
                "Hello world!\n\n"
            ],
            [
                new Paragraph("  "),
                "\n\n"
            ],
            [
                new Paragraph(""),
                ""
            ]
        ];
    }

    public function expectedConstructExceptions()
    {
        return [
            [
                Paragraph::class,
                [NULL],
                InvalidArgumentException::class
            ],
            [
                Paragraph::class,
                [FALSE],
                InvalidArgumentException::class
            ],
            [
                Paragraph::class,
                [TRUE],
                InvalidArgumentException::class
            ],
            [
                Paragraph::class,
                [5],
                InvalidArgumentException::class
            ],
            [
                Paragraph::class,
                [[]],
                InvalidArgumentException::class
            ]
        ];
    }
}
