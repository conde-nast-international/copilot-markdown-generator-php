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
                new Heading("Hello world!"),
                "## Hello world!\n"
            ],
            [
                new Heading("Hello world!", 1),
                "## Hello world!\n"
            ]
        ];
    }

    public function expectedConstructExceptions()
    {
        return [
            [
                Heading::class,
                [NULL],
                InvalidArgumentException::class
            ],
            [
                Heading::class,
                [FALSE],
                InvalidArgumentException::class
            ],
            [
                Heading::class,
                [TRUE],
                InvalidArgumentException::class
            ],
            [
                Heading::class,
                [5],
                InvalidArgumentException::class
            ],
            [
                Heading::class,
                [[]],
                InvalidArgumentException::class
            ]
        ];
    }
}
