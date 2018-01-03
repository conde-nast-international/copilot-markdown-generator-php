<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\InlineText;

class InlineTextTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            "expect empty string" => [
                new InlineText(""),
                ""
            ],
            "expect empty string with subtype" => [
                new InlineText("", "~"),
                ""
            ],
            "expect text without subtype" => [
                new InlineText("Hello world!"),
                "Hello world!"
            ],
            "expect text with subtype" => [
                new InlineText("Hello world!", "¯\_(ツ)_/¯"),
                "¯\_(ツ)_/¯Hello world!¯\_(ツ)_/¯"
            ],
            "expect text with leading and trailing whitespace" => [
                new InlineText("  Hello world!  ", "¯\_(ツ)_/¯"),
                "  ¯\_(ツ)_/¯Hello world!¯\_(ツ)_/¯  "
            ],
            "expect only whitespace and subtype" => [
                new InlineText("   ", "¯\_(ツ)_/¯"),
                "   "
            ],
            "expect text with internal newline and trailing whitespace" => [
                new InlineText("First\nSecond ", ":"),
                ":First:\n:Second: "
            ],
            "expect only embed" => [
                new InlineText("[#image: /photos/123ID]|||caption|||", ":"),
                "\n[#image: /photos/123ID]|||caption|||\n"
            ],
            "expect embed with text after" => [
                new InlineText("[#image: /photos/123ID]|||caption|||Hello world!", ":"),
                "\n[#image: /photos/123ID]|||caption|||\n:Hello world!:"
            ],
            "expect embed with text before" => [
                new InlineText("Hello world! [#image: /photos/123ID]|||caption|||", ":"),
                ":Hello world!: \n[#image: /photos/123ID]|||caption|||\n"
            ],
            "expect embed with text before and after" => [
                new InlineText("Hello world! [#image: /photos/123ID]|||caption||| It's me again", ":"),
                ":Hello world!: \n[#image: /photos/123ID]|||caption|||\n :It's me again:"
            ]
        ];
    }

    public function expectedConstructExceptions()
    {
        return [
            "expect null argument to throw InvalidArgumentException" => [
                InlineText::class,
                [NULL],
                InvalidArgumentException::class
            ],
            "expect boolean false argument to throw InvalidArgumentException" => [
                InlineText::class,
                [FALSE],
                InvalidArgumentException::class
            ],
            "expect boolean true argument to throw InvalidArgumentException" => [
                InlineText::class,
                [TRUE],
                InvalidArgumentException::class
            ],
            "expect number argument to throw InvalidArgumentException" => [
                InlineText::class,
                [5],
                InvalidArgumentException::class
            ],
            "expect array argument to throw InvalidArgumentException" => [
                InlineText::class,
                [[]],
                InvalidArgumentException::class
            ]
        ];
    }
}
