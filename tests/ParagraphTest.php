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
                "  \n\n"
            ],
            [
                new Paragraph(""),
                ""
            ],
            [
                new Paragraph(),
                ""
            ]
        ];
    }
}
