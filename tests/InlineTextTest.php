<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\InlineText;

class InlineTextTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            [
                new InlineText(""),
                ""
            ],
            [
                new InlineText("", "~"),
                ""
            ],
            [
                new InlineText("Hello world!"),
                "Hello world!"
            ],
            [
                new InlineText("Hello world!", "¯\_(ツ)_/¯"),
                "¯\_(ツ)_/¯Hello world!¯\_(ツ)_/¯"
            ],
            [
                new InlineText("  Hello world!  ", "¯\_(ツ)_/¯"),
                "  ¯\_(ツ)_/¯Hello world!¯\_(ツ)_/¯  "
            ],
            [
                new InlineText("   ", "¯\_(ツ)_/¯"),
                "   "
            ],
            [
                new InlineText("First\nSecond ", ":"),
                ":First:\n:Second: "
            ],
            [
                new InlineText("[#image: /photos/123ID]|||caption|||", ":"),
                "\n[#image: /photos/123ID]|||caption|||\n"
            ],
            [
                new InlineText("[#image: /photos/123ID]|||caption|||Hello world!", ":"),
                "\n[#image: /photos/123ID]|||caption|||\n:Hello world!:"
            ],
            [
                new InlineText("Hello world! [#image: /photos/123ID]|||caption|||", ":"),
                ":Hello world!: \n[#image: /photos/123ID]|||caption|||\n"
            ],
            [
                new InlineText("Hello world! [#image: /photos/123ID]|||caption||| It's me again", ":"),
                ":Hello world!: \n[#image: /photos/123ID]|||caption|||\n :It's me again:"
            ]
        ];
    }

    public function expectedConstructExceptions()
    {
        return [
            [
                InlineText::class,
                [NULL],
                InvalidArgumentException::class
            ],
            [
                InlineText::class,
                [FALSE],
                InvalidArgumentException::class
            ],
            [
                InlineText::class,
                [TRUE],
                InvalidArgumentException::class
            ],
            [
                InlineText::class,
                [5],
                InvalidArgumentException::class
            ],
            [
                InlineText::class,
                [[]],
                InvalidArgumentException::class
            ]
        ];
    }
}
