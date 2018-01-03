<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\Blockquote;

class BlockquoteTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            "expect single text line" => [
                new Blockquote("Hello world!"),
                "> Hello world!\n"
            ],
            "expect multiple text lines" => [
                new Blockquote("The city’s central computer told you?\nR2D2,\nyou know better than to trust a strange computer!"),
                "> The city’s central computer told you?\n> R2D2,\n> you know better than to trust a strange computer!\n"
            ],
            "expect multiple lines with leading and trailing whitespace preserved" => [
                new Blockquote("\n\nThe city’s central computer told you?\nR2D2,\nyou know better than to trust a strange computer!\n"),
                "> \n> \n> The city’s central computer told you?\n> R2D2,\n> you know better than to trust a strange computer!\n> \n"
            ],
            "expect whitespace to be preserved" => [
                new Blockquote("  "),
                ">   \n"
            ],
            "expect empty string" => [
                new Blockquote(""),
                ""
            ],
            "expect multiple lines of whitespace only to be preserved with spaces on the first line" => [
                new Blockquote("  \n"),
                ">   \n> \n"
            ],
            "expect multiple lines of whitespace only to be preserved with spaces on the last line" => [
                new Blockquote("\n  "),
                "> \n>   \n"
            ],
            "expect a single newline to be preserved" => [
                new Blockquote("\n"),
                "> \n> \n"
            ],
            "expect multiple newlines to be preserved" => [
                new Blockquote("\n\n\n\n"),
                "> \n> \n> \n> \n> \n"
            ]
        ];
    }

    public function expectedConstructExceptions()
    {
        return [
            "expect null argument to throw InvalidArgumentException" => [
                Blockquote::class,
                [NULL],
                InvalidArgumentException::class
            ],
            "expect boolean false argument to throw InvalidArgumentException" => [
                Blockquote::class,
                [FALSE],
                InvalidArgumentException::class
            ],
            "expect boolean true argument to throw InvalidArgumentException" => [
                Blockquote::class,
                [TRUE],
                InvalidArgumentException::class
            ],
            "expect number argument to throw InvalidArgumentException" => [
                Blockquote::class,
                [5],
                InvalidArgumentException::class
            ],
            "expect array argument to throw InvalidArgumentException" => [
                Blockquote::class,
                [[]],
                InvalidArgumentException::class
            ]
        ];
    }
}
