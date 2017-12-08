<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\Heading;

class HeadingTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            [
                new Heading("Hello world!", 3),
                "### Hello world!\n"
            ],
            [
                new Heading("  "),
                "  \n"
            ],
            [
                new Heading(""),
                ""
            ],
            [
                new Heading("", 4),
                ""
            ],
            [
                new Heading(),
                ""
            ],
            [
                new Heading("Hello world!"),
                "## Hello world!\n"
            ],
            [
                new Heading("Hello world!", 1),
                "## Hello world!\n"
            ]
        ];
    }
}