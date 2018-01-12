<?php
namespace CopilotTags\Tests;
use CopilotTags\BlockQuote;

class BlockQuoteTest extends CopilotTagTest
{
    public static function expectedWrites()
    {
        return [
            "expect single text line" => [
                new BlockQuote("Hello world!"),
                "\n> Hello world!\n"
            ],
            "expect multiple text lines" => [
                new BlockQuote("The city’s central computer told you?\nR2D2,\nyou know better than to trust a strange computer!"),
                "\n> The city’s central computer told you?\n> R2D2,\n> you know better than to trust a strange computer!\n"
            ],
            "expect multiple lines with leading and trailing whitespace preserved" => [
                new BlockQuote("\n\nThe city’s central computer told you?\nR2D2,\nyou know better than to trust a strange computer!\n"),
                "\n> \n> \n> The city’s central computer told you?\n> R2D2,\n> you know better than to trust a strange computer!\n> \n"
            ],
            "expect whitespace to be preserved" => [
                new BlockQuote("  "),
                "\n>   \n"
            ],
            "expect empty string" => [
                new BlockQuote(""),
                "\n\n"
            ],
            "expect multiple lines of whitespace only to be preserved with spaces on the first line" => [
                new BlockQuote("  \n"),
                "\n>   \n> \n"
            ],
            "expect multiple lines of whitespace only to be preserved with spaces on the last line" => [
                new BlockQuote("\n  "),
                "\n> \n>   \n"
            ],
            "expect a single newline to be preserved" => [
                new BlockQuote("\n"),
                "\n> \n> \n"
            ],
            "expect multiple newlines to be preserved" => [
                new BlockQuote("\n\n\n\n"),
                "\n> \n> \n> \n> \n> \n"
            ]
        ];
    }

    public static function expectedConstructExceptions()
    {
        return [
            "expect null \$text argument to throw InvalidArgumentException" => [
                BlockQuote::class,
                [NULL],
                \InvalidArgumentException::class
            ],
            "expect boolean false \$text argument to throw InvalidArgumentException" => [
                BlockQuote::class,
                [FALSE],
                \InvalidArgumentException::class
            ],
            "expect boolean true \$text argument to throw InvalidArgumentException" => [
                BlockQuote::class,
                [TRUE],
                \InvalidArgumentException::class
            ],
            "expect number \$text argument to throw InvalidArgumentException" => [
                BlockQuote::class,
                [5],
                \InvalidArgumentException::class
            ],
            "expect array \$text argument to throw InvalidArgumentException" => [
                BlockQuote::class,
                [[]],
                \InvalidArgumentException::class
            ]
        ];
    }
}
